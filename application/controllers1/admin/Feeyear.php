<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Feeyear extends Admin_Controller {

    function __construct() {
        parent::__construct();
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('fees_year', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Fees Collection');
		$this->session->set_userdata('sub_menu', 'feeyear/index');
		$data['title'] = 'Add Feeyear';
		
		$this->form_validation->set_rules('year','Year','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			
	   /* $this->load->view('layout/header',$data);
        $this->load->view('admin/feeyear/feeyear',$data);
        $this->load->view('layout/footer',$data);*/
			
		}
       
	   else
	   {

	   	$admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
		$year=$this->input->post('year');
		$data=array(
			'centre_id'=>$centre_id,
		'year'=>$year,
		
		);
		
		
		$this->feemaster_model->addfeeyear($data);
	    $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Type added successfully</div>');
        redirect('admin/feeyear/index');
		
	   }
	     $feeyear = $this->feemaster_model->getfeeyear();
         $data['feeyearlist'] = $feeyear;
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/feeyear/feeyear',$data);
        $this->load->view('layout/footer',$data);
		
		
		}
		
		
		
		
		

    function delete($id) {
        if (!$this->rbac->hasPrivilege('fees_year', 'can_delete')) {
            access_denied();
        }
        //$data['title'] = 'Fees Master List';
        $this->feemaster_model->removeyear($id);
        redirect('admin/feeyear/index');
    }



    function edit($id) {
        if (!$this->rbac->hasPrivilege('fees_year', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
		$this->session->set_userdata('sub_menu', 'feeyear/index');
        $data['id'] = $id;
        $feeyear = $this->feemaster_model->getfeeyear($id);
        $data['feeyear'] = $feeyear;
		
		$feeyearlist = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyearlist;
		
       
       $this->form_validation->set_rules('year', 'Year', 'required');
		
        if ($this->form_validation->run() == FALSE) {
           $this->load->view('layout/header',$data);
          $this->load->view('admin/feeyear/feeyear_edit',$data);
           $this->load->view('layout/footer',$data);
        } else {
            $year=$this->input->post('year');
		  $data=array(
		  'id'=>$id,
		  'year'=>$year,
            );
         	$this->feemaster_model->addfeeyear($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees year updated successfully</div>');
             redirect('admin/feeyear/index');
        }
    }

}

?>