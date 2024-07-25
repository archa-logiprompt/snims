<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messfeegroup extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('mess_fee_group', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee group');
        $data['title'] = 'Add FeeGroup';
        $data['title_list'] = 'Recent FeeGroups';
       

        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists_group'))
                )
        );
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
            $data = array(
                'name' => $this->input->post('name'),
				'class_id'=>$this->input->post('class_id'),
				'section_id'=>$this->input->post('section_id'),
                'description' => $this->input->post('description'),
            );
            $this->feegroup_model->add_messfeegroup($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Group added successfully</div>');
            redirect('admin/messfeegroup/index');
        }
        $feegroup_result = $this->feegroup_model->get_feegroup();
        $data['feegroupList'] = $feegroup_result;
		$class = $this->class_model->get();
		$data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/messfeegroup/messfeegroupList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('mess_fee_group', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->feegroup_model->remove_messgroup($id);
         redirect('admin/messfeegroup/index');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('mess_fee_group', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee group');
        $data['id'] = $id;
		
		$class = $this->class_model->get();
		$data['classlist'] = $class;
		
        $feegroup = $this->feegroup_model->get_feegroup($id);
        $data['feegroup'] = $feegroup;
        $feegroup_result = $this->feegroup_model->get_feegroup();
        $data['feegroupList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feegroup_model, 'check_exists_group'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/messfeegroup/messfeegroupEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                 'id' => $id,
                 'name' => $this->input->post('name'),
				 'class_id'=>$this->input->post('class_id'),
				 'section_id'=>$this->input->post('section_id'),
                 'description' => $this->input->post('description'),
            );
            $this->feegroup_model->add_messfeegroup($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Group updated successfully</div>');
             redirect('admin/messfeegroup/index');
        }
    }

}

?>