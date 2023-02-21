<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_form_model extends CI_model
{
    private $_test_details = 'test_details';
    private $_state = 'state';

    public function __construct()
    {
        parent::__construct();
    }
    public function fetch_state()
    {
        $this->db->select('id,name');
        $this->db->from($this->db->dbprefix($this->_state));
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function save_details($data)
    {
        $this->db->insert('mdl_test_details', $data);
        return $this->db->insert_id();
    }

    public function get_non_listed_reportm()
    {
        $this->_get_non_listed_datatable_query();

        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    private function _get_non_listed_datatable_query()
    {
        $this->column_order = array(null, 'td.name', 'email');
        $this->column_search = array('td.name', 'email');

        $this->db->select('td.*,s.name as state');
        $this->db->from($this->db->dbprefix($this->_test_details) . ' td');
        $this->db->join($this->db->dbprefix($this->_state) . ' s', 'td.state=s.id', 'inner');
        $this->db->where('td.is_active', 1);
        $this->db->where('s.is_active', 1);


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

    public function count_all_students()
    {
        $this->_get_non_listed_datatable_query();
        return $this->db->count_all_results();
    }

    public function count_filtered_students()
    {
        $this->_get_non_listed_datatable_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_details($id)
    {
        $this->db->select('*');
        $this->db->from($this->db->dbprefix($this->_test_details) . ' td');
        $this->db->where('td.id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_details($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->_test_details), $data);
    }

    public function update_details($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->db->dbprefix($this->_test_details), $data);
    }
}