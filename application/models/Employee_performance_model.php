<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee_performance_model extends CI_model
{
    private $_test_details = 'test_details';
    private $_employee_ref = 'employee_ref';
    private $state = 'state';

    public function __construct()
    {
        parent::__construct();
    }
    // public function fetch_employee()
    // {
    //     $this->db->select('id,name');
    //     $this->db->from($this->db->dbprefix($this->_test_details));
    //     $this->db->where('is_active', 1);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function save_details($data)
    {
        $this->db->insert('mdl_employee_ref', $data);
        return $this->db->insert_id();
    }

    public function get_non_listed_reportm($userid)
    {
        $this->_get_non_listed_datatable_query($userid);

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    private function _get_non_listed_datatable_query($userid)
    {
        $this->column_order = array(null, 'td.name');
        $this->column_search = array('td.name');

        $this->db->select('er.id,td.name as employee_ref,er.feedback_status');
        $this->db->from($this->db->dbprefix($this->_employee_ref) . ' er');
        $this->db->join($this->db->dbprefix($this->_test_details) . ' td', 'er.employee_ref=td.id', 'inner');
        $this->db->where('er.employee', $userid);
        $this->db->where('er.is_active', 1);
        $this->db->where('td.is_active', 1);

        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function count_all_students($userid)
    {
        $this->_get_non_listed_datatable_query($userid);
        return $this->db->count_all_results();
    }

    public function count_filtered_students($userid)
    {
        $this->_get_non_listed_datatable_query($userid);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function chk_already_assign($employee, $employee_ref)
    {
        $this->db->select('*');
        $this->db->from($this->db->dbprefix($this->_employee_ref));
        $this->db->where('employee', $employee);
        $this->db->where('employee_ref', $employee_ref);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function update_details($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->_employee_ref), $data);
    }
}