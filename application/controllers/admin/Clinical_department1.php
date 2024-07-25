<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinical_department extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_department');
        $data['title'] = 'Add clinical_department';
     
         $clinical = $this->student_model->get_clinical_department();
        $data['clinical_department_list'] = $clinical;
// $this->form_validation->set_rules('department_name','Name of department','required');


   $this->form_validation->set_rules(
                'department_name', 'Department Name', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );


        if ($this->form_validation->run() == FALSE) {
            
        } 
		else {
            $data = array(
                'deptname' => $this->input->post('department_name'),
				
            );
			
            $this->student_model->add_clinical_department($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Department Name Added Successfully</div>');
            redirect('admin/Clinical_department/index');
        }
      
        $this->load->view('layout/header', $data);
        $this->load->view('admin/clinical_rotation/clinical_department/clinical_department', $data);
        $this->load->view('layout/footer', $data);
    }
	
	
	
	
	
	
	
	function delete($id) {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'clinical_department';
        $this->student_model->department_delete($id);
        redirect('admin/clinical_department/index');
    }
	
	
	
	function edit($id) {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_department');
        $data['id'] = $id;
		   $clinical = $this->student_model->get_clinical_department();
        $data['clinical_department_list'] = $clinical;
         

        $department= $this->student_model->department_edit($id);
        $data['department'] = $department;
        
        
		//$this->form_validation->set_rules('department_name','Name of department','required');
		$this->form_validation->set_rules(
                'department_name', 'Department ', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );
	 

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinical_rotation/clinical_department/clinical_edit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
			     'id'=>$this->input->post('id'), 
                 'deptname' => $this->input->post('department_name'),
            );
            $this->student_model->add_clinical_department($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Department Name Updated Successfully</div>');
            redirect('admin/Clinical_department/index');
        }
    }
	
	
	
	function clinical_attendance()
	{
	if (!$this->rbac->hasPrivilege('clinical_attendance', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_attendance');
	
	    $class = $this->class_model->get();
		$data['classlist'] = $class;
	
	   $this->form_validation->set_rules('class_id','class','trim|required|xss_clean');
	$this->form_validation->set_rules('section_id','section_id','trim|required|xss_clean');
	$this->form_validation->set_rules('group','group','trim|required|xss_clean');
		
		 if ($this->form_validation->run() == FALSE) {
		 }
		
		else
		{
		 $classid=$this->input->post('class_id');
		 $data['class_id']=$classid;
		 $sectionid=$this->input->post('section_id');
		 $data['section_id']=$sectionid;
		 $groupid=$this->input->post('group');
		 $data['group_id']=$groupid;
		$subject_id=$this->input->post('subject');
		  $data['subject_id']=$subject_id;
		 
		 $date=$this->input->post('date');
		 $data['date']=$date;
		
         $getstud=$this->clinicalrotation_model->getstudentsbygroup($classid,$sectionid,$groupid,$date,$subject_id);
		
		
		$data['resultlist']=$getstud;
		
		
		$attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
		
		}
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_attendance/clinical_attendance',$data);
        $this->load->view('layout/footer', $data);
		
		
	}
	
	
	
	function getGroupByClassandSection()
	{
	
	
	$classid=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$result=$this->clinicalrotation_model->getgroup($classid,$section_id);
	echo json_encode($result);
		
	}
	
	
	
	function save_attendance()
	{
	   $this->form_validation->set_rules('student_session[]','Student session','trim|required|xss_clean');
	  if ($this->form_validation->run() == FALSE) {
		 }
		 
		 else
		 {
			$class_id=$this->input->post('class_id');
		    $date=$this->input->post('date'); 
			$student_session_id=$this->input->post('student_session');
			$session_id=$this->setting_model->getCurrentSession();
			
			
			foreach($student_session_id as $key=>$val)
			{
			
			$update=$this->input->post('attendendence_id'.$val);
			
			if($this->input->post('attendencetype'.$val)==1)
			{
				$total_min=8;
			}
			else
			{
				$total_min="";
			}
			
			if($update !=0)
			{
			
			$data=array(
			'id'=>$update,
			'student_session_id'=>$val,
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min
			);
				
			}else{
			
			$data=array(
			'student_session_id'=>$val,
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min
			
			);
			
			}
			
			$this->clinicalrotation_model->insert($data);
				
				
			}
		
			
			/*$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">  Attendance Saved Successfully</div>');*/
            redirect('admin/Clinical_department/clinical_attendance');
			 
			 
			 
		 }
	}
		
	
	
	function clinical_mark_reg()
	{
	 if (!$this->rbac->hasPrivilege('marks_register', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/marks_register');	
		
		$class = $this->class_model->get();
	  	$data['classlist'] = $class;
	$this->form_validation->set_rules('exam', 'Exam type','trim|required|xss_clean');
	$this->form_validation->set_rules('class_id', 'Class','trim|required|xss_clean');
	
	if($this->form_validation->run()==FALSE)
	{
	    $this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_marks',$data);
        $this->load->view('layout/footer', $data);	
	}
	
	
	else
	{
		
		$exam=$this->input->post('exam');
		$data['exam']=$exam;
		$class_id=$this->input->post('class_id');
		$data['class_id']=$class_id;
		$section_id=$this->input->post('section_id');
		
		$studentList = $this->student_model->searchByClassSection($class_id, $section_id);
		
		
		
		$sublist=$this->clinicalrotation_model->get_subject_list($class_id,$section_id);
		
		$stdarr=array();
		
		if(!empty($studentList))
		{
			foreach($studentList as $key=>$stud)
			{
			  $arr=array();
			   $arr['student_session_id']=$stud['student_session_id'];
			   $arr['student_id']=$stud['id'];
			   $arr['admission_no']=$stud['admission_no'];
			   $arr['roll_no']=$stud['roll_no'];
			   $arr['firstname']=$stud['firstname'];
			   $arr['lastname']=$stud['lastname'];
			   $x=array();
			   foreach($sublist as $s_key=>$sub)
			   {
				$subar=array();  
				 $subar['subject_id']=$sub['subject_id'];
				 $subar['type']=$sub['type'];
				 $subar['name']=$sub['name'];
				 $x[]=$subar; 
				   }
			    $arr['subarr']=$x;
				$stdarr[]=$arr;
			}
			
			$data['studmarklist']=$stdarr;
		}
		
		
		if($this->input->post('save_exam')=='save_exam')
		{
		 
		 
		 $stud_session=$this->input->post('student');
		 $subject=$this->input->post('subject');
		 if($exam=='internal_mark')
		 {
		 foreach($stud_session as $stud)
		 {
			 foreach($subject as $sub)
			 {
				$ar['marks']=0;
				$ar['attendance']='present';
				$ar['student_session_id']=$stud;
				$ar['subject_id']=$sub;
				$stud_absent=$this->input->post('student_absent'.$stud.'_'.$sub);
				if($stud_absent=='')
				{
					$ar['marks']=$this->input->post('studentmark'.$sub.'_'.$stud);
					
					}
					else
					{
					   $ar['attendance']=$this->input->post('student_absent'.$stud.'_'.$sub);	
						}
						
						
				     $this->clinicalrotation_model->add_internal_mark($ar);	
				
				 }
		      }
			  
		 }
		 else if($exam=='university_exam')
		 {
			 foreach($stud_session as $stud)
		 {
			 foreach($subject as $sub)
			 {
				$ar['marks']=0;
				$ar['attendance']='present';
				$ar['student_session_id']=$stud;
				$ar['subject_id']=$sub;
				$stud_absent=$this->input->post('student_absent'.$stud.'_'.$sub);
				if($stud_absent=='')
				{
					$ar['marks']=$this->input->post('studentmark'.$sub.'_'.$stud);
					
					}
					else
					{
					   $ar['attendance']=$this->input->post('student_absent'.$stud.'_'.$sub);	
						}
						
						
				     $this->clinicalrotation_model->add_university_mark($ar);	
				
				 }
		      }
			 
			 }
		 
		 
			 
		   redirect('admin/clinical_department/clinical_mark_reg');
			}
		  $this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_marks',$data);
        $this->load->view('layout/footer', $data);
		}
		
		
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	}

?>