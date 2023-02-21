<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_performance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Employee_performance_model');
    }

    public function index()
    {
        // if ($this->session->userdata('is_logged_in')) {
        //  redirect(base_url('student/student_dashboard'), 'refresh');
        // }
        // $state = $this->Employee_performance_model->fetch_state();
        // $data = array();
        // $data['state'] = $state;
        $this->load->view('employee_performance', $data);
    }

    public function save()
    {

        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');
        $gender = $this->input->post('gender');
        $state = $this->input->post('state');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile No ', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('gender', ' Gender', 'required');
        $this->form_validation->set_rules('state', ' State', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        }
        $password = password_hash("India@123", PASSWORD_DEFAULT);
        $data = array();
        $data_user = array();
        $data['name']         = $name;
        $data['email']        = $email;
        $data['mobile']       = $mobile;
        $data['gender']       = $gender;
        $data['state']        = $state;
        $data['username']     = $email;
        $data['password']     = $password;
        $data['role_id']      = 2;
        $data['created_by']   = 3;
        $data['created_time'] = date("Y-m-d H:i:s");
        $data = $this->security->xss_clean($data);
        $res = $this->User_form_model->save_details($data);

        if (empty($res)) {
            $response['res_code'] = 1;
            $response['message'] = "Something Went Wrong ! Data not inserted";
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Details Added Successfully";
            $response['method'] = "RegSuccMsg";
            print_r(json_encode($response));
            exit;
        }
    }

    public function fetch_details()
    {
        // print_r($this->session->userdata('userid'));
        // exit();
        $userid = $this->session->userdata('userid');
        $data_final = $this->Employee_performance_model->get_non_listed_reportm($userid);

        $data = array();
        $no = $_POST['start'];
        foreach ($data_final as $stud) {
            $row = array();

            $row[] = $stud->employee_ref;
            if ($stud->feedback_status == 1) {
                $row[] = '<a type="button" data-id="' . $stud->id . '" class="btn btn-success btn-icon btn-sm edit-response disabled"><i class="icon-pencil5" style="color: #fff;"></i></a>';
                $row[] = "Feedback Updated";
            } else {
                $row[] = '<a type="button" data-id="' . $stud->id . '" class="btn btn-success btn-icon btn-sm edit-response"><i class="icon-pencil5" style="color: #fff;"></i></a>';
                $row[] = "";
            }


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Employee_performance_model->count_all_students($userid),
            "recordsFiltered" => $this->Employee_performance_model->count_filtered_students($userid),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function update_feedback()
    {
        $id = $this->input->post('id');
        $feedback = $this->input->post('feedback');

        $this->form_validation->set_rules('feedback', 'Feedback', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        }

        $data = array();
        $data['feedback']     = $feedback;
        $data['feedback_status'] = 1;
        $data['modified_by']   = 3;
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data = $this->security->xss_clean($data);
        $feedback_details = $this->Employee_performance_model->update_details($data, $id);

        if ($feedback_details == 0) {
            $response['res_code'] = 1;
            $response['message'] = "Something Went Wrong!";
            $response['method'] = "RegErrMsg";
            print_r(json_encode($response));
            exit;
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Feedback Updated Successfully";
            $response['method'] = "RegSuccMsg";
            print_r(json_encode($response));
            exit;
        }
    }
}