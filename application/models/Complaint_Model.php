<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class complaint_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_session_name = $this->setting_model->getCurrentSessionName();
        $this->start_month = $this->setting_model->getStartMonth();
    }

    public function add($data) {
        $this->db->insert('complaint', $data);
        return $query = $this->db->insert_id();
    }

    public function image_add($complaint_id, $image) {
        $array = array('id' => $complaint_id);
        $this->db->set('image', $image);
        $this->db->where($array);
        $this->db->update('complaint');
    }

    public function complaint_list($id = null) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select()->from('complaint');
          $this->db->where('centre_id', $centre_id);
        if ($id != null) {
            $this->db->where('complaint.id', $id);
        } else {
            $this->db->order_by('complaint.id', "desc");
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function image_delete($id, $img_name) {
        $file = "./uploads/front_office/complaints/" . $img_name;
        unlink($file);
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('id', $id);
        $this->db->where('centre_id', $centre_id);
        $this->db->delete('complaint');
        $controller_name = $this->uri->segment(2);
    }

    public function compalaint_update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('complaint', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('complaint');
    }

    function getComplaintType() {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('*');
        $this->db->from('complaint_type');
        $this->db->where('centre_id',$centre_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getComplaintSource() {

      $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('*');
        $this->db->from('source');
        $this->db->where('centre_id',$centre_id);
        $query = $this->db->get();
        return $query->result_array();
    }
	function getdevicetype() {

      $admin=$this->session->userdata('admin');
       // $centre_id=$admin['centre_id'];
        $this->db->select('*');
        $this->db->from('device');
        //$this->db->where('id',$centre_id);
       $query = $this->db->get();
        return $query->result_array();
	}

    function getassignList() {

        $admin=$this->session->userdata('admin');
          $this->db->select('*');
          $this->db->from('assign_name');
         $query = $this->db->get();
          return $query->result_array();
      }
	  
    

}
