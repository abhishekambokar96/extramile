<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Change_password_model extends CI_model
{
    public $response = array('success' => FALSE);
    public function __construct()
    {
        parent::__construct();
    }

    public function chk_username_exist($username)
    {
        $this->db->select('*');
        $this->db->from('mdl_test_details');
        $this->db->where('(username = "' . $username . '")');

        return $this->db->get()->num_rows();
    }

    public function update_new_password($username, $new_password)
    {
        $this->db->set('password', $new_password);
        $this->db->where('username', $username);
        return $this->db->update('mdl_test_details');
    }

    public function fetch_old_password($username)
    {
        $this->db->select('*');
        $this->db->from('mdl_test_details');
        $this->db->where('(username = "' . $username . '")');

        return $this->db->get()->result_array();
    }
}