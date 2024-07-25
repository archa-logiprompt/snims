<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Attendencebyday_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function get($id = null) {
        $this->db->select()->from('student_attendences');
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

    public function add($data) {
		
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_attendences', $data);
        } else {
            $this->db->insert('student_attendences', $data);
        }
    }

   /* public function searchAttendenceClassSection($class_id, $section_id, $date) {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id = students.id and students.is_active = 'yes' ";


        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	*/
	
	
	
	 public function searchAttendenceClassSection($class_id, $section_id,$subject,$date) {

        $sql = "select student_sessions.attendence_id,student_sessions.subject_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.subject_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.subject_id=".$this->db->escape($subject)."and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id = students.id and students.is_active = 'yes' ";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
	
	
	 public function searchAttendenceReport($class_id, $section_id,$subject_id, $date) {
     // var_dump($class_id);
	  //var_dump($section_id);
	  //var_dump($subject_id);
	  //var_dump($date);
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . "   where  student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and student_attendences.subject_id=" . $this->db->escape($subject_id).") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";
		

        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
    public function searchAttendenceReportbyperiod($class_id,$section_id,$subject_id=null,$from,$to)
	{
		$q=' ';
		
		if($subject_id!='')
		{
			$q.=' and student_attendences.subject_id='. $this->db->escape($subject_id); 
		}
		
 		$sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) ." and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' and  date >=".$this->db->escape($from)." and  date <= ".$this->db->escape($to)." GROUP BY students.id";
        $query = $this->db->query($sql)->result_array();
		
        return $query;
    }
	 
	public function checksearchAttendenceReportbyperiod($class_id,$section_id,$subject_id=null,$date)
	{
		$q=' ';
		
		if($subject_id!='')
		{
			$q.=' and student_attendences.subject_id='. $this->db->escape($subject_id); 
		}
		 
 		$sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . "  where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions  LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes'";
		
        $query = $this->db->query($sql)->result_array();
		
        return $query;
    }
	
	
	
	
	
	
	
	
	 /*student_session.section_id=" . $this->db->escape($section_id) . "*/
	 
	
   /* public function searchAttendenceClassSectionPrepare($class_id, $section_id, $date) {
        $query = $this->db->query("select student_sessions.attendence_id,student_sessions.remark,students.firstname,students.admission_no,student_sessions.date,students.roll_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` RIGHT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions where student_sessions.student_id=students.id ");
        return $query->result_array();
    }
	*/
	
	
	
	
	
	public function searchAttendenceClassSectionPrepare($class_id, $section_id,$subject, $date) {
        $query = $this->db->query("select student_sessions.attendence_id,student_sessions.remark,students.firstname,students.admission_no,student_sessions.date,students.roll_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark,IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` RIGHT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.subject_id=".$this->db->escape($subject)." and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions where student_sessions.student_id=students.id ");
        return $query->result_array();
    }
	
	  function count_attendance_objbyperiod($month, $year, $student_id, $attendance_type = 1) {


        $query = $this->db->select('count(*) as attendence')->join("student_session", "student_attendences.student_session_id = student_session.id")->where(array('student_attendences.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'student_attendences.attendence_type_id' => $attendance_type))->get("student_attendences");

        return $query->row()->attendence;

    }
	
	
	
	
	
	
	
	
	

    function count_attendance_obj($month, $year, $student_id, $attendance_type = 1) {


        $query = $this->db->select('count(*) as attendence')->join("student_session", "student_attendences.student_session_id = student_session.id")->where(array('student_attendences.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'student_attendences.attendence_type_id' => $attendance_type))->get("student_attendences");

        return $query->row()->attendence;

    }

    function attendanceYearCount() {

        $query = $this->db->select("distinct year(date) as year")->get("student_attendences");

        return $query->result_array();
    }

}
