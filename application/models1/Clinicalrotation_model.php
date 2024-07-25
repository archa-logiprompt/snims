<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinicalrotation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
		
		
		 $this->current_session = $this->setting_model->getCurrentSession();
    }

   
	 
	
    public function getgroup($classid,$sectionid)
	{
		
	 $sql="SELECT clinical_groupname.group_name,clinical_groupname.id  FROM clinical_group INNER JOIN clinical_groupname on clinical_group.group_id=clinical_groupname.id WHERE clinical_group.class_id=".$this->db->escape($classid)." and clinical_group.section_id=".$this->db->escape($sectionid)."and clinical_group.session_id=".$this->db->escape($this->current_session)." group BY clinical_group.group_id";	
	 $result=$this->db->query($sql);
	  return $result->result();	
	
	 
	}

   public function getavailablegroups($classid,$sectionid)
	{
		
	 $sql="SELECT new_batch.group_name,new_batch.id  FROM our_group INNER JOIN new_batch on our_group.group_id=new_batch.id WHERE our_group.class_id=".$this->db->escape($classid)." and our_group.section_id=".$this->db->escape($sectionid)."and our_group.session_id=".$this->db->escape($this->current_session)." group BY our_group.group_id";	
	 $result=$this->db->query($sql);
	  return $result->result();	
	
	 
	}







	public function getgroupnew($classid,$sectionid)
	{
		
	 $sql="SELECT clinical_groupname.group_name,clinical_groupname.id  FROM clinical_group INNER JOIN clinical_groupname on clinical_group.group_id=clinical_groupname.id WHERE clinical_group.class_id=".$this->db->escape($classid)." and clinical_group.section_id=".$this->db->escape($sectionid)."and clinical_group.session_id=".$this->db->escape($this->current_session)." group BY clinical_group.group_id";	
	 $result=$this->db->query($sql);
	  return $result->result();	
	
	 
	}



	public function getavailbatchs($classid,$sectionid)
	{
		
	 $sql="SELECT new_batch.group_name,new_batch.id  FROM our_group INNER JOIN new_batch on our_group.group_id=new_batch.id WHERE our_group.class_id=".$this->db->escape($classid)." and our_group.section_id=".$this->db->escape($sectionid)."and our_group.session_id=".$this->db->escape($this->current_session)." group BY our_group.group_id";	
	 $result=$this->db->query($sql);
	  return $result->result();	
	
	 
	}

	public function searchAttendenceReportupdate($class_id, $section_id,$subject_id, $date,$group_id) {
        
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(clinical_attendance.date, 'xxx') as date,clinical_attendance.subject_id,clinical_attendance.remark, IFNULL(clinical_attendance.id, 0) as attendence_id,clinical_attendance.attendence_type_id FROM `student_session` LEFT JOIN clinical_attendance ON clinical_attendance.student_session_id=student_session.id INNER JOIN clinical_group ON student_session.id=clinical_group.student_session_id and clinical_attendance.date=".$this->db->escape($date) . "  and clinical_attendance.subject_id=" . $this->db->escape($subject_id)." where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and clinical_group.group_id=" . $this->db->escape($group_id) . "and clinical_attendance.session_id=".$this->db->escape($this->current_session).") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }







    public function searchBatchwiseupdate($class_id, $section_id,$subject_id, $date,$group_id) {
        
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(batchwise_attendance.date, 'xxx') as date,batchwise_attendance.subject_id,batchwise_attendance.remark, IFNULL(batchwise_attendance.id, 0) as attendence_id,batchwise_attendance.attendence_type_id FROM `student_session` LEFT JOIN batchwise_attendance ON batchwise_attendance.student_session_id=student_session.id INNER JOIN our_group ON student_session.id=our_group.student_session_id and batchwise_attendance.date=".$this->db->escape($date) . "  and batchwise_attendance.subject_id=" . $this->db->escape($subject_id)." where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and our_group.group_id=" . $this->db->escape($group_id) . "and batchwise_attendance.session_id=".$this->db->escape($this->current_session).") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";
        
        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
	public function getstudentsbygroup($class_id,$section_id,$group_id,$date,$subject_id)
	{
	$sql="SELECT students.id as `student_id`, students.admission_no,students.firstname,students.lastname,students.roll_no,clinical_group.student_session_id,IFNULL(clinical_attendance.id,0) as `attendance_id`,IFNULL(clinical_attendance.date,'xxx') as `date`,IFNULL(clinical_attendance.attendence_type_id,0) as `attendance_type_id` ,IFNULL(clinical_attendance.group_id,0) as `group_id` FROM clinical_group INNER JOIN student_session on student_session.id= clinical_group.student_session_id INNER JOIN students on students.id=student_session.student_id LEFT JOIN clinical_attendance on clinical_attendance.student_session_id=student_session.id and clinical_attendance.date=".$this->db->escape($date)."and clinical_attendance.subject_id=".$this->db->escape($subject_id)." WHERE clinical_group.class_id=".$this->db->escape($class_id)." and clinical_group.section_id=".$this->db->escape($section_id)." and clinical_group.group_id=".$this->db->escape($group_id).'group BY clinical_group.student_session_id';
	
	$query=$this->db->query($sql);
	//print_r($this->db->last_query());  
	return $query->result_array();	
		
		
	}




public function getstudentsinavaliablegroup($class_id,$section_id,$group_id,$date,$subject_id)
	{
	$sql="SELECT students.id as `student_id`, students.admission_no,students.firstname,students.lastname,students.roll_no,our_group.student_session_id,IFNULL(batchwise_attendance.id,0) as `attendance_id`,IFNULL(batchwise_attendance.date,'xxx') as `date`,IFNULL(batchwise_attendance.attendence_type_id,0) as `attendance_type_id` ,IFNULL(batchwise_attendance.group_id,0) as `group_id` FROM our_group INNER JOIN student_session on student_session.id= our_group.student_session_id INNER JOIN students on students.id=student_session.student_id LEFT JOIN batchwise_attendance on batchwise_attendance.student_session_id=student_session.id and batchwise_attendance.date=".$this->db->escape($date)."and batchwise_attendance.subject_id=".$this->db->escape($subject_id)." WHERE our_group.class_id=".$this->db->escape($class_id)." and our_group.section_id=".$this->db->escape($section_id)." and our_group.group_id=".$this->db->escape($group_id).'group BY our_group.student_session_id';
	
	$query=$this->db->query($sql);
	//print_r($this->db->last_query());  
	return $query->result_array();	
		
		
	}







 	public function getpreviousdata($groupid,$date,$subject_id)
	{
		$sql="select * from clinical_attendance where subject_id=".$this->db->escape($subject_id)." and group_id=".$this->db->escape($groupid)." and date=".$this->db->escape($date);
		$query=$this->db->query($sql);
 //print_r($this->db->last_query());  
	return $query->result_array();	
	}




	public function getbatchpreviousdata($groupid,$date,$subject_id)
	{
		$sql="select * from batchwise_attendance where subject_id=".$this->db->escape($subject_id)." and group_id=".$this->db->escape($groupid)." and date=".$this->db->escape($date);
		$query=$this->db->query($sql);
	return $query->result_array();	
	}

	public function insert($data)
	{
		
		if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('clinical_attendance', $data);
        } else {
            $this->db->insert('clinical_attendance', $data);
        }
		
		
	}



	public function insertbatchwiseattendance($data)
	{
		// var_dump($data);exit;
		if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('batchwise_attendance', $data);
        } else {
            $this->db->insert('batchwise_attendance', $data);
        }
		
		
	}
	
	
	/*public function add_clinicsession($data)
	{
	  
		 if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('clinical_session', $data);
        } else {
            $this->db->insert('clinical_session', $data);
        }
		
		
	}*/
	
	/*public function getsession_list($id=null)
	 {
		  $this->db->select()->from('clinical_session');
       
	 
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
		 }*/
	
	
	
	/*public function add_session_delete($id)
	{
		
		$this->db->where('id', $id);
        $this->db->delete('clinical_session');
	}*/
	
	 public function get_tot_min($class_id,$section_id,$group_id)
	 {
		
		$sql="SELECT total_hours FROM assign_ward WHERE class_id=".$this->db->escape($class_id)."and section_id=".$this->db->escape($section_id)." and group_id=".$this->db->escape($group_id)."and session_id=".$this->current_session; 
		
		$query=$this->db->query($sql);
		return $query->row(); 
		 
	 }
	
	public function get_subject_list($class_id,$section_id)
	{
		$sql="SELECT subjects.name,subjects.type,subjects.id as `subject_id` FROM teacher_subjects INNER JOIN class_sections on class_sections.id=teacher_subjects.class_section_id INNER JOIN subjects on teacher_subjects.subject_id=subjects.id WHERE class_sections.class_id=".$this->db->escape($class_id)."and class_sections.section_id=".$this->db->escape($section_id);
		
		
		$query=$this->db->query($sql);
		return $query->result_array();
		
		} 
	
	public function add_internal_mark($arr)
	{
 
		$this->db->insert('clinical_internal_mark',$arr);
		
		}
	
	
	public function add_university_mark($arr)
	{
		$this->db->insert('clinical_university_mark',$arr);
		
		}
	function delete($id){
		//echo "test11"; 
		$this->db->where('group_id', $id);
        $this->db->delete('clinical_group');
		$this->db->where('id', $id);
        $this->db->delete('clinical_groupname');
		}


		function deleteourgroup($id){
		//echo "test11"; 
		$this->db->where('group_id', $id);
        $this->db->delete('our_group');
		$this->db->where('id', $id);
        $this->db->delete('new_batch');
		}
	
	public function searchAttendenceReport($class, $section,$subject, $att_date) {

       $sql="SELECT students.id as `student_id`, students.admission_no,students.firstname,students.lastname,students.roll_no,clinical_group.student_session_id,IFNULL(clinical_attendance.id,0) as `attendance_id`,clinical_attendance.date as `date`,IFNULL(clinical_attendance.attendence_type_id,0) as `attendance_type_id` ,IFNULL(clinical_attendance.group_id,0) as `group_id` FROM clinical_group INNER JOIN student_session on student_session.id= clinical_group.student_session_id INNER JOIN students on students.id=student_session.student_id LEFT JOIN clinical_attendance on clinical_attendance.student_session_id=student_session.id where clinical_attendance.date=".$this->db->escape($att_date)."and clinical_attendance.date=".$this->db->escape($att_date)."and clinical_attendance.subject_id=".$this->db->escape($subject); 
//echo $sql;
       /*  $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(clinical_attendance.date, 'xxx') as date,clinical_attendance.subject_id, IFNULL(clinical_attendance.id, 0) as attendence_id,clinical_attendance.attendence_type_id FROM `student_session` LEFT JOIN clinical_attendance ON clinical_attendance.student_session_id=student_session.id  and clinical_attendance.date=" . $this->db->escape($date) . "   where  student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and clinical_attendance.subject_id=" . $this->db->escape($subject_id).") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";*/
//echo $sql;


        $query = $this->db->query($sql);
        return $query->result_array();
    }
	 function count_attendance_obj($month, $year, $student_id, $attendance_type = 1) {


        $query = $this->db->select('count(*) as attendence')->join("student_session", "clinical_attendance.student_session_id = student_session.id")->where(array('clinical_attendance.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'clinical_attendance.attendence_type_id' => $attendance_type))->get("clinical_attendance");
	//echo $query;
        return $query->row()->attendence;

    }

    function count_attendance_objlatest($month, $year, $student_id, $attendance_type = 1,$subject_id) {


        $query = $this->db->select('count(*) as attendence')->join("student_session", "batchwise_attendance.student_session_id = student_session.id")->where(array('batchwise_attendance.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'batchwise_attendance.attendence_type_id' => $attendance_type,'batchwise_attendance.subject_id' => $subject_id))->get("batchwise_attendance");
	//echo $query;
        return $query->row()->attendence;

    }

    function attendanceYearCount() {

        $query = $this->db->select("distinct year(date) as year")->get("clinical_attendance");

        return $query->result_array();
    }
    function deletes($groupid,$from,$to){

		//echo "test11"; 
		
		$this->db->where('group_id', $groupid);
        $this->db->where(' datefrom >= date("'.$from.'")');
        $this->db->where( 'dateto<= date("'.$to.'")');
         $this->db->delete('assign_ward');
       
		//$this->db->where('date BETWEEN "'. date('Y-m-d', strtotime($datefrom)). '" and "'. date('Y-m-d', strtotime($dateto)).'"');
        
		
        
		}

}