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
        if (empty($this->session->userdata('is_logged_in'))) {
            redirect(base_url('login/login_page'), 'refresh');
        }
       
        $this->load->view('employee_performance', $data);
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
                $row[] = '<label style="color:green";>Feedback Updated</label>';
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