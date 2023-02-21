<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Hybridauth\Hybridauth;

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['login_model', 'Change_password_model']);
        $this->load->library('email');
    }

    public function index()
    {
        $username =  $this->input->post("username");
        $password = $this->input->post("password");

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrorMsg";
            print_r(json_encode($response));
            exit;
        }

        $check_username_valid = $this->login_model->check_user_valid($username);

        if ($check_username_valid['success']) {
            $student_details = array();

            $student_details['role_id'] = $check_username_valid['data']['role_id'];
            $student_details['username'] = $check_username_valid['data']['username'];
            $student_details['id'] = $check_username_valid['data']['id'];

            $this->session->set_userdata('role_id', $student_details['role_id']);
            $this->session->set_userdata('username', $student_details['username']);
            $this->session->set_userdata('userid', $student_details['id']);

            $hashed_password = $check_username_valid['data']['password'];

            if (password_verify($password, $hashed_password)) {
                $this->session->set_userdata('is_logged_in', 1);

                $data = array();
                $data['role_id'] = $student_details['role_id'];

                $response['res_code'] = 1;
                $response['message'] = "Logged In";
                $response['method'] = "login_redirect";
                $response['data'] = $data;
                print_r(json_encode($response));
                exit;
            } else {
                $response['res_code'] = 1;
                $response['message'] = "Incorrect Password! Please Try Again";
                $response['method'] = "RegErrorMsg";
                print_r(json_encode($response));
                exit;
            }
        } else {

            $response['res_code'] = 1;
            $response['message'] = "Incorrect Username! Please Try Again";
            $response['method'] = "RegErrorMsg";
            print_r(json_encode($response));
            exit;
        }
    }
    public function login_page()
    {
        $data['title']             = 'Dashboard';
        $data['header_title']     = 'Dashboard';
        $data['dashboard']      = TRUE;

        $this->load->view('login', $data);
    }

    public function change_password_save()
    {
        $username = $this->input->post('username');
        $new_password = $this->input->post('new_password');
        $confirm_new_password = $this->input->post('confirm_new_password');

        $this->form_validation->set_rules('new_password', 'New Password', 'required');
        $this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'required|matches[new_password]');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrorMsg";
            print_r(json_encode($response));
            exit;
        }

        //chk username exist 
        $chk_username_exist = $this->Change_password_model->chk_username_exist($username);
        if ($chk_username_exist == 1) {
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_password = $this->Change_password_model->update_new_password($username, $new_hashed_password);
            $response['res_code'] = 1;
            $response['message'] = "Password Change SucessFully!";
            $response['method'] = "redirect_with_msg";
            $response['link'] = base_url() . 'logout';
            print_r(json_encode($response));
            exit;
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Email ID Not Found!";
            $response['method'] = "RegErrorMsg";
            print_r(json_encode($response));
            exit;
        }
    }
}