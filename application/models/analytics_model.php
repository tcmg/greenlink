<?php

class Analytics_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('date');
    }

    function insert_refer($game_id, $referer)
    {
        if ($referer === FALSE) {
            return false;
        }

        $referer_short = parse_url($referer);

        $referer_short = $referer_short['host'];

        $data = array(
                    'game_id' => $game_id,
                    'referer' => $referer,
                    'referer_short' => $referer_short,
                    'timestamp' => now()
                );

        $this->db->insert('analytics', $data);
    }

    function get_pie_data($game_id)
    {
        $data = array();

        $this->db->select('referer_short, COUNT(*)');
        $this->db->from('analytics');
        $this->db->where("game_id", $game_id);
        $this->db->group_by('referer_short');
        $this->db->order_by('COUNT(*)', 'DESC');
        $this->db->limit('5');

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {

            array_push($data, array(
                'label' => $row->referer_short,
                'data' => (int)($row->{'COUNT(*)'})
            ));
        }

        return $data;
    }

    function get_line_data($game_id)
    {
        $data = array();

        $this->db->select('*');
        $this->db->from('analytics');
        $this->db->where("game_id", $game_id);

        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            array_push($data, $row);
        }

        return $data;
    }

}


