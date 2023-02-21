<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assign_employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Assign_employee_model');
    }

    public function index()
    {
        // if ($this->session->userdata('is_logged_in')) {
        //  redirect(base_url('student/student_dashboard'), 'refresh');
        // }
        $employee = $this->Assign_employee_model->fetch_employee();
        $data = array();
        $data['employee'] = $employee;
        $this->load->view('assign_employee', $data);
    }

    public function save()
    {

        $employee = $this->input->post('employee');
        $employee_ref = $this->input->post('employee_ref');

        $this->form_validation->set_rules('employee', ' Employee', 'required');
        $this->form_validation->set_rules('employee_ref', ' Employee_ref', 'required|callback__match[employee]');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        }

        $chk_already_assign = $this->Assign_employee_model->chk_already_assign($employee, $employee_ref);
        if ($chk_already_assign >= 1) {
            $response['res_code'] = 1;
            $response['message'] = "Mapping Already Done";
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        }

        $data = array();
        $data_user = array();
        $data['employee']         = $employee;
        $data['employee_ref']     = $employee_ref;
        $data['created_by']   = 3;
        $data['created_time'] = date("Y-m-d H:i:s");
        $data = $this->security->xss_clean($data);
        $res = $this->Assign_employee_model->save_details($data);

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

    public function _match($employee, $employee_ref)
    {
        if ($employee == $this->input->post($employee_ref)) {
            $this->form_validation->set_message('_match', 'Employee And Reference Employee is Same');
            return false;
        }
        return true;
    }

    public function fetch_details()
    {
        $data_final = $this->Assign_employee_model->get_non_listed_reportm();

        $data = array();
        $no = $_POST['start'];
        foreach ($data_final as $stud) {
            $row = array();

            $row[] = $stud->employee;
            $row[] = $stud->employee_ref;
            if ($stud->feedback == "" || empty($stud->feedback)) {
                $row[] = '<label style="color:red";>Feedback Pending</label>';
            } else {
                $row[] = $stud->feedback;
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Assign_employee_model->count_all_students(),
            "recordsFiltered" => $this->Assign_employee_model->count_filtered_students(),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function get_details()
    {
        $id = $this->input->post('id');

        $user_details = $this->User_form_model->get_details($id);
        $response['res_code'] = 1;
        $response['data'] = $user_details;
        $response['method'] = "data_fill";
        print_r(json_encode($response));
    }

    public function delete_details()
    {
        $id = $this->input->post('id');

        $data = array();
        $data['is_active']    = 0;
        $data['is_deleted'] = 1;
        $data['modified_by'] = 3;
        $data['modified_time']    = date("Y-m-d H:i:s");

        $user_details = $this->User_form_model->delete_details($data, $id);
        $user_details = $this->User_form_model->delete_details($data, $id);

        if ($user_details == 0) {
            $response['res_code'] = 1;
            $response['message'] = "Something Went Wrong!";
            $response['method'] = "RegErrMsg";
            print_r(json_encode($response));
            exit;
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Details Deleted Successfully";
            $response['method'] = "RegSuccMsg";
            print_r(json_encode($response));
            exit;
        }
    }

    public function update_details()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $gender = $this->input->post('gender');
        $state = $this->input->post('state_edit');
        $mobile = $this->input->post('mobile');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('mobile', 'Mobile No ', 'required|regex_match[/^[0-9]{10}$/]');
        $this->form_validation->set_rules('gender', ' Gender', 'required');
        $this->form_validation->set_rules('state_edit', ' State', 'required');

        if ($this->form_validation->run() == FALSE) {
            $response['res_code'] = 1;
            $response['message'] = validation_errors();
            $response['method'] = "RegErrMsgNoReload";
            print_r(json_encode($response));
            exit;
        }

        $data = array();
        $data['username']     = $email;
        $data['name']         = $name;
        $data['email']        = $email;
        $data['mobile']       = $mobile;
        $data['gender']       = $gender;
        $data['state']        = $state;
        $data['modified_by']   = 3;
        $data['modified_time'] = date("Y-m-d H:i:s");
        $data = $this->security->xss_clean($data);
        $user_details = $this->User_form_model->update_details($data, $id);

        if ($user_details == 0) {
            $response['res_code'] = 1;
            $response['message'] = "Something Went Wrong!";
            $response['method'] = "RegErrMsg";
            print_r(json_encode($response));
            exit;
        } else {
            $response['res_code'] = 1;
            $response['message'] = "Details Updated Successfully";
            $response['method'] = "RegSuccMsg";
            print_r(json_encode($response));
            exit;
        }
    }
}