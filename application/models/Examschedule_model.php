<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examschedule_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getDetailbyClsandSection($class_id, $section_id, $exam_id) {
        // echo "hi";
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $query = $this->db->query("SELECT staff.name as staffname,staff.surname,exam_schedules.*,teacher_subjects.teacher_id,subjects.name,subjects.id as subject_id,subjects.type,subjects.code FROM exam_schedules,teacher_subjects,exams,class_sections,subjects,staff WHERE staff.id=exam_schedules.teacher and exam_schedules.teacher_subject_id = teacher_subjects.id and exam_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and exam_schedules.centre_id=".$this->db->escape($centre_id)." and  exam_schedules.session_id=" . $this->db->escape($this->current_session));
        // echo $this->db->last_query();
        return $query->result_array();
    }
    public function getDetailbyClsandSectionStudent($class_id, $section_id, $exam_id) {
        $admin=$this->session->userdata('student');
        $centre_id=$admin['centre_id'];
        $query = $this->db->query("SELECT staff.name as staffname,staff.surname,exam_schedules.*,teacher_subjects.teacher_id,subjects.name,subjects.id as subject_id,subjects.type ,subjects.code FROM exam_schedules,teacher_subjects,exams,class_sections,subjects,staff WHERE staff.id=exam_schedules.teacher and exam_schedules.teacher_subject_id = teacher_subjects.id and exam_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and exam_schedules.centre_id=".$this->db->escape($centre_id)." and  exam_schedules.session_id=" . $this->db->escape($this->current_session));
        // echo $this->db->last_query();
        return $query->result_array();
    }
     public function getSubjectsFull($exam_id) {
        
        $query = $this->db->query("SELECT exam_schedules.exam_id,viva_schedules.exam_id,practical_schedules.exam_id,teacher_subjects.*,subjects.*,subjects.code from exam_schedules,viva_schedules,practical_schedules,teacher_subjects inner join subjects on subjects.id=teacher_subjects.subject_id  where exam_schedules.exam_id=" . $this->db->escape($exam_id). " or viva_schedules.exam_id=" . $this->db->escape($exam_id). " or practical_schedules.exam_id=" . $this->db->escape($exam_id). " GROUP BY subjects.id");
        return $query->result_array();
    }




    // public function getAllEarnedmarks($class_id, $section_id, $exam_id) {
    //     $admin=$this->session->userdata('admin');
    //     $centre_id=$admin['centre_id'];
    //     $query = $this->db->query("select exam_results.*,practical_results.student_id as pstdid,practical_results.get_marks,viva_results.student_id as vstdid,viva_results.get_marks as vget,viva_univer_mark.class_id,viva_univer_mark.section_id,subjects.name,subjects.id as subject_id FROM exam_results INNER JOIN students on exam_results.student_id=students.id INNER JOIN practical_results on practical_results.student_id=students.id  INNER JOIN viva_results on viva_results.student_id=practical_results.student_id  INNER JOIN viva_univer_mark on viva_univer_mark.student_id=viva_results.student_id INNER JOIN subjects on subjects.id=viva_univer_mark.subject_id INNER JOIN teacher_subjects on subjects.id=teacher_subjects.subject_id INNER JOIN exam_schedules on exam_schedules.teacher_subject_id=teacher_subjects.id WHERE viva_univer_mark.class_id =" . $this->db->escape($class_id) . " and viva_univer_mark.section_id=" . $this->db->escape($section_id) . " and exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session));
        
    //     $db= $query->result_array();

    //     print_r($this->db->last_query());exit;
    // }
	    public function getAllEarnedmarks($class_id, $section_id, $exam_id) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $query = $this->db->query("SELECT practical_schedules.*, exam_schedules.*,viva_schedules.*,teacher_subjects.teacher_id,subjects.name,subjects.id as subject_id,subjects.type FROM practical_schedules,exam_schedules,viva_schedules,teacher_subjects,exams,class_sections,subjects WHERE practical_schedules.teacher_subject_id = teacher_subjects.id and practical_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and practical_schedules.centre_id=".$this->db->escape($centre_id)." and  practical_schedules.session_id=" . $this->db->escape($this->current_session)); 
        $db= $query->result_array();

        // print_r($this->db->last_query());exit;
    }
    
	


	
	public function practicalDetailbyClsandSection($class_id, $section_id, $exam_id) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $query = $this->db->query("SELECT staff.surname,staff.name as staffname,practical_schedules.*,teacher_subjects.teacher_id,subjects.name,subjects.id as subject_id,subjects.type FROM practical_schedules,teacher_subjects,exams,class_sections,subjects,staff WHERE  staff.id=practical_schedules.teacher and practical_schedules.teacher_subject_id = teacher_subjects.id and practical_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and practical_schedules.centre_id=".$this->db->escape($centre_id)." and  practical_schedules.session_id=" . $this->db->escape($this->current_session));
        return $query->result_array();
    }

    public function vivaDetailbyClsandSection($class_id, $section_id, $exam_id) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $query = $this->db->query("SELECT staff.surname,staff.name as staffname,viva_schedules.*,teacher_subjects.teacher_id,subjects.name,subjects.id as subject_id,subjects.type FROM viva_schedules,teacher_subjects,exams,class_sections,subjects,staff WHERE staff.id=viva_schedules.teacher and viva_schedules.teacher_subject_id = teacher_subjects.id and viva_schedules.exam_id =exams.id and class_sections.id =teacher_subjects.class_section_id and teacher_subjects.subject_id=subjects.id and class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) . " and exam_id =" . $this->db->escape($exam_id) . " and viva_schedules.centre_id=".$this->db->escape($centre_id)." and  viva_schedules.session_id=" . $this->db->escape($this->current_session));
        return $query->result_array();
    }
	
	
	
	
	
	
	public function get_subject($section_id,$class_id,$sub_type=null)
	{
	  if($sub_type=='Theory')
	  {
		$this->db->where('subjects.theory',$sub_type);
		 }
		 elseif($sub_type=='Practical')
		 {
			$this->db->where('subjects.practical',$sub_type); 
			 }
	$this->db->select('teacher_subjects.*,teacher_subjects.id as teacher_subject_id, class_sections.*, subjects.*');
	 $this->db->from('teacher_subjects');
	 $this->db->join('subjects','teacher_subjects.subject_id = subjects.id');
	 $this->db->join('class_sections','teacher_subjects.class_section_id = class_sections.id');
	 $this->db->where(array('class_sections.section_id'=>$section_id,'class_sections.class_id'=>$class_id));
	 $sub=$this->db->get();
	return $subject = $sub->result_array(); 
	 
	}
	
	
	
	
	
	
	

    public function getTeacherSubjects($class_id, $section_id, $id) {

        $query = $this->db->select("teacher_subjects.subject_id")->join("class_sections", "class_sections.id = teacher_subjects.class_section_id")->where(array("class_sections.class_id" => $class_id, "class_sections.section_id" => $section_id, "teacher_subjects.teacher_id" => $id))->get("teacher_subjects");

        return $query->result_array();
    }

    public function getExamByClassandSectionnewplan($class_id, $section_id) {

        $sql = "SELECT * FROM exams INNER JOIN (SELECT exam_schedules.*,teacher_subjects.class_id,teacher_subjects.class_name ,teacher_subjects.section_id,teacher_subjects.section_name FROM `exam_schedules` LEFT JOIN (SELECT teacher_subjects.*,classes.id as `class_id`,classes.class as `class_name` ,sections.id as `section_id`,sections.section as `section_name` FROM `class_sections` 
        INNER JOIN teacher_subjects on teacher_subjects.class_section_id=class_sections.id
        INNER JOIN classes on classes.id=class_sections.class_id
        INNER JOIN sections on sections.id=class_sections.section_id
        WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) .") as teacher_subjects on teacher_subjects.id=teacher_subject_id group by exam_schedules.exam_id) as exam_schedules on exams.id=exam_schedules.exam_id";
 $query = $this->db->query($sql);
 return $query->result_array();
 }
 
 
  public function practicalByClassandSection($class_id, $section_id) {

        $sql = "SELECT * FROM exams INNER JOIN (SELECT practical_schedules.*,teacher_subjects.class_id,teacher_subjects.class_name ,teacher_subjects.section_id,teacher_subjects.section_name FROM `practical_schedules` INNER JOIN (SELECT teacher_subjects.*,classes.id as `class_id`,classes.class as `class_name` ,sections.id as `section_id`,sections.section as `section_name` FROM `class_sections` 
        INNER JOIN teacher_subjects on teacher_subjects.class_section_id=class_sections.id
        INNER JOIN classes on classes.id=class_sections.class_id
        INNER JOIN sections on sections.id=class_sections.section_id
        WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) .") as teacher_subjects on teacher_subjects.id=teacher_subject_id group by practical_schedules.exam_id) as practical_schedules on exams.id=practical_schedules.exam_id WHERE exams.sesion_id=".$this->db->escape($this->current_session);
 $query = $this->db->query($sql);
 return $query->result_array();
 }
 
 
    public function getresultByStudentandExamnewplan($exam_id, $student_id) {
        $query = $this->db->query("SELECT exam_schedules.id as `exam_schedule_id`,exam_schedules.full_marks,exam_schedules.exam_id as `exam_id`,
            exam_schedules.passing_marks,exam_results.attendence,exam_results.get_marks,exam_results.note, subjects.name,subjects.code,subjects.type  FROM `exam_schedules` INNER JOIN teacher_subjects ON teacher_subjects.id=exam_schedules.teacher_subject_id  INNER JOIN exam_results ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN subjects ON teacher_subjects.subject_id=subjects.id  WHERE exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and exam_results.student_id=" . $this->db->escape($student_id));
        return $query->result_array();
    }

    public function getpracsub($exam_id, $student_id) {
        $query = $this->db->query("SELECT practical_schedules.id as `prac_schedule_id`,practical_schedules.full_marks,practical_schedules.exam_id as `exam_id`,
            practical_schedules.passing_marks,practical_results.attendence,practical_results.get_marks,practical_results.note, subjects.name,subjects.code,subjects.type  FROM `practical_schedules` INNER JOIN teacher_subjects ON teacher_subjects.id=practical_schedules.teacher_subject_id  INNER JOIN practical_results ON practical_results.practical_schedule_id=practical_schedules.id INNER JOIN subjects ON teacher_subjects.subject_id=subjects.id  WHERE practical_schedules.exam_id=" . $this->db->escape($exam_id) . " and practical_results.student_id=" . $this->db->escape($student_id));
        return $query->result_array();
    }



    public function getvivasub($exam_id, $student_id) {
        $query = $this->db->query("SELECT viva_schedules.id as `viva_schedule_id`,viva_schedules.full_marks,viva_schedules.exam_id as `exam_id`,
            viva_schedules.passing_marks,viva_results.attendence,viva_results.get_marks,viva_results.note, subjects.name,subjects.code,subjects.type  FROM `viva_schedules` INNER JOIN teacher_subjects ON teacher_subjects.id=viva_schedules.teacher_subject_id  INNER JOIN viva_results ON viva_results.viva_schedules_id=viva_schedules.id INNER JOIN subjects ON teacher_subjects.subject_id=subjects.id  WHERE viva_schedules.exam_id=" . $this->db->escape($exam_id) . " and viva_results.student_id=" . $this->db->escape($student_id));
        return $query->result_array();
    }


    public function getclassandsectionbyexam($exam_id) {
        $query = $this->db->query("SELECT exam_schedules.exam_id,classes.id as `class_id`,sections.id as `section_id`,classes.class as `class`,sections.section as `section` FROM `exam_schedules`,`teacher_subjects`,`class_sections`,classes,sections WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and class_sections.id =teacher_subjects.class_section_id and class_sections.class_id =classes.id and class_sections.section_id=sections.id and exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session) . " group by exam_schedules.exam_id");
        return $query->result_array();
    }

public function remove($id,$type) {
    
    if($type=='Theory'){
        
		$this->db->where('exam_id',$id);
        $this->db->delete('exam_schedules');
    }
    else if($type=='Practical'){
        
		$this->db->where('exam_id',$id);
        $this->db->delete('practical_schedules');
    }
    else if($type=='Viva'){
		$this->db->where('exam_id',$id);
        $this->db->delete('viva_schedules');
        
    }
// 		$this->db->where('exam_schedule_id',$id);
//         $this->db->delete('exam_results');
//         $this->db->where('id', $eid);
// 		$this->db->delete('exams');
// echo $this->db->last_query();
    }
     public function getExamByClassandSection($class_id, $section_id) {

        $sql = "SELECT * FROM exams 
        INNER JOIN (
            SELECT exam_schedules.*, teacher_subjects.class_id, teacher_subjects.class_name, teacher_subjects.section_id, teacher_subjects.section_name 
            FROM `exam_schedules` 
            INNER JOIN (
                SELECT teacher_subjects.*, classes.id as `class_id`, subjects.code,classes.class as `class_name`, sections.id as `section_id`, sections.section as `section_name` 
                FROM `class_sections` 
                INNER JOIN teacher_subjects ON teacher_subjects.class_section_id = class_sections.id
                INNER JOIN classes ON classes.id = class_sections.class_id
                INNER JOIN subjects ON teacher_subjects.subject_id = subjects.id
                INNER JOIN sections ON sections.id = class_sections.section_id
                WHERE class_sections.class_id = " . $this->db->escape($class_id) . " 
                AND class_sections.section_id = " . $this->db->escape($section_id) ."
            ) as teacher_subjects ON teacher_subjects.id = teacher_subject_id 
        ) as exam_schedules ON exams.id = exam_schedules.exam_id 
        WHERE exams.sesion_id = " . $this->db->escape($this->current_session) . " 
        GROUP BY exams.id 
        ORDER BY exams.name"; // Add this line for sorting by exam name

$query = $this->db->query($sql);

 //echo $sql;
 $query = $this->db->query($sql);
return $query->result_array();
 }
  public function getresultByStudentandExam($exam_id, $student_id) {
        $query = $this->db->query("SELECT exam_schedules.id as `exam_schedule_id`,exam_schedules.full_marks,exam_schedules.exam_id as `exam_id`,
            exam_schedules.passing_marks,exam_results.attendence,exam_results.get_marks,exam_results.note, subjects.name,subjects.code,subjects.type  FROM `exam_schedules` INNER JOIN teacher_subjects ON teacher_subjects.id=exam_schedules.teacher_subject_id  INNER JOIN exam_results ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN subjects ON teacher_subjects.subject_id=subjects.id  WHERE exam_schedules.exam_id=" . $this->db->escape($exam_id) . " and teacher_subjects.session_id=" . $this->db->escape($this->current_session) . " and exam_results.student_id=" . $this->db->escape($student_id) . " and teacher_subjects.session_id=" . $this->db->escape($this->current_session));
        return $query->result_array();
    }
 public function vivaByClassandSection($class_id, $section_id) {

        $sql = "SELECT * FROM exams INNER JOIN (SELECT viva_schedules.*,teacher_subjects.class_id,teacher_subjects.class_name ,teacher_subjects.section_id,teacher_subjects.section_name FROM `viva_schedules` INNER JOIN (SELECT teacher_subjects.*,classes.id as `class_id`,classes.class as `class_name` ,sections.id as `section_id`,sections.section as `section_name` FROM `class_sections` 
        INNER JOIN teacher_subjects on teacher_subjects.class_section_id=class_sections.id
        INNER JOIN classes on classes.id=class_sections.class_id
        INNER JOIN sections on sections.id=class_sections.section_id
        WHERE class_sections.class_id =" . $this->db->escape($class_id) . " and class_sections.section_id=" . $this->db->escape($section_id) .") as teacher_subjects on teacher_subjects.id=teacher_subject_id group by viva_schedules.exam_id) as viva_schedules on exams.id=viva_schedules.exam_id WHERE exams.sesion_id=".$this->db->escape($this->current_session);
 $query = $this->db->query($sql);
 return $query->result_array();
 }





}
