<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feesessiongroup_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function add($data) {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $parentid = $this->group_exists($data['fee_groups_id']);
        $data['fee_session_group_id'] = $parentid;
        $this->db->insert('fee_groups_feetype', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
	
	
	

    public function getFeesByGroup($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('fee_session_groups.*,fee_groups.name as `group_name`,feeyear.year');
        $this->db->from('fee_session_groups');
        $this->db->join('fee_groups', 'fee_groups.id = fee_session_groups.fee_groups_id');
		$this->db->join('feeyear','feeyear.id=fee_groups.year');
			
		$this->db->where('fee_groups.centre_id',$centre_id);
        //$this->db->where('fee_session_groups.session_id', $this->current_session);
        $this->db->where('fee_groups.is_system', 0);
        if ($id != null) {
            $this->db->where('fee_session_groups.id', $id);
        }
        $query = $this->db->get();

        $result = $query->result();
        foreach ($result as $key => $value) {
            $value->feetypes = $this->getfeeTypeByGroup($value->fee_groups_id, $value->id);
        }
        return $result;
    }
	
	
	
	
    public function getfeeTypeByGroup($id = null, $fee_session_group_id) {
        $this->db->select('fee_groups_feetype.*,feetype.type,feetype.code');
        $this->db->from('fee_groups_feetype');
        $this->db->join('feetype', 'feetype.id=fee_groups_feetype.feetype_id');
        $this->db->where('fee_groups_feetype.fee_groups_id', $id);
        $this->db->where('fee_groups_feetype.fee_session_group_id', $fee_session_group_id);
        $this->db->order_by('fee_groups_feetype.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
	
	
    function group_exists($fee_groups_id) {
		
        $this->db->where('fee_groups_id', $fee_groups_id);
		
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('fee_session_groups');
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            $data = array('fee_groups_id' => $fee_groups_id, 'session_id' => $this->current_session);
            $this->db->insert('fee_session_groups', $data);
            return $this->db->insert_id();
        }
    }
	
	
	
	 function messfee_group_exists($fee_groups_id) {
		
        $this->db->where('fee_groups_id', $fee_groups_id);
		
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('mess_fee_session');
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            $data = array('fee_groups_id' => $fee_groups_id, 'session_id' => $this->current_session);
            $this->db->insert('mess_fee_session', $data);
            return $this->db->insert_id();
        }
    }
	
	
	function messadvancefee_group_exists($fee_groups_id) {
		
        $this->db->where('fee_groups_id', $fee_groups_id);
		
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('mess_fee_session');
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            $data = array('fee_groups_id' => $fee_groups_id, 'session_id' => $this->current_session);
            $this->db->insert('mess_fee_session', $data);
            return $this->db->insert_id();
        }
    }
	
	
	
	
	
	
	

    public function remove($id) {
        $this->db->trans_begin();
        $sql = "delete fee_groups_feetype.* FROM fee_groups_feetype JOIN fee_session_groups ON fee_session_groups.id = fee_groups_feetype.fee_session_group_id WHERE fee_session_groups.id = ?";
        $this->db->query($sql, array($id));
        $this->db->where('id', $id);
        $this->db->delete('fee_session_groups');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
	
	
	
	
	public function remove_messfee($id) {
        $this->db->trans_begin();
        $sql = "delete messfeemasters.* FROM messfeemasters JOIN mess_fee_session ON mess_fee_session.id = messfeemasters.mess_fee_session_id WHERE mess_fee_session.id = ?";
        $this->db->query($sql, array($id));
        $this->db->where('id', $id);
        $this->db->delete('mess_fee_session');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
	
	
	
	
	
	
	

    function checkExists($data) {
        $this->db->where('fee_session_group_id', $data['fee_session_group_id']);
        $this->db->where('fee_groups_id', $data['fee_groups_id']);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('session_id', $this->current_session);
        $q = $this->db->get('fee_groups_feetype');

        if ($q->num_rows() > 0) {
            return $q->row()->id;
        } else {
            return false;
        }
    }
	
	
	
	function messfee_checkExists($data) {
        $this->db->where('mess_fee_session_id', $data['mess_fee_session_id']);
        $this->db->where('fee_groups_id', $data['fee_groups_id']);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('session_id', $this->current_session);
        $q = $this->db->get('messfeemasters');

        if ($q->num_rows() > 0) {
            return $q->row()->id;
        } else {
            return false;
        }
    }
	
	function messadvancefee_checkExists($data) {
		
        $this->db->where('mess_fee_session_id', $data['mess_fee_session_id']);
        $this->db->where('fee_groups_id', $data['fee_groups_id']);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('session_id', $this->current_session);
        $q = $this->db->get('messfeemasters');

        if ($q->num_rows() > 0) {
            return $q->row()->id;
        } else {
            return false;
        }
    }
	
	
	
	
	

    public function valid_check_exists($str) {
        $fee_groups_id = $this->input->post('fee_groups_id');
        $feetype_id = $this->input->post('feetype_id');
        $id = $this->input->post('id');

        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_data_exists($fee_groups_id, $feetype_id, $id)) {
            $this->form_validation->set_message('check_exists', 'FeeGroup combination already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	

    function check_data_exists($fee_groups_id, $feetype_id, $id) {
        $this->db->where('fee_groups_id', $fee_groups_id);
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('fee_session_groups');

        if ($query->num_rows() > 0) {
            $fee_session_group_id = $query->row()->id;
            $this->db->where('fee_session_group_id', $fee_session_group_id);
            $this->db->where('fee_groups_id', $fee_groups_id);
            $this->db->where('feetype_id', $feetype_id);
            $this->db->where('id !=', $id);
            $query = $this->db->get('fee_groups_feetype');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
	
	
	
	
	
	
	
	
	public function add_messfeemaster($data) {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $parentid = $this->messgroup_exists($data['fee_groups_id']);
        $data['mess_fee_session_id'] = $parentid;
        $this->db->insert('messfeemasters', $data);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
	
	
	
	
	function messgroup_exists($fee_groups_id) {
		
        $this->db->where('fee_groups_id', $fee_groups_id);
		
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('mess_fee_session');
        if ($query->num_rows() > 0) {
            return $query->row()->id;
        } else {
            $data = array('fee_groups_id' => $fee_groups_id, 'session_id' => $this->current_session);
            $this->db->insert('mess_fee_session', $data);
            return $this->db->insert_id();
        }
    }
	
	
	
	
	
	
	
	public function messmaster_check_exists($str) {
        $fee_groups_id = $this->input->post('fee_groups_id');
        $feetype_id = $this->input->post('feetype_id');
        $id = $this->input->post('id');

        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_master_exists($fee_groups_id, $feetype_id, $id)) {
            $this->form_validation->set_message('check_exists', 'FeeGroup combination already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	
	
	function check_master_exists($fee_groups_id, $feetype_id, $id) {
        $this->db->where('fee_groups_id', $fee_groups_id);
        $this->db->where('session_id', $this->current_session);
        $query = $this->db->get('messfeemasters');

        if ($query->num_rows() > 0) {
            $fee_session_group_id = $query->row()->id;
            $this->db->where('mess_fee_session_id', $fee_session_group_id);
            $this->db->where('fee_groups_id', $fee_groups_id);
            $this->db->where('feetype_id', $feetype_id);
            $this->db->where('id !=', $id);
            $query = $this->db->get('messfeemasters');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }
	
	
	
	 public function getMessFeesByGroup($id = null) {
        
        $this->db->select('mess_fee_session.*,messfeegroup.name as `group_name`');
        $this->db->from('mess_fee_session');
        $this->db->join('messfeegroup', 'messfeegroup.id = mess_fee_session.fee_groups_id');
		//$this->db->where('mess_fee_session.session_id', $this->current_session);
        $this->db->where('messfeegroup.is_system', 0);
        if ($id != null) {
            $this->db->where('mess_fee_session.id', $id);
        }
        $query = $this->db->get();

        $result = $query->result();
        foreach ($result as $key => $value) {
            $value->feetypes = $this->getmessfeeTypeByGroup($value->fee_groups_id, $value->id);
        }
        return $result;
    }
	
	
	public function getmessfeeTypeByGroup($id = null, $mess_fee_session_id) {
        $this->db->select('messfeemasters.*,messfeetype.type,messfeetype.code');
        $this->db->from('messfeemasters');
        $this->db->join('messfeetype', 'messfeetype.id=messfeemasters.feetype_id');
        $this->db->where('messfeemasters.fee_groups_id', $id);
        $this->db->where('messfeemasters.mess_fee_session_id', $mess_fee_session_id);
        $this->db->order_by('messfeemasters.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

	
	
	

}
