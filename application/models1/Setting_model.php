<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
		
		   if($this->session->userdata('admin'))
		   {
			$admin=$this->session->userdata('admin');
            $centre=$admin['centre_id'];
		   }
		   else if($this->session->userdata('student'))
		   {
			 $student=$this->session->userdata('student'); 
			  $centre=1; 
			   
			   }
			   
		   
		 
        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.class_teacher,sch_settings.is_rtl,sch_settings.cron_secret_key, sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.fee_due_days,sch_settings.image,sch_settings.theme,sessions.session'
        );
        $this->db->from('sch_settings');
		$this->db->where('sch_settings.id',$centre);
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        if ($id != null) {
            $this->db->where('sch_settings.id', $id);
        } else {
            $this->db->order_by('sch_settings.id');
        }
        $query = $this->db->get();
         
		
		
        if ($id != null) {
            return $query->row_array();
        } else {
            $session_array = $this->session->has_userdata('session_array');
            $result = $query->result_array();
			
            $result[0]['current_session'] = array(
                'session_id' => $result[0]['session_id'],
                'session' => $result[0]['session']
            );

            if ($session_array) {
                $session_array = $this->session->userdata('session_array');
                $result[0]['session_id'] = $session_array['session_id'];
                $result[0]['session'] = $session_array['session'];
            }

            return $result;
            
        }
    }
	
	
    public function loginget($id) {
		
			
            $center=$id;
        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.class_teacher,sch_settings.is_rtl,sch_settings.cron_secret_key, sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.fee_due_days,sch_settings.image,sch_settings.theme,sessions.session'
        );
        $this->db->from('sch_settings');
		$this->db->where('sch_settings.id',$center);
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        if ($id != null) {
            $this->db->where('sch_settings.id', $id);
        } else {
            $this->db->order_by('sch_settings.id');
        }
        $query = $this->db->get();

        if ($id != null) {
            return $query->row_array();
        } else {
            $session_array = $this->session->has_userdata('session_array');
            $result = $query->result_array();
            $result[0]['current_session'] = array(
                'session_id' => $result[0]['session_id'],
                'session' => $result[0]['session']
            );

            if ($session_array) {
                $session_array = $this->session->userdata('session_array');
                $result[0]['session_id'] = $session_array['session_id'];
                $result[0]['session'] = $session_array['session'];
            }

            return $result;
            
        }
    }
    public function getSchoolDetail($id = null) {
         $admin=$this->session->userdata('admin');
        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.image,sch_settings.theme,sessions.session'
        );
        $this->db->from('sch_settings');
		$this->db->where('sch_settings.id',$admin['centre_id']);
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');
        $this->db->order_by('sch_settings.id');
        $query = $this->db->get();
        return $query->row();
    }

    public function getSetting() {
		$admin=$this->session->userdata('admin');

        $this->db->select('sch_settings.id,sch_settings.lang_id,sch_settings.is_rtl,sch_settings.fee_due_days,sch_settings.class_teacher,sch_settings.cron_secret_key,sch_settings.timezone,
          sch_settings.name,sch_settings.email,sch_settings.phone,languages.language,
          sch_settings.address,sch_settings.dise_code,sch_settings.date_format,sch_settings.currency,sch_settings.currency_symbol,sch_settings.start_month,sch_settings.session_id,sch_settings.image,sch_settings.theme,sessions.session'
        );
        $this->db->from('sch_settings');
		$this->db->where('sch_settings.id',$admin['centre_id']);
        $this->db->join('sessions', 'sessions.id = sch_settings.session_id');
        $this->db->join('languages', 'languages.id = sch_settings.lang_id');

        $this->db->order_by('sch_settings.id');

        $query = $this->db->get();

        return $query->row();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('sch_settings');
    }

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sch_settings', $data);
        } else {
            $this->db->insert('sch_settings', $data);
            return $this->db->insert_id();
        }
    }
     public function adds($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('sch_settings', $data);
        } else {
            $this->db->insert('sch_settings', $data);
            return $this->db->insert_id();
        }
    }

    public function getCurrentSession() {
        $session_result = $this->get();

        return $session_result[0]['session_id'];
    }
	
	

    public function getCurrentSessionName() {
        $session_result = $this->get();
        return $session_result[0]['session'];
    }

    public function getCurrentSchoolName() {
        $session_result = $this->get();
        return $session_result[0]['name'];
    }
	
	public function getcurrentid()
	{
		$session_result=$this->get();
		return $session_result[0]['id'];
		
	}
	public function getcollegelogo()
	{
	 $session_result = $this->get();
        return $session_result[0]['image'];	
		
		
	}
	

    public function getStartMonth() {
        $session_result = $this->get();
        return $session_result[0]['start_month'];
    }

    public function getCurrentSessiondata() {
        $session_result = $this->get();
        return $session_result[0];
    }

    public function getCurrency() {
        $session_result = $this->get();
        return $session_result[0]['currency'];
    }

    public function getCurrencySymbol() {
        $session_result = $this->get();
        return $session_result[0]['currency_symbol'];
    }

    public function getDateYmd() {
        return date('Y-m-d');
    }

    public function getDateDmy() {
        return date('d-m-Y');
    }

    public function add_cronsecretkey($data, $id) {

        $this->db->where("id", $id)->update("sch_settings", $data);
    }


public function get_financial_year($id)
{
	$this->db->select('financial_year.value')->where('centre_id',$id)->from('financial_year');
	$this->db->where('financial_year.is_active','yes');
	$f_year=$this->db->get()->row_array();
	
	return $f_year;
		
}


public function getall_institution()
  {
     
    
    $this->db->select('centre.id,centre.centre_name')->from('centre');
    $this->db->where('centre_active =','active');
    
    return $this->db->get()->result_array(); 
       
  }
public function add_schsetting($data)
{
	$this->db->insert('sch_settings',$data);
	
	}


}
