<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Session_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
		$admin=$this->session->userdata('admin');
        $this->db->select()->where('centre_id',$admin['centre_id'])->from('sessions');
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

    public function getAllSession() {
		$admin=$this->session->userdata('admin');
		
        $sql = "SELECT sessions.*, IFNULL(sch_settings.session_id, 0) as `active`,IFNULL(sch_settings.id,0) as `sch_setting_id` FROM `sessions` LEFT JOIN sch_settings ON sessions.id=sch_settings.session_id where sessions.centre_id=".$admin['centre_id'];
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getPreSession($session_id) {
		$admin=$this->session->userdata('admin');
        $sql = "select * from sessions where id in (select max(id) from sessions where id < $session_id) and centre_id=".$admin['centre_id'];

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getStudentAcademicSession($student_id = null) {
		$admin=$this->session->userdata('admin');
        $this->db->select('sessions.*')->from('sessions');
        $this->db->join('student_session', 'sessions.id = student_session.session_id');
		$this->db->where('sessions.centre_id',$admin['centre_id']);
        $this->db->where('student_session.student_id', $student_id);
        $this->db->order_by('sessions.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('sessions');
    }
	
	
	
	

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sessions', $data);
        } else {
            $this->db->insert('sessions', $data);
        }
    }

  public function add_finance_year($data)
  {
	  
	  if (isset($data['id'])) {
		  $val=array('is_active'=>'no');
		  $this->db->update('financial_year',$val);
		  
            $this->db->where('id', $data['id']);
            $this->db->update('financial_year', $data);
        } else {
            $this->db->insert('financial_year', $data);
        } 
	  
	  
  }

 public function getfinancialyear()
{ 
     $admin=$this->session->userdata('admin');
	 return $this->db->select('*')->from('financial_year')->where('centre_id',$admin['centre_id'])->get()->result_array();
	
	
	}

public function remove_financial_year($id)
	
	{
		 $this->db->where('id', $id);
        $this->db->delete('financial_year');
		
	}
	
	
	public function get_starting_invoice()
	{
		$admin=$this->session->userdata('admin');
	 $this->db->select('starting_invoice.starting_inv,id')->where('centre_id',$admin['centre_id'])->from('starting_invoice');
	  return $res=$this->db->get()->row();
	 	
		
	}
	
	
	public function get_mess_invo()
	{
		
		 $this->db->select('*')->from('mess_starting_invo');
	    return $res=$this->db->get()->row();
	 	}
		
		
	
	public function add_messinvoice($data)
	{
		
		if(isset($data['id']))
		{
			$this->db->where('id',$data['id']);
			$this->db->update('mess_starting_invo',$data);
			
		}
		else{
			
		$this->db->insert('mess_starting_invo',$data);
		
		}
		
		
		}


}
