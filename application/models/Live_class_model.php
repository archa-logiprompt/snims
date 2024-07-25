<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Live_class_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('timetables');
    }

    public function add($data) {
	
       /* if (($data['id']) != 0) {
            $this->db->where('id', $data['id']);
            $this->db->update('live_class_timetable', $data); 
        } else {*/
            $this->db->insert('live_class_timetable', $data); 
            return $this->db->insert_id();
        //}
    }



   public function check_edit($teacher_subject_id,$teacher_id)
	{
		$admin=$this->session->userdata('admin');
		
		$this->db->where('teacher_subject_id',$teacher_subject_id);
		$this->db->where('centre_id',$admin['centre_id']);
		$this->db->where('teacher_id',$teacher_id);
		$res=$this->db->get('live_class_timetable');
		
		
		if($res->num_rows()>0)
		{
		$this->db->where('teacher_subject_id',$teacher_subject_id);
		$this->db->where('centre_id',$admin['centre_id']);
		$this->db->where('teacher_id',$teacher_id);
		$this->db->delete('live_class_timetable');
		}
		
		
		}
	






   /* public function get($data) {
		
		
        $query = $this->db->get_where('timetables', $data);
        return $query->result_array();
    }*/
	
	public function get($data) {
		
		
        $query = $this->db->get_where('live_class_timetable', $data);
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
	 
	/* public function teacher($id)
	 {
		$this->db->select('teacher_subjects.id,subjects.name')->from('teacher_subjects');
		$this->db->join('subjects','subjects.id=teacher_subjects.subject_id');
		$this->db->where("FIND_IN_SET(".$id.", teacher_subjects.teacher_id)");
		return $this->db->get()->result_array();
		 
		 
		 
		 }
		 */
		 
		 
		  public function teacher($id,$class_id,$section_id)
	 {
		$this->db->select('teacher_subjects.id,subjects.name,subjects.type')->from('teacher_subjects');
		$this->db->join('subjects','subjects.id=teacher_subjects.subject_id');
		$this->db->join('class_sections','class_sections.id=teacher_subjects.class_section_id');
		$this->db->where('class_sections.class_id',$class_id);
		$this->db->where('class_sections.section_id',$section_id);
		$this->db->where("FIND_IN_SET(".$id.", teacher_subjects.teacher_id)");
		return $this->db->get()->result_array();
		 
		 
		 
		 }
		 
	 
	 
	 public function class_active($id,$status)
	 {
		$data=array('is_live'=>$status);
		$this->db->where('id',$id);
		$this->db->update('live_class_timetable',$data); 
		 
		 }
	 
	  public function get_apid($id)
	 {
		$this->db->select('apid')->from('live_class_timetable');
		$this->db->where('id',$id);
		return $this->db->get()->row_array(); 
		 
		 }
	 
	  public function getteacher_name($id=null)
		 {
			 
			$this->db->select('name,surname')->from('staff')->where('id',$id);
			return $this->db->get()->row_array();
			
			 }
		 
	 public function add_apid($data,$id)
	 {
		$this->db->where('id',$id);
		$this->db->update('live_class_timetable',$data);
		 }
		 
		 
	  public function classupload($data)
	 {
		
		 $this->db->insert('class_uploader',$data);
		 
		 }
	 
	 
	 
	 public function uploaded_class($id)
	{
		$this->db->select('*')->from('class_uploader');
		$this->db->where('live_class_id',$id);
		return $this->db->get()->result_array();
		
		
		}
		
		
		
			public function view_class($id)
		{
			
			$this->db->select('*')->from('class_uploader');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
			
			
			
			}	
			
		
		
		public function attendance($data)
	 {
		 $this->db->select('*')->from('liveclass_attendance');
		 $this->db->where('student_id',$data['student_id']);
		 $this->db->where('live_class_id',$data['live_class_id']);
		 $this->db->where('date',$data['date']);
		 $res=$this->db->get();
		 
		 if($res->num_rows()>0)
		 {
			return false; 
			 
			 }
		 else
		 {
			 $this->db->insert('liveclass_attendance',$data);}
		 
		 
		 }
			
			
			
			
			public function getLiveclassAttendance($student_id,$subject_id,$teacher_id,$date)
	{
		$d=date('Y-m-d', $this->customlib->datetostrtotime($date));
		$sql="SELECT liveclass_attendance.* FROM liveclass_attendance INNER JOIN live_class_timetable on live_class_timetable.id=liveclass_attendance.live_class_id  WHERE live_class_timetable.teacher_subject_id=".$this->db->escape($subject_id)." and live_class_timetable.teacher_id=".$this->db->escape($teacher_id)." and  liveclass_attendance.student_id=".$this->db->escape($student_id)." and liveclass_attendance.date=".$this->db->escape($d);
		$res=$this->db->query($sql);
		$val= $res->row_array();
		
		return $val;
		
		/*$sub=$this->db->select('id')->from('live_class_timetable')->where(array('teacher_subject_id'=>$subject_id,'teacher_id'=>$teacher_id))->get();
		$live_id=$sub->result_array();
		 if(!empty($live_id))
		 { foreach($live_id as $live)
		 {
			
			 if($live['id']==$val['live_class_id'])
			 {
			  return $val;
			 }
			
			 }
			 
			 }*/
		   } 
	 
		
	 
	 
	 
	  
}
