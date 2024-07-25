<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Subject_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select()->from('subjects');
        $this->db->where('centre_id',$centre_id);
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('name');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

  
	
	public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('subjects');
    }
	

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('subjects', $data);
        } else {
            $this->db->insert('subjects', $data);
        //   echo $this->db->last_query();exit;
            return $this->db->insert_id();
        }
    }

    function check_data_exists($data) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('centre_id',$centre_id);
        $this->db->where('name', $data['name']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function check_code_exists($data) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('centre_id',$centre_id);
        $this->db->where('code', $data['code']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	function check_code1_exists($data) {
        $this->db->where('code2', $data['code1']);
        $query = $this->db->get('subjects');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	 public function add_minutes($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('minutes', $data);
        } else {
            $this->db->insert('minutes', $data);
            return $this->db->insert_id();
        }
    }

	
	public function get_minutes($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select()->from('minutes');
        $this->db->where('centre_id',$centre_id);
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
  public function removeminutes($id) {
        $this->db->where('id', $id);
        $this->db->delete('minutes');
    }
	
	
	

}
