<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messfee_type extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        if (!$this->rbac->hasPrivilege('mess_fee_type', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee type');
        $data['title'] = 'Add Feetype';
        $data['title_list'] = 'Recent FeeType';

        $this->form_validation->set_rules(
                'code', 'Code', array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists_mess_type'))
                )
        );
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
            $data = array(
               'type' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add_messfeetype($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Type added successfully</div>');
            redirect('admin/messfee_type/index');
        }
        $feegroup_result = $this->feetype_model->get_messtype();
        $data['feetypeList'] = $feegroup_result;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/messfeetype/messfeetypeList', $data);
        $this->load->view('layout/footer', $data);
    }




    function delete($id) {
        if (!$this->rbac->hasPrivilege('mess_fee_type', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->feetype_model->remove_messtype($id);
        redirect('admin/messfee_type/index');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('mess_fee_type', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee type');
        $data['id'] = $id;
        $feetype = $this->feetype_model->get_messtype($id);
        $data['feetype'] = $feetype;
        $feegroup_result = $this->feetype_model->get_messtype();
        $data['feetypeList'] = $feegroup_result;
        $this->form_validation->set_rules(
                'name', 'Name', array(
            'required',
            array('check_exists', array($this->feetype_model, 'check_exists_mess_type'))
                )
        );
        $this->form_validation->set_rules('name', 'Name', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/messfeetype/messfeetypeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'type' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'description' => $this->input->post('description'),
            );
            $this->feetype_model->add_messfeetype($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Type updated successfully</div>');
            redirect('admin/messfee_type/index');
        }
    }

}

?>