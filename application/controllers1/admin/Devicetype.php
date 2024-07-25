<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Devicetype extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('file');
        //   $this->lang->load('message', 'english');
		$this->load->model('device_model');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('device_type', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'devicetype/index');
        $data['title'] = 'Add Type';
        $subject_result = $this->device_model->get();
        $data['devicelist'] = $subject_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/deviceList ', $data);
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
        if (!$this->rbac->hasPrivilege('device_type', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Device List';
        $this->device_model->remove($id);
        redirect('admin/devicetype/index');
    }

    function deleteassign($id) {
        if (!$this->rbac->hasPrivilege('assigned', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Assign List';
        $this->device_model->removeAssign($id);
        redirect('admin/devicetype/assigned');
    }
    

    function create() {
        if (!$this->rbac->hasPrivilege('device_type', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add type';
        $subject_result = $this->device_model->get();
        $data['devicelist'] = $subject_result;
       
		$this->form_validation->set_rules('devicetype', 'Device Type', 'trim|required|xss_clean');
       
		
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/deviceList ', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $admin=$this->session->userdata('admin');
       // $centre_id=$admin['centre_id'];
            $data = array(
                //'centre_id'	=>	$centre_id,
                'devicetype' => $this->input->post('devicetype'),
				
            );
            $this->device_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Type added successfully</div>');
            redirect('admin/devicetype/index');
        }
    }


    function assigned() {
        if (!$this->rbac->hasPrivilege('assigned', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'front_office');
        $this->session->set_userdata('sub_menu', 'devicetype/index');
        $data['title'] = 'Add Type';
        $assign_result = $this->device_model->getassign();
        $data['asignlist'] = $assign_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/assignedList', $data);
        $this->load->view('layout/footer', $data);
    }
    function addassign(){
        $this->form_validation->set_rules('name', 'Assign', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/assignedList ', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $admin=$this->session->userdata('admin');
            $data = array(
                'assigned' => $this->input->post('name'),
				
            );
            $this->device_model->addassign($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Assign added successfully</div>');
            redirect('admin/devicetype/assigned');
        }

    }

    
    function editassign($id) {
        if (!$this->rbac->hasPrivilege('assigned', 'can_edit')) {
            access_denied();
        }
        $assign_result = $this->device_model->getassign();
        $data['asignlist'] = $assign_result;
        $data['title'] = 'Edit Type';
        $data['id'] = $id;
        $subject = $this->device_model->getassign($id);
        $data['subject'] = $subject;
        $this->form_validation->set_rules('name', 'Assign', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/editassignList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'assigned' => $this->input->post('name'),
               
                 );
            $this->device_model->addassign($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">updated successfully</div>');
            redirect('admin/devicetype/assigned');
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
        if (!$this->rbac->hasPrivilege('device_type', 'can_edit')) {
            access_denied();
        }
        $subject_result = $this->device_model->get();
        $data['devicelist'] = $subject_result;
        $data['title'] = 'Edit Type';
        $data['id'] = $id;
        $subject = $this->device_model->get($id);
        $data['subject'] = $subject;
        $this->form_validation->set_rules('devicetype', 'devicetype', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/deviceEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'devicetype' => $this->input->post('devicetype'),
                //'code' => $this->input->post('code'),
				//'theory' =>$this->input->post('theory'),
			    //'practical'=>$this->input->post('practical')
                 );
            $this->device_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Type updated successfully</div>');
            redirect('admin/devicetype/index');
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