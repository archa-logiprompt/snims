<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stuattendence_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    // public function get($id = null) {
    //  $admin=$this->session->userdata('admin');
    //     $centre_id=$admin['centre_id'];


    //     $this->db->select()->from('student_attendences');
    //     $this->db->where('centre_id',$centre_id);
    //     if ($id != null) {
    //         $this->db->where('id', $id);
    //     } else {
    //         $this->db->order_by('id');
    //     }
    //     $query = $this->db->get();
    //     if ($id != null) {
    //         return $query->row_array();
    //     } else {
    //         return $query->result_array();
    //     }
    // }
    public function get($id = null) {
        $admin=$this->session->userdata('admin');
           $centre_id=$admin['centre_id'];
   
   
           $this->db->select()->from('student_attendences');
           $this->db->where('centre_id',$centre_id);
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
         // print_r($this->db->last_query());exit;
    }
    public function adds($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('staff_evaluation', $data);
        } else {
            $this->db->insert('staff_evaluation', $data);
        }
    }
     public function cliniadds($data) {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('clinical_evaluation', $data);
        } else {
            $this->db->insert('clinical_evaluation', $data);
        }
    }




 public function searchreportbyday($class_id,$section_id,$subject_id=null,$from,$to)
    {
       $q=' ';
        
        if($subject_id!='')
        {
            $q.=' and clinical_attendance.subject_id='. $this->db->escape($subject_id); 
        }
        
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(clinical_attendance.date, 'xxx') as date,clinical_attendance.subject_id,clinical_attendance.remark, IFNULL(clinical_attendance.id, 0) as attendence_id,clinical_attendance.attendence_type_id FROM `student_session` LEFT JOIN clinical_attendance ON clinical_attendance.student_session_id=student_session.id  and clinical_attendance.date =" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and clinical_attendance.subject_id=" . $this->db->escape($subject_id).") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' and  date >=".$this->db->escape($from)." and  date <= ".$this->db->escape($to)." GROUP BY students.id";


        //$query = $this->db->query($sql)->result_array();
        $query = $this->db->query($sql)->result_array();
        
        return $query;
    }
     function selstaff() {

        $query = $this->db->select("*,staff_evaluation.sid as stfid");

        return $query->result_array();
    }
     public function getparentstudentdetail($data)
	{
		
	
		$this->db->select('student_session.id as sess_id,classes.class,sections.section,students.firstname,students.lastname,students.father_name,students.admission_no,students.father_phone')->from('student_session');
		
        $this->db->join('students','students.id=student_session.student_id'); 
        $this->db->join('classes','student_session.class_id=classes.id');
        $this->db->join('sections','student_session.section_id=sections.id'); 
        $this->db->where('student_session.id',$data['student_session_id']);
        $res=$this->db->get();
        return $res->result_array();
		
		
	}
    public function staffreport($class=null, $section=null,$subject=null,$staff=null,$from,$to,$session,$dept)
    {
        
        $this->db->select("*,subjects.name as sname");
        // ,staff_evaluation.id as evid
        $this->db->from("staff_evaluation");
        $this->db->where('sid',$staff);
        $this->db->where('class_id',$class);
        $this->db->where('section_id',$section);
        $this->db->where('subject_id',$subject);

        //$this->db->where('session_id',$session);
        $this->db->where('DATE(date) >=', date('Y-m-d',strtotime($from)));
        $this->db->where('DATE(date) <=', date('Y-m-d',strtotime($to)));
        //$this->db->where('department',$dept);
        $this->db->where('staff_evaluation.status','1');

        $this->db->join('classes', 'staff_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'staff_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'staff_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'staff_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'staff_evaluation.sid = staff.id', 'LEFT');
          // $this->db->where('staff.department',$dept);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function staffreportapprove($session,$dept)
    {
        
        $this->db->select("*,subjects.name as sname,staff_evaluation.id as evid");
        // 
        $this->db->from("staff_evaluation");
        // $this->db->where('sid',$staff);
        
        // $this->db->where('section_id',$section);
        // $this->db->where('subject_id',$subject);
             
        $this->db->where('session_id',$session);
        // $this->db->where('DATE(date) >=', date('Y-m-d',strtotime($from)));
        // $this->db->where('DATE(date) <=', date('Y-m-d',strtotime($to)));
        $this->db->where('department',$dept);
        $this->db->where('staff_evaluation.status','0');

        $this->db->join('classes', 'staff_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'staff_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'staff_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'staff_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'staff_evaluation.sid = staff.id', 'LEFT');
          // $this->db->where('staff.department',$dept);
        $query = $this->db->get();
        return $query->result_array();
    }





    public function approve($id) {
    $data=array('status'=>1);
   $this->db->where('id', $id);
   $this->db->update('staff_evaluation',$data);
   }

public function approvenew($id) {
    $data=array('status'=>1);
    //var_dump($data);
   $this->db->where('sid', $id);
   $this->db->update('clinical_evaluation',$data);
}






public function myreport($class=null, $section=null,$subject=null,$staff=null,$from,$to,$session)
    {
        
        $this->db->select("*,subjects.name as sname");
        // ,staff_evaluation.id as evid
        $this->db->from("staff_evaluation");
        $this->db->where('sid',$staff);
        $this->db->where('class_id',$class);
        $this->db->where('section_id',$section);
        $this->db->where('subject_id',$subject);

        //$this->db->where('session_id',$session);
        $this->db->where('DATE(date) >=', date('Y-m-d',strtotime($from)));
        $this->db->where('DATE(date) <=', date('Y-m-d',strtotime($to)));
        $this->db->where('staff_evaluation.status','1');

        $this->db->join('classes', 'staff_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'staff_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'staff_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'staff_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'staff_evaluation.sid = staff.id', 'LEFT');
        $this->db->where('staff.id',$staff);
        $query = $this->db->get();
        return $query->result_array();
    }
    public function hdreport($class=null, $section=null,$subject=null,$staff=null,$from,$to,$session,$dept)
    {
        
        $this->db->select("*,subjects.name as sname");
        // ,staff_evaluation.id as evid
        $this->db->from("staff_evaluation");
        $this->db->where('sid',$staff);
        $this->db->where('class_id',$class);
        $this->db->where('section_id',$section);
        $this->db->where('subject_id',$subject);

        //$this->db->where('session_id',$session);
        $this->db->where('DATE(date) >=', date('Y-m-d',strtotime($from)));
        $this->db->where('DATE(date) <=', date('Y-m-d',strtotime($to)));
        $this->db->where('department',$dept);
        $this->db->where('staff_evaluation.status','1');

        $this->db->join('classes', 'staff_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'staff_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'staff_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'staff_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'staff_evaluation.sid = staff.id', 'LEFT');
          // $this->db->where('staff.department',$dept);
        $query = $this->db->get();
        return $query->result_array();
    }

   public function hdclinireport($class=null, $section=null,$subject=null,$staff=null,$from,$to,$session,$dept)
    {
         $this->db->distinct();
        $this->db->select("*,subjects.name as sname");
        // ,staff_evaluation.id as evid
        $this->db->from("clinical_evaluation");
        $this->db->where('sid',$staff);
        $this->db->where('class_id',$class);
        $this->db->where('section_id',$section);
        $this->db->where('subject_id',$subject);

        //$this->db->where('session_id',$session);
        $this->db->where('DATE(date) >=', date('Y-m-d',strtotime($from)));
        $this->db->where('DATE(date) <=', date('Y-m-d',strtotime($to)));
        $this->db->where('department',$dept);
        $this->db->where('clinical_evaluation.status','1');

        $this->db->join('classes', 'clinical_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'clinical_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'clinical_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'clinical_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'clinical_evaluation.sid = staff.id', 'LEFT');
          $this->db->group_by('clinical_evaluation.date');
          // $this->db->where('staff.department',$dept);
        $query = $this->db->get();
        return $query->result_array();
    }






   /* public function searchAttendenceClassSection($class_id, $section_id, $date) {

        $sql = "select student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id = students.id and students.is_active = 'yes' ";


        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	*/
	
	
	
	 public function searchAttendenceClassSection($class_id, $section_id,$subject,$date) {
      
      $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $sql = "select student_sessions.attendence_id,student_sessions.subject_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.subject_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.subject_id=".$this->db->escape($subject)."and student_attendences.date=" . $this->db->escape($date) . " where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id = students.id and students.is_active = 'yes' and students.centre_id=".$centre_id;

        $query = $this->db->query($sql);
        return $query->result_array();
    }
	
	
	
	
	 public function searchAttendenceReport($class_id, $section_id,$subject_id, $date) {

       
	   
	    $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id  and student_attendences.date=" . $this->db->escape($date) . " and student_attendences.subject_id=" . $this->db->escape($subject_id)."  where  student_session.session_id=" . $this->db->escape($this->current_session) . " and student_session.class_id=" . $this->db->escape($class_id) . "and student_session.section_id=" . $this->db->escape($section_id) . ") as student_sessions   LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' ";

        $query = $this->db->query($sql);
        // print_r($this->db->last_query());
        return $query->result_array();
    }
	
    public function searchAttendenceReportbyperiod($class_id,$section_id,$subject_id=null,$from,$to)
	{
		$q=' ';
		
		if($subject_id!='')
		{
			$q.=' and student_attendences.subject_id='. $this->db->escape($subject_id); 
		}
		
 		$sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id where  student_session.class_id=" . $this->db->escape($class_id) ." and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' and  date >=".$this->db->escape($from)." and  date <= ".$this->db->escape($to)." GROUP BY students.id order by students.firstname";
        $query = $this->db->query($sql)->result_array();
		
        return $query;
    }

public function searchAttendenceReportbyperiodnew($class_id,$section_id,$subject_id=null,$from,$to)
    {
        $q=' ';
        
        if($subject_id!='')
        {
            $q.=' and student_attendences.subject_id='. $this->db->escape($subject_id); 
        }
        
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id where  student_session.class_id=" . $this->db->escape($class_id) ." and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes' and  date >=".$this->db->escape($from)." and  date <= ".$this->db->escape($to)." GROUP BY students.id";
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
		 
 		$sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . "  where student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions  LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes'";
		
        $query = $this->db->query($sql)->result_array();
		
        return $query;
    }
     
    public function checksearchAttendenceReportbyperiodnew($class_id,$section_id,$subject_id=null,$date)
    {
        $q=' ';
        
        if($subject_id!='')
        {
            $q.=' and student_attendences.subject_id='. $this->db->escape($subject_id); 
        }
         
        $sql = "select  student_sessions.attendence_id,students.firstname,student_sessions.date,student_sessions.remark,students.roll_no,students.admission_no,students.lastname,student_sessions.attendence_type_id,student_sessions.id as student_session_id, attendence_type.type as `att_type`,attendence_type.key_value as `key` from students ,(SELECT student_session.id,student_session.student_id ,IFNULL(student_attendences.date, 'xxx') as date,student_attendences.subject_id,student_attendences.remark, IFNULL(student_attendences.id, 0) as attendence_id,student_attendences.attendence_type_id FROM `student_session` LEFT JOIN student_attendences ON student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . "  where student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) .$q .") as student_sessions  LEFT JOIN attendence_type ON attendence_type.id=student_sessions.attendence_type_id where student_sessions.student_id=students.id  and students.is_active = 'yes'";
        
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
	
	  function count_attendance_objbyperiod($month, $year, $student_id,$sub) {

        $attendance_type = 1;
        $query = $this->db->select('count(*) as attendence')->join("student_session", "student_attendences.student_session_id = student_session.id")->where(array('student_attendences.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'student_attendences.attendence_type_id' => $attendance_type,'student_attendences.subject_id'=>$sub))->get("student_attendences");

        return $query->row()->attendence;

    }
	
	
	
	
	
	
	
	
	

    function count_attendance_obj($month, $year, $student_id, $attendance_type = 1,$sub) {


        $query = $this->db->select('count(*) as attendence')->join("student_session", "student_attendences.student_session_id = student_session.id")->where(array('student_attendences.student_session_id' => $student_id, 'month(date)' => $month, 'year(date)' => $year, 'student_attendences.attendence_type_id' => $attendance_type,'student_attendences.subject_id'=>$sub))->get("student_attendences");

        return $query->row()->attendence;

    }

    function attendanceYearCount() {

        $query = $this->db->select("distinct year(date) as year")->get("student_attendences");

        return $query->result_array();
    }


    function batchwiseYearCount() {

        $query = $this->db->select("distinct year(date) as year")->get("batchwise_attendance");

        return $query->result_array();
    }


public function clinicalreportapprove($session,$dept)
    {
        $this->db->distinct();

        $this->db->select("*,subjects.name as sname,clinical_evaluation.id as evid");

        $this->db->from("clinical_evaluation");
        $this->db->where('session_id',$session);
        $this->db->where('department',$dept);
        $this->db->where('clinical_evaluation.status','0');

        $this->db->join('classes', 'clinical_evaluation.class_id = classes.id', 'LEFT');

        $this->db->join('sections', 'clinical_evaluation.section_id = sections.id', 'LEFT');
        $this->db->join('subjects', 'clinical_evaluation.subject_id = subjects.id', 'LEFT');     
         $this->db->join('sessions', 'clinical_evaluation.session_id = sessions.id', 'LEFT');
         $this->db->join('staff', 'clinical_evaluation.sid = staff.id', 'LEFT');
         $this->db->group_by('staff.name'); 
          // $this->db->where('staff.department',$dept);
        $query = $this->db->get();
        return $query->result_array();
    }







}
