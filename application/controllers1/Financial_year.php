<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Financial_year extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('financial_year', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'System Settings');
        $this->session->set_userdata('sub_menu', 'financial_year');
        //$data['title'] = 'Session List';
        $result = $this->session_model->getfinancialyear();
        $data['list'] = $result;
        $this->load->view('layout/header', $data);
        $this->load->view('financial_year/financial_year', $data);
        $this->load->view('layout/footer', $data);
    }


   function create() {
        if (!$this->rbac->hasPrivilege('financial_year', 'can_add')) {
            access_denied();
        }
        //$session_result = $this->session_model->getAllSession();
        //$data['sessionlist'] = $session_result;
       
        $this->form_validation->set_rules('finance_year', 'Financial Year', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
          $this->load->view('financial_year/financial_year', $data);
            $this->load->view('layout/footer', $data);
        } else {
			$year=$this->input->post('finance_year');
			$str_y=str_replace('-','',$year);
			$y=substr($str_y, -4);
			$admin=$this->session->userdata('admin');
			 $data = array(
			    'centre_id'=>$admin['centre_id'],
                'financial_year' => $this->input->post('finance_year'),
				'is_active'=>'no',
				'value'=>$y
            );
            $this->session_model->add_finance_year($data);
			
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Financial Year added successfully</div>');
            redirect('financial_year/index');
        }
    }




 function activate()
 {
	 $id=$this->input->post('id');
	 
	 $data=array(
	 'id'=>$id,
	 'is_active'=>'yes'
	 );
	 
	 $this->session_model->add_finance_year($data);
	   $array = array('status' => 'success', 'error' => '');
	   
	   echo json_encode($array);
 }


     function delete($id) {
        if (!$this->rbac->hasPrivilege('financial_year', 'can_delete')) {
            access_denied();
        }
        $this->session->set_flashdata('list_msg', '<div class="alert alert-success text-left">Financial Year deleted successfully</div>');
        $this->session_model->remove_financial_year($id);
        redirect('financial_year/index');
    }





}

?>