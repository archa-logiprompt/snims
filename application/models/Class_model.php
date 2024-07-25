<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Class_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */

    public function getgrouplist($id = null)
    {
        $this->db->select()->from('clinical_groupname');

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
    public function get($id = null, $classteacher = null)
    {

        $userdata = $this->customlib->getUserData();
        $role_id = $userdata["role_id"];
        $carray = array();

        if (isset($role_id) && ($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if ($classteacher == 'yes') {

                $classlist = $this->customlib->getclassteacher($userdata["id"]);
            } else {

                $classlist = $this->customlib->getClassbyteacher($userdata["id"]);
            }
        } else {
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];

            $this->db->select()->from('classes');
            $this->db->where('centre_id', $centre_id);
            if ($id != null) {
                $this->db->where('id', $id);
            } else {
                $this->db->order_by('id');
            }
            $query = $this->db->get();
            if ($id != null) {
                $classlist = $query->row_array();
            } else {
                $classlist = $query->result_array();
            }
        }

        return $classlist;
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id)
    {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->delete('classes'); //class record delete.

        $this->db->where('class_id', $id);
        $this->db->delete('class_sections'); //class_sections record delete.

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return TRUE;
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('classes', $data);
        } else {
            $this->db->insert('classes', $data);
        }
    }

    function check_data_exists($data)
    {
        $admin = $this->session->userdata('admin');
        $this->db->where('class', $data);
        $this->db->where('centre_id', $admin['centre_id']);
        $query = $this->db->get('classes');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function class_exists($str)
    {

        $class = $this->security->xss_clean($str);
        $res = $this->check_data_exists($class);

        if ($res) {
            $pre_class_id = $this->input->post('pre_class_id');
            if (isset($pre_class_id)) {
                if ($res->id == $pre_class_id) {
                    return TRUE;
                }
            }
            $this->form_validation->set_message('class_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function check_classteacher_exists($class, $section, $teacher)
    {

        //$this->db->where(array('class_id' =>$class ,'section_id' =>$section,'staff_id' =>$value));
        $this->db->where(array('class_id' => $class, 'section_id' => $section));
        $this->db->where_in('staff_id', $teacher);


        $query = $this->db->get('class_teacher');
        if ($query->num_rows() > 0) {

            return $query->row();
        } else {

            return FALSE;
        }

        exit();
    }

    public function class_teacher_exists($str)
    {
        // print_r($_POST);
        // exit;
        $class = $this->input->post('class');
        $section = $this->input->post('section');
        $teachers = $this->input->post('teachers');
        // $class = $this->security->xss_clean($str);
        $res = $this->check_classteacher_exists($class, $section, $teachers);

        if ($res) {
            $pre_class_id = $this->input->post('pre_class_id');
            if (isset($pre_class_id)) {
                if ($res->id == $pre_class_id) {
                    return TRUE;
                }
            }
            $this->form_validation->set_message('class_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function getClassTeacher()
    {

        $query = $this->db->select('staff.*,class_teacher.id as ctid,classes.class,classes.id as class_id,sections.id as section_id,sections.section')->join("staff", "class_teacher.staff_id = staff.id")->join("classes", "class_teacher.class_id = classes.id")->join("sections", "class_teacher.section_id = sections.id")->group_by("class_teacher.class_id, class_teacher.section_id")->get("class_teacher");

        return $query->result_array();
    }



    /*
	 public function get_hour()
 {
	  $res=$this->db->select('*')->from('timetables')->limit(1)->get();
	  $res1=$res->row();
	  
	  $start=$res1->start_time;
	  $end=$res1->end_time;
	  
	 //$interval = $start->diff($end);
     //$interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
	  
	    
 }
	*/



    public function get_transcript($class_id, $student_session_id, $student_id)
    {

        $this->db->select('student_session.section_id,student_session.class_id,sections.*')->from('student_session');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->where('student_session.student_id', $student_id);
        $query = $this->db->get();
        $trans = $query->result_array();



        $array = array();
        if (!empty($trans)) {
            foreach ($trans as $key => $val) {
                $sub = new stdClass();
                $sub->section = $val['section'];
                $sub->class_id = $val['class_id'];
                $sub->section_id = $this->getsubject($val['class_id'], $val['section_id'], $student_session_id, $student_id);


                $array[] = $sub;
            }
        }

        return $array;
    }



    function getsubject($class_id, $section_id, $student_session_id, $student_id)
    {


        $this->db->select('teacher_subjects.*,teacher_subjects.id as teacher_subject_id, class_sections.*, subjects.*');
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('class_sections', 'teacher_subjects.class_section_id = class_sections.id');
        $this->db->where(array('class_sections.section_id' => $section_id, 'class_sections.class_id' => $class_id));

        $sub = $this->db->get();
        $subject = $sub->result_array();




        $subarray = array();
        if (!empty($subject)) {
            foreach ($subject as $key => $val) {
                $a = new stdClass();
                $a->name = $val['name'];

                $a->teacher_subject_id = $val['teacher_subject_id'];
                $a->type = $val['type'];

                $a->total_hour = $this->totalminutes($val['teacher_subject_id'], $student_session_id);
                $internal_marks = $this->internalmark($val['subject_id'], $student_id);
                $a->mark = $internal_marks->marks;
                $university = $this->universitymark($val['subject_id'], $student_id);
                $a->university_mark = $university->marks;
                $subarray[] = $a;
            }
        }

        return $subarray;
    }


    function totalminutes($teacher_subject_id, $student_session_id)
    {


        $this->db->select('student_attendences.total_hour');
        $this->db->from('student_attendences');
        $this->db->where(array('student_session_id' => $student_session_id, 'subject_id' => $teacher_subject_id));
        $min = $this->db->get();
        $query = $min->result_array();



        //$res=array();
        if (!empty($query)) {
            $total_min = 0;
            foreach ($query as $key => $val) {

                $total_min = $total_min + $val['total_hour'];


                $total_hour = round($total_min / 60);
            }
        }

        return $total_hour;
    }


    function internalmark($subject_id, $student_id)
    {
        $this->db->select('internalmarks.*')->from('internalmarks');
        $this->db->where(array('subject_id' => $subject_id, 'student_id' => $student_id));
        $q = $this->db->get();
        return $q->row();
    }

    function universitymark($subject_id, $student_id)
    {
        /*$this->db->select('universitymarks.*')->from('universitymarks');
	$this->db->where(array('subject_id'=>$subject_id,'student_id'=>$student_id));
	$q=$this->db->get();
    return $q->row();*/
        $sql = "SELECT universitymarks.*, IFNULL(universitymarks.marks,0) as `marks` FROM universitymarks WHERE subject_id =" . $this->db->escape($subject_id) . "and student_id=" . $this->db->escape($student_id);

        $query = $this->db->query($sql);
        return $query->row();
    }





    public function get_hour()
    {




        //$time1 = "10:30";
        //$time2 = "12:00";


        $datetime1 = new DateTime(' 10:00 AM');
        $datetime2 = new DateTime(' 3:30 PM');
        $interval = $datetime1->diff($datetime2);
        //$hours=$interval->format('%h')." Hours ".$interval->format('%i')." Minutes";
        $hours = $interval->format('%h');
        $min = $interval->format('%i') . " Minutes ";

        $totalmin = ($hours * 60) + $min;
        return $totalmin;
    }

    public function getClass()
    {
        $result = $this->db->select('class,id')->where('centre_id', 2)->get('classes')->result_array();
        return $result;
    }
}
