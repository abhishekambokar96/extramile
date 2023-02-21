<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Change_password extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Change_password_model');
        if (!$this->authorize->checkAliveSession()) {
            redirect(base_url(), 'refresh');
        }
    }

    public function index()
    {
        $data['title']  = $this->header_data['title'] . 'Dashboard';
        $data['header_title']  = 'User Dashboard';
        $data['active_vision'] = TRUE;
        $this->load->view('change_password', $data);
    }

    public function save()
    {
        $username = $this->input->post('username');
        $old_password = $this->input->post('old_password');
        $new_password = $this->input->post('new_password');
        $confirm_new_password = $this->input->post('confirm_new_password');

        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
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
            $fetch_old_password_array = $this->Change_password_model->fetch_old_password($username);
            $fetch_old_password = $fetch_old_password_array[0]['password'];

            $old_hashed_password = password_hash($old_password, PASSWORD_DEFAULT);
            $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            if (password_verify($old_password, $fetch_old_password)) {
                if (password_verify($old_password, $new_hashed_password)) {

                    $response['res_code'] = 1;
                    $response['message'] = "New Password is same as Old Password! Please Enter New Password!";
                    $response['method'] = "RegErrorMsg";
                    print_r(json_encode($response));
                    exit;
                } else {
                    $update_password = $this->Change_password_model->update_new_password($username, $new_hashed_password);
                    $response['res_code'] = 1;
                    $response['message'] = "Password Change SucessFully!";
                    $response['method'] = "redirect_with_msg";
                    $response['link'] = base_url() . 'logout';
                    print_r(json_encode($response));
                    exit;
                }
            } else {
                $response['res_code'] = 1;
                $response['message'] = "You Entered Wrong Old Password!";
                $response['method'] = "RegErrorMsg";
                print_r(json_encode($response));
                exit;
            }
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Username Not Found!";
            $response['method'] = "RegErrorMsg";
            print_r(json_encode($response));
            exit;
        }
    }
}