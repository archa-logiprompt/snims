<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Exam_model extends CI_Model {

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

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        $this->db->select()->from('exams');
        $this->db->where('centre_id',$centre_id);
		$this->db->where('sesion_id', $this->current_session);
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

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exams');
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
            $this->db->update('exams', $data);
        } else {
            $this->db->insert('exams', $data);
            return $this->db->insert_id();
        }
    }

    function add_exam_schedule($data) {
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $q = $this->db->get('exam_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('exam_schedules', $data);
        } else {
            $this->db->insert('exam_schedules', $data);
        }
    //    echo $this->db->last_query();exit;
        // var_dump($q);exit;
        
    }
    function getTeachers()
    {
     
        $query=$this->db->select('*')->from('staff')->get()->result_array();
        // var_dump($query);exit;
        return $query;
        
    } 
	
	
	
	function add_practical_schedule($data) {
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $q = $this->db->get('practical_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('practical_schedules', $data);
        } else {
            $this->db->insert('practical_schedules', $data);
        }
    }

    function add_viva_schedule($data) {
        $this->db->where('exam_id', $data['exam_id']);
        $this->db->where('teacher_subject_id', $data['teacher_subject_id']);
        $q = $this->db->get('viva_schedules');
        if ($q->num_rows() > 0) {
            $result = $q->row_array();
            $this->db->where('id', $result['id']);
            $this->db->update('viva_schedules', $data);
        } else {
            $this->db->insert('viva_schedules', $data);
        }
    }
	
	
	
	
	
	
	
	public function get_exam($class_id,$section_id)
	{
		$this->db->select()->from('exams');
		$this->db->where('class_id',$class_id);
		$this->db->where('section_id',$section_id);
		$this->db->where('sesion_id', $this->current_session);
		$query=$this->db->get();
		return $query->result_array();
		}
		
	
	
	

}
