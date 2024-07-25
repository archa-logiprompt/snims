<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fees_report extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/feesreport');
		$data['category_list']=$this->studentfee_model->get_category_list();
		$class = $this->class_model->get();
        $data['classlist'] = $class;
		$data['fee_group']=$this->feegroup_model->get();

		
        $this->form_validation->set_rules('date_from', 'Date from', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date to', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('fee_category[]', 'Fee head', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('fee_group[]', 'Fee Group', 'trim|required|xss_clean');
		
		//$this->form_validation->set_rules('billno_feeheadwise', 'Detailed report', 'trim|required|xss_clean');
		$this->form_validation->set_rules('payment_mode', 'Payment mode', 'trim|required|xss_clean');
		
        
		 if ($this->form_validation->run() == FALSE) {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/fees_report/fee_report', $data);
        $this->load->view('layout/footer', $data);
        }
		
		else
		{
			
			$date_from= $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
			$date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
			
             
			  //$fee_category=explode('/',$this->input->post('fee_category'));
			  $fee_group=$this->input->post('fee_group');
			  $data['feegroup']=$fee_group;
			  $fee_category=$this->input->post('fee_category');
			  $data['feetype']= $fee_category;
			  $payment_mode=$this->input->post('payment_mode');
			  $data['from']=$date_from;
			  $data['to']=$date_to;	
			  $data['payment_mode']=$payment_mode;
			  /*$billno_feeheadwise=$this->input->post('rad_report');
			  $data['billno_feeheadwise']=$billno_feeheadwise;*/
			  /*$feeheadsummary=$this->input->post('rad_report');
			  $data['feehead_summary']=$feeheadsummary;*/
			  
			  $report_type=$this->input->post('rad_report');
			  $data['report_type']= $report_type;
			 
			  if($report_type=='feehead_summary')
				 {
					//$this->feeHeadSummary($date_from,$date_to); 
		$data['list']['headwise']=$this->studentfee_model->get_headwisesummary($date_from,$date_to,$fee_group,$fee_category, $payment_mode);
		$feeexcess=$this->studentfeemaster_model->get_feeexcessReport($date_from, $date_to,$payment_mode);
		 $fe_amount=0;
		 if(!empty($feeexcess))
		 {
			 $ar=array();
			
			 foreach($feeexcess as $key=>$ex)
			 {
				
				foreach($ex->collection_record as $a)
				{
				 $fe_amount=$fe_amount+$a['amount'];	
					}
				  }
			 
			 }
			 $data['feeexcess']=$fe_amount;
		 
		
		$data['otherpayment']=$this->studentfee_model->get_headwise_otherpay($date_from,$date_to,$payment_mode);
		$data['header']='FeeHeadWise Summary';
					 
					  }
				
			
			 else if($report_type=='billno_feeheadwise')
			   {
				
				
		$feeList = $this->studentfeemaster_model->fee_transaction($date_from, $date_to,$payment_mode, $fee_group, $fee_category);
		
		
				$list_array=array();
				$student_id=array();
				foreach($feeList as $key=>$list)
				{
				
				 $a= new stdClass();
				 $a->admission_no=$list->admission_no;	
				$a->collection_record=$this->studentfeemaster_model->get_collection_record($list->student_fees_master_id,$date_from,$date_to,$payment_mode,$fee_group, $fee_category); 
				if($fee_category=='')
				{
				$a->feeadvance=$this->studentfeemaster_model->feeadvance_report($date_from,$date_to,$payment_mode,$list->student_id);
				
				$a->feeexcess=$this->studentfeemaster_model->feeexcess_report($date_from,$date_to,$payment_mode,$list->student_id);
				
				}
				$student_id[]=$list->student_id;	
				$list_array[]=$a;
					
				}
				
		
      $feesexcess=$this->studentfeemaster_model->get_feeexcessReport($date_from, $date_to,$payment_mode,$student_id);
	  
	 
					
			foreach($feesexcess as $key=>$val)
			{
			 $x=new stdClass();
			 $x->admission_no=$val->admission_no;	
			 $x->collection_record=$val->collection_record;
				$list_array[]=$x;
				}
			   
				
				
				
				$data['list']['feeList']=$list_array;
				$data['header']='BillNumber and FeeHeadwise Details';
				
				 $other_payment=$this->income_model->get_other_pyment($date_from, $date_to);
			
			     $data['otherpay']=$other_payment;
				/*else
				{
				
	  $feeList = $this->studentfee_model->fee_category_report($date_from, $date_to,  $fee_category);
	  $data['feeList']=$feeList;
				}*/
				 
				}
				
				else if($report_type=='fee_received_excess')
				{
				
	$feeexcess=$this->studentfeemaster_model->get_feeexcessReport($date_from, $date_to,$payment_mode);
				
				$data['list']['feeList']=$feeexcess;
				$data['header']='Fee Recieved In Excess';
					
					}
					
				
		$this->load->view('layout/header', $data);
        $this->load->view('admin/fees_report/fee_report', $data);
        $this->load->view('layout/footer', $data);
			
			}
	        }

     function mess_fee_report() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Reports/feesreport');
		$data['category_list']=$this->studentfee_model->get_category_list();
		$class = $this->class_model->get();
        $data['classlist'] = $class;

		
        $this->form_validation->set_rules('date_from', 'Date from', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date to', 'trim|required|xss_clean');
		$this->form_validation->set_rules('fee_category', 'Fee category', 'trim|required|xss_clean');
		$this->form_validation->set_rules('billno_feeheadwise', 'Detailed report', 'trim|required|xss_clean');
		$this->form_validation->set_rules('payment_mode', 'Payment mode', 'trim|required|xss_clean');
		
        
		 if ($this->form_validation->run() == FALSE) {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/fees_report/mess_report', $data);
        $this->load->view('layout/footer', $data);
        }
		
		else
		{
			
			$date_from= $date_from = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_from')));
			$date_to = date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_to')));
			
             
			  //$fee_category=explode('/',$this->input->post('fee_category'));
			  $fee_category=$this->input->post('fee_category');
			  $data['feetype']= $fee_category;
			  /*$type=$fee_category[1];
			  $data['type']= $type;*/
			  $payment_mode=$this->input->post('payment_mode');
			  $data['billno_feeheadwise']=$this->input->post('billno_feeheadwise');
			  
			  $data['from']=$date_from;
			  $data['to']=$date_to;	
			  $data['payment_mode']=$payment_mode;	
				
			
			if($this->input->post('billno_feeheadwise')=='billno_feeheadwise')
			{
				if($fee_category=='all')
				{
				$feeList = $this->studentfeemaster_model->messfee_transaction($date_from, $date_to,$payment_mode);
				
				
				$list_array=array();
				
				foreach($feeList as $key=>$list)
				{
				 $a= new stdClass();
				 $a->admission_no=$list->admission_no;	
				$a->collection_record=$this->studentfeemaster_model->get_Messcollection_record($list->student_fees_master_id,$date_from,$date_to,$payment_mode); 	
				$list_array[]=$a;
					
				}
				$data['feeList']=$list_array;
				}
				else
				{
				
			 	$feeList = $this->studentfee_model->fee_category_report($date_from, $date_to,  $fee_category);
				}
				 
				
				}
				
				
				$other_payment=$this->income_model->get_other_pyment($date_from, $date_to);
			
			 
			$data['otherpay']=$other_payment;
			
			
			
			
		$this->load->view('layout/header', $data);
        $this->load->view('admin/fees_report/mess_report', $data);
        $this->load->view('layout/footer', $data);
			
			
			
			}
	        }

  

   

    function feeHeadSummary($date_from,$date_to)
	{
		
		
	   /*$headwise=$this->studentfee_model->get_headwisesummary($date_from,$date_to);	
	   $data['headwise']=$headwise;	
		*/
		
			
		/*$this->load->view('layout/header', $data);
        $this->load->view('admin/fees_report/headwise_summary',$data);
        $this->load->view('layout/footer', $data);*/
		
		
		}
   


    

}

?>