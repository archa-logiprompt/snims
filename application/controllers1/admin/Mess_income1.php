<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mess_income extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('income', 'can_view')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/income');
        $data['title'] = 'Add Income';
        $data['title_list'] = 'Recent Incomes';
        
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		 //$this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
       
        if ($this->form_validation->run() == FALSE) {
            
        } else {
           
		
		$invoice=$this->studentfeemaster_model->mess_invo();
            $data = array(
               
               'person_name'=>$this->input->post('personname'),
                'name' => $this->input->post('name'),
                'date' => date('Y-m-d'),
                'amount' => $this->input->post('amount'),
                'invoice_no' =>$invoice,
				'is_system'=>1,
				'payment_mode'=>$this->input->post('payment_mode_fee'),
				'description'=>$this->input->post('ad_note'), 
                'note' => $this->input->post('description'),
              
            );
           
                $this->income_model->add_mess_income( $data);
          
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Income added successfully</div>');
            redirect('admin/mess_income/index');
        }

        $income_result = $this->income_model->get_mess();
        $data['incomelist'] = $income_result;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/income/mess_incomeList', $data);
        $this->load->view('layout/footer', $data);
    }




    public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/school_income/" . $this->uri->segment(6);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('income', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $income = $this->income_model->get($id);
        $data['income'] = $income;
        $this->load->view('layout/header', $data);
        $this->load->view('income/incomeShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function getByFeecategory() {
        $feecategory_id = $this->input->get('feecategory_id');
        $data = $this->feetype_model->getTypeByFeecategory($feecategory_id);
        echo json_encode($data);
    }

    function getStudentCategoryFee() {
        $type = $this->input->post('type');
        $class_id = $this->input->post('class_id');
        $data = $this->income_model->getTypeByFeecategory($type, $class_id);
        if (empty($data)) {
            $status = 'fail';
        } else {
            $status = 'success';
        }
        $array = array('status' => $status, 'data' => $data);
        echo json_encode($array);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('income', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->income_model->remove_mess_income($id);
        redirect('admin/mess_income/index');
    }

    function create() {
        $data['title'] = 'Add Fees Master';
        $this->form_validation->set_rules('income', 'Fees Master', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('income/incomeCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'income' => $this->input->post('income'),
            );
            $this->income_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">income added successfully</div>');
            redirect('income/index');
        }
    }

    function handle_upload() {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if ($_FILES["file"]["type"] != 'image/gif' &&
                    $_FILES["file"]["type"] != 'image/jpeg' &&
                    $_FILES["file"]["type"] != 'image/png') {

                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {

                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 10240000) {

                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            return true;
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('income', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Fees Master';
        $data['id'] = $id;
        $income = $this->income_model->get_mess($id);
        $data['income'] = $income;
        $data['title_list'] = 'Fees Master List';
        $income_result = $this->income_model->get_mess();
        $data['incomelist'] = $income_result;
       
       
        $this->form_validation->set_rules('amount', 'Amount', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/income/mess_incomeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
				'person_name'=>$this->input->post('personname'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount' => $this->input->post('amount'),
				'is_system'=>1,
				'payment_mode'=>$this->input->post('payment_mode_fee'),
				'description'=>$this->input->post('ad_note'),  
                'note' => $this->input->post('description')
            );
            $insert_id = $this->income_model->add_mess_income($data);
           
            

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Income updated successfully</div>');
            redirect('admin/mess_income/index');
        }
    }

    function incomeSearch() {
        if (!$this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Income');
        $this->session->set_userdata('sub_menu', 'income/incomesearch');
        $data['title'] = 'Search Income';
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['inc_title'] = 'Collection Report From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                $resultList = $this->income_model->search("", $date_from, $date_to);
                $data['resultList'] = $resultList;
            } else {
                $data['inc_title'] = 'Income Result';
                $this->form_validation->set_rules('search_text', 'Search Text', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    
                } else {

                    $search_text = $this->input->post('search_text');
                    $resultList = $this->income_model->search($search_text, "", "");
                    $data['resultList'] = $resultList;
                }
            }

            $this->load->view('layout/header', $data);
            $this->load->view('admin/income/incomeSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/income/incomeSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }

}

?>