<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partchange extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        //   $this->lang->load('message', 'english');
		$this->load->model('device_model');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('parts_change', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'partchange/index');
        $data['title'] = 'Add Part';
        $subject_result = $this->device_model->getparts();
        $data['parlist'] = $subject_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/partlist', $data);
        $this->load->view('layout/footer', $data);
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('device_type', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Device Type';
        $subject = $this->device_model->get($id);
        $data['devicetype'] = $devicetype;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/deviceShow',$data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('parts_change', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Parts List';
        $this->device_model->removepart($id);
        redirect('admin/partchange/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('parts_change', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Parts';
        $subject_result = $this->device_model->getparts();
        $data['parlist'] = $subject_result;
		
       $this->form_validation->set_rules('part', 'partname', 'trim|required|xss_clean');
		
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/partlist', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $admin=$this->session->userdata('admin');
      
            $data = array(
              
                'partname' => $this->input->post('part'),
				
            );
            $this->device_model->addpart($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Part added successfully</div>');
            redirect('admin/partchange/index');
        }
    }



     

    function _check_name_exists() {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->subject_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', 'Name already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _check_code_exists() {
        $data['code'] = $this->security->xss_clean($this->input->post('code'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code_exists', 'Code already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }


      function _check_code1_exists() {
        $data['code1'] = $this->security->xss_clean($this->input->post('code1'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code1_exists', 'Code already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }




    function edit($id) {
        if (!$this->rbac->hasPrivilege('parts_change', 'can_edit')) {
            access_denied();
        }
        $subject_result = $this->device_model->getparts();
        $data['parlist'] = $subject_result;
        $data['title'] = 'Edit Parts';
        $data['id'] = $id;
        $subject = $this->device_model->getparts($id);
         $data['subject'] = $subject;
        $this->form_validation->set_rules('part', 'partname', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/partEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'partname' => $this->input->post('part'),
                
                 );
            $this->device_model->addpart($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Part updated successfully</div>');
            redirect('admin/partchange/index');
        }
    }

        function getSubjctByClassandSection() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $date = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($data);
    }

}

?>