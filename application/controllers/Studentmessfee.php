<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentmessfee extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
		
    }

    function index() {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/collect fee');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentmessfeeSearch', $data);
        $this->load->view('layout/footer', $data);
    }

    function pdf() {
        $this->load->helper('pdf_helper');
    }

    function search() {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentmessfeeSearch', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $search = $this->input->post('search');
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                     $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                        
                    } else {
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
                    }
                } else if ($search == 'search_full') {
                    $resultlist = $this->student_model->searchFullText($search_text);
                    $data['resultlist'] = $resultlist;
                }
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentmessfeeSearch', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function feesearch() {
        if (!$this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/search due fee');
        $data['title'] = 'student fees';
        /*$class = $this->class_model->get();
        $data['classlist'] = $class;*/
		
        $feesessiongroup = $this->feesessiongroup_model->getMessFeesByGroup();
        $data['feesessiongrouplist'] = $feesessiongroup;
		
        $this->form_validation->set_rules('feegroup_id', 'Fee Group', 'trim|required|xss_clean');

        /*$this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');*/
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchMessFee', $data);
            $this->load->view('layout/footer', $data);
        } else {
		
            $feegroup_id = $this->input->post('feegroup_id');
            $feegroup = explode("-", $feegroup_id);
            $feegroup_id = $feegroup[0];
            $messfeemasters_id = $feegroup[1];
            /*$class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');*/
			 $data['student_due_fee'] = array();
         $student_due_fee = $this->studentfee_model->getDueStudentMessFees($feegroup_id,$messfeemasters_id);
		 
			
            if (!empty($student_due_fee)) {
                foreach ($student_due_fee as $student_due_fee_key => $student_due_fee_value) {
                    $amt_due = $student_due_fee_value['amount'];
                    $student_due_fee[$student_due_fee_key]['amount_discount'] = 0;
                    $student_due_fee[$student_due_fee_key]['amount_fine'] = 0;
                    $a = json_decode($student_due_fee_value['amount_detail']);
                    if (!empty($a)) {
                        $amount = 0;
                        $amount_discount = 0;
                        $amount_fine = 0;

                        foreach ($a as $a_key => $a_value) {
                            $amount = $amount + $a_value->amount;
                            $amount_discount = $amount_discount + $a_value->amount_discount;
                            $amount_fine = $amount_fine + $a_value->amount_fine;
                        }
                        if ($amt_due <= $amount) {
                            unset($student_due_fee[$student_due_fee_key]);
                        } else {

                            $student_due_fee[$student_due_fee_key]['amount_detail'] = $amount;
                            $student_due_fee[$student_due_fee_key]['amount_discount'] = $amount_discount;
                            $student_due_fee[$student_due_fee_key]['amount_fine'] = $amount_fine;
                        }
                    }
                }
            }


            $data['student_due_fee'] = $student_due_fee;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchMessFee', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function reportbyname() {
        if (!$this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/fee statement');
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/messfee_reportByName', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', 'Student', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/messfee_reportByName', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data['student_due_fee'] = array();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                $student = $this->student_model->get($student_id);
                $data['student'] = $student;
                $student_due_fee = $this->studentfeemaster_model->getStudentMessFees($student['id']);
                $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee'] = $student_due_fee;
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $category = $this->category_model->get();
                $data['categorylist'] = $category;
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/messfee_reportByName', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }
	
	
	
	
	

    function reportbyclass() {
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_fees_array = array();
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_result = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['student_due_fee'] = array();
            if (!empty($student_result)) {
                foreach ($student_result as $key => $student) {
                    $student_array = array();
                    $student_array['student_detail'] = $student;
                    $student_session_id = $student['student_session_id'];
                    $student_id = $student['id'];
                    $student_due_fee = $this->studentfee_model->getDueFeeBystudentSection($class_id, $section_id, $student_session_id);
                    $student_array['fee_detail'] = $student_due_fee;
                    $student_fees_array[$student['id']] = $student_array;
                }
            }
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $data['student_fees_array'] = $student_fees_array;
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByClass', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'studentfee List';
        $studentfee = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteFee() {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_delete')) {
            access_denied();
        }
        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice = $this->input->post('sub_invoice');
		$type=$this->input->post('type');
		
		
        if (!empty($invoice_id)) {
            $this->studentfee_model->revertmessfee($invoice_id, $sub_invoice,$type );
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }
	
	
	function revert_messadvance() {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_delete')) {
            access_denied();
        }
        $deposit_id = $this->input->post('deposit_id');
        $mess_amount = $this->input->post('mess_amount');
		$arraykey=$this->input->post('arraykey');
		
		
        if (!empty($deposit_id)) {
            $this->studentfee_model->revert_messadvance($deposit_id, $arraykey,$mess_amount );
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }
	
	
	
	
	
	
	
	function refund_fee()
	{
	
	
	  $refund_amount =$this->input->post('refund_amount');
	  $student_messfees_master_id =$this->input->post('student_messfees_master_id');
	  $messfeemasters_id =$this->input->post('messfeemasters_id');
	  $date =$this->input->post('date');
	  $payment_mode=$this->input->post('payment_mode');
	  $amount=array(
	  'date'=>$date,
	  'amount'=>$refund_amount,
	  'payment_mode'=>$payment_mode
	  );
	  
	  $data=array(
	  'student_messfees_master_id'=>$student_messfees_master_id,
	  'messfeemasters_id'=> $messfeemasters_id,
	  //'amount_detail'=>array(),
	  'refund_detail'=>json_encode($amount)
	  
	  );
	  	
	  	$this->studentfee_model->refund_Messfee($data);
		
		 $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
		
	}
	
	
	
	
	
	
	

    function deleteStudentDiscount() {

        $discount_id = $this->input->post('discount_id');
        if (!empty($discount_id)) {
            $data = array('id' => $discount_id, 'status' => 'assigned', 'payment_id' => "");
            $this->feediscount_model->updateStudentDiscount($data);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function addfee($id) {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $data['student'] = $student;
		$data['student_id']=$id;
		$billdetail=$this->studentfeemaster_model->get_Messbilldetail($id);
        //$fees_excess=$this->studentfeemaster_model->get_fee_excess($id);
		//$fees_advance_bill=$this->studentfeemaster_model->fee_advance_bill($id); 
        $student_due_fee = $this->studentfeemaster_model->getStudentMessFees($student['id']);
		/*$fee_excess=$this->studentfeemaster_model->getFeeexcess($id);
		$data['fee_excess']=$fee_excess;*/
		$fee_advance=$this->studentfeemaster_model->getMessFeeadvance($id);
		$data['fee_advance']=$fee_advance;
		
        $data['student_due_fee'] = $student_due_fee;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $class_section = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"] = $class_section;
        $session = $this->setting_model->getCurrentSession();
        
        $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"],$session);
		
		if(!empty($billdetail)){
		 foreach($billdetail as $key=>$val)
		  {
			$arr[$key]=$val;
			  }}
		/*if(!empty($fees_excess)){	  
		foreach($fees_excess as $key=>$res)
	     {
		   $arr[$key]=$res;
				  
			}}*/
			/*if(!empty($fees_advance_bill)){	  
		 foreach($fees_advance_bill as $key=>$ar)
		 {
			$arr[$key]=$ar; 
			 }}*/
			   
		 $data['billdetail']=$arr;
		 
		$data["studentlistbysection"] = $studentlistbysection;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentAddMessfee', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteTransportFee() {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function delete($id) {
        $data['title'] = 'studentfee List';
        $this->studentfee_model->remove($id);
        redirect('studentfee/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Add studentfee';
        $this->form_validation->set_rules('category', 'Category', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">Employee added to successfully</div>');
            redirect('studentfee/index');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit studentfees';
        $data['id'] = $id;
        $studentfee = $this->studentfee_model->get($id);
        $data['studentfee'] = $studentfee;
        $this->form_validation->set_rules('category', 'category', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'category' => $this->input->post('category'),
            );
            $this->studentfee_model->add($data);
            $this->session->set_flashdata('msg', '<div studentfee="alert alert-success text-center">Employee updated successfully</div>');
            redirect('studentfee/index');
        }
    }

    function addstudentfee() {
		

        $this->form_validation->set_rules('student_messfees_master_id', 'Fee Master', 'required|trim|xss_clean');
      
       /* $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean|callback_check_deposit');*/
        
        $this->form_validation->set_rules('amount_fine', 'Fine', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $data = array(
                'amount' => form_error('amount'),
                'student_messfees_master_id' => form_error('student_messfees_master_id'),
               
               
                'amount_fine' => form_error('amount_fine'),
                'payment_mode' => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
			//$invoice=$this->input->post('ad_invo');
		    $stud_name=$this->input->post('stud_name');
			$type=$this->input->post('type');
            $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
           /* 
			
			$group=$this->input->post('group');*/
			$invoice=$this->studentfeemaster_model->mess_invo();
			$admin=$this->session->userdata('admin');
			
            $json_array = array(
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_fine' => $this->input->post('amount_fine'),
                'description' => $this->input->post('description') . $collected_by,
                'payment_mode' => $this->input->post('payment_mode')
				
            );
            $data = array(
			  
                'student_messfees_master_id' => $this->input->post('student_messfees_master_id'),
            
                'amount_detail' => $json_array,
				
				'created_at' => date('Y-m-d')
            );
			
			
            $send_to = $this->input->post('guardian_phone');
            $email = $this->input->post('guardian_email');
			
            $inserted_id = $this->studentfeemaster_model->messFee_deposit($data, $send_to,$invoice);
			$id=json_decode($inserted_id);
			
			
			
			$mess_income=array(
			'person_name'=>$stud_name,
			'name'=>$type,
			'invoice_no'=>$invoice,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
			'amount'=>$this->input->post('amount'),
			'deposit_id'=>$id->invoice_id,
			'payment_mode'=>$this->input->post('payment_mode'),
			'description'=>$this->input->post('description')
			
			);
			
			
			 $this->income_model->add_mess_income($mess_income);
			
			
			
           /* $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
            $this->mailsmsconf->mailsms('fee_submission', $sender_details);*/

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }

 function addstudentfee2() {

        $this->form_validation->set_rules('student_messfees_master_id[]', ' Fees Type', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');
		
        if ($this->form_validation->run() == false) {
            $data = array(
                'amount2' => form_error('amount'),
                
                'tfeetype' => form_error('student_messfees_master_id[]'),
               
                'payment_mode' => form_error('payment_mode'),
			
            );
            $array = array('status' => 'fail', 'error' => $data);
            
			echo json_encode($array);
			
        } 
		
		
		else {
			
			$admin=$this->session->userdata('admin');
			$amount=$this->input->post('amount');
			$bamount=$this->input->post('balance');
			$cal_amount=$this->input->post('cal_amount');
			$student_messfees_master_id=$this->input->post('student_messfees_master_id');
			$c=count($student_messfees_master_id);
			
			//$dis_fee_type_id = $this->input->post('dis_fee_type_id');
			//$amount_discount=$this->input->post('amount_discount');
			//$invoice=$this->input->post('invo');
			$invoice=$this->studentfeemaster_model->mess_invo();
		    //$fixed_fine=$this->input->post('amount_fine');
			$stud_name=$this->input->post('stud_name');
		    $t_amount=$amount;
		    
         for($i=0;$i<$c;$i++)
	       {
			
				
				$json_array = array(
                'amount' => $bamount[$i],
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_discount' =>0,
                'amount_fine' => 0,
                'description' => $this->input->post('description') . $collected_by,
                'payment_mode' => $this->input->post('payment_mode')
            );
				
			
			
            $data = array(
			   
                'student_messfees_master_id' =>$student_messfees_master_id[$i],
                'amount_detail' => $json_array,
				'created_at' => date('Y-m-d') 
            );

            $send_to = $this->input->post('guardian_phone');
            $email = $this->input->post('guardian_email');
            $inserted_id = $this->studentfeemaster_model->total_Messfee_deposit($data, $send_to,$invoice);
             $id=json_decode($inserted_id);
			 
			 $mess_income=array(
			'person_name'=>$stud_name,
			'name'=>'Mess Fee',
			'invoice_no'=>$invoice,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
			'amount'=>$bamount[$i],
			'deposit_id'=>$id->invoice_id,
			'payment_mode'=>$this->input->post('payment_mode'),
			'description'=>$this->input->post('description')
			
			);
			
			 $this->income_model->add_mess_income($mess_income);
			
			 
			 
			 
			 
			 
			 
			
            $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
            $this->mailsmsconf->mailsms('fee_submission', $sender_details);
 } 
 
 
	  $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
	 
}  
	   
 }



    function printFeesByName() {
        $data = array('payment' => "0");

        $record = $this->input->post('data');
        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice_id = $this->input->post('sub_invoice');
        $student_session_id = $this->input->post('student_session_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $student = $this->studentsession_model->searchStudentsBySession($student_session_id);

        $fee_record = $this->studentfeemaster_model->printFeeByInvoice($invoice_id, $sub_invoice_id);
        $data['student'] = $student;
        $data['sub_invoice_id'] = $sub_invoice_id;
        $data['feeList'] = $fee_record;
        $this->load->view('print/printFeesByName', $data);
    }
	
	
	function printBillwise() {
     

       
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['billno']=$this->input->post('billno');
		 $data['billamount']=$this->input->post('billamount');
		  $data['billdate']=$this->input->post('billdate');
		   $data['studname']=$this->input->post('studname');
		  $data['type']=$this->input->post('type');
		  $data['mode']=$this->input->post('mode');
		  $data['admin_no']=$this->input->post('admin_no');
		  $data['course']=$this->input->post('course');

        $this->load->view('print/printBillwise', $data);
    }
	
	
	
	
	
	

    function printFeesByGroup() {
        $messfeemasters_id = $this->input->post('messfeemasters_id');
        $fee_master_id = $this->input->post('fee_master_id');
        $mess_fee_session_id = $this->input->post('mess_fee_session_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['feeList'] = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($mess_fee_session_id, $fee_master_id, $messfeemasters_id);

        $this->load->view('print/printFeesByGroup', $data);
    }




    function printFeesByGroupArray() {
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $record = $this->input->post('data');
        $record_array = json_decode($record);
        $fees_array = array();
		
	     
		
		 //$student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
		
       /* $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
		
		$data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $class_section = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"] = $class_section;
        $session = $this->setting_model->getCurrentSession();
        
        $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"],$session);*/
		
		
		
		
        foreach ($record_array as $key => $value) {
            $fee_groups_feetype_id = $value->fee_groups_feetype_id;
            $fee_master_id = $value->fee_master_id;
            $fee_session_group_id = $value->fee_session_group_id;
			
            $feeList = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);
            $fees_array[] = $feeList;
			
				
        }
       
        $data['feearray'] = $fees_array;
		
        $this->load->view('print/printFeesByGroupArray', $data);
    }
	

    function searchpayment() {
        if (!$this->rbac->hasPrivilege('search_fees_payment', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/search');
        $data['title'] = 'Edit studentfees';


        $this->form_validation->set_rules('paymentid', 'Payment ID', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            $paymentid = $this->input->post('paymentid');
            $invoice = explode("/", $paymentid);

            if (array_key_exists(0, $invoice) && array_key_exists(1, $invoice)) {
                $invoice_id = $invoice[0];
                $sub_invoice_id = $invoice[1];
				
				
                $feeList = $this->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
                $data['feeList'] = $feeList;
                $data['sub_invoice_id'] = $paymentid;
            } else {
                $data['feeList'] = array();
            }
        }
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/searchMesspayment', $data);
        $this->load->view('layout/footer', $data);
    }



	
	 function addmessfeegroup() {
        /*$this->form_validation->set_rules('mess_fee_session_id', 'Fee Group', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'mess_fee_session_id' => form_error('mess_fee_session_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        }*/
		
		 //else {
            $student_session_id = $this->input->post('student_session_id');
            //$mess_fee_session_id = $this->input->post('mess_fee_session_id');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids = $this->input->post('student_ids');
            $delete_student = array_diff($student_ids, $student_sesssion_array);
			$month=$this->input->post('date');
			$due_date=$this->input->post('due_date');
                
            $preserve_record = array();
			
            if (!empty($student_sesssion_array)) {
				
                foreach ($student_sesssion_array as $key => $value) {

                    $insert_array = array(
					    
                        'student_session_id' => $value,
                        'amount' => $this->input->post('amount_'.$value),
						'student_id'=>$this->input->post('student_id_'.$value),
						'month'=>$month,
						'type'=>'Mess Fee',
						'due_date'=>date('Y-m-d', $this->customlib->datetostrtotime($due_date))
                    );
                    $inserted_id = $this->studentfeemaster_model->addmess($insert_array);

                    $preserve_record[] = $inserted_id;
                }
            }
			
			 if (!empty($delete_student)) {
				
                $this->studentfeemaster_model->deletemessmaster($month, $delete_student);
            }
            
            
            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            echo json_encode($array);
        //}
    }
	
	

    function geBalanceFee() {
        
        $this->form_validation->set_rules('student_messfees_master_id', 'student_messfees_master_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_session_id', 'student_session_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
               
                'student_messfees_master_id' => form_error('student_messfees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data = array();
			$fine=$this->input->post('fine');
            $student_session_id = $this->input->post('student_session_id');
            $student_messfees_master_id = $this->input->post('student_messfees_master_id');
            $remain_amount = $this->getStuFeetypeBalance($student_messfees_master_id);
            //$discount_not_applied = $this->getNotAppliedDiscount($student_session_id);
            $remain_amount = json_decode($remain_amount)->balance;
            $array = array('status' => 'success', 'error' => '', 'balance' =>$remain_amount);
            echo json_encode($array);
        }
    }




 function getBalanceFee2() {
       
        $this->form_validation->set_rules('student_session_id', 'student_session_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                //'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                //'student_fees_master_id' => form_error('student_fees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data = array();
			
            $student_session_id = $this->input->post('student_session_id');
            $student_messfees_master_id = $this->input->post('student_messfees_master_id');
			$student_id=$this->input->post('student_id');
			
			
			
			$c=count($student_messfees_master_id);
			
			$ar=array();
			
			for($i=0;$i<$c;$i++)
			{
				
			$remain_amount = $this->getStuFeetypeBalance($student_messfees_master_id[$i]);
			
			
			   $remain_amount = json_decode($remain_amount)->balance;
			$ar[]=$remain_amount;
			
			}
			
            //$discount_not_applied = $this->getNotAppliedDiscount($student_session_id);
            //$remain_amount = json_decode($remain_amount)->balance;
			
			$t_fee_type=$this->getNotAppliedfeetype($student_id);
			
       $array = array('status' => 'success', 'error' => '','balance' =>$ar,'t_fee_type'=>$t_fee_type);
            echo json_encode($array);
        }
    }







    function getStuFeetypeBalance( $student_messfees_master_id) {
        $data = array();
       
        $data['student_messfees_master_id'] = $student_messfees_master_id;

		
        $result = $this->studentfeemaster_model->studentMessDeposit($data);
		
		
        $amount_balance = 0;
        $amount = 0;
        $amount_fine = 0;
        $amount_discount = 0;
        $due_amt = $result->student_messfees_master_amount;
       /* if ($result->is_system) {
            $due_amt = $result->student_messfees_master_amount;
        }*/
        $amount_detail = json_decode($result->amount_detail);

        if (is_object($amount_detail)) {

            foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                $amount = $amount + $amount_detail_value->amount;
                //$amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                //$amount_fine = $amount_fine + $amount_detail_value->amount_fine;
            }
        }

       
		  $amount_balance = $due_amt - ($amount);
        $array = array('status' => 'success', 'error' => '', 'balance' => $amount_balance);
        return json_encode($array);
    }
	
	
	

    /*function check_deposit($amount) {
        if ($this->input->post('amount') != "" && $this->input->post('amount_discount') != "") {
            if ($this->input->post('amount') < 0) {
                $this->form_validation->set_message('check_deposit', 'Deposit amount can not be less than zero');
                return FALSE;
            } else {
                $student_fees_master_id = $this->input->post('student_fees_master_id');
                $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
                $deposit_amount = $this->input->post('amount') + $this->input->post('amount_discount');
                $remain_amount = $this->getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id);
                $remain_amount = json_decode($remain_amount)->balance;
                if ($remain_amount < $deposit_amount) {
                    $this->form_validation->set_message('check_deposit', 'Deposit amount can not be grater than remaining');
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
            return TRUE;
        }
        return TRUE;
    }*/

    
	
	
	function getNotAppliedfeetype($student_id)
	{
	return $this->studentfee_model->getNotAppliedMessfeetype($student_id);	
		
	}
	
	
	
	
	function deleteFee_ex()
	{
		$id=$this->input->post('id');
		if(!empty($id))
		{
			$this->studentfee_model->delete_fee_ex($id);
			
			}
		$array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
		}
	
	 function deleteFee_ad()
	{
		$id=$this->input->post('id');
		if(!empty($id))
		{
			$this->studentfee_model->delete_Messfee_ad($id);
			
			}
		$array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
		}
	
	
	
	
	
	function fee_advance()
	{
		
		$id=$this->input->post('student_id');
		//$invoice=$this->input->post('ad_invo');
		$invoice=$this->studentfeemaster_model->mess_invo();
		$stud_name=$this->input->post('stud_name');
		$student_session_id=$this->input->post('student_session_id');
		$date=date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ad_date')));
		
		 $time=strtotime($date);
		 $month=date("F",$time);
         $year=date("Y",$time);
		
		
		$json_array=array(
		'amount'=>$this->input->post('ad_amount'),
		'date'=>$date,
		'payment_mode'=>$this->input->post('payment_mode_fee'),
		'description'=>$this->input->post('ad_note'),
		'inv_no'=>$invoice
		);
		
		//'amount_detail'=>json_encode(array($invoice=>$json_array)),
		$data=array(
		'student_session_id'=>$student_session_id,
		'student_id'=>$this->input->post('student_id'),
		'type'=>'Fees Received in Advance',
		'amount'=>$this->input->post('ad_amount'),
		'month'=>$month.'-'. $year,
		'balance_amount'=>$this->input->post('ad_amount'), 
		'is_system'=>1
		
		);
		
		 $insert_id=$this->studentfeemaster_model->collect_messfee_advance($data,$json_array);
		 
		 $mess_income=array(
			'person_name'=>$stud_name,
			'name'=>'Fee Received in Advance',
			'invoice_no'=>$invoice,
			'date'=>$date,
			'amount'=>$this->input->post('ad_amount'),
			'deposit_id'=>$insert_id
			
			);
			
			 $this->income_model->add_mess_income($mess_income);
			
		 
		 
		
		 $array = array('status' => 'success', 'error' => '');
         echo json_encode($array);
		
		
		}
	
	
	
	
	
	
	/*function fee_excess()
	{
		
		$id=$this->input->post('student_id');
		$invoice=$this->input->post('ex_invo');
		//$invoice=$this->studentfeemaster_model->inv_no();
		$stud_name=$this->input->post('stud_name');
		$json_array=array(
		'amount'=>$this->input->post('ex_amount'),
		'date'=>date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ex_date'))),
		'payment_mode'=>$this->input->post('payment_mode_fee'),
		'description'=>$this->input->post('ex_note'),
		'invo'=>$invoice
		);
		
		$data=array(
		
		'student_id'=>$this->input->post('student_id'),
		'type'=>'Fees Received in Excess',
		'amount_detail'=>json_encode(array($invoice=>$json_array))
		
		);
	   
	   $this->studentfeemaster_model->collect_fee_excess($data);
	   
	     $admin=$this->session->userdata('admin');
	     $amount=array(
		    'invoice_no'=> $invoice, 
			'person_name'=>$stud_name,
			'amount' => $this->input->post('ex_amount'),
			'centre_id'=>$admin['centre_id'],
			'note'=>'Fees Received in Excess',
			'name'=>'Fees Received in Excess',
			'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ex_date'))),
			);
			$this->income_model->add($amount);
	   
	   
	   
	
		 $array = array('status' => 'success', 'error' => '');
         echo json_encode($array);
		
		
		}
	*/
	
	
	
	
	
	
		
		
		
		
	
	

}

?>