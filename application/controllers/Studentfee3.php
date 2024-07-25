<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Studentfee extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');

    }

    function index()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/index');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentfeeSearch', $data);
        $this->load->view('layout/footer', $data);
    }

    function pdf()
    {
        $this->load->helper('pdf_helper');
    }

    function search()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentfeeSearch', $data);
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
                } else if ($search == 'search_full') {
                    $resultlist = $this->student_model->searchFullText($search_text);
                    $data['resultlist'] = $resultlist;
                }
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/studentfeeSearch', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function feesearch()
    {
        if (!$this->rbac->hasPrivilege('search_due_fees', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/feesearch');
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feesessiongroup = $this->feesessiongroup_model->getFeesByGroup();

        $data['feesessiongrouplist'] = $feesessiongroup;
        $this->form_validation->set_rules('feegroup_id', 'Fee Group', 'trim|required|xss_clean');

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['student_due_fee'] = array();
            $feegroup_id = $this->input->post('feegroup_id');
            $feegroup = explode("-", $feegroup_id);
            $feegroup_id = $feegroup[0];
            $fee_groups_feetype_id = $feegroup[1];
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $student_due_fee = $this->studentfee_model->getDueStudentFees($feegroup_id, $fee_groups_feetype_id, $class_id, $section_id);
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
            $this->load->view('studentfee/studentSearchFee', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function reportbyname()
    {
        if (!$this->rbac->hasPrivilege('fees_statement', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/reportbyname');
        $data['title'] = 'student fees';
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('studentfee/reportByName', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            $this->form_validation->set_rules('student_id', 'Student', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data['student_due_fee'] = array();
                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $student_id = $this->input->post('student_id');
                $student = $this->student_model->get($student_id);
                $data['student'] = $student;
                $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
                $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
                $data['student_discount_fee'] = $student_discount_fee;
                $data['student_due_fee'] = $student_due_fee;
                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;
                $data['student_id'] = $student_id;
                $category = $this->category_model->get();
                $data['categorylist'] = $category;

                $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
                $fee_excess = $this->studentfeemaster_model->getFeeexcess($student['id']);
                $data['fee_excess'] = $fee_excess;
                $fee_advance = $this->studentfeemaster_model->getFeeadvance($student['id']);
                $data['fee_advance'] = $fee_advance;

                $data['excess_balance'] = $this->db->select('amount')->where('student_id', $student['id'])->get('excess_balance')->row()->amount;
                $data['advance_balance'] = $this->db->select('amount')->where('student_id', $student['id'])->get('advance_balance')->row()->amount;
                $this->load->view('layout/header', $data);
                $this->load->view('studentfee/reportByName', $data);
                $this->load->view('layout/footer', $data);
            }
        }
    }

    function reportbyclass()
    {
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

    function view($id)
    {
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

    function deleteFee()
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_delete')) {
            access_denied();
        }
        $invoice_id = $this->input->post('main_invoice');
        $sub_invoice = $this->input->post('sub_invoice');
        $studentname = $this->input->post('studentname');
        $student_id = $this->input->post('student_id');
        $paymode = $this->input->post('paymode');
        $type = $this->input->post('type');

        $currentdate = date('Y-m-d');
        if (!empty($invoice_id)) {




            $currentdata = json_decode($this->db->where('id', $invoice_id)->get('student_fees_deposite')->row()->amount_detail, true);

            $amount = $currentdata[$sub_invoice]['amount'];


            $change = [
                'reverted_by' => $this->customlib->getAdminSessionUserName(),
                'person_name' => $studentname,
                'amount' => $amount,
                'invoice_no' => $sub_invoice,
                'is_recieved' => 2,
                'date' => date('Y-m-d')
            ];


            $reciept = [
                'reverted_by' => $this->customlib->getAdminSessionUserName(),
                'name' => $studentname,
                'amount' => $amount,
                'admission_no' => $this->input->post('admissionno'),
                'type' => 0,
                'invoice_no' => $sub_invoice,
                'date' => date('Y-m-d')
            ];

            $this->db->insert('refund_recipts', $reciept);




            $balancedata['changes'] = $change;
            $balancedata['student_id'] = $student_id;
            $balancedata['amount'] = $amount;

            if ($paymode == 'Excess') {
                $this->studentfeemaster_model->excess_balance_add($balancedata);

            } else if ($paymode == 'Advance') {
                $this->studentfeemaster_model->advance_balance_add($balancedata);

            }






            $array = array(
                'studentname' => $studentname,
                'type' => $type,
                'invoice' => $sub_invoice,
                'date' => date('Y-m-d')
            );


            $this->studentfee_model->remove($invoice_id, $sub_invoice, $array);


        }


        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }


    function refund_report()
    {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'Studentfee/refundreport');
        $data['category_list'] = $this->studentfee_model->get_category_list();
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        // $data['fee_group']=$this->feegroup_model->get();


        $this->form_validation->set_rules('date_from', 'Date from', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date_to', 'Date to', 'trim|required|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/fees_report/refund_report', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');


            $fees_refund = $this->db->select('student_id,class_id as class,section_id as section,reverted_by,cancelled_date as date,amount,mode,name,CONCAT(firstname," ",lastname) as studentname,admission_no ')
                ->join('students', 'students.id=income.student_id')
                ->where([
                    'is_cancelled' => 1,
                    'student_id!=' => null,
                ])->get('income')->result_array();


            $excess_refund['excess'] = $this->db->select('excess_balance.*,CONCAT(firstname," ",lastname) as studentname,admission_no')->join('students', 'students.id=excess_balance.student_id')->get('excess_balance')->result();
            $advance_refund['advance'] = $this->db->select('advance_balance.*,CONCAT(firstname," ",lastname) as studentname,admission_no')->join('students', 'students.id=advance_balance.student_id')->get('advance_balance')->result();


            $refund = array_merge($fees_refund, $excess_refund, $advance_refund);


            $changes_arr = [];



            foreach ($refund['excess'] ? $refund['excess'] : [] as $excesskey => $excessvalue) {
                // var_dump($excessvalue);exit;
                $studentname = $excessvalue->studentname;
                $admission_no = $excessvalue->admission_no;
                if (isset($excessvalue->changes)) {
                    $excess_arr = json_decode($excessvalue->changes, true);
                    foreach ($excess_arr as &$excesschange) {
                        $excesschange['name'] = 'Reverted From Excess';
                        $excesschange['studentname'] = $studentname;
                        $excesschange['admission_no'] = $admission_no;
                        if ($excesschange['is_recieved'] == 3) {

                            $changes_arr[] = $excesschange;
                        }
                    }
                }
            }
            foreach ($refund['advance'] ? $refund['advance'] : [] as $advancekey => $advancevalue) {
                $studentname = $advancevalue->studentname;
                $admission_no = $advancevalue->admission_no;

                if (isset($advancevalue->changes)) {
                    $advance_arr = json_decode($advancevalue->changes, true);
                    foreach ($advance_arr as &$advancechange) {
                        $advancechange['name'] = 'Reverted From Advance';
                        $advancechange['studentname'] = $studentname;
                        $advancechange['admission_no'] = $admission_no;

                        if ($advancechange['is_recieved'] == 3) {

                            $changes_arr[] = $advancechange;
                        }
                    }
                }
            }

            unset($refund['excess']);
            unset($refund['advance']);
            $finalarr = array_merge($refund, $changes_arr);

            $filtered_array = array_filter($finalarr, function ($item) use ($date_from, $date_to) {
                $item_date = strtotime($item['date']); // Assuming 'cancelled_date' is the date field in your array

                return ($item_date >= strtotime($date_from) && $item_date <= strtotime($date_to));
            });

            // var_dump($filtered_array);exit;
            $data['refund_data'] = $filtered_array;



            $this->load->view('layout/header', $data);
            $this->load->view('admin/fees_report/refund_report', $data);
            $this->load->view('layout/footer', $data);

        }
    }


    function refund_fee()
    {


        $refund_amount = $this->input->post('refund_amount');
        $student_fees_master_id = $this->input->post('student_fees_master_id');
        $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
        $date = $this->input->post('date');
        $payment_mode = $this->input->post('payment_mode');
        $amount = array(
            'date' => $date,
            'amount' => $refund_amount,
            'payment_mode' => $payment_mode
        );

        $data = array(
            'student_fees_master_id' => $student_fees_master_id,
            'fee_groups_feetype_id' => $fee_groups_feetype_id,
            //'amount_detail'=>array(),
            'refund_detail' => json_encode($amount)

        );

        $reciept = [
            'reverted_by' => $this->customlib->getAdminSessionUserName(),
            'name' => $this->input->post('student_name'),
            'amount' => $refund_amount,
            'admission_no' => $this->input->post('admissionno'),
            'type' => 0,
            'invoice_no' => rand(10, 100) . '/' . rand(100, 200),
            'date' => date('Y-m-d'),
            'is_refund' => 1
        ];

        $this->db->insert('refund_recipts', $reciept);


        // var_dump($data);exit;
        $this->studentfee_model->refund_fee($data);

        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);

    }








    function deleteStudentDiscount()
    {

        $discount_id = $this->input->post('discount_id');
        if (!empty($discount_id)) {
            $data = array('id' => $discount_id, 'status' => 'assigned', 'payment_id' => "");
            $this->feediscount_model->updateStudentDiscount($data);
        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function addfee($id)
    {
        if (!$this->rbac->hasPrivilege('collect_fees', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Student Detail';
        $student = $this->student_model->get($id);
        $data['student'] = $student;

        $billdetail = $this->studentfeemaster_model->get_billdetail($id);
        $fees_excess = $this->studentfeemaster_model->get_fee_excess($id);
        $fees_advance = $this->studentfeemaster_model->get_fee_advance($id);
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);


        $fee_excess = $this->studentfeemaster_model->getFeeexcess($id);
        $data['fee_excess'] = $fee_excess;
        $fee_advance = $this->studentfeemaster_model->getFeeadvance($id);
        $data['fee_advance'] = $fee_advance;

        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);

        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $class_section = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"] = $class_section;
        $session = $this->setting_model->getCurrentSession();

        $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"], $session);

        if (!empty($billdetail)) {
            foreach ($billdetail as $key => $val) {
                $arr[$key] = $val;
            }
        }
        if (!empty($fees_excess)) {
            foreach ($fees_excess as $key => $res) {
                $arr[$key] = $res;

            }
        }
        if (!empty($fees_advance)) {
            foreach ($fees_advance as $key => $ar) {
                $arr[$key] = $ar;
            }
        }

        $data['billdetail'] = $arr;
        $data['excess_balance'] = $this->db->select('amount')->where('student_id', $id)->get('excess_balance')->row()->amount;
        $data['advance_balance'] = $this->db->select('amount')->where('student_id', $id)->get('advance_balance')->row()->amount;

        $data['refunddata'] = $this->db->where('admission_no', $student['admission_no'])->get('refund_recipts')->result_array();


        $data["studentlistbysection"] = $studentlistbysection;


        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/studentAddfee', $data);
        $this->load->view('layout/footer', $data);
    }

    function deleteTransportFee()
    {
        $id = $this->input->post('feeid');
        $this->studenttransportfee_model->remove($id);
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }

    function delete($id)
    {
        $data['title'] = 'studentfee List';
        $this->studentfee_model->remove($id);
        redirect('studentfee/index');
    }

    function create()
    {
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

    function edit($id)
    {
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

    function addstudentfee()
    {

        $this->form_validation->set_rules('student_fees_master_id', 'Fee Master', 'required|trim|xss_clean');
        $this->form_validation->set_rules('fee_groups_feetype_id', 'Student', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean|callback_check_deposit|callback_check_balance');
        $this->form_validation->set_rules('amount_discount', 'Discount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount_fine', 'Fine', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');
        if ($this->form_validation->run() == false) {
            $data = array(
                'amount' => form_error('amount'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'amount_discount' => form_error('amount_discount'),
                'amount_fine' => form_error('amount_fine'),
                'payment_mode' => form_error('payment_mode'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $invoice = $this->input->post('ad_invo');
            $admin = $this->session->userdata('admin');


            $user_id = $admin['id'];
            $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
            $student_fees_discount_id = $this->input->post('student_fees_discount_id');
            $type = $this->input->post('feename');
            $stud_name = $this->input->post('stud_name');
            $group = $this->input->post('group');
            $invoice = $this->studentfeemaster_model->inv_no();


            $json_array = array(
                'amount' => $this->input->post('amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'amount_discount' => $this->input->post('amount_discount'),
                'amount_fine' => $this->input->post('amount_fine'),
                'description' => $this->input->post('description') . $collected_by,
                'payment_mode' => $this->input->post('payment_mode')

            );
            $data = array(
                'centre_id' => $admin['centre_id'],
                'student_fees_master_id' => $this->input->post('student_fees_master_id'),
                'fee_groups_feetype_id' => $this->input->post('fee_groups_feetype_id'),
                'amount_detail' => $json_array,
                'collected_by' => $user_id,
                'created_at' => date('Y-m-d')
            );

            $student_id = $this->input->post('student_id');

            $send_to = $this->input->post('guardian_phone');
            $email = $this->input->post('guardian_email');
            $inserted_id = $this->studentfeemaster_model->fee_deposit($data, $send_to, $student_fees_discount_id, $invoice);
            $sub = substr($admin['financial_year'], 0, 2);
            $income_amount = $this->input->post('amount') + $this->input->post('amount_fine');

            $current_class_section = $this->db->select('*')->where('student_id', $student_id)->get('student_session')->row();

            $class_id = $current_class_section->class_id;
            $section_id = $current_class_section->section_id;


            $amount = array(
                'invoice_no' => $invoice . '/' . $sub,
                'person_name' => $stud_name,
                'amount' => $income_amount,
                'centre_id' => $admin['centre_id'],
                'note' => $group . ': ' . $type,
                'name' => $type,
                'mode' => $this->input->post('payment_mode'),
                'description' => $this->input->post('description'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'student_id' => $student_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'reverted_by' => $this->customlib->getAdminSessionUserName()
            );
            $this->income_model->add($amount);

            $payment_mode = $this->input->post('payment_mode');
            $finalamount = $income_amount + $this->input->post('amount_discount');
            $change = array(
                'invoice_no' => $invoice . '/' . $sub,
                'person_name' => $stud_name,
                'amount' => $finalamount,
                'centre_id' => $admin['centre_id'],
                'mode' => $this->input->post('payment_mode'),
                'description' => $this->input->post('description'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                'is_recieved' => 0
            );


            if ($payment_mode == 'Advance') {
                $advance['student_id'] = $student_id;
                $advance['changes'] = $change;
                $advance['amount'] = $finalamount;

                $this->studentfeemaster_model->debit_from_advance($advance);

            }
            if ($payment_mode == 'Excess') {
                $excess['student_id'] = $student_id;
                $excess['changes'] = $change;
                $excess['amount'] = $finalamount;

                $this->studentfeemaster_model->debit_from_excess($excess);

            }





            /* $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
             $this->mailsmsconf->mailsms('fee_submission', $sender_details);*/

            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }
    }



    function check_balance($amount)
    {
        $payment_mode = $_POST['payment_mode'];
        $amount_discount = $_POST['amount_discount'];
        $amount_fine = $_POST['amount_fine'];

        $finalamount = $amount + $amount_discount + $amount_fine;
        // echo($payment_mode== "Excess");exit;
        if ($payment_mode == "Excess" || $payment_mode == "Advance") {
            if ($payment_mode == "Excess") {
                $student_id = $this->input->post('student_id');
                $excess_balance = $this->db->select('amount')->where('student_id', $student_id)->get('excess_balance')->row()->amount;

                if ($excess_balance < $finalamount) {
                    $this->form_validation->set_message('check_balance', 'Amount Exceeds Excess Balance');
                    return FALSE;
                } else {

                    return TRUE;
                }

            }
            if ($payment_mode == "Advance") {
                $student_id = $this->input->post('student_id');
                $advance_balance = $this->db->select('amount')->where('student_id', $student_id)->get('advance_balance')->row()->amount;

                if ($advance_balance < $finalamount) {
                    $this->form_validation->set_message('check_balance', 'Amount Exceeds Advance Balance');
                    return FALSE;
                } else {

                    return TRUE;
                }


            }


        }
        return TRUE;
    }

    function addstudentfee2()
    {

        $this->form_validation->set_rules('fee_groups_feetype_id[]', ' Fees Head', 'required|trim|xss_clean');
        $this->form_validation->set_rules('amount', 'Amount', 'required|trim|xss_clean');
        $this->form_validation->set_rules('payment_mode', 'Payment Mode', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'amount2' => form_error('amount'),

                'tfeetype' => form_error('fee_groups_feetype_id[]'),

                'payment_mode' => form_error('payment_mode'),

            );
            $array = array('status' => 'fail', 'error' => $data);

            echo json_encode($array);

        } else {
            $admin = $this->session->userdata('admin');
            $amount = $this->input->post('amount');
            $bamount = $this->input->post('balance');
            $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
            $c = count($fee_groups_feetype_id);
            $cal_amount = $this->input->post('cal_amount');
            $student_fees_master_id = $this->input->post('student_fees_master_id');
            $dis_fee_type_id = $this->input->post('dis_fee_type_id');
            $amount_discount = $this->input->post('amount_discount');
            //$invoice=$this->input->post('invo');
            $invoice = $this->studentfeemaster_model->inv_no();
            $fixed_fine = $this->input->post('amount_fine');
            $stud_name = $this->input->post('stud_name');
            $t_amount = $amount;



            if ($cal_amount != $amount && $dis_fee_type_id == 0) {
                for ($i = 0; $i < $c; $i++) {
                    if ($t_amount != 0) {
                        if ($t_amount < (int) $bamount[$i]) {

                            $final_amount = $t_amount;
                            $t_amount = 0;

                        } else if ($t_amount == (int) $bamount[$i]) {
                            $final_amount = $bamount[$i];
                            $t_amount = 0;

                        } else {
                            $final_amount = $bamount[$i];
                            $t_amount = $t_amount - (int) $bamount[$i];

                        }

                        $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
                        $student_fees_discount_id = $this->input->post('student_fees_discount_id');
                        if (!empty($dis_fee_type_id)) {
                            if ($fee_groups_feetype_id[$i] == $dis_fee_type_id) {
                                $income_amount = ($final_amount - $amount_discount) + $fixed_fine[$i];
                                $json_array = array(
                                    'amount' => $final_amount - $amount_discount,
                                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                                    'amount_discount' => $amount_discount,
                                    'amount_fine' => $fixed_fine[$i],
                                    'description' => $this->input->post('description') . $collected_by,
                                    'payment_mode' => $this->input->post('payment_mode')
                                );


                            } else {
                                $income_amount = $final_amount + $fixed_fine[$i];

                                $json_array = array(

                                    'amount' => $final_amount,
                                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                                    'amount_discount' => 0,
                                    'amount_fine' => $fixed_fine[$i],
                                    'description' => $this->input->post('description') . $collected_by,
                                    'payment_mode' => $this->input->post('payment_mode')
                                );


                            }

                        } else {
                            $income_amount = $income_amount + $fixed_fine[$i];

                            $json_array = array(
                                'amount' => $income_amount,
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                                'amount_discount' => $amount_discount,
                                'amount_fine' => $fixed_fine[$i],
                                'description' => $this->input->post('description') . $collected_by,
                                'payment_mode' => $this->input->post('payment_mode')
                            );


                        }


                        $data = array(
                            'centre_id' => $admin['centre_id'],
                            'student_fees_master_id' => $student_fees_master_id[$i],
                            'fee_groups_feetype_id' => $fee_groups_feetype_id[$i],
                            'amount_detail' => $json_array,
                            'created_at' => date('Y-m-d')
                        );


                        $send_to = $this->input->post('guardian_phone');
                        $email = $this->input->post('guardian_email');
                        $inserted_id = $this->studentfeemaster_model->total_fee_deposit($data, $send_to, $student_fees_discount_id, $invoice);
                        $incomename = $this->studentfeemaster_model->getfeetypefeegroup($fee_groups_feetype_id[$i]);
                        $sub = substr($admin['financial_year'], 0, 2);

                        $amount = array(
                            'invoice_no' => $invoice . '/' . $sub,
                            'person_name' => $stud_name,
                            'amount' => $income_amount,
                            'centre_id' => $admin['centre_id'],
                            'note' => $incomename['name'] . ': ' . $incomename['type'],
                            'name' => $incomename['type'],
                            'mode' => $this->input->post('payment_mode'),
                            'description' => $this->input->post('description'),
                            'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                        );
                        $this->income_model->add($amount);



                        $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
                        $this->mailsmsconf->mailsms('fee_submission', $sender_details);
                    } else {
                        $array = array('status' => 'success', 'error' => '');
                        echo json_encode($array);

                    }


                }

                $array = array('status' => 'success', 'error' => '');
                echo json_encode($array);
            } else {

                for ($i = 0; $i < $c; $i++) {

                    $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
                    $student_fees_discount_id = $this->input->post('student_fees_discount_id');
                    if (!empty($dis_fee_type_id)) {
                        if ($fee_groups_feetype_id[$i] == $dis_fee_type_id) {
                            $income_amount = ($bamount[$i] - $amount_discount) + $fixed_fine[$i];

                            $json_array = array(
                                'amount' => $bamount[$i] - $amount_discount,
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                                'amount_discount' => $amount_discount,
                                'amount_fine' => $fixed_fine[$i],
                                'description' => $this->input->post('description') . $collected_by,
                                'payment_mode' => $this->input->post('payment_mode')
                            );


                        } else {

                            $income_amount = $bamount[$i] + $fixed_fine[$i];
                            $json_array = array(

                                'amount' => $bamount[$i],
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                                'amount_discount' => 0,
                                'amount_fine' => $fixed_fine[$i],
                                'description' => $this->input->post('description') . $collected_by,
                                'payment_mode' => $this->input->post('payment_mode')
                            );


                        }

                    } else {
                        $income_amount = $bamount[$i] + $fixed_fine[$i];
                        $json_array = array(
                            'amount' => $bamount[$i],
                            'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                            'amount_discount' => $amount_discount,
                            'amount_fine' => $fixed_fine[$i],
                            'description' => $this->input->post('description') . $collected_by,
                            'payment_mode' => $this->input->post('payment_mode')
                        );


                    }


                    $data = array(
                        'centre_id' => $admin['centre_id'],
                        'student_fees_master_id' => $student_fees_master_id[$i],
                        'fee_groups_feetype_id' => $fee_groups_feetype_id[$i],
                        'amount_detail' => $json_array,
                        'created_at' => date('Y-m-d')
                    );

                    $send_to = $this->input->post('guardian_phone');
                    $email = $this->input->post('guardian_email');
                    $inserted_id = $this->studentfeemaster_model->total_fee_deposit($data, $send_to, $student_fees_discount_id, $invoice);
                    $incomename = $this->studentfeemaster_model->getfeetypefeegroup($fee_groups_feetype_id[$i]);

                    $amount = array(
                        'invoice_no' => $invoice,
                        'person_name' => $stud_name,
                        'amount' => $income_amount,
                        'centre_id' => $admin['centre_id'],
                        'note' => $incomename['name'] . ': ' . $incomename['type'],
                        'name' => $incomename['type'],
                        'mode' => $this->input->post('payment_mode'),
                        'description' => $this->input->post('description'),
                        'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
                    );
                    $this->income_model->add($amount);




                    $sender_details = array('invoice' => $inserted_id, 'contact_no' => $send_to, 'email' => $email);
                    $this->mailsmsconf->mailsms('fee_submission', $sender_details);
                }


                $array = array('status' => 'success', 'error' => '');
                echo json_encode($array);



            }





        }
    }



    function printFeesByName()
    {
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


    function printBillwise()
    {



        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['billno'] = $this->input->post('billno');
        $data['billamount'] = $this->input->post('billamount');
        $data['billdate'] = $this->input->post('billdate');
        $data['studname'] = $this->input->post('studname');
        $data['type'] = $this->input->post('type');
        $data['mode'] = $this->input->post('mode');
        $data['course'] = $this->input->post('course');
        $data['admin_no'] = $this->input->post('admin_no');
        $data['rectype'] = $this->input->post('rectype');
        $data['refundtype'] = $this->input->post('refundtype');
        $data['reverted_by'] = $this->input->post('reverted_by');

        $this->load->view('print/printBillwise', $data);
    }







    function printFeesByGroup()
    {
        $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
        $fee_master_id = $this->input->post('fee_master_id');
        $fee_session_group_id = $this->input->post('fee_session_group_id');
        $setting_result = $this->setting_model->get();
        $data['settinglist'] = $setting_result;
        $data['feeList'] = $this->studentfeemaster_model->getDueFeeByFeeSessionGroupFeetype($fee_session_group_id, $fee_master_id, $fee_groups_feetype_id);

        $this->load->view('print/printFeesByGroup', $data);
    }

    function printFeesByGroupArray()
    {
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

    function searchpayment()
    {
        if (!$this->rbac->hasPrivilege('search_fees_payment', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'studentfee/searchpayment');
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
                // var_dump($feeList);exit;
                $data['feeList'] = $feeList;
                $data['sub_invoice_id'] = $paymentid;
            } else {
                $data['feeList'] = array();
            }
        }
        $this->load->view('layout/header', $data);
        $this->load->view('studentfee/searchpayment', $data);
        $this->load->view('layout/footer', $data);
    }

    function addfeegroup()
    {
        $this->form_validation->set_rules('fee_session_groups', 'Fee Group', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_session_groups' => form_error('fee_session_groups'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $student_session_id = $this->input->post('student_session_id');
            $fee_session_groups = $this->input->post('fee_session_groups');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids = $this->input->post('student_ids');
            $delete_student = array_diff($student_ids, $student_sesssion_array);

            $preserve_record = array();
            if (!empty($student_sesssion_array)) {
                $admin = $this->session->userdata('admin');
                foreach ($student_sesssion_array as $key => $value) {

                    $insert_array = array(
                        'centre_id' => $admin['centre_id'],
                        'student_session_id' => $value,
                        'fee_session_group_id' => $fee_session_groups,
                        'student_id' => $this->input->post('student_id_' . $value)
                    );
                    $inserted_id = $this->studentfeemaster_model->add($insert_array);

                    $preserve_record[] = $inserted_id;
                }
            }


            if (!empty($delete_student)) {
                $this->studentfeemaster_model->delete($fee_session_groups, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            echo json_encode($array);
        }
    }

    function checkStudentHostelMonths()
    {

        $months = json_decode($this->input->post('months'));
        $hostelid = $this->input->post('hostelid');

        $hostel_data = $this->db->where(
            [
                'hostel_room_id' => $hostelid
            ]
        )->get('hostel_fee_assign')->result();


        echo json_encode($hostel_data);





    }
    function addhostelfeegroup()
    {

        // $this->form_validation->set_rules('fee_session_groups', 'Fee Group', 'required|trim|xss_clean');

        // if ($this->form_validation->run() == false) {
        //     $data = array(
        //         'fee_session_groups' => form_error('fee_session_groups'),
        //     );
        //     $array = array('status' => 'fail', 'error' => $data);
        //     echo json_encode($array);
        // } else {
            $student_session_id = $this->input->post('student_session_id');
            $fee_session_groups = $this->input->post('fee_session_groups');
            $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
            $student_ids = $this->input->post('student_ids');
            $delete_student = array_diff($student_ids, $student_sesssion_array);


            $hostel_fee_assign_data = [
                'hostel_room_id' => $this->input->post('hostel_room'),
                'months' => implode(',', $this->input->post('months')),
                'student_session_ids' => implode(',', $student_session_id),
            ];

            $this->db->insert('hostel_fee_assign', $hostel_fee_assign_data);
            $preserve_record = array();
            if (!empty($student_sesssion_array)) {
                $admin = $this->session->userdata('admin');
                foreach ($student_sesssion_array as $key => $value) {

                    $insert_array = array(
                        'centre_id' => $admin['centre_id'],
                        'student_session_id' => $value,
                        'fee_session_group_id' => $fee_session_groups,
                        'months' => $this->input->post('months'),
                        'student_id' => $this->input->post('student_id_' . $value),
                        'hostel_roomid' => $this->input->post('hostel_room'),
                        'feegroupname' => $this->input->post('feegroupname'),
                    );
                    $this->studentfeemaster_model->addHostelFee($insert_array);

                    // $preserve_record[] = $inserted_id;
                }
            }


            if (!empty($delete_student)) {
                $this->studentfeemaster_model->delete($fee_session_groups, $delete_student);
            }

            $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
            echo json_encode($array);
        // }
    }


    function removeHostelAssign()
    {
        $student_session_ids = $this->input->post('student_session_id');
        $hostel_room = $this->input->post('hostel_room');
        $months = implode(',', $this->input->post('months'));

        

        foreach ($student_session_ids as $ids) {
            $studentfee_existing = $this->db->where([
                'student_session_id' => $ids
            ])->get('student_fees_master')->result();
 
            foreach ($studentfee_existing as $key => $studentfee) {

                $fee_session_groups_exist = $this->db->where([
                    'id' => $studentfee->fee_session_group_id
                ])->get('fee_session_groups')->row();


                $feegroup_exist = $this->db->where([
                    'id' => $fee_session_groups_exist->fee_groups_id
                ])->get('fee_groups')->row();

                if ($feegroup_exist->hostel_room_fee_id == $hostel_room) {

                   


                    $this->db->where([
                        'id' => $fee_session_groups_exist->fee_groups_id
                    ])->delete('fee_groups');
                    $this->db->where([
                        'fee_session_group_id' => $studentfee->fee_session_group_id,
                        'student_session_id' => $studentfee->student_session_id,
                    ])->delete('student_fees_master');

                    $assignedhostel = $this->db->where( [
                        'months'=> $months,
                        'hostel_room_id'=> $hostel_room,
                    ]
                    )->get('hostel_fee_assign')->row();

                    $studentsinhostel = explode(',', $assignedhostel->student_session_ids);

                    $studentkey = array_search($ids, $studentsinhostel);

                    if ($studentkey !== false) {
                        unset($studentsinhostel[$studentkey]);
                    }



                    $this->db->where(
                        [
                            'months'=> $months,
                            'hostel_room_id'=> $hostel_room,
                        ]
                        )->update('hostel_fee_assign',['student_session_ids'=>implode(',',$studentsinhostel)]);

                    
                    



                }

                // $hostelroom_exist_ids[] = $feegroup_exist->hostel_room_fee_id;

            }
        }

        echo json_encode('success');

    }




























    /*function addmessfeegroup() {
          $this->form_validation->set_rules('mess_fee_session_id', 'Fee Group', 'required|trim|xss_clean');

          if ($this->form_validation->run() == false) {
              $data = array(
                  'mess_fee_session_id' => form_error('mess_fee_session_id'),
              );
              $array = array('status' => 'fail', 'error' => $data);
              echo json_encode($array);
          } else {
              $student_session_id = $this->input->post('student_session_id');
              $mess_fee_session_id = $this->input->post('mess_fee_session_id');
              $student_sesssion_array = isset($student_session_id) ? $student_session_id : array();
              $student_ids = $this->input->post('student_ids');
              $delete_student = array_diff($student_ids, $student_sesssion_array);

              $preserve_record = array();
              if (!empty($student_sesssion_array)) {
                  
                  foreach ($student_sesssion_array as $key => $value) {

                      $insert_array = array(
                          
                          'student_session_id' => $value,
                          'mess_fee_session_id' => $mess_fee_session_id,
                          'student_id'=>$this->input->post('student_id_'.$value)
                      );
                      $inserted_id = $this->studentfeemaster_model->addmess($insert_array);

                      $preserve_record[] = $inserted_id;
                  }
              }
              
              
              
              if (!empty($delete_student)) {
                  $this->studentfeemaster_model->deletemeemaster($mess_fee_session_id, $delete_student);
              }
             
               
              $array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
              echo json_encode($array);
          }
      }
      */





    function geBalanceFee()
    {
        $this->form_validation->set_rules('fee_groups_feetype_id', 'fee_groups_feetype_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_fees_master_id', 'student_fees_master_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('student_session_id', 'student_session_id', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'fee_groups_feetype_id' => form_error('fee_groups_feetype_id'),
                'student_fees_master_id' => form_error('student_fees_master_id'),
            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {
            $data = array();
            $fine = $this->input->post('fine');
            $student_session_id = $this->input->post('student_session_id');
            $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
            $student_fees_master_id = $this->input->post('student_fees_master_id');
            $remain_amount = $this->getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id);


            $discount_not_applied = $this->getNotAppliedDiscount($student_session_id);
            $remain_amount = json_decode($remain_amount)->balance;
            $array = array('status' => 'success', 'error' => '', 'balance' => $remain_amount, 'discount_not_applied' => $discount_not_applied, 'fine' => $fine);
            echo json_encode($array);
        }
    }




    function geBalanceFee2()
    {
        //$this->form_validation->set_rules('fee_groups_feetype_id', 'fee_groups_feetype_id', 'required|trim|xss_clean');
        //$this->form_validation->set_rules('student_fees_master_id', 'student_fees_master_id', 'required|trim|xss_clean');
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
            $fee_groups_feetype_id = $this->input->post('fee_groups_feetype_id');
            $student_fees_master_id = $this->input->post('student_fees_master_id');
            $student_id = $this->input->post('student_id');



            $c = count($fee_groups_feetype_id);

            $ar = array();

            for ($i = 0; $i < $c; $i++) {

                $remain_amount = $this->getStuFeetypeBalance($fee_groups_feetype_id[$i], $student_fees_master_id[$i]);


                $remain_amount = json_decode($remain_amount)->balance;
                $ar[] = $remain_amount;

            }

            $discount_not_applied = $this->getNotAppliedDiscount($student_session_id);
            //$remain_amount = json_decode($remain_amount)->balance;

            $t_fee_type = $this->getNotAppliedfeetype($student_id);

            $array = array('status' => 'success', 'error' => '', 'discount_not_applied' => $discount_not_applied, 'balance' => $ar, 't_fee_type' => $t_fee_type);
            echo json_encode($array);
        }
    }







    function getStuFeetypeBalance($fee_groups_feetype_id, $student_fees_master_id)
    {
        $data = array();
        $data['fee_groups_feetype_id'] = $fee_groups_feetype_id;
        $data['student_fees_master_id'] = $student_fees_master_id;


        $result = $this->studentfeemaster_model->studentDeposit($data);


        $amount_balance = 0;
        $amount = 0;
        $amount_fine = 0;
        $amount_discount = 0;
        $due_amt = $result->amount;
        if ($result->is_system) {
            $due_amt = $result->student_fees_master_amount;
        }
        $amount_detail = json_decode($result->amount_detail);

        if (is_object($amount_detail)) {

            foreach ($amount_detail as $amount_detail_key => $amount_detail_value) {
                $amount = $amount + $amount_detail_value->amount;
                $amount_discount = $amount_discount + $amount_detail_value->amount_discount;
                $amount_fine = $amount_fine + $amount_detail_value->amount_fine;
            }
        }



        $amount_balance = $due_amt - ($amount + $amount_discount);
        $array = array('status' => 'success', 'error' => '', 'balance' => $amount_balance);
        return json_encode($array);
    }




    function check_deposit($amount)
    {
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
    }

    function getNotAppliedDiscount($student_session_id)
    {
        return $this->feediscount_model->getDiscountNotApplied($student_session_id);
    }


    function getNotAppliedfeetype($student_id)
    {
        return $this->studentfee_model->getNotAppliedfeetype($student_id);

    }




    function deleteFee_ex()
    {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $student_id = $this->input->post('student_id');

        $amount = $this->input->post('ex_amount');
        $changes = [
            'reverted_by' => $this->customlib->getAdminSessionUserName(),
            'invoice_no' => $invoice,
            'amount' => $amount,
            'date' => date('Y-m-d'),
            'is_recieved' => 3
        ];
        $reciept = [
            'reverted_by' => $this->customlib->getAdminSessionUserName(),
            'name' => $this->input->post('studentname'),
            'amount' => $amount,
            'admission_no' => $this->input->post('admissionno'),
            'type' => 2,
            'invoice_no' => $invoice,
            'date' => date('Y-m-d')
        ];

        $this->db->insert('refund_recipts', $reciept);


        if (!empty($id)) {
            $balance['student_id'] = $student_id;
            $balance['amount'] = $amount;
            $balance['changes'] = $changes;

            $this->studentfeemaster_model->debit_from_excess($balance);

            $this->studentfee_model->delete_fee_ex($id, $invoice);

        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }


    function deleteFee_ad()
    {
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $student_id = $this->input->post('student_id');
        $amount = $this->input->post('ad_amount');

        $changes = [
            'reverted_by' => $this->customlib->getAdminSessionUserName(),
            'invoice_no' => $invoice,
            'amount' => $amount,
            'date' => date('Y-m-d'),
            'is_recieved' => 3
        ];

        $reciept = [
            'reverted_by' => $this->customlib->getAdminSessionUserName(),
            'name' => $this->input->post('studentname'),
            'amount' => $amount,
            'admission_no' => $this->input->post('admissionno'),
            'type' => 1,
            'invoice_no' => $invoice,
            'date' => date('Y-m-d')
        ];

        $this->db->insert('refund_recipts', $reciept);


        if (!empty($id)) {


            $balance['student_id'] = $student_id;
            $balance['amount'] = $amount;
            $balance['changes'] = $changes;

            $this->studentfeemaster_model->debit_from_advance($balance);

            $this->studentfee_model->delete_fee_ad($id, $invoice);


        }
        $array = array('status' => 'success', 'result' => 'success');
        echo json_encode($array);
    }





    function fee_advance()
    {

        $this->form_validation->set_rules('ad_amount', 'Amount', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'amountadvance' => form_error('ad_amount'),

            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {

            $id = $this->input->post('student_id');
            //$invoice=$this->input->post('ad_invo');
            $invoice = $this->studentfeemaster_model->inv_no();
            $stud_name = $this->input->post('stud_name');
            $json_array = array(
                'amount' => $this->input->post('ad_amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ad_date'))),
                'payment_mode' => $this->input->post('payment_mode_fee'),
                'description' => $this->input->post('ad_note'),
                'invo' => $invoice
            );

            $data = array(

                'student_id' => $this->input->post('student_id'),
                'type' => 'Fees Received in Advance',
                'amount_detail' => json_encode(array($invoice => $json_array))

            );

            $this->studentfeemaster_model->collect_fee_advance($data);
            $admin = $this->session->userdata('admin');

            $balance['student_id'] = $id;
            $balance['amount'] = $this->input->post('ad_amount');
            $amount = array(
                'invoice_no' => $invoice,
                'person_name' => $stud_name,
                'amount' => $this->input->post('ad_amount'),
                'centre_id' => $admin['centre_id'],
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ad_date'))),
                'is_recieved' => 1
            );

            $balance['changes'] = $amount;

            $this->studentfeemaster_model->advance_balance_add($balance);


            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);

            // $amount=array(
            //     'invoice_no'=> $invoice, 
            // 	'person_name'=>$stud_name,
            // 	'amount' => $this->input->post('ad_amount'),
            // 	'centre_id'=>$admin['centre_id'],
            // 	'note'=>'Fees Received in Advance',
            // 	'name'=>'Fees Received in Advance',
            // 	'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ad_date'))),
            // 	);
            // 	$this->income_model->add($amount);



        }
    }




    function fee_excess()
    {



        $this->form_validation->set_rules('ex_amount', 'Amount', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $data = array(
                'amountexcess' => form_error('ex_amount'),

            );
            $array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array);
        } else {


            $id = $this->input->post('student_id');
            //$invoice=$this->input->post('ex_invo');
            $invoice = $this->studentfeemaster_model->inv_no();
            $stud_name = $this->input->post('stud_name');
            $json_array = array(
                'amount' => $this->input->post('ex_amount'),
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ex_date'))),
                'payment_mode' => $this->input->post('payment_mode_fee'),
                'description' => $this->input->post('ex_note'),
                'invo' => $invoice
            );

            $data = array(

                'student_id' => $this->input->post('student_id'),
                'type' => 'Fees Received in Excess',
                'amount_detail' => json_encode(array($invoice => $json_array))

            );

            $this->studentfeemaster_model->collect_fee_excess($data);

            $admin = $this->session->userdata('admin');

            $excess['student_id'] = $id;
            $excess['amount'] = $this->input->post('ex_amount');
            $amount = array(
                'invoice_no' => $invoice,
                'person_name' => $stud_name,
                'amount' => $this->input->post('ex_amount'),
                'centre_id' => $admin['centre_id'],
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ex_date'))),
                'is_recieved' => 1
            );

            $excess['changes'] = $amount;
            $this->studentfeemaster_model->excess_balance_add($excess);

            //  $amount=array(
            //     'invoice_no'=> $invoice, 
            // 	'person_name'=>$stud_name,
            // 	'amount' => $this->input->post('ex_amount'),
            // 	'centre_id'=>$admin['centre_id'],
            // 	'note'=>'Fees Received in Excess',
            // 	'name'=>'Fees Received in Excess',
            // 	'date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('ex_date'))),
            // 	);
            // 	$this->income_model->add($amount);




            $array = array('status' => 'success', 'error' => '');
            echo json_encode($array);
        }

    }














}

?>