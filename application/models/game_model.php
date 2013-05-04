<?php

class Game_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    function get($id)
    {
        $query = $this->db->get_where('game', array('id' => $id), 1);
        foreach ($query->result() as $row)
        {
            return $row;
        }
        return FALSE;
    }

    function get_by_steam($email, $id)
    {
        $this->db->select('*');
        $this->db->from('game');
        $this->db->join('user', 'user.id = game.user_id');
        $this->db->where(array('steam_id' => $id), 1);

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            if ($row->email == $email) {
                return $row;
            }
        }
        return FALSE;
    }

    function get_by_token($token)
    {
        $query = $this->db->get_where('game', array('game_token' => $token), 1);
        foreach ($query->result() as $row)
        {
            return $row;
        }
        return FALSE;
    }

    function get_by_public_token($token)
    {
        $query = $this->db->get_where('game', array('public_token' => $token), 1);
        foreach ($query->result() as $row)
        {
            return $row;
        }
        return FALSE;
    }

    function parse_steam_url($url)
    {
        $data = parse_url($url);

        if (!isset($data['query'])) {
            //show_error('');
            throw new Exception("Bad Query");
        }

        $query = $data['query'];

        $parts = explode('&', $query);
        $id = FALSE;

        foreach($parts as $part) {
            $sub_parts = explode('=', $part);

            if ($sub_parts[0] == 'id') {
                $id = $sub_parts[1];
            }
        }

        return $id;
    }

    public function get_dev_random()
    {
        $pr_bits = '';
        $fp = @fopen('/dev/urandom','rb');
        if ($fp !== false) {
            $pr_bits .= @fread($fp, 16);
            @fclose($fp);
        } else {
            return uniqid('', TRUE);;
        }
        return base64_encode(urlencode(base64_encode($pr_bits)));
    }

    public function get_random()
    {
        return preg_replace("/[^a-zA-Z0-9\s]/", "", $this->get_dev_random());
    }


    function create($user_id, $steam_id)
    {
        $token = $this->get_random();
        $public_token = $this->get_random();

        $data = array(
            'steam_id' => $steam_id,
            'user_id' => $user_id,
            'game_token' => $token,
            'public_token' => $public_token
        );

        $this->db->insert('game', $data);

        return $this->get_by_token($token);
    }

    function send_access($email, $steam_id)
    {
        $game = $this->get_by_steam($email, $steam_id);

        $url = site_url('welcome/access/' . $game->game_token);
        $product = $this->config->item('product_name');

        $to      = $email;
        $subject = $product . ' Access';
$message = <<<EOD
Hi,
<br><br>
Go to <a href="$url">this URL</a> to confirm your email and learn more about embedding the $product widget.
<br><br>
Thanks,
$product
EOD;

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: support@kumobius.com' . "\r\n";
        $headers .= 'Reply-To: support@kumobius.com' . "\r\n";
        $headers .= 'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
    }


    function scrape($game_id)
    {
        require_once('simplehtmldom/simple_html_dom.php');

        $game = $this->get($game_id);

        $html = file_get_contents("http://steamcommunity.com/sharedfiles/filedetails/?id=" . $game->steam_id);
        $results = explode('mainContents', $html);
        $results = explode('friendsPickerModal', $results[1]);

        $main = $results[0];

        $post_html = str_get_html($main);
//        $post_html = str_get_html($html);

        $first_img = $post_html->find('#previewImageMain', 0);
        
        if ($first_img !== null) {
            $image_src = $first_img->src;
        }

        $title = $post_html->find('div.workshopItemTitle', 0)->plaintext;

        $steam_data = array(
            'genres' => array(),
            'platforms' => array(),
            'languages' => array(),
            'players' => array(),
        );
        
        $genres = $post_html->find('div.workshopTags', 0);
        $platforms = $genres->next_sibling();
        $languages = $platforms->next_sibling();
        $players = $languages->next_sibling();

        $anchors = $genres->find('a');
        foreach($anchors as $anchor)
        {
            $steam_data['genres'][] = strtolower($anchor->plaintext);
        }
        
        $anchors = $platforms->find('a');
        foreach($anchors as $anchor)
        {
            $steam_data['platforms'][] = strtolower($anchor->plaintext);
        }

        $anchors = $languages->find('a');
        foreach($anchors as $anchor)
        {
            $steam_data['languages'][] = strtolower($anchor->plaintext);
        }

        $anchors = $players->find('a');
        foreach($anchors as $anchor)
        {
            $steam_data['players'][] = strtolower($anchor->plaintext);
        }

        //$paging = $post_html->find('.commentthread_paging', 0);
        //$links = $paging->find('.commentthread_pagelink', 0);

        $data = array(
            'steam_title' => $title,
            'steam_data' => json_encode($steam_data),
            'steam_icon_url' => $image_src
        );

        $this->db->where('id', $game_id);
        $this->db->update('game', $data);

    }

}


