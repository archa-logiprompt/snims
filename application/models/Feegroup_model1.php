<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feegroup_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
	
        if ($id != null) {
	  $this->db->select('fee_groups.*')->from('fee_groups');
         $this->db->where('centre_id',$centre_id);
        $this->db->where('is_system', 0);
         $this->db->where('id', $id);
        } else {
			$this->db->select('fee_groups.id,fee_groups.name,fee_groups.class_id,fee_groups.section_id,feeyear.year')->from('fee_groups');
			$this->db->join('feeyear','feeyear.id=fee_groups.year');
		$this->db->where('fee_groups.centre_id',$centre_id);	
        $this->db->where('is_system', 0);
			
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->where('is_system', 0);
        $this->db->delete('fee_groups');
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('fee_groups', $data);
        } else {
            $this->db->insert('fee_groups', $data);
            return $this->db->insert_id();
        }
    }

    public function check_exists($str) {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');
        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_data_exists($name, $id)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_data_exists($name, $id) {
		$admin=$this->session->userdata('admin');
		$this->db->where('centre_id',$admin['centre_id']);
        $this->db->where('name', $name);
        $this->db->where('id !=', $id);

        $query = $this->db->get('fee_groups');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkGroupExistsByName($name) {
        $this->db->where('name', $name);
        $query = $this->db->get('fee_groups');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

}
