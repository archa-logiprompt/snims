<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Income_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function search($text = null, $start_date = null, $end_date = null,$income_head=null) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
		  if (!empty($text)) {
            $this->db->select('income.id,income.date,income.name,income.person_name,income.invoice_no,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id,income.is_cancelled,income.cancelled_date,income.mode,income.description')->from('income');
            $this->db->join('income_head', 'income.inc_head_id = income_head.id','left');
             $this->db->where('income.centre_id',$centre_id);
            $this->db->like('income.name', $text);
			$this->db->order_by('income.invoice_no','ASC');
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select('income.id,income.date,income.name,income.person_name,income.invoice_no,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id,income.is_cancelled,income.cancelled_date,income.mode,income.description')->from('income');
            $this->db->join('income_head','income.inc_head_id = income_head.id','left');
             $this->db->where('income.centre_id',$centre_id);
            $this->db->where('income.date >=', $start_date);
            $this->db->where('income.date <=', $end_date);
			$this->db->order_by('income.invoice_no','ASC');
			if($income_head !=null)
			{
				$this->db->where('income.inc_head_id',$income_head);
				
				}
			
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function get($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select('income.id,income.date,income.name,income.person_name,income.invoice_no,income.amount,income.documents,income.note,income_head.income_category,income.inc_head_id,income.mode,income.description')->from('income');
		$this->db->where('income.is_cancelled',0);
        $this->db->where('income.centre_id',$centre_id);
        $this->db->join('income_head', 'income.inc_head_id = income_head.id');
        if ($id != null) {
            $this->db->where('income.id', $id);
        } else {
            $this->db->order_by('income.id', 'DESC');
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
		
		$data=array('is_cancelled'=>1);
		
        $this->db->where('id', $id);
		$this->db->update('income',$data);
	    
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
            $this->db->update('income', $data);
        } else {
            $this->db->insert('income', $data);
            return $this->db->insert_id();
        }
    }
	
	
	

    public function check_Exits_group($data) {
        $this->db->select('*');
        $this->db->from('income');
        $this->db->where('session_id', $this->current_session);
        $this->db->where('feetype_id', $data['feetype_id']);
        $this->db->where('class_id', $data['class_id']);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return false;
        } else {
            return true;
        }
    }

    public function getTypeByFeecategory($type, $class_id) {
        $this->db->select('income.id,income.session_id,income.amount,income.invoice_no,income.documents,income.note,income_head.class,feetype.type')->from('income');
        $this->db->join('income_head', 'income.class_id = income_head.id');
        $this->db->join('feetype', 'income.feetype_id = feetype.id');
        $this->db->where('income.class_id', $class_id);
        $this->db->where('income.feetype_id', $type);
        $this->db->where('income.session_id', $this->current_session);
        $this->db->order_by('income.id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getTotalExpenseBydate($date) {
        $query = 'SELECT sum(amount) as `amount` FROM `income` where date=' . $this->db->escape($date);
        $query = $this->db->query($query);
        return $query->row();
    }

    public function getTotalExpenseBwdate($date_from, $date_to) {
        $query = 'SELECT sum(amount) as `amount` FROM `income` where date between ' . $this->db->escape($date_from) . ' and ' . $this->db->escape($date_to);

        $query = $this->db->query($query);
        return $query->row();
    }
	
	
	public function add_mess_income($data) {
		
		
		
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('mess_income', $data);
        } else {
            $this->db->insert('mess_income', $data);
            return $this->db->insert_id();
        }
    }
	
	
	 public function get_mess($id = null) {

        
        $this->db->select()->from('mess_income');
        $this->db->where('is_cancelled',0);
		$this->db->where('is_system',1); 
      
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id', 'DESC');
        }
     
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

	 public function remove_mess_income($id) {
		 $data=array('is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'));
        $this->db->where('id', $id);
        $this->db->update('mess_income',$data);
		
    }

	
	public function mess_collection_report($date_from, $date_to)
	{
		
	  	$this->db->select('mess_income.*,student_messfees_deposite.amount_detail')->from('mess_income');
		$this->db->join('student_messfees_deposite','student_messfees_deposite.id=mess_income.deposit_id','left');
		$this->db->where('mess_income.date >=', $date_from);
        $this->db->where('mess_income.date <=', $date_to);
		$this->db->order_by('invoice_no','ASC');
		return $this->db->get()->result_array();
		
		}
		
		
		public function get_other_pyment($date_from, $date_to)
		{
		$head_id=$this->incomehead_model->get();
		
		$ar=array();
		if(!empty($head_id))
		{
			foreach($head_id as $id)
			{
				
				$income=$this->payment($id['id'],$date_from, $date_to);
				 if(!empty($income))
				 foreach($income as $in)
				 {
					$a['income_category']=$id['income_category'];
					$a['name']=$in['person_name'];
					$a['invo']=$in['invoice_no'];
					$a['date']=$in['date'];
				    $a['amount']=$in['amount'];
					$a['is_cancelled']=$in['is_cancelled'];
					
					 
					 $ar[]=$a;
					 }
				}
			
			}
			
			return $ar;
		}
		
		
		
	 function payment($id,$date_from, $date_to)
		
		{
		
		$this->db->select('*')->from('income');
		$this->db->where('income.date >=', $date_from);
        $this->db->where('income.date <=', $date_to);
		$this->db->where('income.inc_head_id',$id);
		$this->db->order_by('invoice_no','ASC');
		return $this->db->get()->result_array();
			
			
			
			}
		
		
		
		
		
		
		
	
}
