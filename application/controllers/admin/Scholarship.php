<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scholarship extends Admin_Controller {

    function __construct() {
        parent::__construct();
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('scholarship', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'Scholarship');
		$this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
		$data['title'] = 'Scholarship List';
		$sch= $this->student_model->getscholarship();
		$data['sch']=$sch;
		
		
		$this->form_validation->set_rules('name','Name','required|is_unique[scholarship.name]');

       
		  if ($this->form_validation->run() == FALSE) {
		  
		  }
		  
		else
		{
			$admin=$this->session->userdata('admin');
           $centre_id=$admin['centre_id'];
		   $data=array(
		   'centre_id'=>$centre_id,
		   'name'=>$this->input->post('name'),
		   'description'=>$this->input->post('description'),
		   'valid_from'=>$this->input->post('valid_from'),
		   'valid_to'=>$this->input->post('valid_to'),
		    'session_id' => $this->setting_model->getCurrentSession()
		   );	
			
			 $feegroup_result = $this->student_model->scholarship($data);
			 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Scholarship added successfully</div>');
            redirect('admin/scholarship/index');
			
		}
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/scholarship/scholarship',$data);
        $this->load->view('layout/footer',$data);
		
		
		}
		
		

    function delete($id) {
        if (!$this->rbac->hasPrivilege('scholarship', 'can_delete')) {
            access_denied();
        }
        //$data['title'] = 'Fees Master List';
        $this->student_model->removescholar($id);
         redirect('admin/scholarship/index');
    }



    function edit($id) {

        if (!$this->rbac->hasPrivilege('scholarship', 'can_edit')) {
            access_denied();
        }
      $this->session->set_userdata('top_menu', 'Scholarship');
	$this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
        $data['id'] = $id;
        $sch= $this->student_model->getscholarship();
		$data['sch']=$sch;
		$scholar= $this->student_model->getscholarship($id);
		$data['scholar']=$scholar;
		
		
       $this->form_validation->set_rules('name', 'Name', 'required');
		
        if ($this->form_validation->run() == FALSE) {
          
		$this->load->view('layout/header',$data);
        $this->load->view('admin/scholarship/scholarship_edit',$data);
        $this->load->view('layout/footer',$data);
		
        }else
		{
		   $data=array(
		   'id'=>$this->input->post('id'), 
		   'name'=>$this->input->post('name'),
		   'description'=>$this->input->post('description'),
		   'valid_from'=>$this->input->post('valid_from'),
		   'valid_to'=>$this->input->post('valid_to'),
		    'session_id' =>$this->setting_model->getCurrentSession()
		   );
         	 $feegroup_result = $this->student_model->scholarship($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Scholarship updated successfully</div>');
             redirect('admin/scholarship/index');
        }
    
	
	
	}
	
	
	
	 function assign($id) {
        if (!$this->rbac->hasPrivilege('scholarship', 'can_view')) {
           access_denied();
        }
        $this->session->set_userdata('top_menu', 'Scholarship');
       $this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
        $data['id'] = $id;
        $student=$this->student_model->getstudent_scholarship($id);
	    $data['sch']= $student ; 

	    $this->load->view('layout/header', $data);
        $this->load->view('admin/scholarship/assign', $data);
        $this->load->view('layout/footer', $data);
    }

 
 
    function apply_scholarship()
	{
		if (!$this->rbac->hasPrivilege('apply_scholarship', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Scholarship');
		$this->session->set_userdata('sub_menu', 'scholarship/apply_scholarship');
		$class = $this->class_model->get();
		$data['classlist'] = $class;
		$data['scholarship']=$this->student_model->getallscholarship();
		
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/scholarship/applyscholarship', $data);
        $this->load->view('layout/footer', $data);
		
		
	}









}


?>