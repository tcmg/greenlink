<?php

class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();

    }

    public function create($email)
    {
        $data = array(
            'email' => $email
        );

        $this->db->insert('user', $data);

        return $this->get_by_email($email);
    }

    public function get_by_email($email)
    {
        $query = $this->db->get_where('user', array('email' => $email), 1);
        foreach ($query->result() as $row)
        {
            return $row;
        }
        return FALSE;
    }
}
