<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fee_transaction extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'transaction/fee_transaction');
        $data['title'] = 'Search Expense';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'Transaction From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                
                $feeList = $this->studentfeemaster_model->fee_transaction($date_from, $date_to);
				
				$list_array=array();
				
				foreach($feeList as $key=>$list)
				{
				 $a= new stdClass();
				 $a->admission_no=$list->admission_no;	
				$a->collection_record=$this->studentfeemaster_model->get_collection_record($list->student_fees_master_id,$date_from,$date_to); 	
				$list_array[]=$a;
					
				}
				
				$data['feeList'] = $list_array;
				
				 
				
				 
				 
            }
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/fee_transaction', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/fee_transaction', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	
	
   
   function fees_category_report()
   {
	   
	   
	   $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'fees_category_report');
      
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'Transaction From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
              
			  $data['feetype']=$this->input->post('fee_category');
			  $fee_category=$this->input->post('fee_category');
			  
			  
                $feeList = $this->studentfee_model->fee_category_report($date_from, $date_to, $fee_category);
              
			  $data['feeList']=$feeList;	 
			
			
			
			
			
			
			
				 
            }
            
        } 
		
		
		  $data['category_list']=$this->studentfee_model->get_category_list();
		
		
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/fee_category_report', $data);
            $this->load->view('layout/footer', $data);
       
	   
	   
   }
   
   
   
   
   function messFeeTransaction() {
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/fee transaction');
        $data['title'] = 'Search Expense';
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $search = $this->input->post('search');
            if ($search == "search_filter") {
                $data['exp_title'] = 'Transaction From ' . $this->input->post('date_from') . " To " . $this->input->post('date_to');
                $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
                $date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
                
                $feeList = $this->studentfeemaster_model->messfee_transaction($date_from, $date_to);
				
				$list_array=array();
				
				foreach($feeList as $key=>$list)
				{
				 $a= new stdClass();
				 $a->admission_no=$list->admission_no;	
				$a->collection_record=$this->studentfeemaster_model->get_Messcollection_record($list->student_messfees_master_id,$date_from,$date_to); 	
				$list_array[]=$a;
					
				}
				
				$data['feeList'] = $list_array;
				
				 
				
				 
				 
            }
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/mess_fee_transaction', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->load->view('layout/header',$data);
            $this->load->view('admin/transaction/mess_fee_transaction', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	
	



	


}
	
?>