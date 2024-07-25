<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mark_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

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

    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('exam_results');
    }

    public function add($data) 
	{
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('exam_results', $data);
        } else {
            $this->db->insert('exam_results', $data);
            return $this->db->insert_id();
        }
    }
	
	
	public function addinternal($data)
  	{
	  	$this->db->where('student_id',$data['student_id']);
	  	$this->db->where('subject_id',$data['subject_id']);
	  	$query=$this->db->get('internalmarks');
	  	$result=$query->row();
	  
		if($query->num_rows() >0)
		{
	 		$this->db->where('id',$result->id);
	 		$this->db->update('internalmarks',$data);	
		}
		else
		{
			$this->db->insert('internalmarks',$data);
			return $this->db->insert_id(); 
		} 
  	}
	
	
	public function add_practical_internal($data)
  	{
	  	$this->db->where('student_id',$data['student_id']);
	  	$this->db->where('subject_id',$data['subject_id']);
	  	$query=$this->db->get('practical_internal');
	  	$result=$query->row();
	  
		if($query->num_rows() >0)
		{
	 		$this->db->where('id',$result->id);
	 		$this->db->update('practical_internal',$data);	
		}
		else
		{
			$this->db->insert('practical_internal',$data);
			return $this->db->insert_id(); 
		} 
  	}
	
	
	
	
	
	 
	public function adduniversitymark($data)
  	{
		$this->db->where('student_id',$data['student_id']);
	  	$this->db->where('subject_id',$data['subject_id']);
	  	$query=$this->db->get('universitymarks');
	  	$result=$query->row();
	  
	   	if($query->num_rows() >0)
	 	{
	 		$this->db->where('id',$result->id);
	 		$this->db->update('universitymarks',$data);
		}
		else
		{
			$this->db->insert('universitymarks',$data);
			return $this->db->insert_id();
		} 
  	}
	
	
	public function add_prac_univer_mark($data)
  	{
		$this->db->where('student_id',$data['student_id']);
	  	$this->db->where('subject_id',$data['subject_id']);
	  	$query=$this->db->get('prac_univer_mark');
	  	$result=$query->row();
	  
	   	if($query->num_rows() >0)
	 	{
	 		$this->db->where('id',$result->id);
	 		$this->db->update('prac_univer_mark',$data);
		}
		else
		{
			$this->db->insert('prac_univer_mark',$data);
			return $this->db->insert_id();
		} 
  	}

   public function add_viva_univer_mark($data)
  	{
		$this->db->where('student_id',$data['student_id']);
	  	$this->db->where('subject_id',$data['subject_id']);
	  	$query=$this->db->get('viva_univer_mark');
	  	$result=$query->row();
	  
	   	if($query->num_rows() >0)
	 	{
	 		$this->db->where('id',$result->id);
	 		$this->db->update('viva_univer_mark',$data);
		}
		else
		{
			$this->db->insert('viva_univer_mark',$data);
			return $this->db->insert_id();
		} 
  	}



	
	
	
	public function get_mark($sub_id = null,$stud_id = null,$section_id=null)
	{
		$this->db->select('*')->from('internalmarks');
		//$this->db->where('student_id',$stud_id);
		//$this->db->where('subject_id',$sub_id);
		$this->db->where(array('student_id'=>$stud_id,'subject_id'=>$sub_id,'section_id'=>$section_id));
		$query=$this->db->get();
		$result =$query->row();
		 
		if($query->num_rows() > 0)
		{
			return $query->row(); 
		}
		else
		{
			$obj=new stdClass();
			$obj->marks="0.00";
			return $obj; 
		} 
	}
	
	
	
	public function get_practicalmark($sub_id = null,$stud_id = null,$section_id=null)
	{
		$this->db->select('*')->from('practical_internal');
		//$this->db->where('student_id',$stud_id);
		//$this->db->where('subject_id',$sub_id);
		$this->db->where(array('student_id'=>$stud_id,'subject_id'=>$sub_id,'section_id'=>$section_id));
		$query=$this->db->get();
		$result =$query->row();
		 
		if($query->num_rows() > 0)
		{
			return $query->row(); 
		}
		else
		{
			$obj=new stdClass();
			$obj->marks="0.00";
			return $obj; 
		} 
	}
	
	
	
	 
	public function get_university_mark($sub_id=null,$stud_id=null)
	{
		 $this->db->select('*')->from('universitymarks');
		 $this->db->where('student_id',$stud_id);
		 $this->db->where('subject_id',$sub_id);
		 $query=$this->db->get();
		 $result=$query->row();
	
		if($query->num_rows() > 0)
		{
			return $query->row(); 
		}
		else
		{
			$obj=new stdClass();
			$obj->marks="0.00";
			return $obj; 
		} 
	}
	
	
	public function get_mark_details($student_id)
	{
		/*$query=$this->db->select('student_session.class_id,student_session.section_id,classes.class,sections.section')->from('student_session')->join('classes','classes.id=student_session.class_id')->join('sections','sections.id=student_session.section_id')->where('student_session.student_id',$student_id)->get();*/
		
		$query=$this->db->select('stud_exam_appeared.*,classes.class,sections.section')->from('stud_exam_appeared')->join('classes','classes.id=stud_exam_appeared.class_id')->join('sections','sections.id=stud_exam_appeared.section_id')->where('stud_exam_appeared.student_id',$student_id)->get();
		 
		$result=$query->result_array();
		$ar=array();
		if(!empty($result))
		{	
			foreach($result as $key=>$res )
			{
				$a=new stdClass();
				$a->course=$res['class'];
				$a->section=$res['section'];
				$a->appeared=$res['appeared'];
				$a->class_id=$res['class_id'];
				$a->section_id=$res['section_id'];
				$a->student_id=$res['student_id'];
				$a->exam_result=$this->exam_result($res['class_id'],$res['section_id'],$student_id,$res['appeared']);
				$ar[]=$a;	
			} 
			return $ar;
		} 
	}
	
	function exam_result($class_id,$section_id,$student_id,$appeared)
	{ 
		$query = $this->db->query("SELECT exam_schedules.full_marks,exam_schedules.passing_marks,supplementry_exam.exam_schedule_id,subjects.name,subjects.id as subject_id,subjects.type,supplementry_exam.get_marks FROM exam_schedules,teacher_subjects,supplementry_exam,subjects WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and supplementry_exam.exam_schedule_id =exam_schedules.id and teacher_subjects.subject_id=subjects.id and supplementry_exam.class_id=".$this->db->escape($class_id)."and supplementry_exam.section_id=".$this->db->escape($section_id)."and supplementry_exam.student_id=".$this->db->escape($student_id)."and supplementry_exam.no_chances =".$this->db->escape($appeared));
		
		$result=$query->result_array();

		$array=array();
 		foreach($result as $key=>$val)
 		{
			$ex=new stdClass();
			$ex->full_marks=$val['full_marks'];
			$ex->passing_marks=$val['passing_marks'];
			$ex->exam_schedule_id=$val['exam_schedule_id'];
			$ex->name=$val['name'];
			$ex->subject_id=$val['subject_id'];
			$ex->get_marks=$val['get_marks'];
			$ex->type=$val['type'];
			$ex->max_appeared=$this->get_max_appeared($class_id,$section_id,$student_id,$val['exam_schedule_id']);
			$array[]=$ex; 
 		}
   		return $array; 
	}
	 
	function get_max_appeared($class_id,$section_id,$student_id,$schedule_id)
	{ 
		$query=$this->db->select('MAX(supplementry_exam.no_chances) as maxappeared,classes.class,sections.section')->from('supplementry_exam')->join('classes','classes.id=supplementry_exam.class_id')->join('sections','sections.id=supplementry_exam.section_id')->where('supplementry_exam.student_id',$student_id)->where('supplementry_exam.class_id',$class_id)->where('supplementry_exam.section_id',$section_id)->where('supplementry_exam.exam_schedule_id',$schedule_id)->get(); 
		return $query->row();  
	}
	 
	////////////////////////////////ck///////////////////////////////////
	 
	public function get_supply_details()
	{  
		$student_id=$this->input->post('student_id');
		$class_id=$this->input->post('class_id');
		$section_id=$this->input->post('section_id');
		$appeared=$this->input->post('appeared_id');
		$subject_id=$this->input->post('subject_id');
		
		$query=$this->db->select('stud_exam_appeared.*,classes.class,sections.section')->from('stud_exam_appeared')->join('classes','classes.id=stud_exam_appeared.class_id')->join('sections','sections.id=stud_exam_appeared.section_id')->where('stud_exam_appeared.student_id',$student_id)->where('stud_exam_appeared.appeared',$appeared)->where('stud_exam_appeared.class_id',$class_id)->where('stud_exam_appeared.section_id',$section_id)->get();
		
		$result=$query->result_array();
		$ar=array();
		if(!empty($result))
		{	
			foreach($result as $key=>$res )
			{
		 		$a=new stdClass();
				 $a->course=$res['class'];
				 $a->section=$res['section'];
				 $a->appeared=$res['appeared'];
				 $a->class_id=$res['class_id'];
				 $a->section_id=$res['section_id'];
				 $a->student_id=$res['student_id'];
				 $a->exam_result=$this->supply_exam_result($class_id,$section_id,$student_id,$appeared,$subject_id); 
				// $a->max_appeared=$this->get_max_appeared($res['class_id'],$res['section_id'],$student_id);
				 $ar[]=$a;	 
			}
	 
			$html='';
			if(count($ar)>0)
			{ 
				foreach($ar as $key=>$exam)
				{
                	$html.='<input type="hidden" name="student_id" value="'.$exam->student_id.'">     
                    	<input type="hidden" name="class_id" value="'.$exam->class_id.'">     
                    	<input type="hidden" name="section_id" value="'.$exam->section_id.'">   
                        <div class="box-body">
                        	<h4 class="box-title">'.$exam->section.'</h4>  
							<div class="table-responsive"> 
								<div class="col-md-12" >
									<div class="row">
										<div class="col-md-2" style="font-weight:bold">Exam Month </div>
										<div class="col-md-4"> <input class="modal_date" id="date" name="date"  type="text" value="'.set_value('date').'"/> </div>
										<div class="col-md-2" style="font-weight:bold"> No. of appearance </div>
 										<div class="col-md-4">  
 											<select id="appearence" name="appearence" class="form-control" >
												 <option value="0">Select</option>';
												  for($i=1;$i<=6;$i++){
													  foreach($exam->exam_result as $ex)
														{
													  		if($i>$ex->max_appeared->maxappeared)
													  		{
																$html.=' <option value="'.$i.'">'.$i.'</option>';
													  		}
														}
												  }
												
												$html.=' 
  											</select> 
										</div> 
									</div>
								</div> 
								<table class="table table-striped table-bordered table-hover"> 
    								<thead> 
        								<tr>
            								<th>Subject</th>
           									<th>Marks</th> 
        								</tr>
    								</thead>
    								<tbody class="tbody"> ';
										foreach($exam->exam_result as $ex)
										{ 
											if($ex->get_marks< $ex->passing_marks)
											{ 
												$html.='<input type="hidden" name="exam_schedule[]" value="'.$ex->exam_schedule_id.'">
												<tr>
													<td>'.$ex->name.'</td> 
													<td><input type="text" name="mark_'.$ex->exam_schedule_id.'" value=""> </td> 
												</tr> ';
											}
										}  
   								$html.='</tbody> 
							</table>
						</div> 
 					</div>'; 
		 		}
			}
			echo $html;  
		} 
	}
	
	function supply_exam_result($class_id,$section_id,$student_id,$appeared,$subject_id)
	{ 
		$query = $this->db->query("SELECT exam_schedules.full_marks,exam_schedules.passing_marks,supplementry_exam.exam_schedule_id,subjects.name,subjects.id as subject_id,subjects.type,supplementry_exam.get_marks FROM exam_schedules,teacher_subjects,supplementry_exam,subjects WHERE exam_schedules.teacher_subject_id = teacher_subjects.id and supplementry_exam.exam_schedule_id =exam_schedules.id and teacher_subjects.subject_id=subjects.id and supplementry_exam.class_id=".$this->db->escape($class_id)."and supplementry_exam.section_id=".$this->db->escape($section_id)."and supplementry_exam.student_id=".$this->db->escape($student_id)."and supplementry_exam.no_chances =".$this->db->escape($appeared)."and teacher_subjects.subject_id =".$this->db->escape($subject_id));
		
		$result = $query->result_array(); 
		 
		$array=array();
 		foreach($result as $key=>$val)
 		{
			$ex=new stdClass();
			$ex->full_marks=$val['full_marks'];
			$ex->passing_marks=$val['passing_marks'];
			$ex->exam_schedule_id=$val['exam_schedule_id'];
			$ex->name=$val['name'];
			$ex->subject_id=$val['subject_id'];
			$ex->get_marks=$val['get_marks'];
			$ex->type=$val['type'];
			$ex->max_appeared=$this->get_max_appeared($class_id,$section_id,$student_id,$val['exam_schedule_id']);
			$array[]=$ex; 
 		}
   		return $array;  
	} 
	
	///////////////////////////////////////////////////////////////// 
}
