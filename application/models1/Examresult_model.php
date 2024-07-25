<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Examresult_model extends CI_Model {

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
    public function get($id = null) {
        $this->db->select()->from('exam_results');
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
	
	public function get_examtype($id) 
	{
        $query = $this->db->select('exam_type')
				->from('exams')
				->where('id',$id)
        		->get();   
		return $query->row()->exam_type;
   	}
    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exam_results');
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
            $this->db->update('exam_results', $data);
        } else {
            $this->db->insert('exam_results', $data);
            return $this->db->insert_id();
        }
    }

    function add_exam_result($data) {
        $this->db->where('exam_schedule_id', $data['exam_schedule_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('exam_results');
        $result = $q->row();
		
		
		
        if ($q->num_rows() > 0) {
            $this->db->where('id', $result->id);
			
            $this->db->update('exam_results', $data);
            if ($result->get_marks != $data['get_marks']) {
                return $result->id;
            }
        } else {
            $this->db->insert('exam_results', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }
	
	
	
	function add_practicalexam_result($data) {
        $this->db->where('practical_schedule_id', $data['practical_schedule_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('practical_results');
        $result = $q->row();
		
		
		
        if ($q->num_rows() > 0) {
            $this->db->where('id', $result->id);
			
            $this->db->update('practical_results', $data);
            if ($result->get_marks != $data['get_marks']) {
                return $result->id;
            }
        } else {
            $this->db->insert('practical_results', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    function add_vivaexam_result($data) {
        // var_dump($data);exit;
        $this->db->where('viva_schedules_id', $data['viva_schedules_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('viva_results');
        $result = $q->row();
        
        
        
        if ($q->num_rows() > 0) {
            $this->db->where('id', $result->id);
            
            $this->db->update('viva_results', $data);
            if ($result->get_marks != $data['get_marks']) {
                return $result->id;
            }
        } else {
            $this->db->insert('viva_results', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

	
	
	
	
	  function add_supp_exam_result($data) {
        $this->db->where('exam_schedule_id', $data['exam_schedule_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('supplementry_exam');
        $result = $q->row();
		 
		 
		  if ($q->num_rows() > 0) {
            $this->db->where('id', $result->id);
            $this->db->update('supplementry_exam', $data);
            if ($result->get_marks != $data['get_marks']) {
                return $result->id;
            }
		  } else {
        
            $this->db->insert('supplementry_exam', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
		  }
		  
		  return false;
       
    }
	
	
	  function add_supp_exam($data) {
       
            $this->db->insert('supplementry_exam', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id; 
    }
	
	
	public  function add_supp_appearence($data) 
	{
		$appearence = array('student_id'=>$data['student_id'],
							'class_id'=>$data['class_id'],
							'section_id'=>$data['section_id'], 
							'appeared'=>$data['appeared']);
							  
		$this->db->select()->from('stud_exam_appeared');
        $this->db->where($appearence);
        //$this->db->where('student_id', $student_id);
        $query = $this->db->get()->num_rows();
		 
		if ($query == 0) 
		{ 
			$this->db->insert('stud_exam_appeared',$data);
		}
 	}
	
	
	

    public function get_exam_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('exam_results');
        $this->db->where('exam_schedule_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            $obj = new stdClass();
            $obj->attendence = 'pre';
            $obj->get_marks = "0.00";
            return $obj;
        }
    }
	
	
	
	 public function get_practicalexam_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('practical_results');
        $this->db->where('practical_schedule_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            $obj = new stdClass();
            $obj->attendence = 'pre';
            $obj->get_marks = "0.00";
            return $obj;
        }
    }
    public function get_vivaexam_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('viva_results');
        $this->db->where('viva_schedules_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            $obj = new stdClass();
            $obj->attendence = 'pre';
            $obj->get_marks = "0.00";
            return $obj;
        }
    }
	
	
	
	
	

    public function get_result($exam_schedule_id = null, $student_id = null) {
        $this->db->select()->from('exam_results');
        $this->db->where('exam_schedule_id', $exam_schedule_id);
        $this->db->where('student_id', $student_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            
        }
    }

    public function checkexamresultpreparebyexam($exam_id, $class_id, $section_id) {
        $query = $this->db->query("SELECT count(*) `counter` FROM `exam_results`,exam_schedules,student_session WHERE exam_results.exam_schedule_id=exam_schedules.id and student_session.student_id=exam_results.student_id and student_session.class_id=" . $this->db->escape($class_id) . " and student_session.section_id=" . $this->db->escape($section_id) . " and exam_schedules.session_id=" . $this->db->escape($this->current_session) . " and exam_schedules.exam_id=" . $this->db->escape($exam_id));
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
        return $query->result_array();
    }

    public function getStudentExamResultByStudent($exam_id, $student_id, $exam_schedule) {
        $sql = "SELECT exam_schedules.id as `exam_schedules_id`,exam_results.id as `exam_results_id`,exam_schedules.exam_id,exam_schedules.date_of_exam,exam_schedules.full_marks,exam_schedules.passing_marks,exam_results.student_id,exam_results.get_marks,students.firstname,students.lastname,students.guardian_phone,students.email ,exams.name as `exam_name` FROM `exam_schedules` INNER JOIN exams on exams.id=exam_schedules.exam_id INNER JOIN exam_results ON exam_results.exam_schedule_id=exam_schedules.id INNER JOIN students on students.id=exam_results.student_id WHERE exam_schedules.session_id =" . $this->db->escape($this->current_session) . " and exam_schedules.exam_id =" . $this->db->escape($exam_id) . " and exam_results.student_id =" . $this->db->escape($student_id) . " and exam_schedules.id in (" . $exam_schedule . ") ORDER BY `exam_results`.`id` ASC";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

 public  function add_appearence($data) {
        $this->db->where('appeared',1);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('stud_exam_appeared');
        $result = $q->row();
		
		if($q->num_rows() >0)
		{
		}
		else
		{
			$this->db->insert('stud_exam_appeared',$data);
			
		}
		
		
		 
 }






}
