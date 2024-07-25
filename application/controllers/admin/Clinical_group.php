<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinical_group extends Admin_Controller {

    function __construct() {
        parent::__construct();
		$this->load->model('Clinicalrotation_model');
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('clinical_group', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
		$this->session->set_userdata('sub_menu', 'clinical_rotation/assign_group');
		
		 $class = $this->class_model->get();
         $data['classlist'] = $class;
		$group=$this->class_model->getgrouplist();
		 $data['grouplist']=$group;
		$search = $this->input->post('search');
	    $class = $this->input->post('class_id');
        $section = $this->input->post('section_id');
		
		if(isset($search))
		{
			
		if($search =='search_filter')
		
		{
			 $this->form_validation->set_rules('class_id','Course','trim|required|xss_clean');
		     $this->form_validation->set_rules('section_id','Section','trim|required|xss_clean');
			
			 if($this->form_validation->run() == FALSE)
				   {
					  
					  $this->load->view('layout/header', $data);
                      $this->load->view('admin/clinical_rotation/assign_group/clinical_group',$data);
                      $this->load->view('layout/footer', $data);
					  
				   }
			else
			{
				
				 $student_list = $this->student_model->getstudentByclasssection($class, $section);
		         $data['student_list']=$student_list;	
			}
			}
			}
			
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_group/clinical_group',$data);
        $this->load->view('layout/footer',$data);
		
	}


	function new_grup() {
		
		if (!$this->rbac->hasPrivilege('add_group', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'groupwise_attendance');
		$this->session->set_userdata('sub_menu', 'groupwise_attendance/new_grup');
		
		 $class = $this->class_model->get();
         $data['classlist'] = $class;
		$group=$this->class_model->getmygrouplist();
		 $data['grouplist']=$group;
		$search = $this->input->post('search');
	    $class = $this->input->post('class_id');
        $section = $this->input->post('section_id');
		
		if(isset($search))
		{
			
		if($search =='search_filter')
		
		{
			 $this->form_validation->set_rules('class_id','Course','trim|required|xss_clean');
		     $this->form_validation->set_rules('section_id','Section','trim|required|xss_clean');
			
			 if($this->form_validation->run() == FALSE)
				   {
					  
					  $this->load->view('layout/header', $data);
                      $this->load->view('admin/clinical_rotation/assign_group/newgrup',$data);
                      $this->load->view('layout/footer', $data);
					  
				   }
			else
			{
				
				 $student_list = $this->student_model->getstudentByclasssectionforgroup($class, $section);
		         $data['student_list']=$student_list;	
			}
			}
			}
			
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_group/newgrup',$data);
        $this->load->view('layout/footer',$data);
		
	}
		




  function assign_group()
  {


	
   $this->form_validation->set_rules(
                'groupname', 'groupname', array(
            'required',
            array('check_exists_group', array($this->student_model, 'check_exists_group'))
                ));
   
   
	   if ($this->form_validation->run() == false) {
		 
		 
		  $data = array(
                
               
                'groupname' => form_error('groupname'),
               
            );  
		   $array = array('status' => 'fail', 'error' => $data);
           echo json_encode($array);
		}
	  
	  else
	  {
		$admin = $this->session->userdata('admin');
		$centre_id = $admin['centre_id'];
		  
		  $groupname=$this->input->post('groupname');
		 // $groupname1=$this->input->post('group');
		 
		 $data_new=array(
			 'session_id'=>$this->setting_model->getCurrentSession(),
			 'group_name'=> $groupname,
			 'centre_id'=>$centre_id,
			 
			 
			);
// 			var_dump($data_new);exit;
		    $insert_id=$this->student_model->add_groupname($data_new);
		//   var_dump($insert_id);exit;
		  
		  $student_sess_id=$this->input->post('student_sess_id');
		  $class_id=$this->input->post('class_id');
		  $section_id=$this->input->post('section_id');
		 //$groupnameid=$this->input->post('group');
		  
		  foreach($student_sess_id as $key=>$stud)
		  {
			 $data=array(
// 			'centre_id'=>$centre_id,
			 'class_id'=> $class_id,
			 'session_id'=>$this->setting_model->getCurrentSession(),
			 'student_session_id'=>$stud,
			 'section_id'=>$section_id,
			 'group_id'=> $insert_id,
			 
			 
			 ); 
			 
			 
		 $this->student_model->addgroup($data);
			 
			  
		  }
		   
		  
		    $array = array('status' => 'success', 'error' => '');
            echo json_encode($array); 
		  
	  }
	  
	   
	  
  }

  function assign_ourgroup()
  {


	
   $this->form_validation->set_rules(
                'groupname', 'groupname', array(
            'required',
            array('check_exists_ourgroup', array($this->student_model, 'check_exists_ourgroup'))
                ));
   
   
	   if ($this->form_validation->run() == false) {
		 
		 
		  $data = array(
                
               
                'groupname' => form_error('groupname'),
               
            );  
		   $array = array('status' => 'fail', 'error' => $data);
           echo json_encode($array);
		}
	  
	  else
	  {
		  
		  $groupname=$this->input->post('groupname');
		 // $groupname1=$this->input->post('group');
		  
		  
		  $data_new=array(
		  'session_id'=>$this->setting_model->getCurrentSession(),
		  'group_name'=> $groupname,
		 
		  
		  );
		  $insert_id=$this->student_model->addour_groupname($data_new);
		  
		  
		  $student_sess_id=$this->input->post('student_sess_id');
		  $class_id=$this->input->post('class_id');
		  $section_id=$this->input->post('section_id');
		 //$groupnameid=$this->input->post('group');
		  
		  foreach($student_sess_id as $key=>$stud)
		  {
			 $data=array(
			 'class_id'=> $class_id,
			 'session_id'=>$this->setting_model->getCurrentSession(),
			 'student_session_id'=>$stud,
			 'section_id'=>$section_id,
			 'group_id'=> $insert_id,
			 
			 
			 ); 
			 
			 
		 $this->student_model->addourgroup($data);
			 
			  
		  }
		   
		  
		    $array = array('status' => 'success', 'error' => '');
            echo json_encode($array); 
		  
	  }
	  
	   
	  
  }



 function view_clinicalgroup()
 {
	 
	 if (!$this->rbac->hasPrivilege('clinical_group', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'clinical_rotation');
		$this->session->set_userdata('sub_menu', 'clinical_rotation/assign_group');
		
		
		  $group=$this->student_model->view_clinical_group();
	       $data['group']= $group;
				 
		 
		 
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_group/view_clinicalgroup',$data);
        $this->load->view('layout/footer',$data);
		
	  
	 
 }


 function view_addedgroups()
 {
	 
	 if (!$this->rbac->hasPrivilege('add_group', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'groupwise_attendance');
		$this->session->set_userdata('sub_menu', 'groupwise_attendance/add_group');
		
		
		  $group=$this->student_model->view_addour_group();
	       $data['group']= $group;
				 
		 
		 
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_group/view_addedgroup',$data);
        $this->load->view('layout/footer',$data);
		
	  
	 
 }







 function getstudentdetail()
 {
	 $section_id=$this->input->post('section_id');
	 $class_id=$this->input->post('class_id');
	 $ward_id=$this->input->post('ward_id');
	 
	 
	 $studentdetail=$this->student_model->getstudentdetail($section_id,$class_id,$ward_id);
	 echo json_encode( $studentdetail);
	  
 }



function get_studentbygroup()
{
 $group_id=$this->input->post('group_id');
 
 $studentbygroup=$this->student_model->get_studentBygroup($group_id);
 echo json_encode($studentbygroup);
	
	
	
}

function get_studentbyournewgroup()
{
 $group_id=$this->input->post('group_id');
 
 $studentbygroup=$this->student_model->get_studentByournewgroup($group_id);
 echo json_encode($studentbygroup);
	
	
	
}



function release_stud()
{
	
	
	$student_session_array=$this->input->post('student_session_id');
	
	//echo json_encode($student_session_array);
	
	foreach($student_session_array as $key=>$stud_sess)
      {
	$this->student_model->release($stud_sess);
	}
	
	 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Selected students are successfully released </div>');
	redirect('admin/clinical_group/view_clinicalgroup');
}

function release_studfromgroup()
{
	
	
	$student_session_array=$this->input->post('student_session_id');
	
	//echo json_encode($student_session_array);
	
	foreach($student_session_array as $key=>$stud_sess)
      {
	$this->student_model->releasestudents($stud_sess);
	}
	
	 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Selected students are successfully released </div>');
	redirect('admin/clinical_group/view_addedgroups');
}

function delete($id){
	//echo $id;
	 if (!$this->rbac->hasPrivilege('clinical_group', 'can_delete')) {
            access_denied();
        }
       
        $this->Clinicalrotation_model->delete($id);
        redirect('admin/clinical_group/view_clinicalgroup');
	}


	function deletenewgroup($id){
	//echo $id;
	 if (!$this->rbac->hasPrivilege('add_group', 'can_delete')) {
            access_denied();
        }
       
        $this->Clinicalrotation_model->deleteourgroup($id);
        redirect('admin/clinical_group/view_addedgroups');
	}
	
}



?>