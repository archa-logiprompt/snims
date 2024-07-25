<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Virtualaccount extends Admin_Controller {

    

    function index() {
        if (!$this->rbac->hasPrivilege('virtual_account', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'virtual_account/index');
        $data['title'] = 'virtual_account';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('virtualaccount/virtualaccountSearch', $data);
        $this->load->view('layout/footer', $data);
    }
	
	
	function search() {
        if (!$this->rbac->hasPrivilege('virtual_account', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'virtual_account';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('virtualaccount/virtualaccountSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        
                    } else {
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
                    }
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('virtualaccount/virtualaccountSearch', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

 
}

?>