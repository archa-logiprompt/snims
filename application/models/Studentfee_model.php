<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentfee_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function getStudentFeesArray($ids = null, $student_session_id) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.payment_mode,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id where feemasters.id IN (" . $ids . ")";

        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getTotalCollectionBydate($date) {
        $sql = "SELECT sum(amount) as `amount`, SUM(amount_discount) as `amount_discount` ,SUM(amount_fine) as `amount_fine` FROM `student_fees` where date=" . $this->db->escape($date);
        $query = $this->db->query($sql);
        return $query->row();
    }

    public function getStudentFees($id = null) {
        $this->db->select('feecategory.category,student_fees.id as `invoiceno`,student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->where('student_session.student_id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getFeeByInvoice($id = null) {
        $this->db->select('feecategory.category,student_fees.date,student_fees.payment_mode,student_fees.id as `student_fee_id`,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,feetype.type,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name, students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.rte')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('feecategory', 'feetype.feecategory_id = feecategory.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.id', $id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTodayStudentFees() {
        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date', $this->current_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function remove($id, $sub_invoice,$array) {
		$admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->where('id', $id);
        $q = $this->db->get('student_fees_deposite');
        if ($q->num_rows() > 0) {
            $result = $q->row();
            $a = json_decode($result->amount_detail, true);
            unset($a[$sub_invoice]);
            if (!empty($a)) {
                $data['amount_detail'] = json_encode($a);
				$this->db->trans_start();
				
                $this->db->where('id', $id);
                $this->db->update('student_fees_deposite', $data);
				
				/*$this->db->where('invoice.invoice_no',$sub_invoice);
				$this->db->delete('invoice');*/
				
				$cancelled=array('is_cancelled'=>1,'cancelled_date'=>$array['date']);
				
				$this->db->where('person_name',$array['studentname']);
				$this->db->where('name',$array['type']);
				$this->db->where('invoice_no',$array['invoice']);
				$this->db->where('centre_id',$centre_id);
				$this->db->update('income',$cancelled);
				
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
				
				
            } else {
				$this->db->trans_start();
                $this->db->where('id', $id);
                $this->db->delete('student_fees_deposite');
				
				/*$this->db->where('invoice.invoice_no',$sub_invoice);
				$this->db->delete('invoice');*/
				
				
				$cancelled=array('is_cancelled'=>1,'cancelled_date'=>$array['date']);
				
				$this->db->where('person_name',$array['studentname']);
				$this->db->where('name',$array['type']);
				$this->db->where('invoice_no',$array['invoice']);
				$this->db->update('income',$cancelled);
				
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
            }
        }
    }


  public function revertmessfee($id, $sub_invoice,$type=null) {
        $this->db->where('id', $id);
        $q = $this->db->get('student_messfees_deposite');
        if ($q->num_rows() > 0) {
            $result = $q->row();
            $a = json_decode($result->amount_detail, true);
            unset($a[$sub_invoice]);
            if (!empty($a)) {
                $data['amount_detail'] = json_encode($a);
				$this->db->trans_start();
				
                $this->db->where('id', $id);
                $this->db->update('student_messfees_deposite', $data);
				
				$dlt=array('is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'));
				$this->db->where('deposit_id',$id);
				$this->db->where('invoice_no',$sub_invoice);
				$this->db->update('mess_income',$dlt);
				
				
				/*$this->db->where('invoice.invoice_no',$sub_invoice);
				$this->db->delete('invoice');*/
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
				
				
            } else {
				$this->db->trans_start();
				
				
				$dlt=array('is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'));
				$this->db->where('deposit_id',$id);
				$this->db->where('invoice_no',$sub_invoice);
				$this->db->update('mess_income',$dlt);
				
				if($type =='Fees Received in Advance')
				{
				$this->db->select('student_messfees_master_id')->from('student_messfees_deposite');
				$this->db->where('id',$id);
				$student_messfees_master_id=$this->db->get()->row();
				
				$this->db->where('id',$student_messfees_master_id->student_messfees_master_id);
				$this->db->delete('student_messfees_master');
				
				
				}
                $this->db->where('id', $id);
                $this->db->delete('student_messfees_deposite');
				
				/*$this->db->where('invoice.invoice_no',$sub_invoice);
				$this->db->delete('invoice');*/
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
            }
        }
    }


  
 public function revert_messadvance($deposit_id, $arraykey,$mess_amount ) {
	
	
        $this->db->where('id', $deposit_id);
        $q = $this->db->get('student_messfees_deposite');
        if ($q->num_rows() > 0) {
            $result = $q->row();
            $a = json_decode($result->advance_collected, true);
            unset($a[$arraykey]);
			
            if (!empty($a)) {
                $data['advance_collected'] = json_encode($a);
				$this->db->trans_start();
				
				$this->db->select('balance_amount,id')->where('id',$result->student_messfees_master_id);
				$val=$this->db->get('student_messfees_master')->row();
				$balamount=$val->balance_amount+$mess_amount;
				
				
				$array=array('balance_amount'=>$balamount);
				$this->db->where('id',$val->id);
				$this->db->update('student_messfees_master',$array);
				
				
                $this->db->where('id', $deposit_id);
                $this->db->update('student_messfees_deposite', $data);
				
				
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
				
				
            } else {
				$this->db->trans_start();
				
				 $data['advance_collected'] ='';
				 $this->db->where('id', $deposit_id);
                $this->db->update('student_messfees_deposite', $data);
				
				
				$this->db->select('balance_amount,id')->where('id',$result->student_messfees_master_id);
				$val=$this->db->get('student_messfees_master')->row();
				$balamount=$val->balance_amount+$mess_amount;
				
				
				$array=array('balance_amount'=>$balamount);
				$this->db->where('id',$val->id);
				$this->db->update('student_messfees_master',$array);
				
				
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
				
				
            }
        }
    	 
	 
 }


   public function refund_fee($data)
   {
	   $this->db->trans_begin();
	  $this->db->where('student_fees_master_id',$data['student_fees_master_id']);
	  $this->db->where('fee_groups_feetype_id',$data['fee_groups_feetype_id']);
	  $r=$this->db->get('student_fees_deposite');
	 
	  if($r->num_rows() > 0)
	  { 

		  $res=$r->row();
		  if($res->refund_detail){

			  $current_refund_details = json_decode($res->refund_detail,true);
	
			  $updated_refund_details = json_decode($data['refund_detail'],true);
			  
			  array_push($current_refund_details,$updated_refund_details);
			  
			  $data['refund_detail'] = json_encode($current_refund_details);   
			}else{
				
				$updated_refund_details[] = json_decode($data['refund_detail'],true);
				$data['refund_detail'] = json_encode($updated_refund_details);   
		  }

		 
		 $this->db->where('id',$res->id);
		 $this->db->update('student_fees_deposite', $data);
	  
	  }
	   
	    if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
		return TRUE; 
	   
	   
	   
	   
   }
   
   
   public function refund_Messfee($data)
   {
	   $this->db->trans_begin();
	  $this->db->where('student_messfees_master_id',$data['student_messfees_master_id']);
	  $this->db->where('messfeemasters_id',$data['messfeemasters_id']);
	  $r=$this->db->get('student_messfees_deposite');
	 
	  if($r->num_rows() > 0)
	  {
		
		  $res=$r->row();
		 
		 $this->db->where('id',$res->id);
		 $this->db->update('student_messfees_deposite', $data);
	  
	  }
	   
	    if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
		return TRUE; 
	   
	   
	   
	   
   }
   
   

    public function add($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_fees', $data);
        } else {
            $this->db->insert('student_fees', $data);
            return $this->db->insert_id();
        }
    }

    public function getDueStudentFees($feegroup_id = null, $fee_groups_feetype_id = null, $class_id = null, $section_id = null) {

        $query = "SELECT IFNULL(student_fees_deposite.id, 0) as student_fees_deposite_id, IFNULL(student_fees_deposite.fee_groups_feetype_id, 0) as fee_groups_feetype_id, IFNULL(student_fees_deposite.amount_detail, 0) as amount_detail, student_fees_master.id as `fee_master_id`,fee_groups_feetype.feetype_id ,fee_groups_feetype.amount,fee_groups_feetype.due_date, `classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `students` JOIN `student_session` ON `student_session`.`student_id` = `students`.`id` JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN student_fees_master on student_fees_master.student_session_id=student_session.id and student_fees_master.fee_session_group_id=" . $this->db->escape($feegroup_id) . " LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=" . $this->db->escape($fee_groups_feetype_id) . "  INNER JOIN fee_groups_feetype on fee_groups_feetype.id = " . $this->db->escape($fee_groups_feetype_id) . " WHERE `student_session`.`session_id` = " . $this->current_session . " AND 
            `students`.`is_active` = 'yes'  AND 
            `student_session`.`class_id` = " . $this->db->escape($class_id) . " AND `student_session`.`section_id` = " . $this->db->escape($section_id) . " ORDER BY `students`.`firstname`";
        $query = $this->db->query($query);
        return $query->result_array();
    }
	
	
	
	
	
	
	public function getDueStudentMessFees($feegroup_id = null, $messfeemasters_id = null) {

        $query = "SELECT IFNULL(student_messfees_deposite.id, 0) as student_messfees_deposite_id, IFNULL(student_messfees_deposite.messfeemasters_id, 0) as messfeemasters_id, IFNULL(student_messfees_deposite.amount_detail, 0) as amount_detail, student_messfees_master.id as `fee_master_id`,messfeemasters.feetype_id ,messfeemasters.amount,messfeemasters.due_date, `classes`.`id` AS `class_id`, `student_session`.`id` as `student_session_id`, `students`.`id`, `classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, `students`.`id`, `students`.`admission_no`, `students`.`roll_no`, `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`, `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`, `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, `students`.`current_address`, `students`.`permanent_address`, IFNULL(students.category_id, 0) as `category_id`, IFNULL(categories.category, '') as `category`, `students`.`adhar_no`, `students`.`samagra_id`, `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`, `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`, `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`, `students`.`updated_at`, `students`.`father_name`, `students`.`rte`, `students`.`gender` FROM `students` JOIN `student_session` ON `student_session`.`student_id` = `students`.`id` JOIN `classes` ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` ON `students`.`category_id` = `categories`.`id` INNER JOIN student_messfees_master on student_messfees_master.student_session_id=student_session.id and student_messfees_master.mess_fee_session_id=" . $this->db->escape($feegroup_id) . " LEFT JOIN student_messfees_deposite on student_messfees_deposite.student_messfees_master_id=student_messfees_master.id and student_messfees_deposite.messfeemasters_id=" . $this->db->escape($messfeemasters_id) . "  INNER JOIN messfeemasters on messfeemasters.id = " . $this->db->escape($messfeemasters_id) . " WHERE `student_session`.`session_id` = " . $this->current_session . " AND `students`.`is_active` = 'yes' ORDER BY `students`.`id`";
        $query = $this->db->query($query);
        return $query->result_array();
    }
	
	
	
    public function getDueFeeBystudent($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine,IFNULL(student_fees.payment_mode, 'xxx') as payment_mode,IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category,student_fees.description FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.payment_mode,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id,student_fees.description  from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id JOIN feetype ON feemasters.feetype_id = feetype.id JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getDueFeeBystudentSection($class_id = null, $section_id = null, $student_session_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.id=" . $this->db->escape($student_session_id) . " ) as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeesByClass($class_id = null, $section_id = null, $student_id = null) {
        $query = "SELECT feemasters.id as feemastersid, feemasters.amount as amount,IFNULL(student_fees.id, 'xxx') as invoiceno,IFNULL(student_fees.amount_discount, 'xxx') as discount,IFNULL(student_fees.amount_fine, 'xxx') as fine, IFNULL(student_fees.date, 'xxx') as date,feetype.type ,feecategory.category FROM feemasters LEFT JOIN (select student_fees.id,student_fees.feemaster_id,student_fees.amount_fine,student_fees.amount_discount,student_fees.date,student_fees.student_session_id from student_fees , student_session where student_fees.student_session_id=student_session.id and student_session.student_id=" . $this->db->escape($student_id) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_fees ON student_fees.feemaster_id=feemasters.id LEFT JOIN feetype ON feemasters.feetype_id = feetype.id LEFT JOIN feecategory ON feetype.feecategory_id = feecategory.id  where  feemasters.class_id=" . $this->db->escape($class_id) . " and feemasters.session_id=" . $this->db->escape($this->current_session);
        $query = $this->db->query($query);
        return $query->result_array();
    }

    public function getFeeBetweenDate($start_date, $end_date) {

        $this->db->select('student_fees.date,student_fees.id,student_fees.amount,student_fees.amount_discount,student_fees.amount_fine,student_fees.created_at,students.rte,classes.class,sections.section,students.firstname,students.lastname,students.admission_no,students.roll_no,students.dob,students.guardian_name,feetype.type')->from('student_fees');
        $this->db->join('student_session', 'student_session.id = student_fees.student_session_id');
        $this->db->join('feemasters', 'feemasters.id = student_fees.feemaster_id');
        $this->db->join('feetype', 'feetype.id = feemasters.feetype_id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('students', 'students.id = student_session.student_id');
        $this->db->where('student_fees.date >=', $start_date);
        $this->db->where('student_fees.date <=', $end_date);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->order_by('student_fees.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentTotalFee($class_id, $student_session_id) {
        $query = "SELECT a.totalfee,b.fee_deposit,b.payment_mode  FROM ( SELECT COALESCE(sum(amount),0) as totalfee FROM `feemasters` WHERE session_id =$this->current_session and class_id=" . $this->db->escape($class_id) . ") as a, (select COALESCE(sum(amount),0) as fee_deposit,payment_mode from student_fees WHERE student_session_id =" . $this->db->escape($student_session_id) . ") as b";
        $query = $this->db->query($query);
        return $query->row();
    }
	
	
	public function get_category_list()
	{
		$admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
		$this->db->select('type,id')->from('feetype')->where('centre_id',$centre_id);
		 return $this->db->get()->result_array();
		
	}
	
	
	public function fee_category_report($date_from, $date_to, $fee_category=null)
	{
	
     $admin=$this->session->userdata('admin');
     $centre_id=$admin['centre_id'];	
	 $st_date = strtotime($date_from);
     $ed_date = strtotime($date_to);
	
	$this->db->select('student_fees_deposite.created_at,students.admission_no,student_session.student_id, student_fees_master.student_session_id,student_fees_deposite.student_fees_master_id,student_fees_deposite.fee_groups_feetype_id,student_fees_deposite.amount_detail')->from('student_fees_deposite');

    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
	 $this->db->join('fee_groups_feetype','fee_groups_feetype.id=student_fees_deposite.fee_groups_feetype_id ');
      $this->db->join('students', 'students.id=student_session.student_id');
      $this->db->where('students.centre_id',$centre_id);
	  
	  if($fee_category!=null)
	  {
	  $this->db->where_in('fee_groups_feetype.feetype_id',$fee_category);
	  }
	  $this->db->order_by('student_fees_deposite.id');
       	  $query = $this->db->get();
	      $result_value = $query->result();    
	
	   
	
	     $array=array();
		foreach($result_value as $key =>$val)
		 {
			  $return = $this->findObjectById($val, $st_date, $ed_date);
			  
			  if(!empty($return))
			  {
				  $a=new stdClass();
				 $a->admission_no=$val->admission_no;
				 $a->student_fees_master_id=$val->student_fees_master_id;
				 $a->collection_record=$this->get_collection_record($val->fee_groups_feetype_id,$val->student_fees_master_id,$date_from,$date_to); 
				  $array[]=$a;
				  }
			  
			
			 
		 }
		 
		
		 return  $array;
	
		
		
		
	}

	
	function get_collection_record($fee_groups_feetype_id,$student_fees_master_id,$start_date,$end_date)
 {
	$this->db->select('student_fees_deposite.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`,`feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
$this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');
  $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
   $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
		$this->db->where('student_fees_deposite.student_fees_master_id',$student_fees_master_id);
		$this->db->where('student_fees_deposite.fee_groups_feetype_id',$fee_groups_feetype_id);
         //$this->db->order_by('student_fees_deposite.id');
       	  $query = $this->db->get();
           $result=$query->result();
		  
		
		  
		  $arr=array();
		  
		  if(!empty($result))
		  {
			  
			  $st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
			  
		  foreach($result as $key => $value)
		  {
			 $return = $this->findObjectById($value, $st_date, $ed_date);  
			  if(!empty($return))
			  {
			  foreach($return as $r_key => $r_res)
			  {
				        $a['id'] = $value->id;
                        $a['student_fees_master_id'] = $value->student_fees_master_id;
                        $a['fee_groups_feetype_id'] = $value->fee_groups_feetype_id;
                        $a['firstname'] = $value->firstname;
                        $a['lastname'] = $value->lastname;
                        $a['class_id'] = $value->class_id;
                        $a['class'] = $value->class;
                        $a['section'] = $value->section;
                        $a['section_id'] = $value->section_id;
                        $a['student_id'] = $value->student_id;
                        $a['name'] = $value->name;
                        $a['type'] = $value->type;
                        $a['code'] = $value->code;
                        $a['student_session_id'] = $value->student_session_id;
                        $a['amount'] = $r_res->amount;
                        $a['date'] = $r_res->date;
                        $a['amount_discount'] = $r_res->amount_discount;
                        $a['amount_fine'] = $r_res->amount_fine;
                        $a['description'] = $r_res->description;
                        $a['payment_mode'] = $r_res->payment_mode;
                        $a['inv_no'] = $r_res->inv_no;  
				        $arr[]=$a;
				  
			              }
			             }
			            }
		               }
			   return $arr;
			 
	  }

	
	 function findObjectById($array, $st_date, $ed_date) {

        $ar = json_decode($array->amount_detail);
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if ($row_value->date == $find) {
                    $array[] = $row_value;
                }
            }
        }
        return $array;
    }
	
	
	public function getNotAppliedfeetype($student_id)
	{
		/*$this->db->select('fee_type.type,fee_groups_feetype.amount')->from('student_fees_master');
		//$this->db->join('fee_session_groups','fee_session_groups.id=student_fees_master.fee_session_group_id');
		$this->db->join('fee_groups_feetype','fee_groups_feetype.fee_session_group_id=student_fees_master.fee_session_group_id');
		$this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');
		$this->db->where('student_fees_master.student_id',$student_id);
		$query=$this->db->get();
		return $query->result_array();*/
		
		
		$sql = "SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.finetype,fee_groups_feetype.amounttype,fee_groups_feetype.fixedamount,fee_groups_feetype.percentage,fee_groups.name,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.student_id =" . $student_id;
	$query = $this->db->query($sql);
     return $result=$query->result();	
	
	/*$fee=array();
	if(!empty($result))
	{
	 foreach($result as $key=>$res)
	 {
		 
		 $a=new stdClass();
		 $a->amount=$res->amount;
		 $a->type=$res->type;
		  
		 
	 }
	 	
	}
	
	*/
	
		
	}
	
	
	public function getNotAppliedMessfeetype($student_id)
	{
		
		$sql = "SELECT student_messfees_master.*, IFNULL(student_messfees_deposite.id,0) as `student_messfees_deposite_id`, IFNULL(student_messfees_deposite.amount_detail,0) as `amount_detail` FROM `student_messfees_master` LEFT JOIN student_messfees_deposite on student_messfees_deposite.student_messfees_master_id=student_messfees_master.id  WHERE student_messfees_master.student_id =" .$student_id;
	$query = $this->db->query($sql);
     return $result=$query->result();	
	
	
		
	}
	
	
		public function delete_fee_ex($id,$invoice)
	   {
		
	$this->db->trans_start();
	$this->db->where('id', $id);
    $this->db->delete('fees_excess');
	
	$data=array('is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'));
	$this->db->where('invoice_no',$invoice);
	$this->db->update('income',$data);
	
	
	$this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();
            return FALSE;
        } else {

            $this->db->trans_commit();
            return TRUE;
        }
		
		}
		
		
		
		
		public function delete_fee_ad($id,$invoice)
	{
		$this->db->trans_start();
	$this->db->where('id', $id);
    $this->db->delete('fees_advance');
	
	$data=array('is_cancelled'=>1,'cancelled_date'=>date('Y-m-d'));
	$this->db->where('invoice_no',$invoice);
	$this->db->update('income',$data);
	
	
	
	$this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {

            $this->db->trans_rollback();
            return FALSE;
        } else {

            $this->db->trans_commit();
            return TRUE;
        }
		
		}
	
	
	
	
	public function delete_Messfee_ad($id)
	{
	$this->db->where('id', $id);
    $this->db->delete('messfee_advance');
		
		}
		
		
		
	public function check_studentfeeadvance($id)
	{
	  $this->db->select('*')->from('student_messfees_master');
	  $this->db->where('balance_amount!=',0);
	  $this->db->where('is_system',1);
	  $this->db->where('student_id',$id);
	  $res=$this->db->get();
	  $val=$res->result_array();
	  $count=$res->num_rows();
	 $ar=array('c'=>$count,'val'=> $val);
	  return $ar;
	  }	
		
		
	public function deletedamount($date_from, $date_to, $type)
	{
		 $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];	
		$sql="SELECT sum(amount) as `deleted_amount` FROM income WHERE date BETWEEN ".$this->db->escape($date_from)."AND ".$this->db->escape($date_to)." and name=".$this->db->escape($type)." and centre_id=". $centre_id." and  is_cancelled=1";
		$query=$this->db->query($sql); 
		return $query->row_array();
		
		}
              
		
		public function get_headwisesummary($date_from,$date_to,$fee_group=null,$fee_category=null,$payment_mode)
		{
			
		$admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];	
		$this->db->select('id,type')->from('feetype')->where('centre_id', $centre_id);
		if($fee_category!=null)
		{
			 $this->db->where_in('id',$fee_category);
			
			}
		$res=$this->db->get();	
		$result=$res->result_array();
		$value=array();
		if($res->num_rows()>0)
		{
			foreach($result as $key=>$type)
			{
				$a=array();
				$a['type']=$type['type'];
				if($fee_group!=null)
				{
				$feetotal=$this->headwise_feetotal($type['id'],$date_from,$date_to,$fee_group,$payment_mode);
				}
				else{
					
					$feetotal=$this->headwise_feetotal($type['id'],$date_from,$date_to,"",$payment_mode);
					
					}
				
				$a['amount']=$feetotal['value']['amount'];
				$a['fine']=$feetotal['value']['fine'];
				$a['deleted_amount']=$feetotal['value']['deleted_amount'];
				$value[]=$a;
				}}
			return $value;
			}
			
 function headwise_feetotal($id,$date_from,$date_to,$fee_group=null,$payment_mode)
	{
	  
		
	 $this->db->select('student_fees_deposite.*')->from('fee_groups_feetype');
	 $this->db->join('student_fees_deposite','student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id');
	 $this->db->where('fee_groups_feetype.feetype_id',$id);
	 if($fee_group!=null)
	 {
		 $this->db->where_in('fee_groups_feetype.fee_groups_id',$fee_group);
		 
		 }
	  $query=$this->db->get();
	 $result=$query->result();
	 
	
	
	if(!empty($result))
		{
			$st_date = strtotime($date_from);
            $ed_date = strtotime($date_to);
			 $amount=0;
			 $fine=0;
			foreach($result as $val)
			{
			if($payment_mode=='All')
			{	
		$return = $this->studentfeemaster_model->findObjectById($val, $st_date, $ed_date);
			}
		else{
			
			  $return = $this->studentfeemaster_model->findObjectById_report($val, $st_date, $ed_date,$payment_mode);
			  }
		
		if(!empty($return))
				{
					 $deleted_amount=0; 
					
				 foreach($return as $r_key=>$re)
				 {
					
					 
					 $deleted_amount=$deleted_amount+$deleted->amount;
					 $amount=$amount+$re->amount;
					 $fine=$fine+$re->fine;
					
					 }}
			        }
				$a['deleted_amount']=$deleted_amount;	
				$a['amount']= $amount;
				$a['fine']=$fine;
					 
			   $array['value']=$a; 
		
		}
		
		
		 return $array;	
	}
	
	
	function getCancelled_amount($id,$invo)
	{
		$val=$this->db->select('type')->from('feetype')->where('id',$id)->get();
		$res=$val->row_array();
		
		$this->db->select('amount')->from('income');
		$this->db->where('invoice_no',$invo);
		$this->db->where('name',$res['type']);
		return $this->db->get()->row();
		}
	
	
	
	
	
	
	
	
	
	
	
	public function get_headwise_otherpay($date_from,$date_to,$payment_mode)
	{
	 
	 $incomehead=$this->incomehead_model->get();
		$result=array();
		if(isset($incomehead))
		{
		 foreach($incomehead as  $key=>$income)
		 {
			 $a['income']=$income['income_category'];
			 $t=$this->total_incomeamount($income['id'],$date_from,$date_to,$payment_mode);
			 $a['amount']=$t['amount'];
			 $result[]=$a;
			 }	
			}
		
			
		return $result;
		
	
		}
	
	
	
	function total_incomeamount($id,$date_from,$date_to,$payment_mode)
	{
		
		if($payment_mode=='All')
		{
		 $q='';
		
		}
		else
		{
			$q.=" and  mode='".$payment_mode."'";
			
			}
			
			$sql="SELECT SUM(amount) as amount FROM income WHERE date BETWEEN".$this->db->escape($date_from)." and".$this->db->escape($date_to)."and is_cancelled=0 and inc_head_id=".$id.$q;
		$res=$this->db->query($sql);
		return $res->row_array();
	
		
		
		}
	 
	
	
		
}
