<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_model
{
    public $response = array('success' => FALSE);
    public function __construct()
    {
        parent::__construct();
    }

    public function check_user_valid($username, $row = true)
    {
        $this->db->select('*');
        $this->db->from('mdl_test_details');
        $this->db->where(['username' => $username, 'is_active' => 1]);
        $query = $this->db->get();

        if ($query->num_rows()) {
            $this->response['success']  = TRUE;
            $this->response['data']     = ($row) ? $query->row_array() : $query->result_array();
            $this->response['count']    = $query->num_rows();
        }

        return $this->response;
    }
}