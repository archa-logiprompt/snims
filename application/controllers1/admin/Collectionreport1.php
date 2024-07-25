<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Collectionreport extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'transaction/collectionreport');
        $data['title'] = 'Search Expense';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'Transaction From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
               
                $feeList = $this->studentfeemaster_model->collection_report($date_from, $date_to);
               
                $data['feeList'] = $feeList;
				 
            }
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/collection_report', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/collection_report', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	
	
	
	
	function mess_collection_report() {
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/collection report');
        $data['title'] = 'Search Expense';
		$income_result = $this->incomehead_model->get_headlist();
        $data['incomehead'] = $income_result;
		
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'Transaction From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
               
               /* $feeList = $this->studentfeemaster_model->mess_collection_report($date_from, $date_to);
               
                $data['feeList'] = $feeList;*/
				$incomehead=$this->input->post('head_id');
				$data['head']=$incomehead;
				
				
				
				$feeList = $this->income_model->mess_collection_report($date_from, $date_to,$incomehead);
               
			     	  
			 /*  function sortFunction( $a, $b ) {
            return strtotime($a["date"]) - strtotime($b["date"]);
			
             }
			 
          usort($feeList, "sortFunction");*/
			   
			   
			   
                $data['feeList'] = $feeList;
				
				 
            }
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/mess_collection_report', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/mess_collection_report', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
	
?>