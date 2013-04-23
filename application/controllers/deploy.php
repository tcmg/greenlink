<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deploy extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function access($public_token = FALSE, $banner = FALSE)
	{
        if ($public_token === FALSE) {
            show_404();
            die();
        }

        $this->load->helper('url');

        $this->load->model('game_model');

        $game = $this->game_model->get_by_public_token($public_token);
        $steam_data = json_decode($game->steam_data);

        $data['game'] = $game;
        $data['platforms'] = $steam_data->platforms;
        $data['genres'] = $steam_data->genres;

        if ($banner === FALSE) {
            $this->load->view('deploy', $data);
        } else {
            $this->load->view('deploy_banner', $data);
        }
	}

    public function refer($public_token= FALSE) 
    {
        if ($public_token === FALSE) {
            die('Something went wrong.');
        }
        $this->load->model('game_model');
        $this->load->model('analytics_model');

        $game = $this->game_model->get_by_public_token($public_token);
        $steam_id = $game->steam_id;

        $referer = $this->input->get('q');
        $this->analytics_model->insert_refer($game->id, $referer);

        $steam_end_point = "http://steamcommunity.com/sharedfiles/filedetails/?id=" . $steam_id;

        header('Location: ' . $steam_end_point);

    }

    public function banner_js($public_token = FALSE)
    {
        $this->load->helper('url');
        $site = site_url();

$out =<<<EOT

var iframe = document.createElement("iframe");
iframe.width = "100%";
iframe.height = "100";
iframe.frameBorder = "0";
iframe.style.border = 'none';
iframe.scrolling = "no";
iframe.src = "{$site}deploy/access/{$public_token}/1";

document.body.insertBefore(iframe, document.body.firstChild);

EOT;

die($out);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
