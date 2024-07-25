<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FeeGroup extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feegroup');
        $data['title'] = 'Add FeeGroup';
        $data['title_list'] = 'Recent FeeGroups';
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;

        $this->form_validation->set_rules('year','Year','required');
        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists'))
                )
        );
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $admin=$this->session->userdata('admin');
           $centre_id=$admin['centre_id'];
            $data = array(
                'centre_id'=>$centre_id,
                'name' => $this->input->post('name'),
				'year'=>$this->input->post('year'),
				'class_id'=>$this->input->post('class_id'),
				'section_id'=>$this->input->post('section_id'),
                'description' => $this->input->post('description'),
            );
            $this->feegroup_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Group added successfully</div>');
            redirect('admin/feegroup/index');
        }
        $feegroup_result = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup_result;
		 $class = $this->class_model->get();
		$data['classlist'] = $class;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/feegroup/feegroupList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->feegroup_model->remove($id);
        redirect('admin/feegroup/index');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('fees_group', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'admin/feegroup');
        $data['id'] = $id;
		$feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
		 $class = $this->class_model->get();
		$data['classlist'] = $class;
		
        $feegroup = $this->feegroup_model->get($id);
        $data['feegroup'] = $feegroup;
        $feegroup_result = $this->feegroup_model->get();
        $data['feegroupList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/feegroup/feegroupEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                 'id' => $id,
                 'name' => $this->input->post('name'),
				 'year'=>$this->input->post('year'),
				 'class_id'=>$this->input->post('class_id'),
				'section_id'=>$this->input->post('section_id'),
                 'description' => $this->input->post('description'),
            );
            $this->feegroup_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Group updated successfully</div>');
            redirect('admin/feegroup/index');
        }
    }

}

?>