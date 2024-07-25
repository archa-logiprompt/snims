<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Warddetail extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('warddetail', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/warddetail');
        $data['title'] = 'Add warddetail';
        //$data['title_list'] = 'Recent FeeGroups';
        // $deptname = $this->student_model->get_clinical_department();

        $deptname = $this->db->get('clinical_department')->result_array();
        $data['departmentlist'] = $deptname;

        $warddetail = $this->db->select('*,clinical_department.id as wardid,warddetail.id as detailid')->join('clinical_department','warddetail.deptnames=clinical_department.id')->get('warddetail')->result_array();
        $data['warddetaillist'] = $warddetail;

        $this->form_validation->set_rules('name_department','Wardname','required');
		
        if ($this->form_validation->run() == FALSE) {
             
        } else  {
            $data = array(
                 
				'aliasname'=>$this->input->post('aliasname'),
				'deptnames'=>$this->input->post('name_department'),
				'block'=>$this->input->post('block'),
				'noofbeds'=>$this->input->post('noofbeds'),
				'landmark'=>$this->input->post('landmark'),
				'wardcontact'=>$this->input->post('wardcontactdetails'),
                'incharge' => $this->input->post('incharge')
            );
           
            $this->student_model->add_warddetail($data);
			 
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Warddetail added successfully</div>');
			
            redirect('admin/Warddetail/index');
        }
		
      
        $this->load->view('layout/header', $data);
        $this->load->view('admin/clinical_rotation/warddetail/wardlist', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('warddetail', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'warddetail';
        $this->student_model->removeward($id);
        redirect('admin/Warddetail/index');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('warddetail', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/warddetail');
        $data['id'] = $id;
		$deptname = $this->db->get('clinical_department')->result_array();
        $data['departmentlist'] = $deptname;
        
        $warddetaillist = $this->db->select('*,clinical_department.id as wardid,warddetail.id as detailid')->join('clinical_department','warddetail.deptnames=clinical_department.id')->get('warddetail')->result_array();
        $data['warddetaillist'] = $warddetaillist;
      


        $warddetail = $this->db->select('*,clinical_department.id as wardid,warddetail.id as detailid')->join('clinical_department','warddetail.deptnames=clinical_department.id')->where('warddetail.id',$id)->get('warddetail')->row();
        
        $data['warddetail'] = $warddetail;

        // $warddetail= $this->student_model->edit($id);
        // $data['warddetail'] = $warddetail;
        /*$feegroup_result = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup_result;*/
        $this->form_validation->set_rules('name_department','Wardname','required');
		// $this->form_validation->set_rules('name_department','Name of department','required');
		//$this->form_validation->set_rules('aliasname','Aliasname','required');
		// $this->form_validation->set_rules('block','Block','required');
		// $this->form_validation->set_rules('noofbeds','Noofbeds','required');
		// $this->form_validation->set_rules('landmark','landmark','required');
	   	// $this->form_validation->set_rules('wardcontactdetails','wardcontactdetails','required');
	 	// $this->form_validation->set_rules('incharge','Incharge','required');
	 

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinical_rotation/warddetail/wardedit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' =>$this->input->post('id'),
                'wardname' => $this->input->post('wardname'),
				'aliasname'=>$this->input->post('aliasname'),
				'deptnames'=>$this->input->post('name_department'),
				
				'block'=>$this->input->post('block'),
				'noofbeds'=>$this->input->post('noofbeds'),
				'landmark'=>$this->input->post('landmark'),
				'wardcontact'=>$this->input->post('wardcontactdetails'),
                'incharge' => $this->input->post('incharge')
            );
            $this->student_model->add_warddetail($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Warddetail updated successfully</div>');
            redirect('admin/Warddetail/index');
        }
    }
	
	
	 function adddepartment() {
        if (!$this->rbac->hasPrivilege('warddetail', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/warddetail');
        $data['title'] = 'Add warddetail';
        //$data['title_list'] = 'Recent FeeGroups';
        //$this->form_validation->set_rules('department_name','Department_name','required');
		
		$this->form_validation->set_rules(
                'department_name', 'Department Name', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );
		
		
		       if ($this->form_validation->run() == FALSE) {
				   $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Error Code: 1062.[No Data/Duplicate Entry]</div>');
				   redirect('admin/Warddetail');
            
        } else {
            $data = array(
                'deptname' => $this->input->post('department_name'));
            $this->student_model->add_clinical_department($data);
           $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Department added successfully</div>');
          redirect('admin/Warddetail');
		   
		   //$array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            //echo json_encode($array);
			
		   
        }
      
       /* $this->load->view('layout/header', $data);
        $this->load->view('admin/clinical_rotation/warddetail/wardlist', $data);
        $this->load->view('layout/footer', $data);*/
    }
	
	 function editdepartment() {
        if (!$this->rbac->hasPrivilege('warddetail', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/warddetail');
        $data['title'] = 'Add warddetail';
        $department= $this->student_model->department_edit($id);
        $data['department'] = $department;
        $this->form_validation->set_rules(
                'department_name', 'Department Name', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );
		
		
		       if ($this->form_validation->run() == FALSE) {
				   $this->session->set_flashdata('msg', '<div class="alert alert-danger text-left">Error Code: 1062.[No Data/Duplicate Entry]</div>');
				   redirect('admin/Warddetail');
            $department= $this->student_model->department_edit($id);
        $data['department'] = $department;
        } else {
            $data = array(
			 	'id'=>$this->input->post('id'), 
                'deptname' => $this->input->post('department_name'));
            $this->student_model->add_clinical_department($data);
           $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Department added successfully</div>');
		   $editid=$this->input->post('id');
           redirect('admin/Warddetail/edit/'.$editid);
        }
      
      /* $this->load->view('layout/header', $data);
            $this->load->view('admin/clinical_rotation/warddetail/wardedit', $data);
            $this->load->view('layout/footer', $data);*/
    }

}

?>