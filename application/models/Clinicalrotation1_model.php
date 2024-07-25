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
	
	
	public function getstudentsbygroup($class_id,$section_id,$group_id,$date)
	{
	$sql="SELECT students.id as `student_id`, students.admission_no,students.firstname,students.lastname,students.roll_no,clinical_group.student_session_id,IFNULL(clinical_attendance.id,0) as `attendance_id`,IFNULL(clinical_attendance.date,'xxx') as `date`,IFNULL(clinical_attendance.attendence_type_id,0) as `attendance_type_id` ,IFNULL(clinical_attendance.group_id,0) as `group_id` FROM clinical_group INNER JOIN student_session on student_session.id= clinical_group.student_session_id INNER JOIN students on students.id=student_session.student_id LEFT JOIN clinical_attendance on clinical_attendance.student_session_id=student_session.id and clinical_attendance.date=".$this->db->escape($date)."and clinical_attendance.subject_id=".$this->db->escape($subject_id)." WHERE clinical_group.class_id=".$this->db->escape($class_id)." and clinical_group.section_id=".$this->db->escape($section_id)." and clinical_group.group_id=".$this->db->escape($group_id);
	
	
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
	

}
