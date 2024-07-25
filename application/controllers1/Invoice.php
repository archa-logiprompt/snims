<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('starting_invoice', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'starting_invoice');
       
        $result = $this->session_model->get_starting_invoice();
        $data['list'] = $result;
        $this->load->view('layout/header', $data);
        $this->load->view('invoice/invoice', $data);
        $this->load->view('layout/footer', $data);
    }




   function create() {
        if (!$this->rbac->hasPrivilege('starting_invoice', 'can_add')) {
            access_denied();
        }
        //$session_result = $this->session_model->getAllSession();
        //$data['sessionlist'] = $session_result;
       
        $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('invoice/invoice', $data);
            $this->load->view('layout/footer', $data);
        } else {
		
		     $id=$this->input->post('id');
			 $admin=$this->session->userdata('admin');
			 if($id!='')
			 {
			  
			 $data = array(
			    'id'=>$id,
				'centre_id'=>$admin['centre_id'],
                'starting_inv' => $this->input->post('invoice')
		
            );
			
			 }
			 
			 else {
				 
				 $data = array(
			    'centre_id'=>$admin['centre_id'],
                'starting_inv' => $this->input->post('invoice')
		        );
				 
				 }
			 
			 $this->session_model->add_invoice($data);
			
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Invoice added successfully</div>');
            redirect('invoice/index');
        }
    }



function mess_invoice() {
        if (!$this->rbac->hasPrivilege('starting_invoice', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'mess invoice');
        $data['list']=$this->session_model->get_mess_invo();
		 $this->form_validation->set_rules('invoice', 'Invoice', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('invoice/messinvoice', $data);
            $this->load->view('layout/footer', $data);
        } else {
		
		     $id=$this->input->post('id');
			 
			 if($id=='')
			 {
			 
			 $data = array(
			 
		  'invo' => $this->input->post('invoice')
		
            );
			
			 }else {
				 
			 $data = array(
		    'id'=>$id,	 
		    'invo' => $this->input->post('invoice')
		
            );	 
			 }
			
			
			
				 
            $this->session_model->add_messinvoice($data);
			
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Invoice added successfully</div>');
            redirect('invoice/mess_invoice');
        }
		
		
		
		
		
       
        
    }


 





}

?>