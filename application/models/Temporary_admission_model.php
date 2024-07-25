<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temporary_admission_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function create($data)
    {
        $this->db->insert('temporary_admission', $data);
        // $this->session->set_userdata('sub_menu', 'temporary/create');
    }

    public function checkUser($username, $otp)
    {

        $user_id = $this->db->select('id,phone')->where('user_id', $username)->get('temporary_admission')->row();
        $this->db->where('id', $user_id->id)->update('temporary_admission', ['otp' => $otp]);
        return $user_id;
    }

    public function checkOtp($id, $otp)
    {
        $user_data = $this->db->where('id', $id)->where('otp', $otp)->get('temporary_admission')->row();
        return ($user_data);
    }

    public function getSectionByClass($class_id)
    {
        $result = $this->db->select('section,sections.id as section_id')->join('sections', 'sections.id=class_sections.section_id')->where('class_id', $class_id)->get('class_sections')->result_array();
        echo json_encode($result);
    }
    
    public function getscholar($id = null) {
       
        $this->db->select()->from('scholarship');
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
    public function getClass()
    {
        $result = $this->db->select('class,id')->where('centre_id', 2)->get('classes')->result_array();
        return $result;
    }
    public function getcat($id = null) {
       
        $this->db->select()->from('categories');
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
    public function getfee($id = null) {
       
        $this->db->select()->from('feeyear');
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
    public function add($data)
    {
        if (!empty($data)) {
            $this->db->insert('temp_user', $data);
        }
            
            
       
    }
    

}
