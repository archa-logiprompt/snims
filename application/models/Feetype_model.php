<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feetype_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];

        $this->db->select()->from('feetype');
        $this->db->where('centre_id',$centre_id);
        $this->db->where('is_system', 0);
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

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->where('is_system', 0);
        $this->db->delete('feetype');
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
            $this->db->update('feetype', $data);
        } else {
            $this->db->insert('feetype', $data);
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
        $this->db->where('type', $name);
		$this->db->where('centre_id',$admin['centre_id']);
        $this->db->where('id !=', $id);

        $query = $this->db->get('feetype');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkFeetypeByName($name) {
        $this->db->where('type', $name);


        $query = $this->db->get('feetype');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	
	
	
	
	function checkFeetypeByName_mess($name) {
        $this->db->where('type', $name);


        $query = $this->db->get('messfeetype');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	function check_advance_messfee_type($name) {
        $this->db->where('type', $name);


        $query = $this->db->get('messfeetype');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	
	
	
	
	
	
	
	public function add_messfeetype($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('messfeetype', $data);
        } else {
            $this->db->insert('messfeetype', $data);
            return $this->db->insert_id();
        }
    }

	
	 public function check_exists_mess_type($str) {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');
        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_type_exists($name, $id)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	
	function check_type_exists($name, $id) {
		
        $this->db->where('type', $name);
		 $this->db->where('id !=', $id);

        $query = $this->db->get('messfeetype');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	
	
	 public function get_messtype($id = null) {

       $this->db->select()->from('messfeetype');
       
        $this->db->where('is_system', 0);
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

	 public function remove_messtype($id) {
        $this->db->where('id', $id);
        $this->db->where('is_system', 0);
        $this->db->delete('messfeetype');
    }

	
	
	
	

}
