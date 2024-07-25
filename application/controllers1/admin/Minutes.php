<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Minutes extends Admin_Controller {

    function __construct() {
        parent::__construct();
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('minutes_detail', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'minutes');
		$this->session->set_userdata('sub_menu', 'minutes/minutes_details');
		$data['minute_list']=$this->subject_model->get_minutes();
		
		$this->form_validation->set_rules('min_title', 'Title', 'required');
		
		
		 if ($this->form_validation->run() == FALSE) {
		  
		  }
		  else
		  {
		  	$admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
			$data=array(
			'centre_id'=>$centre_id,
			'min_title'=>$this->input->post('min_title'),
			'min_desc'=>$this->input->post('description'),
			'information'=>$this->input->post('information'),
			'report'=>$this->input->post('report'),
			'meeting_adj'=>$this->input->post('meeting_adjourned')
			);  
			  
			$this->subject_model->add_minutes($data);  
			
			 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Minutes Added successfully </div>');
            redirect('admin/minutes');
			  
		  }
		
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/minutes/minutes',$data);
        $this->load->view('layout/footer',$data);
		
		
		}
		
		

    function delete($id) {
        if (!$this->rbac->hasPrivilege('minutes', 'can_delete')) {
            access_denied();
        }
        //$data['title'] = 'Fees Master List';
        $this->subject_model->removeminutes($id);
          redirect('admin/minutes');
    }



    function edit($id) {
        if (!$this->rbac->hasPrivilege('minutes', 'can_edit')) {
            access_denied();
        }
      $this->session->set_userdata('top_menu', 'minutes');
	$this->session->set_userdata('sub_menu', 'minutes/minutes_details');
       
       $data['minute_list']=$this->subject_model->get_minutes();
	   
	    $data['minute']=$this->subject_model->get_minutes($id);
		$data['id']=$id;
		$this->form_validation->set_rules('min_title', 'Title', 'required');
		
		
      
        if ($this->form_validation->run() == FALSE) {
          
		$this->load->view('layout/header',$data);
        $this->load->view('admin/minutes/minutes_edit',$data);
        $this->load->view('layout/footer',$data);
		
        }else
		{
		  $data=array(
			'id'=>$id,
			'min_title'=>$this->input->post('min_title'),
			'min_desc'=>$this->input->post('description'),
			'information'=>$this->input->post('information'),
			'report'=>$this->input->post('report'),
			'meeting_adj'=>$this->input->post('meeting_adjourned')
			);  
			   
			$this->subject_model->add_minutes($data);  
			
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Minutes updated successfully</div>');
             redirect('admin/minutes');
        }
    
	
	
	}
	
	
	
	 

 
 
   

   function minutes_pdf()
   {
	  $id=$this->input->post('id');
	 
	 
	  $data['minute']=$this->subject_model->get_minutes($id);
	  
	  $this->load->view('print/printminutes',$data);
	   
   }






}


?>