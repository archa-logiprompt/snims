<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentfeemaster_model extends CI_Model {

    protected $balance_group;
    protected $balance_type;

    public function __construct() {
        parent::__construct();
        $this->load->config('ci-blog');
        $this->balance_group = $this->config->item('ci_balance_group');
        $this->balance_type = $this->config->item('ci_balance_type');
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function searchAssignFeeByClassSection($class_id = null, $section_id = null, $fee_session_group_id = null, $category = null, $gender = null, $rte = null) {
        $sql = "SELECT IFNULL(`student_fees_master`.`id`, '0') as `student_fees_master_id`,`classes`.`id` AS `class_id`,"
                . " `student_session`.`id` as `student_session_id`, `students`.`id`, "
                . "`classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, "
                . "`students`.`id`, `students`.`admission_no`, `students`.`roll_no`,"
                . " `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`,"
                . " `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`,"
                . " `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, "
                . "`students`.`current_address`, `students`.`permanent_address`,"
                . " IFNULL(students.category_id, 0) as `category_id`,"
                . " IFNULL(categories.category, '') as `category`,"
                . " `students`.`adhar_no`, `students`.`samagra_id`,"
                . " `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`,"
                . " `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`,"
                . " `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`,"
                . " `students`.`updated_at`, `students`.`father_name`, `students`.`rte`,"
                . " `students`.`gender` FROM `students` JOIN `student_session` "
                . "ON `student_session`.`student_id` = `students`.`id` JOIN `classes` "
                . "ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` "
                . "ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` "
                . "ON `students`.`category_id` = `categories`.`id` LEFT JOIN student_fees_master on"
                . " student_fees_master.student_session_id=student_session.id"
                . "  AND student_fees_master.fee_session_group_id=" . $this->db->escape($fee_session_group_id)
                . "WHERE `student_session`.`session_id` =  " . $this->current_session
                . " and `students`.`is_active` =  'yes'";

        if ($class_id != null) {
            $sql .= " AND `student_session`.`class_id` = " . $this->db->escape($class_id);
        }
        if ($section_id != null) {
            $sql .= " AND `student_session`.`section_id` =" . $this->db->escape($section_id);
        }
        if ($category != null) {
            $sql .= " AND `students`.`category_id` =" . $this->db->escape($category);
        }
        if ($gender != null) {
            $sql .= " AND `students`.`gender` =" . $this->db->escape($gender);
        }
        if ($rte != null) {
            $sql .= " AND `students`.`rte` =" . $this->db->escape($rte);
        }
        $sql .= " ORDER BY `students`.`id`";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
	
	public function searchAssignMessFeeByClassSection($class_id = null, $section_id = null, $month, $category = null, $gender = null, $rte = null) {
		
		
        $sql = "SELECT IFNULL(`student_messfees_master`.`id`, '0') as `student_messfees_master_id`, IFNULL(`student_messfees_master`.`amount`, '0') as `amount`,`classes`.`id` AS `class_id`,"
                . " `student_session`.`id` as `student_session_id`, `students`.`id`, "
                . "`classes`.`class`, `sections`.`id` AS `section_id`, `sections`.`section`, "
                . "`students`.`id`, `students`.`admission_no`, `students`.`roll_no`,"
                . " `students`.`admission_date`, `students`.`firstname`, `students`.`lastname`,"
                . " `students`.`image`, `students`.`mobileno`, `students`.`email`, `students`.`state`,"
                . " `students`.`city`, `students`.`pincode`, `students`.`religion`, `students`.`dob`, "
                . "`students`.`current_address`, `students`.`permanent_address`,"
                . " IFNULL(students.category_id, 0) as `category_id`,"
                . " IFNULL(categories.category, '') as `category`, "
                . " `students`.`adhar_no`, `students`.`samagra_id`,"
                . " `students`.`bank_account_no`, `students`.`bank_name`, `students`.`ifsc_code`,"
                . " `students`.`guardian_name`, `students`.`guardian_relation`, `students`.`guardian_phone`,"
                . " `students`.`guardian_address`, `students`.`is_active`, `students`.`created_at`,"
                . " `students`.`updated_at`, `students`.`father_name`, `students`.`rte`,"
                . " `students`.`gender` FROM `students` JOIN `student_session` "
                . "ON `student_session`.`student_id` = `students`.`id` JOIN `classes` "
                . "ON `student_session`.`class_id` = `classes`.`id` JOIN `sections` "
                . "ON `sections`.`id` = `student_session`.`section_id` LEFT JOIN `categories` "
                . "ON `students`.`category_id` = `categories`.`id` LEFT JOIN student_messfees_master on"
                . " student_messfees_master.student_session_id=student_session.id "
				. " AND student_messfees_master.month =".$this->db->escape($month) 
				. " AND student_messfees_master.is_system = 0 "
				. " WHERE `student_session`.`session_id` =  " . $this->current_session   
				. " and `students`.`is_active` =  'yes'";

        if ($class_id != null) {
            $sql .= " AND `student_session`.`class_id` = " . $this->db->escape($class_id);
        }
        if ($section_id != null) {
            $sql .= " AND `student_session`.`section_id` =" . $this->db->escape($section_id);
        }
        if ($category != null) {
            $sql .= " AND `students`.`category_id` =" . $this->db->escape($category);
        }
        if ($gender != null) {
            $sql .= " AND `students`.`gender` =" . $this->db->escape($gender);
        }
        if ($rte != null) {
            $sql .= " AND `students`.`rte` =" . $this->db->escape($rte);
        }
        $sql .= " ORDER BY `students`.`id`";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
    public function add($data) {

        $this->db->where('student_session_id', $data['student_session_id']);
        $this->db->where('fee_session_group_id', $data['fee_session_group_id']);
        $q = $this->db->get('student_fees_master');

        if ($q->num_rows() > 0) {
            return $q->row()->id;
        } else {
            $this->db->insert('student_fees_master', $data);
            return $this->db->insert_id();
        }
    }
	
	
	
	 public function addmess($data) {
        
		
		$this->db->where('student_session_id', $data['student_session_id']);
        $this->db->where('month', $data['month']);
		$this->db->where('is_system',0);
        $q = $this->db->get('student_messfees_master');
		
		  if ($q->num_rows() > 0) {
			 $result=$q->row();
			 if($result->amount !=$data['amount'])
			 {
				 $this->db->trans_start();
				 
				$this->db->where('id',$result->id);
				$this->db->update('student_messfees_master',$data);
				
				$fee_advance=$this->studentfee_model->check_studentfeeadvance($data['student_id']);
				
				if(!empty($fee_advance['val']))
	               {
			
			
			      
			 $data['advance_paid']=1;
			$exceed_amount=0;
			
			$balance_amount=0;
			
			foreach($fee_advance['val'] as $key=>$fee)
			{
				$amount=$data['amount']+ $exceed_amount;
				$num_loop=$key+1;
				
			 if($fee['balance_amount'] !=0)
			 {
				if($fee['balance_amount'] >= $amount ) 
				{
					$balance_amount=$fee['balance_amount'] - $amount;
					
		   
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);
					
			 $this->db->insert('student_messfees_master', $data);
             $master_id= $this->db->insert_id();
			 
			 $json_arr=array(
				'amount'=>$data['amount'],
				'description'=>'Collected from fees advance',
				'advance_bal'=>$exceed_amount,
				'month'=>$data['month']
			    );
			  $this->db->where('student_messfees_master_id',$fee['id']);
			 $q=$this->db->get('student_messfees_deposite')->row();
			  $a = json_decode($q->advance_collected, true);
			  if(!empty($a))
			  {
				  $this->db->where('id',$q->id);
				    $inv = max(array_keys($a)) + 1; 
				    $a[$inv]= $json_arr;
					
					$deposit=array(
				'advance_collected'=>json_encode($a),
				);
				$this->db->update('student_messfees_deposite', $deposit);
				  
				  }
				
				else {
				
				$deposit=array(
				'advance_collected'=>json_encode(array('1' => $json_arr)),
				);
				
				 $this->db->where('student_messfees_master_id',$fee['id']);
				 $this->db->update('student_messfees_deposite', $deposit);
				}
					
					break;
					}
				  else if($fee['balance_amount'] < $amount)
				  {
					 $exceed_amount = $amount - $fee['balance_amount']; 
					  $balance_amount=0;
					  
					  $num_arr=$fee_advance['c'];
					  
					    if($num_loop ==$num_arr)
						{
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);	
			
			$master=array(
			'student_session_id'=>$data['student_session_id'],
			'amount'=> $exceed_amount,
			'month'=>$data['month'],
			'type'=>'Balance Fee',
			'due_date'=>$data['due_date'],
			'student_id'=>$data['student_id']
			
			);				
			
			$this->db->insert('student_messfees_master',$master);				
							
							}
						
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);		
						
							
				$json_arr=array(
				'amount'=>$fee['balance_amount'],
				'description'=>'Collected from advance fee',
				'month'=>$data['month']
			    );
			  $this->db->where('student_messfees_master_id',$fee['id']);
			 $q=$this->db->get('student_messfees_deposite')->row();
			 $a = json_decode($q->advance_collected, true);
							
				if(!empty($a))
			  {
				  $this->db->where('id',$q->id);
				    $inv = max(array_keys($a)) + 1; 
				    $a[$inv]= $json_arr;
					
					$deposit=array(
				'advance_collected'=>json_encode($a),
				);
				$this->db->update('student_messfees_deposite', $deposit);
				  
				  }			
							
			      }
				 }	
				}
			 
			   }
			  
			  
			  
			   $this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return TRUE;
                 }
			     }
			   
			    else
				 {
			 
            return $q->row()->id; }
        } else {
			
			$this->db->trans_start();
			
			$fee_advance=$this->studentfee_model->check_studentfeeadvance($data['student_id']);
			  
			  
			
			if(!empty($fee_advance['val']))
	    {
			 $data['advance_paid']=1;
			$exceed_amount=0;
			
			$balance_amount=0;
			
			foreach($fee_advance['val'] as $key=>$fee)
			{
				$amount=$data['amount']+ $exceed_amount;
				$num_loop=$key+1;
				
			 if($fee['balance_amount'] !=0)
			 {
				if($fee['balance_amount'] >= $amount ) 
				{
					$balance_amount=$fee['balance_amount'] - $amount;
					
		   
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);
					
			 $this->db->insert('student_messfees_master', $data);
             $master_id= $this->db->insert_id();
			 
			 $json_arr=array(
				'amount'=>$data['amount'],
				'description'=>'Collected from fees advance',
				'advance_bal'=>$exceed_amount,
				'month'=>$data['month']
			    );
			  $this->db->where('student_messfees_master_id',$fee['id']);
			 $q=$this->db->get('student_messfees_deposite')->row();
			  $a = json_decode($q->advance_collected, true);
			  if(!empty($a))
			  {
				  $this->db->where('id',$q->id);
				    $inv = max(array_keys($a)) + 1; 
				    $a[$inv]= $json_arr;
					
					$deposit=array(
				'advance_collected'=>json_encode($a),
				);
				$this->db->update('student_messfees_deposite', $deposit);
				  
				  }
				
				else {
				
				$deposit=array(
				'advance_collected'=>json_encode(array('1' => $json_arr)),
				);
				
				 $this->db->where('student_messfees_master_id',$fee['id']);
				 $this->db->update('student_messfees_deposite', $deposit);
				}
					
					break;
					}
				  else if($fee['balance_amount'] < $amount)
				  {
					 $exceed_amount = $amount - $fee['balance_amount']; 
					  $balance_amount=0;
					  
					  $num_arr=$fee_advance['c'];
					  
					    if($num_loop ==$num_arr)
						{
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);	
			
			$master=array(
			'student_session_id'=>$data['student_session_id'],
			'amount'=> $exceed_amount,
			'month'=>$data['month'],
			'type'=>'Balance Fee',
			'due_date'=>$data['due_date'],
			'student_id'=>$data['student_id']
			
			);				
			
			$this->db->insert('student_messfees_master',$master);				
							
							}
						
			$master_amount=array('balance_amount'=>$balance_amount);
			$this->db->where('id',$fee['id']);
			$this->db->update('student_messfees_master',$master_amount);		
						
							
				$json_arr=array(
				'amount'=>$fee['balance_amount'],
				'description'=>'Collected from advance fee',
				'month'=>$data['month']
			    );
			  $this->db->where('student_messfees_master_id',$fee['id']);
			 $q=$this->db->get('student_messfees_deposite')->row();
			 $a = json_decode($q->advance_collected, true);
							
				if(!empty($a))
			  {
				  $this->db->where('id',$q->id);
				    $inv = max(array_keys($a)) + 1; 
				    $a[$inv]= $json_arr;
					
					$deposit=array(
				'advance_collected'=>json_encode($a),
				);
				$this->db->update('student_messfees_deposite', $deposit);
				  
				  }			
							
			      }
				 }	
				}
			
		}
		else {	
			
		  $this->db->insert('student_messfees_master', $data);
            $insert_id= $this->db->insert_id();
		}
		
		        $this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return $insert_id;
                 }
			 
		}
		
			
		 
      
	  }
    
	
	
	
	
	
	

    public function addPreviousBal($student_data, $due_date) {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $fee_group_exists = $this->feegroup_model->checkGroupExistsByName($this->balance_group);
        $fee_type_exists = $this->feetype_model->checkFeetypeByName($this->balance_type);
        $fee_group_id = 0;
        $fee_type_id = 0;
        if (!$fee_group_exists) {
            $this->db->insert('fee_groups', array('name' => $this->balance_group, 'is_system' => 1));
            $fee_group_id = $this->db->insert_id();
        } else {
            $fee_group_id = $fee_group_exists->id;
        }

        if (!$fee_type_exists) {
            $this->db->insert('feetype', array('type' => $this->balance_type, 'code' => $this->balance_type, 'is_system' => 1));
            $fee_type_id = $this->db->insert_id();
        } else {
            $fee_type_id = $fee_type_exists->id;
        }
        $to_be_insert = array(
            'session_id' => $this->current_session,
            'fee_groups_id' => $fee_group_id,
            'feetype_id' => $fee_type_id,
            'fee_session_group_id' => 0,
            'due_date' => $due_date
        );
        $parentid = $this->feesessiongroup_model->group_exists($to_be_insert['fee_groups_id']);

        $to_be_insert['fee_session_group_id'] = $parentid;

        $session_group_exists = $this->feesessiongroup_model->checkExists($to_be_insert);
        if (!$session_group_exists) {
            $this->db->insert('fee_groups_feetype', $to_be_insert);
        } else {
            $this->db->where('id', $session_group_exists);
            $this->db->update('fee_groups_feetype', $to_be_insert);
        }
        $student_list = array();
        if (isset($student_data) && !empty($student_data)) {

            $total_rec = count($student_data);
            for ($i = 0; $i < $total_rec; $i++) {
                $student_list[] = $student_data[$i]['student_session_id'];
                $student_data[$i]['id'] = 0;
                $student_data[$i]['fee_session_group_id'] = $parentid;
            }
            $check_insert_feemaster = $this->selectInArray($parentid, $student_list);
            if (!empty($check_insert_feemaster)) {
                $insert_new_student = array();
                foreach ($student_data as $student_key => $student_value) {
                    $student_data[$student_key]['id'] = $this->findValueExists($check_insert_feemaster, $student_value['student_session_id']);
                    if ($student_data[$student_key]['id'] == 0) {
                        $insert_new_student[] = $student_data[$student_key];
                        unset($student_data[$student_key]);
                    }
                }

                if (!empty($insert_new_student)) {
                    $this->db->insert_batch('student_fees_master', $insert_new_student);
                }
                $this->db->update_batch('student_fees_master', $student_data, 'id');
            } else {
                $this->db->insert_batch('student_fees_master', $student_data);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
	
	
	
	
	
	
	
	
	public function addPreviousMessBal($student_data, $due_date) {
        $this->db->trans_start();
        $this->db->trans_strict(FALSE);
        $fee_group_exists = $this->feegroup_model->checkGroupExistsByName_mess($this->balance_group);
        $fee_type_exists = $this->feetype_model->checkFeetypeByName_mess($this->balance_type);
        $fee_group_id = 0;
        $fee_type_id = 0;
        if (!$fee_group_exists) {
            $this->db->insert('messfeegroup', array('name' => $this->balance_group, 'is_system' => 1));
            $fee_group_id = $this->db->insert_id();
        } else {
            $fee_group_id = $fee_group_exists->id;
        }

        if (!$fee_type_exists) {
            $this->db->insert('messfeetype', array('type' => $this->balance_type, 'code' => $this->balance_type, 'is_system' => 1));
            $fee_type_id = $this->db->insert_id();
        } else {
            $fee_type_id = $fee_type_exists->id;
        }
        $to_be_insert = array(
            'session_id' => $this->current_session,
            'fee_groups_id' => $fee_group_id,
            'feetype_id' => $fee_type_id,
            'mess_fee_session_id' => 0,
            'due_date' => $due_date
        );
        $parentid = $this->feesessiongroup_model->messfee_group_exists($to_be_insert['fee_groups_id']);

        $to_be_insert['mess_fee_session_id'] = $parentid;

        $session_group_exists = $this->feesessiongroup_model->messfee_checkExists($to_be_insert);
        if (!$session_group_exists) {
            $this->db->insert('messfeemasters', $to_be_insert);
        } else {
            $this->db->where('id', $session_group_exists);
            $this->db->update('messfeemasters', $to_be_insert);
        }
        $student_list = array();
        if (isset($student_data) && !empty($student_data)) {

            $total_rec = count($student_data);
            for ($i = 0; $i < $total_rec; $i++) {
                $student_list[] = $student_data[$i]['student_session_id'];
                $student_data[$i]['id'] = 0;
                $student_data[$i]['mess_fee_session_id'] = $parentid;
            }
            $check_insert_feemaster = $this->messfee_selectInArray($parentid, $student_list);
            if (!empty($check_insert_feemaster)) {
                $insert_new_student = array();
                foreach ($student_data as $student_key => $student_value) {
                    $student_data[$student_key]['id'] = $this->findValueExists($check_insert_feemaster, $student_value['student_session_id']);
                    if ($student_data[$student_key]['id'] == 0) {
                        $insert_new_student[] = $student_data[$student_key];
                        unset($student_data[$student_key]);
                    }
                }

                if (!empty($insert_new_student)) {
                    $this->db->insert_batch('student_messfees_master', $insert_new_student);
                }
                $this->db->update_batch('student_messfees_master', $student_data, 'id');
            } else {
                $this->db->insert_batch('student_messfees_master', $student_data);
            }
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
	
	
	
	
	
	

    function findValueExists($array, $find) {
        $id = 0;
        foreach ($array as $x => $x_value) {
            if ($x_value->student_session_id == $find)
                return $x_value->id;
        }
        return $id;
    }

    public function selectInArray($fee_session_groups, $student_session_array) {

        $this->db->where('fee_session_group_id', $fee_session_groups);
        $this->db->where_in('student_session_id', $student_session_array);
        $q = $this->db->get('student_fees_master');
        $result = $q->result();
        return $result;
    }
	
	
	
	 public function messfee_selectInArray($mess_fee_session_id, $student_session_array) {

        $this->db->where('mess_fee_session_id', $mess_fee_session_id);
        $this->db->where_in('student_session_id', $student_session_array);
        $q = $this->db->get('student_messfees_master');
        $result = $q->result();
        return $result;
    }
	
	

    public function delete($fee_session_groups, $array) {

        $this->db->where('fee_session_group_id', $fee_session_groups);
        $this->db->where_in('student_session_id', $array);
        $this->db->delete('student_fees_master');
    }
	
	
	
	 public function deletemessmaster($month, $array) {
		
		 
        $this->db->where('month',$month);
        $this->db->where_in('student_session_id', $array);
		$this->db->where('is_system',0);
        $this->db->delete('student_messfees_master');
			
    }
	
	
	

    public function getBalanceMasterRecord($group_name, $student_session_array) {
        $sql = "select * from student_fees_master where student_session_id in $student_session_array and fee_session_group_id=(SELECT id FROM `fee_session_groups` where fee_groups_id=(SELECT id FROM `fee_groups` WHERE name=" . "'" . $group_name . "'" . ") and session_id=$this->current_session)";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
	
	public function getMessBalanceMasterRecord($group_name, $student_session_array) {
        $sql = "select * from student_messfees_master where student_session_id in $student_session_array and mess_fee_session_id=(SELECT id FROM `mess_fee_session` where fee_groups_id=(SELECT id FROM `messfeegroup` WHERE name=" . "'" . $group_name . "'" . ") and session_id=$this->current_session)";

        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
	
	
	
	

    public function getStudentFees($student_id) {
        $sql = "SELECT `student_fees_master`.*,fee_groups.name FROM `student_fees_master` INNER JOIN fee_session_groups on student_fees_master.fee_session_group_id=fee_session_groups.id INNER JOIN fee_groups on fee_groups.id=fee_session_groups.fee_groups_id  WHERE `student_id` = " . $student_id . " ORDER BY `student_fees_master`.`id`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
                $fee_session_group_id = $result_value->fee_session_group_id;
                $student_fees_master_id =$result_value->id;
                $result_value->fees = $this->getDueFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }

        return $result;
    }
	
	
	
	
	
	public function getDueFeeByFeeSessionGroup($fee_session_groups_id, $student_fees_master_id) {
        $sql = "SELECT student_fees_master.*,fee_groups_feetype.id as `fee_groups_feetype_id`,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.finetype,fee_groups_feetype.amounttype,fee_groups_feetype.fixedamount,fee_groups_feetype.percentage,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail`,IFNULL(student_fees_deposite.refund_detail,0) as `refund_detail` FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.fee_session_group_id =" . $fee_session_groups_id . " and student_fees_master.id=" . $student_fees_master_id . " order by fee_groups_feetype.due_date asc";

        $query = $this->db->query($sql);
        return $query->result();
    }
	
	
	
	
	 public function getStudentMessFees($student_id) {
        $sql = "SELECT `student_messfees_master`.* FROM `student_messfees_master`  WHERE `student_id` = " . $student_id . " and `advance_paid` =0 ORDER BY `student_messfees_master`.`id`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
                
                $student_messfees_master_id =$result_value->id;
                $result_value->fees = $this->getDueMessFeeByFeeSessionGroup( $student_messfees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }

        return $result;
    }
	

	
	


 public function getDueMessFeeByFeeSessionGroup( $student_messfees_master_id) {
        $sql = "SELECT student_messfees_master.*, IFNULL(student_messfees_deposite.id,0) as `student_messfees_deposite_id`, IFNULL(student_messfees_deposite.amount_detail,0) as `amount_detail`,IFNULL(student_messfees_deposite.refund_detail,0) as `refund_detail`,IFNULL(student_messfees_deposite.advance_collected,0) as `advance_collected` FROM `student_messfees_master` LEFT JOIN student_messfees_deposite on student_messfees_deposite.student_messfees_master_id=student_messfees_master.id  WHERE student_messfees_master.id=" . $student_messfees_master_id;

        $query = $this->db->query($sql);
        return $query->result();
    }






    public function getDueFeeByFeeSessionGroupFeetype($fee_session_groups_id, $student_fees_master_id, $fee_groups_feetype_id) {

        $sql = "SELECT  student_fees_master.id,student_fees_master.is_system,student_fees_master.student_session_id,student_fees_master.fee_session_group_id,student_fees_master.amount as `student_fees_master_amount`,fee_groups_feetype.id as `fee_groups_feetype_id`,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,students.guardian_name,students.father_name,student_session.section_id,student_session.student_id,fee_groups_feetype.amount,fee_groups_feetype.due_date,fee_groups_feetype.fee_groups_id,fee_groups.name,fee_groups_feetype.feetype_id,feetype.code,feetype.type, IFNULL(student_fees_deposite.id,0) as `student_fees_deposite_id`, IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail`,fee_groups_feetype.finetype,fee_groups_feetype.percentage, fee_groups_feetype.amounttype,fee_groups_feetype.fixedamount FROM `student_fees_master` INNER JOIN fee_session_groups on fee_session_groups.id = student_fees_master.fee_session_group_id INNER JOIN fee_groups_feetype on  fee_groups_feetype.fee_session_group_id = fee_session_groups.id  INNER JOIN fee_groups on fee_groups.id=fee_groups_feetype.fee_groups_id INNER JOIN feetype on feetype.id=fee_groups_feetype.feetype_id LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id INNER JOIN student_session on student_session.id= student_fees_master.student_session_id INNER JOIN classes on classes.id= student_session.class_id INNER JOIN sections on sections.id= student_session.section_id INNER JOIN students on students.id=student_session.student_id  WHERE student_fees_master.fee_session_group_id =" . $fee_session_groups_id . " and student_fees_master.id=" . $student_fees_master_id . " and fee_groups_feetype.id= " . $fee_groups_feetype_id;
       
        $query = $this->db->query($sql);
        return $query->row();
	 }
	 
	 
	 

    public function fee_deposit($data, $send_to, $student_fees_discount_id,$invoice) {
        $this->db->where('student_fees_master_id', $data['student_fees_master_id']);
        $this->db->where('fee_groups_feetype_id', $data['fee_groups_feetype_id']);
        $q = $this->db->get('student_fees_deposite');
		
		$admin=$this->session->userdata('admin');
		/*$invoice=$this->inv_no();*/
		
		$sub=substr($admin['financial_year'], 0, 2);
		$invoice=$invoice.'/'.$sub;
        if ($q->num_rows() > 0) {
            $desc = $data['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
			
			
			$inv_no = max(array_keys($a)) + 1;
            $data['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $data['amount_detail'];
			
            $data['amount_detail'] = json_encode($a);
            $this->db->update('student_fees_deposite', $data);
			
			$deposit['student_fee_deposit_id']= $row->id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice',$deposit);
			
			

            if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $row->id . "/" . $invoice));
            }


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        } else {

            $this->db->trans_start(); // Query will be rolled back
            $data['amount_detail']['inv_no'] = $invoice;
            $desc = $data['amount_detail']['description'];
            $data['amount_detail'] = json_encode(array( $invoice => $data['amount_detail']));
            $this->db->insert('student_fees_deposite', $data);
            $inserted_id = $this->db->insert_id();
			
			
			$deposit['student_fee_deposit_id']= $inserted_id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice', $deposit);
			
			
			
            if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $invoice));
            }

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
    }

 public function total_fee_deposit($data, $send_to, $student_fees_discount_id,$invoice)
 {
	
        $this->db->where('student_fees_master_id', $data['student_fees_master_id']);
        $this->db->where('fee_groups_feetype_id', $data['fee_groups_feetype_id']);
        $q = $this->db->get('student_fees_deposite');
		
		$admin=$this->session->userdata('admin');
		//$invoice=$this->inv_no();
		
		$sub=substr($admin['financial_year'], 0, 2);
		$invoice=$invoice.'/'.$sub;
        if ($q->num_rows() > 0) {
            $desc = $data['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
			
			
			$inv_no = max(array_keys($a)) + 1;
            $data['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $data['amount_detail'];
			
            $data['amount_detail'] = json_encode($a);
            $this->db->update('student_fees_deposite', $data);
			
			$deposit['student_fee_deposit_id']= $row->id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice',$deposit);
			
			

            if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $row->id . "/" . $invoice));
            }


            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        } else {

            $this->db->trans_start(); // Query will be rolled back
            $data['amount_detail']['inv_no'] = $invoice;
            $desc = $data['amount_detail']['description'];
            $data['amount_detail'] = json_encode(array( $invoice => $data['amount_detail']));
            $this->db->insert('student_fees_deposite', $data);
            $inserted_id = $this->db->insert_id();
			
			
			$deposit['student_fee_deposit_id']= $inserted_id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice', $deposit);
			
			
			
            if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $invoice));
            }

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
    
		 
 }


public function total_Messfee_deposit($data, $send_to,$invoice)
 {
	 
	 
        $this->db->where('student_messfees_master_id', $data['student_messfees_master_id']);
        $q = $this->db->get('student_messfees_deposite');
		
		$admin=$this->session->userdata('admin');
		//$invoice=$this->inv_no();
		
		
        if ($q->num_rows() > 0) {
            $desc = $data['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
			
			
			$inv_no = max(array_keys($a)) + 1;
            $data['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $data['amount_detail'];
			
            $data['amount_detail'] = json_encode($a);
            $this->db->update('student_messfees_deposite', $data);
			
			/*$deposit['student_fee_deposit_id']= $row->id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice',$deposit);*/
			
			

           /* if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $row->id . "/" . $invoice));
            }
*/

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        } else {

            $this->db->trans_start(); // Query will be rolled back
            $data['amount_detail']['inv_no'] = $invoice;
            $desc = $data['amount_detail']['description'];
            $data['amount_detail'] = json_encode(array( $invoice => $data['amount_detail']));
            $this->db->insert('student_messfees_deposite', $data);
            $inserted_id = $this->db->insert_id();
			
			
			/*$deposit['student_fee_deposit_id']= $inserted_id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice', $deposit);*/
			
			
			
         /*   if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $invoice));
            }*/

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
    
		 
 }



    public function messFee_deposit($data, $send_to,$invoice) {
		
		
		
        $this->db->where('student_messfees_master_id', $data['student_messfees_master_id']);
       
        $q = $this->db->get('student_messfees_deposite');
		
		$admin=$this->session->userdata('admin');
		//$invoice=$this->mess_invo();
		
		
        if ($q->num_rows() > 0) {
            $desc = $data['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
			$inv_no = max(array_keys($a)) + 1;
            $data['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $data['amount_detail'];
			
            $data['amount_detail'] = json_encode($a);
            $this->db->update('student_messfees_deposite', $data);
		  
			
			/*$deposit['student_fee_deposit_id']= $row->id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice',$deposit);
			*/
			

           /* if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $row->id . "/" . $invoice));
            }
*/

            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        } else {

            $this->db->trans_start(); // Query will be rolled back
            $data['amount_detail']['inv_no'] = $invoice;
            $desc = $data['amount_detail']['description'];
            $data['amount_detail'] = json_encode(array( $invoice => $data['amount_detail']));
            $this->db->insert('student_messfees_deposite', $data);
            $inserted_id = $this->db->insert_id();
			
			
			/*$deposit['student_fee_deposit_id']= $inserted_id;
			$this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
			$this->db->update('invoice', $deposit);*/
			
			
			
           /* if ($student_fees_discount_id != "") {
                $this->db->where('id', $student_fees_discount_id);
                $this->db->update('student_fees_discounts', array('status' => 'applied', 'description' => $desc, 'payment_id' => $invoice));
            }*/

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
    }


    function inv_no()
	{
		$this->db->trans_start();
		
		$admin=$this->session->userdata('admin');
		$this->db->select('starting_inv')->where('centre_id',$admin['centre_id'])->from('starting_invoice');
		$q=$this->db->get();
	    $row=$q->row_array();	
		
	 $res=$this->db->select('invoice.*')->where('centre_id',$admin['centre_id'])->where('year',$admin['financial_year'])->get('invoice');
	 
	if($res->num_rows() >0)
	{
	
	 $result=max($res->result_array());
	 $max_no=$result['number']+1;
	 $inv_no=$max_no;
	 $data=array(
	 'number'=>$max_no,
	 'centre_id'=>$admin['centre_id'],
	 'year'=>$admin['financial_year'],
	 'invoice_no'=>$inv_no
	 
	 );
	 
	 $this->db->insert('invoice',$data);	
	  }
	 
	  else
	   {
	
	 $inv_no=$row['starting_inv'];
	 $data=array(
	 'centre_id'=>$admin['centre_id'],
	 'number'=>$row['starting_inv'],
	 'year'=>$admin['financial_year'],
	 'invoice_no'=>$inv_no
	 
	 );
	 
	  $this->db->insert('invoice',$data);
	 	
		
		}
	            $this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return $inv_no;
                 }
	
	
	
	
		
	}


   public function  mess_invo()
   {
	  
	$this->db->trans_start();
	$starting_ivo=$this->session_model->get_mess_invo();
	$res=$this->db->select('*')->get('mess_invoice');
	 $admin=$this->session->userdata('admin'); 
	 
	  
	  if($res->num_rows() >0)
	{
	
	 $result=max($res->result_array());
	 $max_no=$result['invo']+1;
	 $inv_no=$max_no;
	 $data=array(
	 'invo'=>$max_no,
	 
	  );
	 
	 $this->db->insert('mess_invoice',$data);	
	
		
	}
	 
	else
	{
	
	$inv_no=$starting_ivo->invo;
	
	 $data=array(
	
	 'invo'=>$inv_no,
	
	);
	
	 
	  $this->db->insert('mess_invoice',$data);
	 	}
	
	
	            $this->db->trans_complete();
				if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
                } else {
                $this->db->trans_commit();
                return $inv_no;
                 }
	
	 
	   }




    public function getFeeBetweenDate($start_date, $end_date) {
        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
$this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');
  $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
   $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
         $this->db->order_by('student_fees_deposite.id');
       	  $query = $this->db->get();
           $result_value = $query->result();
       	    $return_array = array();
       		if (!empty($result_value)) {
            	$st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
            	foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($value, $st_date, $ed_date);
                		if (!empty($return)) {
                   		 foreach ($return as $r_key => $r_value) {
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
                        $a['amount'] = $r_value->amount;
                        $a['date'] = $r_value->date;
                        $a['amount_discount'] = $r_value->amount_discount;
                        $a['amount_fine'] = $r_value->amount_fine;
                        $a['description'] = $r_value->description;
                        $a['payment_mode'] = $r_value->payment_mode;
                        $a['inv_no'] = $r_value->inv_no;
                        $return_array[] = $a;
                    }
                }
            }
        }

        return $return_array;
    }
 
 
 public function collection_report($start_date,$end_date)
 {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
$this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
$this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');
  $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
   $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('students.centre_id',$centre_id);
         $this->db->order_by('student_fees_deposite.id');
       	  $query = $this->db->get();
           $result_value = $query->result();
       	    $return_array = array();
			
			
       		if (!empty($result_value)) {
            	$st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
            	foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($value, $st_date, $ed_date);
                		if (!empty($return)) {
                   		 foreach ($return as $r_key => $r_value) {
                        $a['id'] = $value->id;
                        $a['student_fees_master_id'] = $value->student_fees_master_id;
                        $a['fee_groups_feetype_id'] = $value->fee_groups_feetype_id;
                        $a['firstname'] = $value->firstname;
                        $a['lastname'] = $value->lastname;
                        $a['class_id'] = $value->class_id;
						$a['refund_detail']=$value->refund_detail;
                        $a['class'] = $value->class;
                        $a['section'] = $value->section;
                        $a['section_id'] = $value->section_id;
                        $a['student_id'] = $value->student_id;
                        $a['name'] = $value->name;
                        $a['type'] = $value->type;
                        $a['code'] = $value->code;
                        $a['student_session_id'] = $value->student_session_id;
                        $a['amount'] = $r_value->amount;
                        $a['date'] = $r_value->date;
                        $a['amount_discount'] = $r_value->amount_discount;
                        $a['amount_fine'] = $r_value->amount_fine;
                        $a['description'] = $r_value->description;
                        $a['payment_mode'] = $r_value->payment_mode;
                        $a['inv_no'] = $r_value->inv_no;
                        $return_array[] = $a;
                    }
                }
            }
        }

        return $return_array; 
	 
	 
 }
 
 
 
 public function mess_collection_report($start_date,$end_date)
 {
     
$this->db->select('`student_messfees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`messfeegroup`.`name`,`messfeetype`.`type`,`messfeetype`.`code`,student_messfees_master.student_session_id')->from('student_messfees_deposite');
$this->db->join('messfeemasters', 'messfeemasters.id = student_messfees_deposite.messfeemasters_id');
  $this->db->join('messfeegroup', 'messfeegroup.id = messfeemasters.fee_groups_id');
   $this->db->join('messfeetype', 'messfeetype.id = messfeemasters.feetype_id');
    $this->db->join('student_messfees_master', 'student_messfees_master.id=student_messfees_deposite.student_messfees_master_id');
     $this->db->join('student_session', 'student_session.id= student_messfees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
         $this->db->order_by('student_messfees_deposite.id');
       	  $query = $this->db->get();
           $result_value = $query->result();
		  
		   
       	    $return_array = array();
       		if (!empty($result_value)) {
            	$st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
            	foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($value, $st_date, $ed_date);
                		if (!empty($return)) {
                   		 foreach ($return as $r_key => $r_value) {
                        $a['id'] = $value->id;
                        $a['student_messfees_master_id'] = $value->student_messfees_master_id;
                        $a['messfeemasters_id'] = $value->messfeemasters_id;
                        $a['firstname'] = $value->firstname;
                        $a['lastname'] = $value->lastname;
                        $a['class_id'] = $value->class_id;
						$a['refund_detail']=$value->refund_detail;
                        $a['class'] = $value->class;
                        $a['section'] = $value->section;
                        $a['section_id'] = $value->section_id;
                        $a['student_id'] = $value->student_id;
                        $a['name'] = $value->name;
                        $a['type'] = $value->type;
                        $a['code'] = $value->code;
                        $a['student_session_id'] = $value->student_session_id;
                        $a['amount'] = $r_value->amount;
                        $a['date'] = $r_value->date;
                        $a['amount_discount'] = $r_value->amount_discount;
                        $a['amount_fine'] = $r_value->amount_fine;
                        $a['description'] = $r_value->description;
                        $a['payment_mode'] = $r_value->payment_mode;
                        $a['inv_no'] = $r_value->inv_no;
                        $return_array[] = $a;
                    }
                }
            }
        }

        return $return_array; 
	 
	 
 }
 
 
 
  public function fee_transaction($start_date ,$end_date,$mode=null,$fee_group=null,$fee_category=null)
  {
	$admin=$this->session->userdata('admin');
    $centre_id=$admin['centre_id'];
	
	 $st_date = strtotime($start_date);
     $ed_date = strtotime($end_date);
	
	$this->db->select('student_fees_deposite.created_at,student_fees_deposite.amount_detail,students.admission_no,student_session.student_id, student_fees_master.student_session_id,student_fees_deposite.student_fees_master_id,fee_groups_feetype.id')->from('student_fees_deposite');
  
    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
	 $this->db->join('fee_groups_feetype','fee_groups_feetype.id=student_fees_deposite.fee_groups_feetype_id ');
	 //$this->db->join('fee_groups','fee_groups.id=fee_groups_feetype.fee_groups_id');
	 //$this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
     $this->db->join('students', 'students.id=student_session.student_id');
     $this->db->where('students.centre_id',$centre_id);
	 if($fee_group!=null)
	 {
	 $this->db->where_in('fee_groups_feetype.fee_groups_id',$fee_group);
	 }
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
			 if($mode =='All')
			 {
				 $return = $this->findObjectById($val, $st_date, $ed_date);
				
				 }
			 else{
				 $return = $this->findObjectById_report($val, $st_date, $ed_date,$mode); 
			  
			 }
			  
			  
			  if(!empty($return))
			  {
				 $ab=new stdClass();
				 $ab->admission_no=$val->admission_no;
				 $ab->student_id=$val->student_id;
				 $ab->student_fees_master_id=$val->student_fees_master_id;
				
				 
				  $array[]=$ab;
				  
				  }
			 
			
			 
		 }
		
		   return array_unique($array,SORT_REGULAR); 
	
	  
  }
  
  
   
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
   public function get_feeexcessReport($date_from, $date_to,$payment_mode,$student_id=null)
   {
     $admin=$this->session->userdata('admin');
     $centre_id=$admin['centre_id'];
	 $this->db->select('students.admission_no,students.firstname,students.lastname,fees_excess.*')->from('fees_excess');
	 $this->db->join('students','fees_excess.student_id=students.id');
	 $this->db->where('students.centre_id', $centre_id);
	 if($student_id !=null)
	 {
		 $this->db->where_not_in('fees_excess.student_id', $student_id); 
		 
		 
		 }
	 
	 $res=$this->db->get();
	 $val=$res->result();
	 
	 if($res->num_rows()>0)
	 { 
	 $list=array();
	   $st_date = strtotime($date_from);
        $ed_date = strtotime($date_to);
	 
	 foreach($val as $key=>$fee)
	 {
		
		 
		  if($payment_mode =='All')
			 {
				 $return = $this->findObjectById($fee, $st_date, $ed_date);
				
				 }
			 else{
				 $return = $this->findObjectById_report($fee, $st_date, $ed_date,$payment_mode); 
			  
			 }
		   
		    if(!empty($return))
			{
				
		
				 $arr=array();
			 $a=new stdClass();
			 $a->admission_no=$fee->admission_no;	
			 	foreach($return as $r_key=>$re)
				{
				 $x['firstname']=$fee->firstname;
				 $x['lastname']=$fee->lastname;
				 $x['type']=$fee->type;
				 $x['amount']=$re->amount;
				 $x['payment_mode']=$re->payment_mode;
				 $x['inv_no']=$re->invo;
				 $x['description']=$re->description;
				 $x['date']=$re->date;	
					
				 $arr[]=$x;
						
					}
					 $a->collection_record=$arr;
				
					 $list[]=$a;
				   }
				  
		           }
		        }
				
				return $list;
				 
	          } 
  
  
    public function messfee_transaction($start_date ,$end_date,$mode)
  {
	
	
	 $st_date = strtotime($start_date);
     $ed_date = strtotime($end_date);
	
	$this->db->select('student_messfees_deposite.created_at,student_messfees_deposite.amount_detail,students.admission_no,student_session.student_id, student_messfees_master.student_session_id,student_messfees_deposite.student_messfees_master_id')->from('student_messfees_deposite');
  
    $this->db->join('student_messfees_master', 'student_messfees_master.id=student_messfees_deposite.student_messfees_master_id');
        $this->db->join('student_session', 'student_session.id= student_messfees_master.student_session_id');
      $this->db->join('students', 'students.id=student_session.student_id');
     
		 $this->db->order_by('student_messfees_deposite.id');
       	  $query = $this->db->get();
	       $result_value = $query->result();    
	
	   
	
	     $array=array();
		 foreach($result_value as $key =>$val)
		 {
			  $return = $this->findObjectById($val, $st_date, $ed_date,$mode);
			  if(!empty($return))
			  {
				 $ab=new stdClass();
				 $ab->admission_no=$val->admission_no;
				 $ab->student_messfees_master_id=$val->student_messfees_master_id;
				 
				  $array[]=$ab;
				  
				  }
			 
			
			 
		 }
		 
		   return array_unique($array,SORT_REGULAR); 
	
	  
  }
  
  
  function get_collection_record($id,$start_date,$end_date,$mode=null,$fee_group=null, $fee_category=null)
 {
	
	$this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
$this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');
  $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
   $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
    $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
     $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
		$this->db->where('student_fees_deposite.student_fees_master_id',$id);
		if($fee_group!=null)
		{
		 $this->db->where_in('fee_groups_feetype.fee_groups_id',$fee_group);
		}
		if($fee_category!=null)
		{
	      $this->db->where_in('fee_groups_feetype.feetype_id',$fee_category);
		  
		}
         $this->db->order_by('student_fees_deposite.id');
       	  $query = $this->db->get();
           $result_value = $query->result();
	
	
		  $arr=array();
		  
		  if(!empty($result_value))
		  {
			  
			  $st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
			  
		  foreach($result_value as $key => $value)
		  {
			  if($mode =='All')
			  {
				   $return = $this->findObjectById($value, $st_date, $ed_date);
				 
				  }
			  else{
			
			  $return = $this->findObjectById_report($value, $st_date, $ed_date,$mode);
			  }
			   
			 
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
			   return $arr;
			
	  }

 
 
  public function feeadvance_report($date_from,$date_to,$payment_mode,$student_id)
  {
	$this->db->select('*')->from('fees_advance');
	$this->db->where('student_id',$student_id);
	$array=$this->db->get()->result();
	
	$ar=array();
	if(!empty($array))
	{
		 $st_date = strtotime($date_from);
         $ed_date = strtotime($date_to);
		
		    
			 
		 foreach($array as $key => $value)
		  {
			  if($payment_mode =='All')
			  {
				   $return = $this->findObjectById($value, $st_date, $ed_date);
				 
				  }
			  else{
			
			  $return = $this->findObjectById_report($value, $st_date, $ed_date,$mode);
			  }
			  
		
			  foreach($return as $re)
			  {
				$a['type']= $value->type;
				$a['amount']= $re->amount;
				$a['date']=$re->date;
				$a['mode']=$re->payment_mode;
				$a['description']=$re->description;
				$a['inv_no']=$re->invo;
				$ar[]=$a;
			  
				  }
			
		  }
		}
	
	  return $ar;
	  }
	  
	  
	  
	  
	  public function feeexcess_report($date_from,$date_to,$payment_mode,$student_id)
  {
	
	$this->db->select('*')->from('fees_excess');
	$this->db->where('student_id',$student_id);
	$array=$this->db->get()->result();
	
	$arr=array();
	if(!empty($array))
	{
		 $st_date = strtotime($date_from);
         $ed_date = strtotime($date_to);
		
		    
			 
		 foreach($array as $key => $value)
		  {
			  if($payment_mode =='All')
			  {
				   $return = $this->findObjectById($value, $st_date, $ed_date);
				 
				  }
			  else{
			
			  $return = $this->findObjectById_report($value, $st_date, $ed_date,$mode);
			  }
			  
			   
			  
		
			  foreach($return as $re)
			  {
				$a['type']= $value->type;
				$a['amount']= $re->amount;
				$a['date']=$re->date;
				$a['mode']=$re->payment_mode;
				$a['description']=$re->description;
				$a['inv_no']=$re->invo;
				$arr[]=$a;
			  
				  }
			
		  }
		}
	
	  return $arr;
	  }
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
 
 
  function get_Messcollection_record($id,$start_date,$end_date)
 {
	
	$this->db->select('`student_messfees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`messfeegroup`.`name`, `messfeetype`.`type`, `messfeetype`.`code`,student_messfees_master.student_session_id')->from('student_messfees_deposite');
$this->db->join('messfeemasters', 'messfeemasters.id = student_messfees_deposite.messfeemasters_id');
  $this->db->join('messfeegroup', 'messfeegroup.id = messfeemasters.fee_groups_id');
   $this->db->join('messfeetype', 'messfeetype.id = messfeemasters.feetype_id');
    $this->db->join('student_messfees_master', 'student_messfees_master.id=student_messfees_deposite.student_messfees_master_id');
     $this->db->join('student_session', 'student_session.id= student_messfees_master.student_session_id');
      $this->db->join('classes', 'classes.id= student_session.class_id');
	   $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
		$this->db->where('student_messfees_deposite.student_messfees_master_id',$id);
         $this->db->order_by('student_messfees_deposite.id');
       	  $query = $this->db->get();
           $result_value = $query->result();
	
	
		  $arr=array();
		  
		  if(!empty($result_value))
		  {
			  
			  $st_date = strtotime($start_date);
            	$ed_date = strtotime($end_date);
			  
		  foreach($result_value as $key => $value)
		  {
			  
			 $return = $this->findObjectById($value, $st_date, $ed_date);
			 
			
			   
			 
			  foreach($return as $r_key => $r_res)
			  {
				        $a['id'] = $value->id;
                        $a['student_messfees_master_id'] = $value->student_messfees_master_id;
                        $a['messfeemasters_id'] = $value->messfeemasters_id;
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
			   return $arr;
			
	  }

 
 
 
 
 

    public function getDepositAmountBetweenDate($start_date, $end_date) {
         $admin=$this->session->userdata('admin');
        $this->db->select('`student_fees_deposite`.*')->from('student_fees_deposite');
		$this->db->where('centre_id',$admin['centre_id']);
        $this->db->order_by('student_fees_deposite.id');
        $query = $this->db->get();
        $result_value = $query->result();

        $return_array = array();
        if (!empty($result_value)) {
            $st_date = strtotime($start_date);
            $ed_date = strtotime($end_date);
            foreach ($result_value as $key => $value) {
                $return = $this->findObjectById($value, $st_date, $ed_date);
                if (!empty($return)) {
                    foreach ($return as $r_key => $r_value) {                                                                                                                   
                        $a = array();
                        $a['amount'] = $r_value->amount;
                        $a['date'] = $r_value->date;
                        $a['amount_discount'] = $r_value->amount_discount;
                        $a['amount_fine'] = $r_value->amount_fine;
                        $a['description'] = $r_value->description;
                        $a['payment_mode'] = $r_value->payment_mode;
                        $a['inv_no'] = $r_value->inv_no;
                        $return_array[] = $a;
                    }
                }
            }
        }

        return $return_array;
    }

    function findObjectAmount($array, $st_date, $ed_date) {

        $ar = json_decode($array->amount_detail);
        $array = array();
        $amount = 0;
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


    function findObjectById($array, $st_date, $ed_date) {
        
		  $ar = json_decode($array->amount_detail);
		
		//var_dump($ar);
		
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
				
                if ($row_value->date == $find  ) {
					
						$array[] = $row_value;
						
						
					
					/*else{
                    $array[] = $row_value;}*/
                }
            }
        }
		
		//var_dump($array);
        return $array;
    }
	
	
	
	
	 function findObjectById_report($array, $st_date, $ed_date,$mode=null) {
        
		
		
        $ar = json_decode($array->amount_detail);
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if ($row_value->date == $find && $row_value->payment_mode==$mode ) {
					
						$array[] = $row_value;
						
						
					
					/*else{
                    $array[] = $row_value;}*/
                }
            }
        }
		
		
        return $array;
    }
	
	
	
	
	
	
	
	
	 function findbetweendate($array, $st_date, $ed_date) {

        $ar = json_decode($array->amount_detail);
        $array = array();
        for ($i = $st_date; $i <= $ed_date; $i += 86400) {
            $find = date('Y-m-d', $i);
            foreach ($ar as $row_key => $row_value) {
                if ($row_value->date == $find) {
                    $array[] = $array;
                }
            }
        }
        return $array;
    }

	
	
	

    public function getFeeByInvoice($invoice_id, $sub_invoice_id) {
		$this->db->select('student_fee_deposit_id')->where(array('year'=>$invoice_id,'number'=> $sub_invoice_id));
		$id=$this->db->get('invoice')->row();
		
        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');

        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');

        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('student_fees_deposite.id', $id->student_fee_deposit_id);
        $q = $this->db->get();


        if ($q->num_rows() > 0) {
	       $invoice=$invoice_id.'/'.$sub_invoice_id;
            $result = $q->row();
            $res = json_decode($result->amount_detail);
            $a = (array) $res;
              
			
			  
            foreach ($a as $key => $value) {
                if ($key ==  $invoice) {

                    return $result;
                }
            }
        }


        return false;
    }



  
  public function printFeeByInvoice($invoice_id, $sub_invoice_id) {
		
        $this->db->select('`student_fees_deposite`.*,students.firstname,students.lastname,student_session.class_id,classes.class,sections.section,student_session.section_id,student_session.student_id,`fee_groups`.`name`, `feetype`.`type`, `feetype`.`code`,student_fees_master.student_session_id')->from('student_fees_deposite');
        $this->db->join('fee_groups_feetype', 'fee_groups_feetype.id = student_fees_deposite.fee_groups_feetype_id');

        $this->db->join('fee_groups', 'fee_groups.id = fee_groups_feetype.fee_groups_id');
        $this->db->join('feetype', 'feetype.id = fee_groups_feetype.feetype_id');
        $this->db->join('student_fees_master', 'student_fees_master.id=student_fees_deposite.student_fees_master_id');
        $this->db->join('student_session', 'student_session.id= student_fees_master.student_session_id');
        $this->db->join('classes', 'classes.id= student_session.class_id');

        $this->db->join('sections', 'sections.id= student_session.section_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('student_fees_deposite.id', $invoice_id);
        $q = $this->db->get();


        if ($q->num_rows() > 0) {
	       
            $result = $q->row();
            $res = json_decode($result->amount_detail);
            $a = (array) $res;
              
			
			  
            foreach ($a as $key => $value) {
                if ($key ==  $sub_invoice_id) {

                    return $result;
                }
            }
        }


        return false;
    }





    public function studentDeposit($data) {
        $sql = "SELECT fee_groups.is_system,student_fees_master.amount as `student_fees_master_amount`, fee_groups.name as `fee_group_name`,feetype.code as `fee_type_code`,fee_groups_feetype.amount,IFNULL(student_fees_deposite.amount_detail,0) as `amount_detail` from student_fees_master 
               INNER JOIN fee_session_groups on fee_session_groups.id=student_fees_master.fee_session_group_id 
              INNER JOIN fee_groups_feetype on fee_groups_feetype.fee_groups_id=fee_session_groups.fee_groups_id
              INNER JOIN fee_groups on fee_groups_feetype.fee_groups_id=fee_groups.id
              INNER JOIN feetype on fee_groups_feetype.feetype_id=feetype.id
         LEFT JOIN student_fees_deposite on student_fees_deposite.student_fees_master_id=student_fees_master.id and student_fees_deposite.fee_groups_feetype_id=fee_groups_feetype.id WHERE student_fees_master.id =" . $data['student_fees_master_id'] . " and fee_groups_feetype.id =" . $data['fee_groups_feetype_id'];
        $query = $this->db->query($sql);

        return $query->row();
    }
	
	
	public function studentMessDeposit($data) {
		
		
        $sql = "SELECT student_messfees_master.amount as `student_messfees_master_amount`, IFNULL(student_messfees_deposite.amount_detail,0) as `amount_detail` from student_messfees_master   LEFT JOIN student_messfees_deposite on student_messfees_deposite.student_messfees_master_id=student_messfees_master.id  WHERE student_messfees_master.id =" .$data['student_messfees_master_id'];
        $query = $this->db->query($sql);

        return $query->row();
    }
	
	
	
	
	
	
	
	
	

    public function getPreviousStudentFees($student_session_id) {
        $sql = "SELECT `student_fees_master`.*,fee_groups.name FROM `student_fees_master` INNER JOIN fee_session_groups on student_fees_master.fee_session_group_id=fee_session_groups.id INNER JOIN fee_groups on fee_groups.id=fee_session_groups.fee_groups_id  WHERE `student_session_id` = " . $student_session_id . " ORDER BY `student_fees_master`.`id`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
                $fee_session_group_id = $result_value->fee_session_group_id;
                $student_fees_master_id = $result_value->id;
                $result_value->fees = $this->getDueFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }

        return $result;
    }
	
	
	
	 public function getPreviousStudentMessFees($student_session_id) {
        $sql = "SELECT `student_messfees_master`.*,messfeegroup.name FROM `student_messfees_master` INNER JOIN mess_fee_session on student_messfees_master.mess_fee_session_id=mess_fee_session.id INNER JOIN messfeegroup on messfeegroup.id=mess_fee_session.fee_groups_id  WHERE `student_session_id` = " . $student_session_id . " ORDER BY `student_messfees_master`.`id`";
        $query = $this->db->query($sql);
        $result = $query->result();
        if (!empty($result)) {
            foreach ($result as $result_key => $result_value) {
                $fee_session_group_id = $result_value->fee_session_group_id;
                $student_fees_master_id = $result_value->id;
                $result_value->fees = $this->getDueMessFeeByFeeSessionGroup($fee_session_group_id, $student_fees_master_id);

                if ($result_value->is_system != 0) {
                    $result_value->fees[0]->amount = $result_value->amount;
                }
            }
        }

        return $result;
    }
	
	
	
	
	
	
	
	
	
	public function promote_fee($addate,$promoted_class,$promoted_section)
  {
	  
	  $this->db->select('fee_groups.id,fee_session_groups.id as fee_session_group_id')->from('fee_groups');
	  $this->db->join('fee_session_groups','fee_session_groups.fee_groups_id=fee_groups.id');
	  $this->db->where(array('fee_groups.year'=>$addate,'fee_groups.class_id'=>$promoted_class,'fee_groups.section_id'=>$promoted_section));
	 
	return $query=$this->db->get()->row_array(); 
	  
	  }
	
	
	
        public function add_promote($data)
  {
	  
	  $this->db->insert('student_fees_master',$data);
	  
	  
	  }	
	
	
	
	 public function upload_file($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('tbl_fees_upload', $data);
        } else {
            $this->db->insert('tbl_fees_upload', $data);
            return $this->db->insert_id();
        }
    }
	
	
	
	 public function get_fees_upload($id = null) {
        $this->db->select('tbl_fees_upload.*')->from('tbl_fees_upload');
        
        if ($id != null) {
            $this->db->where('tbl_fees_upload.id', $id);
        } else {
            $this->db->order_by('tbl_fees_upload.id', 'DESC');
        }
     
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }
	
	
	public function delete_fees_upload($id)
	{
		
		$this->db->where('id', $id);
        $this->db->delete('tbl_fees_upload');
    	
	}
	
	
	
	
	
	
	public function get_billdetail($id)
	{
$this->db->select('student_fees_deposite.amount_detail,student_fees_deposite.id,feetype.type,sections.section')->from('student_fees_master');
	 $this->db->join('student_fees_deposite','student_fees_master.id=student_fees_deposite.student_fees_master_id');
	 $this->db->join('fee_groups_feetype','fee_groups_feetype.id=student_fees_deposite.fee_groups_feetype_id');
	 $this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');
	 $this->db->join('fee_groups','fee_groups.id=fee_groups_feetype.fee_groups_id');
	 $this->db->join('sections','sections.id=fee_groups.section_id');
	 $this->db->where('student_fees_master.student_id',$id);
	 $res=$this->db->get();
	 $result=$res->result_array();
	
	
	if(!empty($result))
	{  
	$arr=array();
	
	
		foreach($result as $t_key=>$value)
		{
			$a=json_decode($value['amount_detail']);
			
	    $ar=array();
		foreach($a as $key=>$val)
		{
		 
		
		if(!isset($arr[$key]))
		{
		 $t=array();		
		 $arr[$key]['amount']=($val->amount+$val->amount_fine)-$val->discount ;	
		 $arr[$key]['date']=$val->date;
		 //array_push($arr[$key],$value['type']);
		 $amount=($val->amount+$val->amount_fine)-$val->discount ;	
		$arr[$key]['type'][] =$value['type'].','.$amount;
		$arr[$key]['type'] =$value['type'].'['.$value['section'].' - '.$amount.']';
		$arr[$key]['mode']=$val->payment_mode;	
		$arr[$key]['id']=$value['id'];		
			}
		
		else
		{
			$amount = ($val->amount+$val->amount_fine)-$val->discount;
			$arr[$key]['amount'] +=($val->amount+$val->amount_fine)-$val->discount;
		    $arr[$key]['date']=$val->date;
			
			//array_push($ar[$key],$value['type']);
			
			
			$arr[$key]['type'] .=','.$value['type'].'['.$value['section'].' - '.$amount.']';
			
			//$arr[$key]['section'][] .=','.$value['section'];
			$arr[$key]['mode']=$val->payment_mode;
			$arr[$key]['id'].=','.$value['id'];		
			
		}
	
	
			}
			
		
		}
		}
		
		return $arr;
		
	}
	
	
	
	
	public function get_Messbilldetail($id)
	{
		
$this->db->select('student_messfees_deposite
.amount_detail,student_messfees_master.type,student_messfees_master.month')->from('student_messfees_master
');
	 $this->db->join('student_messfees_deposite','student_messfees_master.id=student_messfees_deposite.student_messfees_master_id');
	 $this->db->where('student_messfees_master.student_id',$id);
	 $res=$this->db->get();
	 $result=$res->result_array();
	
	
	if(!empty($result))
	{  
	$arr=array();
	
		foreach($result as $t_key=>$value)
		{
			$a=json_decode($value['amount_detail']);
			
	     
		foreach($a as $key=>$val)
		{
		
		
		if(!isset($arr[$key]))
		{
		 $t=array();
		 $amount=$val->amount+$val->amount_fine ;		
		 $arr[$key]['amount']=$val->amount+$val->amount_fine ;	
		 $arr[$key]['date']=$val->date;
		 //array_push($arr[$key],$value['type']);
		$arr[$key]['type'] .=$value['type'];
		//$arr[$key]['type'][] =$value['type'].','. $amount;
		
		$arr[$key]['mode']=$val->payment_mode;	
			}
		
		else
		{
			 $amount=$val->amount+$val->amount_fine ;	
			$arr[$key]['amount'] +=$val->amount+$val->amount_fine;
		    $arr[$key]['date']=$val->date;
			
			//array_push($arr[$key]['type'],$value['type']);
			$arr[$key]['type'] .=', '.$value['type'];
			//$arr[$key]['type'][] =$value['type'].','.$amount;
			$arr[$key]['mode']=$val->payment_mode;	
			
			
				
		}
	
	
			}
			
		
		}
		}
		
		return $arr;
		
	}
	
	
	public function collect_fee_advance($data)
       {
	   $this->db->insert('fees_advance',$data);
	   
	
	   }
	
	
	
	public function collect_messfee_advance($data,$json_array)
    {
		
	    $this->db->trans_start();
        $this->db->trans_strict(FALSE);
		
         $this->db->insert('student_messfees_master',$data);
		 $student_messfee_master_id=$this->db->insert_id();
          $invoice=$json_array['inv_no'];
		  
		  $deposit=array(
		  'student_messfees_master_id'=>$student_messfee_master_id,
		  'amount_detail'=>json_encode(array($invoice=>$json_array))
		   );
		  
		   $this->db->insert('student_messfees_deposite',$deposit);	  
           $insert_id=$this->db->insert_id();
		
		
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
           
			return $insert_id;
	
	
		}
		
	}
	
	
	
public function collect_fee_excess($data)
{
  $this->db->insert('fees_excess',$data);	
	
	}


public function getFeeexcess($id)
	{
		
		$sql="SELECT fees_excess.id,fees_excess.type,fees_excess.amount_detail FROM fees_excess WHERE fees_excess.student_id=".$this->db->escape($id);
		
		$query=$this->db->query($sql);
		return $query->result();
		
		
		}
	
	
	public function getFeeadvance($id)
	{
		
		$sql="SELECT fees_advance.id, fees_advance.type,fees_advance.amount_detail FROM fees_advance WHERE fees_advance.student_id=".$this->db->escape($id);
		
		$query=$this->db->query($sql);
		return $query->result();
		
		
		}
		
		
		
		public function getMessFeeadvance($id)
	{
		
		$sql="SELECT messfee_advance.id, messfee_advance.type,messfee_advance.amount_detail,messfee_advance.amount FROM messfee_advance WHERE messfee_advance.student_id=".$this->db->escape($id);
		
		$query=$this->db->query($sql);
		return $query->result();
		
		
		}
		
		
		public function get_fee_excess($id)
	{
		
		$res=$this->db->select('amount_detail,type')->from('fees_excess')->where('student_id',$id)->get();
		
		$result=$res->result_array();
		
		
		if(!empty($result))
		$array=array();
		foreach($result as $fe_key=>$val)
		{
		 $a=json_decode($val['amount_detail']);
		 {
			foreach($a as $key=>$fee)
			{
			$array[$key]['amount']=$fee->amount;
			$array[$key]['type']=$val['type'];
			$array[$key]['date']=$fee->date;
			$array[$key]['mode']=$fee->payment_mode;	
				
				} 
			 
			 }
			
			
			
			}
		
		return $array;
		
		
		}
	
	
	
	
	public function fee_advance_bill($id)
	{
		
		$res=$this->db->select('amount_detail,type')->from('messfee_advance')->where('student_id',$id)->get();
		
		$result=$res->result_array();
		
		
		if(!empty($result))
		$array=array();
		foreach($result as $fe_key=>$val)
		{
		 $a=json_decode($val['amount_detail']);
		 {
			foreach($a as $key=>$fee)
			{
			$array[$key]['amount']=$fee->amount;
			$array[$key]['type']=$val['type'];
			$array[$key]['date']=$fee->date;	
			$array[$key]['mode']=$fee->payment_mode;	
				} 
			 
			 }
			
			
			
			}
		
		return $array;
		
		
		}
	
	
	public function get_fee_advance($id)
	{
		
		$res=$this->db->select('amount_detail,type')->from('fees_advance')->where('student_id',$id)->get();
		
		$result=$res->result_array();
		
		
		if(!empty($result))
		$array=array();
		foreach($result as $fe_key=>$val)
		{
		 $a=json_decode($val['amount_detail']);
		 {
			foreach($a as $key=>$fee)
			{
			$array[$key]['amount']=$fee->amount;
			$array[$key]['type']=$val['type'];
			$array[$key]['date']=$fee->date;	
			$array[$key]['mode']=$fee->payment_mode;	
				} 
			 
			 }
			
			
			
			}
		
		return $array;
		
		
		}
	

    public function postDiamond($result)
{
    $this->db->insert('diamond_master',$result);
    
}

public function getfeetypefeegroup($feegroupfeetype_id)
{
	$this->db->select('feetype.type,fee_groups.name')->from('fee_groups_feetype');
	$this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');
	$this->db->join('fee_groups','fee_groups.id=fee_groups_feetype.fee_groups_id');
	$this->db->where('fee_groups_feetype.id',$feegroupfeetype_id);
	return $this->db->get()->row_array();
	
	}
	
	public function getmessfeemaster($messfeemasters_id)
{
	$this->db->select('messfeetype.type,messfeegroup.name')->from('messfeemasters');
	$this->db->join('messfeetype','messfeetype.id=messfeemasters.feetype_id');
	$this->db->join('messfeegroup','messfeegroup.id=messfeemasters.fee_groups_id');
	$this->db->where('messfeemasters.id',$messfeemasters_id);
	return $this->db->get()->row_array();
	
	}
	
	
	
	
	

}
