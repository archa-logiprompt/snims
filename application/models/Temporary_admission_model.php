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
    public function getsections(){
        $result=$this->db->select('*')->get('sections')->result_array();
        
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
    public function getexistingdetails($id)
    {
        $result=$this->db->select('firstname,lastname,email,phone')->where('id',$id)->from('temporary_admission')->get()->row();
        return $result;
    }
    public function getdatafromstudentdetails($id)
    {
        $result = $this->db->select('temp_user.*, temporary_admission.*')
                   ->from('temporary_admission')
                   ->join('temp_user', 'temp_user.user_id = temporary_admission.id', 'left')
                   ->where('temporary_admission.id', $id)
                   ->get()
                   ->row();
        // echo $this->db->last_query();exit;
        return $result;

    }
    public function add($data)
{
    if (!empty($data) && isset($data['user_id'])) {
        
        $this->db->where('user_id', $data['user_id']);
        $query = $this->db->get('temp_user');
        
        if ($query->num_rows() > 0) {
          
            $this->db->where('user_id', $data['user_id']);
            $this->db->update('temp_user', $data);
        } else {
            
            $this->db->insert('temp_user', $data);
        }
    }
}

    

}
