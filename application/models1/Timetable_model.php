<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetable_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('timetables');
    }

    public function add($data) {
        if (($data['id']) != 0) {
            $this->db->where('id', $data['id']);
            $this->db->update('timetables', $data); 
        } else {
            $this->db->insert('timetables', $data); 
            return $this->db->insert_id();
        }
    }

   /* public function get($data) {
		
		
        $query = $this->db->get_where('timetables', $data);
        return $query->result_array();
    }*/
	
	public function get($data) {
		
		
        $query = $this->db->get_where('timetables', $data);
        return $query->result_array();
	
	}
	
	
	 public function valid_check_exists() 
	 {
		$day = $this->input->post('day');
		$class_id = $this->input->post('class_id');
		$section_id = $this->input->post('section_id');
		$subject_id = $this->input->post('subject_id'); 
		$stime = date('H:i a',strtotime($this->input->post('stime')));
		 
	  	//echo json_encode($time);
	  	$this->db->select('*');
	  	//$this->db->where('class_id',$class_id);
	  	//$this->db->where('section_id',$section_id);
	  	$this->db->where('teacher_subject_id',$subject_id);
	  	$this->db->where('day_name',$day);
	  	$rows=$this->db->get('timetables');
		
		if($rows->num_rows()>0)
		{
			$row=$rows->row();
			if(date('H:i a',strtotime($row->start_time))>=$stime && date('H:i a',strtotime($row->end_time))<=$stime)
			{
			echo 1;
			}else
			{
			echo 2;
			}
		} 
	 } 
}
