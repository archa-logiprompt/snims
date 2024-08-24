<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temporary_admission extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("live_class_model");
        $this->load->model("temporary_admission_model");
        $this->load->library('form_validation');
        $this->load->model("Temporary_admission_model");
    }

    public function index()
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        if (!$this->rbac->hasPrivilege('temporary_admission', 'can_add') || $centre_id != 2) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/index');
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if (empty($_FILES['file']['name'])) {
            // $this->form_validation->set_rules('file', 'Document', 'required');
        }

        $data['classlist'] = $this->class_model->get('', $classteacher = 'yes');
        $data['sessionlist'] = $this->session_model->getsessionlist();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/temporary_admission/create', $data);
            $this->load->view('layout/footer', $data);
        } else {
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if ($ext == 'csv') {
                    $file = $_FILES['file']['tmp_name'];
                    $this->load->library('CSVReader');
                    $result = $this->csvreader->parse_file($file);
                    $class_id = $this->input->post('class_id');
                    $section_id = $this->input->post('section_id');
                    $session_id = $this->input->post('session_list');
                    foreach ($result as $row) {
                        $user_id = $this->MakeUserId(5);

                        $array = array(
                            'class_id' => $class_id,
                            'section_id' => $section_id,
                            'user_id' => $user_id,
                            'session' => $session_id,
                        );

                        // $this->sendLoginSms($user_id, $row['phone']);
                        $row = array_merge($row, $array);
                        $this->temporary_admission_model->create($row);
                    }
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Temporary Students has been added.</div>');
                    redirect('admin/temporary_admission');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please upload CSV file only.</div>');
                    $this->load->view('layout/header', $data);
                    $this->load->view('student/temporary_admission/create', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
            $this->load->view('layout/header', $data);
            $this->load->view('student/temporary_admission/create', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    // public function search()
    // {

    //     $this->session->set_userdata('top_menu', 'Student Information');
    //     $this->session->set_userdata('sub_menu', 'temporary_admission/search');
    //     $data['sessionlist'] = $this->session_model->getsessionlist();
    //     $class = $this->Temporary_admission_model->getClass();
    //     $data['classlist'] = $class;

    //     $this->load->view('layout/header');
    //     $this->load->view('student/temporary_admission/search',$data);
    //     $this->load->view('layout/footer');
    // }
    function home($id)
    {
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $category = $this->Temporary_admission_model->getcat();
        $data['categorylist'] = $category;
        $feeyear = $this->Temporary_admission_model->getfee();
        $data['feeyearlist'] = $feeyear;
        $sch = $this->Temporary_admission_model->getscholar();
        $data['sch'] = $sch;
        $userdata = $this->session->userdata('temporary_student');
        $data['userdata'] = $userdata;
        $section = $this->Temporary_admission_model->getsections();
        $data['section'] = $section;
<<<<<<< HEAD
        $data['commentdetails'] = $this->Temporary_admission_model->commentdetails($id);
        $existing_details = $this->Temporary_admission_model->getexistingdetails($id);
        $data['existing_details']=$existing_details;
        $paymentsucceess = $this->Temporary_admission_model->paymentsucceess($id);
=======
        $data['commentdetails'] = $this->Temporary_admission_model->commentdetails($userdata['id']);
        $existing_details = $this->Temporary_admission_model->getexistingdetails($userdata['id']);
        $data['existing_details'] = $existing_details;
        $paymentsucceess = $this->Temporary_admission_model->paymentsucceess($userdata['id']);
>>>>>>> origin/govind
        $data['paymentsucceess'] = $paymentsucceess;

        $categoryamount = $this->Temporary_admission_model->getamountbasedoncategory($userdata['id']);
        $totalAmount = 0;
        $paidAmount = 0;
        foreach ($categoryamount as $amount) {
            $totalAmount += (int)$amount['amount'];
        }

        foreach ($paymentsucceess as $amount) {
            $paidAmount += (int)$amount['amount'];
        }

        // $data['feeBalance'] = $totalAmount - $paidAmount;
<<<<<<< HEAD
        $getdatafromstudentdetails = $this->Temporary_admission_model->getdatafromstudentdetailsforstaff($data['student_id']);
             $data['getdatafromstudentdetails'] = $getdatafromstudentdetails;
=======
        // $getdatafromstudentdetails = $this->Temporary_admission_model->getdatafromstudentdetails($userdata['id']);
        // $data['getdatafromstudentdetails'] = $getdatafromstudentdetails;
>>>>>>> origin/govind


        // $data['status'] = $this->Temporary_admission_model->getstatus($userdata['id']);


        // $quota = $this->Temporary_admission_model->getquota();
        // $data['quota'] = $quota;
        $this->load->view('temporarystudent/header', $data);
        $this->load->view('student/temporary_admission/home', $id);
    }
<<<<<<< HEAD


    public function create()
    {
        $student_id=$this->input->post('student_id');
      
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;

        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $category = $this->Temporary_admission_model->getcat();
        $data['categorylist'] = $category;
        $feeyear = $this->Temporary_admission_model->getfee();
        $data['feeyearlist'] = $feeyear;

        $sch = $this->Temporary_admission_model->getscholar();
        $data['sch'] = $sch;
        $userdata = $this->session->userdata('temporary_student');

        $existing_details = $this->Temporary_admission_model->getexistingdetails($student_id);
        $data['existing_details'] = $existing_details;
        $getdatafromstudentdetails = $this->Temporary_admission_model->getdatafromstudentdetailsforstaff($student_id);
        
        $data['getdatafromstudentdetails'] = $getdatafromstudentdetails;

        $data['commentdetails'] = $this->Temporary_admission_model->commentdetails($student_id);

        $section = $this->Temporary_admission_model->getsections();
        $data['section'] = $section;
        $quota = $this->Temporary_admission_model->getquota();
        $data['quota'] = $quota;


        
        $this->form_validation->set_rules('class_id', 'Class Id', 'trim|required|xss_clean');

     


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('temporarystudent/header', $data);
            $this->load->view('student/temporary_admission/home',$existing_details);
        } else {
            $action=$this->input->post('action');
           
            if($action=="1")
            {
                $data = array(
                    'user_id' => $student_id,
                    'admission_no' => $this->input->post('admission_no'),
                    'kuhs_reg' => $this->input->post('kuhs_reg'),
                    'roll_no' => $this->input->post('roll_no'),
                    'class_id' => $this->input->post('class_id'),
                    'section_id' => $this->input->post('section_id'),
                    // 'full_name' => $this->input->post('firstname') . ' ' . $this->input->post('lastname'),
                    // 'firstname' => $this->input->post('firstname'),
                    // 'lastname' => $this->input->post('lastname'),
                    'gender' => $this->input->post('gender'),
                    'dob' => $this->input->post('dob'),
                    'age' => $this->input->post('age'),
                    'category_id' => $this->input->post('category_id'),
                    'religion' => $this->input->post('religion'),
                    'cast' => $this->input->post('cast'),
                    // 'mobileno' => $this->input->post('mobileno'),
                    // 'email' => $this->input->post('email'),
    
                    'year' => $this->input->post('year'),
                    'admission_date' => $this->input->post('admission_date'),
                    // 'file' => $this->input->post('file'),
                    // 'file' => 'uploads/student_images/no_image.png',
                    'blood_group' => $this->input->post('blood_group'),
                    'height' => $this->input->post('height'),
                    'weight' => $this->input->post('weight'),
                    'nationality' => $this->input->post('nationality'),
                    'annual_income' => $this->input->post('annual_income'),
                    'adhar_no' => $this->input->post('adhar_no'),
                    'fees_discount' => $this->input->post('fees_discount'),
                    'father_name' => $this->input->post('father_name'),
                    'father_phone' => $this->input->post('father_phone'),
                    'father_occupation' => $this->input->post('father_occupation'),
                    // 'father_pic' => $this->input->post('father_pic'),
                    'mother_name' => $this->input->post('mother_name'),
                    'mother_phone' => $this->input->post('mother_phone'),
                    'mother_occupation' => $this->input->post('mother_occupation'),
                    // 'mother_pic' => $this->input->post('mother_pic'),
                    'guardian_is' => $this->input->post('guardian_is'),
                    'guardian_name' => $this->input->post('guardian_name'),
                    'guardian_relation' => $this->input->post('guardian_relation'),
                    'guardian_phone' => $this->input->post('guardian_phone'),
                    'guardian_occupation' => $this->input->post('guardian_occupation'),
                    'guardian_email' => $this->input->post('guardian_email'),
                    // 'guardian_pic' => $this->input->post('guardian_pic'),
                    'guardian_address' => $this->input->post('guardian_address'),
                    'autofill_current_address' => $this->input->post('autofill_current_address'),
                    'current_address' => $this->input->post('current_address'),
                    'permanent_address' => $this->input->post('permanent_address'),
    
                    'qualifying_exam' => $this->input->post('qualifying_exam'),
                    'regno' => $this->input->post('regno'),
    
                    'previous_school' => $this->input->post('previous_school'),
                    'monthyear' => $this->input->post('monthyear'),
                    'total_mark' => $this->input->post('total_mark'),
                    'neetrank' => $this->input->post('neetrank'),
                    'totmark' => $this->input->post('totmark'),
                    'chem_markob' => $this->input->post('chem_markob'),
                    'chem_maxmark' => $this->input->post('chem_maxmark'),
                    'chem_per' => $this->input->post('chem_per'),
                    'phy_markob' => $this->input->post('phy_markob'),
                    'phy_maxmark' => $this->input->post('phy_maxmark'),
                    'phy_per' => $this->input->post('phy_per'),
                    'bio_markob' => $this->input->post('bio_markob'),
                    'bio_maxmark' => $this->input->post('bio_maxmark'),
                    'bio_per' => $this->input->post('bio_per'),
                    'tot1' => $this->input->post('tot1'),
                    'tot2' => $this->input->post('tot2'),
                    'tot3' => $this->input->post('tot3'),
                    'eng_markob' => $this->input->post('eng_markob'),
                    'eng_maxmark' => $this->input->post('eng_maxmark'),
                    'eng_per' => $this->input->post('eng_per'),
                    // 'total_mark' => $this->input->post('total_mark'),
                    'total_maxmark' => $this->input->post('total_maxmark'),
                    'total_per' => $this->input->post('total_per'),
                    'med_previous_school' => $this->input->post('med_previous_school'),
                    'med_qualifying_exam' => $this->input->post('med_qualifying_exam'),
                    'med_regno' => $this->input->post('med_regno'),
                    'med_year' => $this->input->post('med_year'),
    
    
    
                    'quota' => $this->input->post('quota'),
    
    
                    'dfs' => $this->input->post('dfs'),
                    'first_mbbs_scored' => $this->input->post('first_mbbs_scored'),
                    'first_mbbs_max' => $this->input->post('first_mbbs_max'),
                    'first_mbbs_per' => $this->input->post('first_mbbs_per'),
                    'first_mbbs_year' => $this->input->post('first_mbbs_year'),
                    'total_markobtained' => $this->input->post('total_markobtained'),
    
                    'second_mbbs_scored' => $this->input->post('second_mbbs_scored'),
                    'second_mbbs_max' => $this->input->post('second_mbbs_max'),
                    'second_mbbs_per' => $this->input->post('second_mbbs_per'),
                    'second_mbbs_year' => $this->input->post('second_mbbs_year'),
    
                    'third_mbbs_scored' => $this->input->post('third_mbbs_scored'),
                    'third_mbbs_max' => $this->input->post('third_mbbs_max'),
                    'third_mbbs_per' => $this->input->post('third_mbbs_per'),
                    'third_mbbs_year' => $this->input->post('third_mbbs_year'),
    
                    'third_mbbs_scored2' => $this->input->post('third_mbbs_scored2'),
                    'third_mbbs_max2' => $this->input->post('third_mbbs_max2'),
                    'third_mbbs_per2' => $this->input->post('third_mbbs_per2'),
                    'third_mbbs_year2' => $this->input->post('third_mbbs_year2'),
    
                    'med_total_scored' => $this->input->post('med_total_scored'),
                    'med_total_per' => $this->input->post('med_total_per'),
                    'med_total_year' => $this->input->post('med_total_year'),
                    'med_total_max' => $this->input->post('med_total_max'),
    
                    'neet_reg' => $this->input->post('neet_reg'),
                    'neet_rank' => $this->input->post('neet_rank'),
                    'neet_marks' => $this->input->post('neet_marks'),
                    'neet_phy_mark_obtained' => $this->input->post('neet_phy_mark_obtained'),
                    'neet_chem_mark_obtained' => $this->input->post('neet_chem_mark_obtained'),
                    'neet_bio_mark_biology' => $this->input->post('neet_bio_mark_biology'),
                    'neet_percentile' => $this->input->post('neet_percentile'),
                    'keam_roll_no' => $this->input->post('keam_roll_no'),
                    'kerala_medical_rank' => $this->input->post('kerala_medical_rank'),
                    'seat_type' => $this->input->post('seat_type'),
    
    
                    'bank_account_no' => $this->input->post('bank_account_no'),
                    'bank_name' => $this->input->post('bank_name'),
                    'ifsc_code' => $this->input->post('ifsc_code'),
                    'samagra_id' => $this->input->post('samagra_id'),
                    'rte' => $this->input->post('rte'),
                    // 'file'=>$this->input->post('file'),
                    // 'father_pic'=>$this->input->post('father_pic'),
                    // 'mother_pic'=>$this->input->post('mother_pic'),
    
    
                    'note' => $this->input->post('note'),
                    'scholarship' => $this->input->post('scholarship'),
                    'action'=>$action
    
                );
                $insert_id = $this->Temporary_admission_model->add($data);
                if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                    $fileInfo = pathinfo($_FILES["file"]["name"]);
                    $img_name = time() . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/temporary_admission/" . $img_name);
                    $data_img = array('user_id' => $insert_id, 'file' => 'uploads/temporary_admission/' . $img_name);
                    
                    $this->Temporary_admission_model->add($data_img);
                }
                if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                    $img_name = time() . "father" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/temporary_admission/" . $img_name);
                    $data_img = array('user_id' => $insert_id, 'father_pic' => 'uploads/temporary_admission/' . $img_name);

                    $this->Temporary_admission_model->add($data_img);
                }
                if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                    $img_name = time() . "mother" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/temporary_admission/" . $img_name);
                    $data_img = array('user_id' => $insert_id, 'mother_pic' => 'uploads/temporary_admission/' . $img_name);
                    $this->Temporary_admission_model->add($data_img);
                }
                if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                    $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                    $img_name = time() . "mother" . '.' . $fileInfo['extension'];
                    move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/temporary_admission/" . $img_name);
                    $data_img = array('user_id' => $insert_id, 'guardian_pic' => 'uploads/temporary_admission/' . $img_name);
                    $this->Temporary_admission_model->add($data_img);
                }
                $image_arr = array();
                if (!empty($_FILES['images']['name'][0])) {
                    foreach ($_FILES['images']['name'] as $key => $name) {
                        if ($_FILES['images']['error'][$key] == 0) {
                            $file_name = $insert_id . '_' . time() . '_' . $key;
                            $file_path = './uploads/temporary_admission/' . $file_name;
                            $image_arr[] = $file_name;
    
    
                            move_uploaded_file($_FILES['images']['tmp_name'][$key], $file_path);
                        }
                    }
                    $image_arr = implode(',', $image_arr);
                    $this->db->where('user_id', $insert_id);
                    $query = $this->db->get('temp_user')->row();
                    if ($query) {
                        $this->db->where('user_id', $insert_id);
                        $this->db->update('temp_user', ['documents' => $image_arr]);
                    } else {
    
                        $this->db->insert('temp_user', [
                            'user_id' => $insert_id,
                            'documents' => $image_arr
                        ]);
                    }
                }
            }
            // else{
            //     $getdetailsfromdraftuserdetails = $this->db->select('*')->from('draft_user_details')->where('user_id', $userdata['id'])->get()->row_array();
            //     $getdetailsfromdraftuserdetails['action']='1';
            //     $this->Temporary_admission_model->add($getdetailsfromdraftuserdetails);

            // }


          
            $this->session->set_flashdata('msg1', '<div class="alert alert-success">Student data has been Updated Successfully</div>');
            redirect('admin/temporary_admission/home/'.$student_id);
        }
    }

=======
>>>>>>> origin/govind
    function search()
    {

        if (!$this->rbac->hasPrivilege('temp_student_details', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/search');
        $data['title'] = 'Student Search';
        $data['sessionlist'] = $this->session_model->getsessionlist();
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;
        $staff_list = $this->temporary_admission_model->getstaff();
        $data['staff_list'] = $staff_list;
        $userdata = $this->session->userdata();
        $data['userdata'] = $userdata['admin'];
        $data['role'] = $data['userdata']['roles'];
        // var_dump($data['userdata']);exit;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header');
            $this->load->view('student/temporary_admission/search', $data);
            $this->load->view('layout/footer');
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $session_id = $this->input->post('session_list');
            $search = $this->input->post('search');

            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {
                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                        $data['session_id'] = $this->input->post('session_id');
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchtemporarystudentadmission($class, $section, $session_id);
                        foreach ($resultlist as $index => $student) {
                            $totalAmount = 0;
                            $paidAmount = 0;
                            $categoryamounts = $this->Temporary_admission_model->getamountbasedoncategory($student['id']);
                            $paymentsucceess = $this->Temporary_admission_model->paymentsucceess($student['id']);
                            foreach ($categoryamounts as $amounts) {
                                $totalAmount += (int) ($amounts['amount']);
                            }
                            foreach ($paymentsucceess as $success) {
                                $paidAmount += (int) ($success['amount']);
                            }
                            $resultlist[$index]['paidAmount'] = $paidAmount;
                            $resultlist[$index]['totalAmount'] = $totalAmount;
                        }
                        $data['resultlist'] = $resultlist;
                        $title = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title'] = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));



                    $resultlist = $this->student_model->searchFullText($search_text, $carray);
                    $data['resultlist'] = $resultlist;

                    $data['title'] = 'Search Details: ' . $data['search_text'];
                }
                //var_dump($resultlist);
            }
            $this->load->view('layout/header');
            $this->load->view('student/temporary_admission/search', $data);
            $this->load->view('layout/footer');
        }
    }
    // function show($id)
    // {


    //     if (!$this->rbac->hasPrivilege('student', 'can_view')) {
    //         access_denied();
    //     }

    //     $data['title'] = 'Student Details';
    //     $student = $this->student_model->get($id);
    //     $gradeList = $this->grade_model->get();
    //     $studentSession = $this->student_model->getStudentSession($id);
    //     $timeline = $this->timeline_model->getStudentTimeline($id, $status = '');
    //     $data["timeline_list"] = $timeline;

    //     $student_session_id = $studentSession["student_session_id"];

    //     $student_session = $studentSession["session"];
    //     // $data["session"] = $student_session;       
    //     $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);

    //     $data["session"] = $current_student_session["session"];
    //     $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);

    //     $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
    //     $data['student_discount_fee'] = $student_discount_fee;
    //     $data['student_due_fee'] = $student_due_fee;
    //     $siblings = $this->student_model->getMySiblings($student['parent_id'], $student['id']);

    //     $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
    //     $data['examSchedule'] = array();
    //     if (!empty($examList)) {
    //         $new_array = array();
    //         foreach ($examList as $ex_key => $ex_value) {
    //             $array = array();
    //             $x = array();
    //             $exam_id = $ex_value['exam_id'];
    //             $student['id'];
    //             $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
    //             foreach ($exam_subjects as $key => $value) {
    //                 $exam_array = array();
    //                 $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
    //                 $exam_array['exam_id'] = $value['exam_id'];
    //                 $exam_array['full_marks'] = $value['full_marks'];
    //                 $exam_array['passing_marks'] = $value['passing_marks'];
    //                 $exam_array['exam_name'] = $value['name'];
    //                 $exam_array['exam_type'] = $value['type'];
    //                 $exam_array['attendence'] = $value['attendence'];
    //                 $exam_array['get_marks'] = $value['get_marks'];
    //                 $x[] = $exam_array;
    //             }
    //             $array['exam_name'] = $ex_value['name'];
    //             $array['exam_result'] = $x;
    //             $new_array[] = $array;
    //         }
    //         $data['examSchedule'] = $new_array;
    //     }
    //     $student_doc = $this->student_model->getstudentdoc($id);
    //     $data['student_doc'] = $student_doc;
    //     $data['student_doc_id'] = $id;
    //     $category_list = $this->category_model->get();
    //     $data['category_list'] = $category_list;
    //     $data['gradeList'] = $gradeList;
    //     $data['student'] = $student;
    //     $data['siblings'] = $siblings;
    //     $class_section = $this->student_model->getClassSection($student["class_id"]);
    //     $data["class_section"] = $class_section;
    //     $session = $this->setting_model->getCurrentSession();

    //     $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"], $session);
    //     $data["studentlistbysection"] = $studentlistbysection; 

    //     // Bottom Tab
    //     $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
    //     $fee_excess = $this->studentfeemaster_model->getFeeexcess($id);
    //     $data['fee_excess'] = $fee_excess;
    //     $fee_advance = $this->studentfeemaster_model->getFeeadvance($id);
    //     $data['fee_advance'] = $fee_advance;

    //     $data['excess_balance'] = $this->db->select('amount')->where('student_id', $id)->get('excess_balance')->row()->amount;
    //     $data['advance_balance'] = $this->db->select('amount')->where('student_id', $id)->get('advance_balance')->row()->amount;
    //     $data["studentlistbysection"] = $studentlistbysection;
    //     $this->load->view('layout/header', $data);
    //     $this->load->view('student/temporary_admission/show', $data);
    //     $this->load->view('layout/footer', $data);
    // }

    public function show($id)
    {


        $userdata = $this->session->userdata();
        $data['userdata'] = $userdata['temporary_student'];
        $curuserdata = $userdata['admin'];
        $data['getstudentdetails'] = $this->temporary_admission_model->getstudentdetails($id);
<<<<<<< HEAD
=======
        $categoryamounts = $this->Temporary_admission_model->getamountbasedoncategory($id);
        $paymentsucceess = $this->Temporary_admission_model->paymentsucceess($id);
        $categoryamounts = $this->Temporary_admission_model->getamountbasedoncategory($id);
        $paymentsucceess = $this->Temporary_admission_model->paymentsucceess($id);
        $totalAmount = 0;
        $paidAmount = 0;
        $paid = false;
        foreach ($categoryamounts as $amounts) {
            $totalAmount += (int) ($amounts['amount']);
        }
        foreach ($paymentsucceess as $success) {
            $paidAmount += (int) ($success['amount']);
        }
        if ($totalAmount == $paidAmount) {
            $paid = true;
        }
        $data['paid'] = $paid;
>>>>>>> origin/govind
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $data['userdata'] = $userdata['admin'];
        $data['role'] = $data['userdata']['roles'];

        $data['commentdetails'] = $this->Temporary_admission_model->commentdetails($id);
        $userdata = $this->session->userdata();
        $this->load->view('layout/header', $data);
        $this->load->view('student/temporary_admission/show', $data);
        $this->load->view('layout/footer', $data);
    }
    public function manual_payment($id)
    {
        $userdata = $this->session->userdata();
        $categoryamounts = $this->Temporary_admission_model->getamountbasedoncategory($id);
        $candidate_name = $this->Temporary_admission_model->getCandidateName($id);
        $transaction_id = date('YmdHis');

        $fee_details = array();

        foreach ($categoryamounts as $categoryamount) {
            $fee_details[] = $categoryamount['name'] . '-' . $categoryamount['type'];
        }

        $fee_details = implode(',', $fee_details);

        $data = array(
            'date' => $this->input->post('date'),
            'amount' => $this->input->post('amount'),
            'payment_mode' => $this->input->post('payment_mode'),
            'description' => $this->input->post('description'),
            'transaction_id' => $transaction_id,
            'temporary_student_id' => $id,
            'fee_details' => $fee_details
        );
        
        $this->db->insert('payment_suceess', $data);
        $log = array(
            'user_name' => $userdata['admin']['username'],
            'user_id' => $userdata['admin']['id'],
            'description' => "Manual Payment of " . $candidate_name->firstname . " " . $candidate_name->lastname ,
        );
        $this->Temporary_admission_model->getCreateLog($log);
        redirect('admin/temporary_admission/show/' . $id);
    }

    public function pickup($id)
    {
        $userdata = $this->session->userdata();
        $candidate_name = $this->Temporary_admission_model->getCandidateName($id);
        $curuserdata = $userdata['admin'];
        $data['sessionlist'] = $this->session_model->getsessionlist();
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;
        $userdata = $this->session->userdata();
        $pickup = $this->temporary_admission_model->pickupupdate($id, $curuserdata['id']);
        $log = array(
            'user_name' => $userdata['admin']['username'],
            'user_id' => $userdata['admin']['id'],
            'description' => "User has Picked " . $candidate_name->firstname . " " . $candidate_name->lastname,
        );
        $this->Temporary_admission_model->getCreateLog($log);


        $this->load->view('layout/header');
        $this->load->view('student/temporary_admission/search', $data);
        $this->load->view('layout/footer');
    }
    public function approve($id)
    {

        $userdata = $this->session->userdata();
        $candidate_name = $this->Temporary_admission_model->getCandidateName($id);
        $curuserdata = $userdata['admin'];
        $data['getstudentdetails'] = $this->temporary_admission_model->getstudentdetails($id);
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $status = $this->Temporary_admission_model->status($id);
        $log = array(
            'user_name' => $userdata['admin']['username'],
            'user_id' => $userdata['admin']['id'],
            'description' => "Approved " . $candidate_name->firstname . " " . $candidate_name->lastname,
        );
        $this->Temporary_admission_model->getCreateLog($log);
        $userdata = $this->session->userdata();
        redirect('admin/temporary_admission/show/' . $id);
    }
    public function comment($id)
    {



        $comment = $this->input->post('comment');
        $userdata = $this->session->userdata('admin');


        $data = array(
            'comment' => $comment,
            'commented_by' => $userdata['username'],
            'created_at' => date('Y-m-d H:i:s'),
            'stud_id' => $id
        );


        $insert_id = $this->Temporary_admission_model->addcomment($data);
        // var_dump($data);exit;


        redirect('admin/temporary_admission/show/' . $id);

        // $this->db->where('id', $id);
        // $update = $this->db->update('temporary_admission', $data);


    }
    public function leave()
    {
        $userdata = $this->session->userdata();
        $id = $this->input->post('id');
        $this->Temporary_admission_model->pickedbyupdate($id);
        $candidate_name = $this->Temporary_admission_model->getCandidateName($id);
        $log = array(
            'user_name' => $userdata['admin']['username'],
            'user_id' => $userdata['admin']['id'],
            'description' => $candidate_name->firstname . " " . $candidate_name->lastname. " ". "left",
        );
        $this->Temporary_admission_model->getCreateLog($log);
        echo ('success');
    }
    private function MakeUserId($length)
    {
        $salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $len = strlen($salt);
        $makepass = '';
        mt_srand(10000000 * (float) microtime());
        for ($i = 0; $i < $length; $i++) {
            $makepass .= $salt[mt_rand(0, $len - 1)];
        }
        return $makepass;
    }

    private function sendLoginSms($user_id, $phone)
    {
        $password = "test";
        $fullApi = 'http://prioritysms.a4add.com/api/sendhttp.php?authkey=341137A6fjmQ8YSgq95f588459P1&mobiles={num}&message={msg}&sender=AMCSFN&route=4&country=91&unicode=1&DLT_TE_ID={tid}';
        $tid = '1207162731815046564';
        $msg = "AMCSFNCK B.Sc Nursing Application 2024-25. Your Applicant ID: " . $user_id . " and Password: " . $password . ".\n For more details www.amcsfnck.com or https://bit.ly/3AR0uPs";
        ;
        $msg = urlencode($msg);
        $num = $phone;
        $api = str_replace(['{msg}', '{num}', '{tid}'], [$msg, $num, $tid], $fullApi);

        $url = $api;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        $http_result = $info['http_code'];
        curl_close($ch);
    }
    public function upload_signature()
    {

        if (!$this->rbac->hasPrivilege('upload_signature', 'can_add')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/upload_signature');
        $res = $this->Temporary_admission_model->getalldocuments();
        $data['res'] = $res;
        $roles = $this->role_model->get();
        $data["roles"] = $roles;

        $this->form_validation->set_rules('xcordinate', 'xcordinate', 'required');
        $this->form_validation->set_rules('ycoordinate', 'ycoordinate', 'required');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('student/temporary_admission/upload_signature', $data);
            $this->load->view('layout/footer');
        } else {

            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];

            $data = array(
                'staffname' => $this->input->post('staffname'),
                'centre_id' => $centre_id,
                'mail' => $this->input->post('mail'),
                'xcordinate' => $this->input->post('xcordinate'),
                'ycoordinate' => $this->input->post('ycoordinate'),
                'orders' => $this->input->post('orders'),
                'pageno' => $this->input->post('page_no'),
                'picked_by_id' => $this->input->post('picked_by_id'),
                'enable' => $this->input->post('enable'),

                'role' => $this->input->post('role')
            );



            $visitor_id = $this->Temporary_admission_model->upload_signature($data);


            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $visitor_id . "signature" . '.' . $fileInfo['extension'];
                $upload_path = "./uploads/upload_signature/" . $img_name;



                if (move_uploaded_file($_FILES["file"]["tmp_name"], $upload_path)) {

                    $impath = FCPATH . "uploads/upload_signature/" . $img_name;
                    $type = pathinfo($impath, PATHINFO_EXTENSION);
                    $data = file_get_contents($impath);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    // var_dump($data);exit;


                    $data_img = array('file' => $upload_path);
                    $data_img['base_64_path'] = $base64;

                    $this->Temporary_admission_model->update_signature($visitor_id, $data_img);
                } else {

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">File upload failed</div>');
                    redirect('admin/temporary_admission/upload_signature');
                }
            }


            $this->session->set_flashdata('msg', '<div class="alert alert-success">Signature added successfully</div>');
            redirect('admin/temporary_admission/upload_signature');
        }
    }

    public function signedit($id)
    {

        if (!$this->rbac->hasPrivilege('upload_signature', 'can_edit')) {
            access_denied();
        }


        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/upload_signature');
        $res = $this->Temporary_admission_model->getalldocuments();
        $data['res'] = $res;
        $roles = $this->role_model->get();
        $data["roles"] = $roles;
        $document = $this->Temporary_admission_model->getDocumentById($id);
        if (!$document) {

            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Document not found</div>');
            redirect('admin/temporary_admission/upload_signature');
        }
        $data['document'] = $document;


        $this->form_validation->set_rules('staffname', 'Staff Name', 'required');
        $this->form_validation->set_rules('mail', 'Mail', 'required');


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header');
            $this->load->view('student/temporary_admission/edit_signature', $data);
            $this->load->view('layout/footer');
        } else {

            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];


            $data = array(
                'staffname' => $this->input->post('staffname'),
                'centre_id' => $centre_id,
                'mail' => $this->input->post('mail'),
                'xcordinate' => $this->input->post('xcordinate'),
                'ycoordinate' => $this->input->post('ycoordinate'),
                'orders' => $this->input->post('orders'),
            );


            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . "signature" . '.' . $fileInfo['extension'];
                $upload_path = "./uploads/upload_signature/" . $img_name;

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $upload_path)) {

                    $data['file'] = $upload_path;


                    if (!empty($document['file']) && file_exists($document['file'])) {
                        unlink($document['file']);
                    }
                } else {

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger">File upload failed</div>');
                    redirect('admin/temporary_admission/edit_signature/' . $id);
                }
            }


            $this->Temporary_admission_model->update_signature($id, $data);


            $this->session->set_flashdata('msg', '<div class="alert alert-success">Signature updated successfully</div>');
            redirect('admin/temporary_admission/upload_signature');
        }
    }
    public function signdelete($id)
    {
        if (!$this->rbac->hasPrivilege('upload_signature', 'can_delete')) {
            access_denied();
        }

        $this->Temporary_admission_model->signdelete($id);
    }

    public function admindownloadreceipt($id)
    {

        $data['student_id'] = $id;
        $userdata = $this->session->userdata();
        $data['userdata'] = $userdata['admin'];
        $data['role'] = $data['userdata']['roles'];
        $data['paymentsucceess'] = $this->Temporary_admission_model->paymentsucceess($id);
        // $this->load->view('temporarystudent/header', $data);
        $this->load->view('temporarystudent/admindownloadreceipt', $data);
    }


    public function updateStatusinmail($id)
    {
        $this->db->where('id', $id);
        $this->db->update('temporary_admission', ['status' => 3]);
        // $getpickedbyid=$this->db->select('picked_by_id')->from('upload_signature')->get()->row_array();
<<<<<<< HEAD
        
        $result = $this->db->where(['temp_user_id' => $id, 'status' => 1])->order_by('order_no', 'desc')->get('temp_admission_approval')->result_array();
        
        
        
        
        
        if (count($result) > 0) {
            
            $order_no = $result[0]['order_no'];
            
        } else {
            $order_no = 0;
            
        }
        $signer_details = $this->db->where('orders', $order_no + 1)->get('upload_signature')->row_array();
        
        // $signer_details = $this->db->where('orders',$order_no+1)->get('upload_signature')->row_array();
        if ($signer_details['picked_by_id'] == 1) {
            
            $staff_details = $this->db->select('temporary_admission.*,staff.*')->where('temporary_admission.id', $id)->join('staff', 'temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();
            
=======

        $result = $this->db->where(['temp_user_id' => $id, 'status' => 1])->order_by('order_no', 'desc')->get('temp_admission_approval')->result_array();





        if (count($result) > 0) {

            $order_no = $result[0]['order_no'];
        } else {
            $order_no = 0;
        }
        $signer_details = $this->db->where('orders', $order_no + 1)->get('upload_signature')->row_array();

        // $signer_details = $this->db->where('orders',$order_no+1)->get('upload_signature')->row_array();
        if ($signer_details['picked_by_id'] == 1) {

            $staff_details = $this->db->select('temporary_admission.*,staff.*')->where('temporary_admission.id', $id)->join('staff', 'temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();

>>>>>>> origin/govind
            $arr = [
                'temp_user_id' => $id,
                'sign_id' => $signer_details['id'],
                'signer_email' => $staff_details['email'],
                'order_no' => $signer_details['orders'],
                'status' => 0
            ];
        } else {
<<<<<<< HEAD
            
=======

>>>>>>> origin/govind
            $arr = [
                'temp_user_id' => $id,
                'sign_id' => $signer_details['id'],
                'signer_email' => $signer_details['mail'],
                'order_no' => $signer_details['orders'],
                'status' => 0
            ];
<<<<<<< HEAD
            
        }
        
        
        
        
        
        $this->db->insert('temp_admission_approval', $arr);
        // $documentName = $this->createDocument($id);
        
        $documentName = $this->sampledocument($id, $order_no, $arr);
        
        $this->sendmail($documentName, $arr['signer_email'], $id);
        
        
        // $response_message = "Document processed and sent to " . $signer_details['mail'] . " for approval.";
        
        echo json_encode('success');
    }


    public function updateStatus($id)
=======
        }





        $this->db->insert('temp_admission_approval', $arr);
        // $documentName = $this->createDocument($id);

        $documentName = $this->sampledocument($id, $order_no, $arr);

        $this->sendmail($documentName, $arr['signer_email'], $id);


        // $response_message = "Document processed and sent to " . $signer_details['mail'] . " for approval.";

        echo json_encode('success');
    }

    public function cashierUpdateStatus($id)
>>>>>>> origin/govind
    {

        $this->db->where('id', $id);
        $this->db->update('temporary_admission', ['status' => 3]);



        echo json_encode(['message' => "success"]);
    }
    public function updateStatus($id)
    {

        $this->db->where('id', $id);
        $this->db->update('temporary_admission', ['financial_verification' => 1]);


        $result = $this->db->where(['temp_user_id' => $id, 'status' => 1])
            ->order_by('order_no', 'desc')
            ->get('temp_admission_approval')
            ->result_array();

        $order_no = count($result) > 0 ? $result[0]['order_no'] : 0;

        $signer_details = $this->db->where('orders', $order_no + 1)->get('upload_signature')->row_array();

        if ($signer_details['picked_by_id'] == 1) {
            $staff_details = $this->db->select('temporary_admission.*, staff.*')
                ->where('temporary_admission.id', $id)
                ->join('staff', 'temporary_admission.picked_by = staff.id')
                ->get('temporary_admission')
                ->row_array();

            $arr = [
                'temp_user_id' => $id,
                'sign_id' => $signer_details['id'],
                'signer_email' => $staff_details['email'],
                'order_no' => $signer_details['orders'],
                'status' => 0
            ];
        }

        $this->db->insert('temp_admission_approval', $arr);


        $documentName = $this->sampledocument($id, $order_no, $arr);
        $this->initialapprove($documentName, $arr['signer_email'], $id);



        $folderPath = './uploads/approved_documents/';
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0755, true);
        }

        $filePath = $documentName;
        $candidate_name = $this->Temporary_admission_model->getCandidateName($id);
        $userdata = $this->session->userdata();
        $log = array(
            'user_name' => $userdata['admin']['username'],
            'user_id' => $userdata['admin']['id'],
            'description' => $candidate_name->firstname . " " . $candidate_name->lastname. " ". "payment has been verified",
        );
        $this->Temporary_admission_model->getCreateLog($log);
        $response_message = "Document has been saved to " . $filePath;
        
        $this->updateStatusinmail($id);
        echo json_encode(['message' => $response_message]);
       
    }
    public function initialapprove($documentName, $signermail, $id)
    {

        $this->db->where(['signer_email' => $signermail, 'temp_user_id' => $id])->update('temp_admission_approval', ['status' => 1]);
        // $this->updateStatus($id);

    }
    public function sampledocument($id, $order_no, $arr)
    {

        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $images = [];
        // $staff_details=$this->db->select('staff.*')->where('temporary_admission.id',$id)->join('staff','temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();



        $signer_details = $this->db->where('orders', 1)->get('upload_signature')->row_array();




        if ($signer_details['picked_by_id'] == 1) {

            $staff_details = $this->db->select('staff.*')->where('temporary_admission.id', $id)->join('staff', 'temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();

            $images[] =
                [
                    'src' => FCPATH . $staff_details['sign'],
                    'pageno' => $signer_details['pageno'],
                    'x' => $signer_details['xcordinate'],
                    'y' => $signer_details['ycoordinate'],
                    'width' => 200,
                    'height' => 100,
                ];
        }



        $getstudentdetails = $this->Temporary_admission_model->getstudentdetails($id);
        $pageIndexArray = [
            [
                'Name' => $getstudentdetails['firstname'] . " " . $getstudentdetails['lastname'],
                'Admission Date' => $getstudentdetails['admission_date'],
                'Course' => $getstudentdetails['class'],
                'Section' => $getstudentdetails['section'],
                'Date of ' => $getstudentdetails['dob'],
                'Phone No' => $getstudentdetails['phone'],
                'Caste' => $getstudentdetails['cast'],
                'Religion' => $getstudentdetails['religion'],
                'Email' => $getstudentdetails['email'],
                'Current Address' => $getstudentdetails['current_address'],
                'Permanent Address' => $getstudentdetails['permanent_address'],
                'Father Name' => $getstudentdetails['father_name'],
                'Father Phone' => $getstudentdetails['father_phone'],
                'Father Occupation' => $getstudentdetails['father_occupation'],
                'Mother Name' => $getstudentdetails['mother_name'],
                'Mother Phone' => $getstudentdetails['mother_phone'],
                'Mother Occupation' => $getstudentdetails['mother_occupation'],
                'Guardian Name' => $getstudentdetails['guardian_name'],
                'Guardian Email' => $getstudentdetails['guardian_email'],
                'Guardian Relation' => $getstudentdetails['guardian_relation'],
                'Guardian Phone' => $getstudentdetails['guardian_phone'],
                'Guardian Occupation' => $getstudentdetails['guardian_occupation'],
                'Guardian Address' => $getstudentdetails['guardian_address'],
                'Nationality' => $getstudentdetails['nationality'],
                'Blood Group' => $getstudentdetails['blood_group'],
                'Previous School' => $getstudentdetails['previous_school'],
                'Adhar No' => $getstudentdetails['adhar_no'],
            ],
            [
                'Name' => $getstudentdetails['firstname'] . " " . $getstudentdetails['lastname'],
                'Admission Date' => $getstudentdetails['admission_date'],
                'Course' => $getstudentdetails['class'],
                'Section' => $getstudentdetails['section'],
                'Date of ' => $getstudentdetails['dob'],
                'Phone No' => $getstudentdetails['phone'],
                'Caste' => $getstudentdetails['cast'],
                'Religion' => $getstudentdetails['religion'],
                'Email' => $getstudentdetails['email'],
                'Current Address' => $getstudentdetails['current_address'],
                'Permanent Address' => $getstudentdetails['permanent_address'],
                'Father Name' => $getstudentdetails['father_name'],
                'Father Phone' => $getstudentdetails['father_phone'],
                'Father Occupation' => $getstudentdetails['father_occupation'],
                'Mother Name' => $getstudentdetails['mother_name'],
                'Mother Phone' => $getstudentdetails['mother_phone'],
                'Mother Occupation' => $getstudentdetails['mother_occupation'],
                'Guardian Name' => $getstudentdetails['guardian_name'],
                'Guardian Email' => $getstudentdetails['guardian_email'],
                'Guardian Relation' => $getstudentdetails['guardian_relation'],
                'Guardian Phone' => $getstudentdetails['guardian_phone'],
                'Guardian Occupation' => $getstudentdetails['guardian_occupation'],
                'Guardian Address' => $getstudentdetails['guardian_address'],
                'Nationality' => $getstudentdetails['nationality'],
                'Blood Group' => $getstudentdetails['blood_group'],
                'Previous School' => $getstudentdetails['previous_school'],
                'Adhar No' => $getstudentdetails['adhar_no'],
            ]
        ];
        $html = "<html><head><style>
        .page-break { page-break-before: always; }
        .image-container { position: absolute; }
        </style></head><body>";
        $html .= "
        <div style='position: relative;'>
                <table border='1' cellpadding='5' cellspacing='0' style='width: 100%;'>
                <tr><th colspan='2'>Student Details</th></tr>";

        foreach ($pageIndexArray as $pageno => $pageData) {
            $pagecontentcount = 0;
            foreach ($pageData as $pageContentTitle => $pageContent) {

                $html .= "<tr><td>" . $pageContentTitle . "</td><td>" . $pageContent . "</td></tr>";

                $pagecontentcount++;

                if ($pagecontentcount == count($pageData)) {

                    $html .= "
                </table><table border='1' cellpadding='5' cellspacing='0' style='width: 100%;'>";

                    $signatureimage = array_filter($images, function ($im) use ($pageno) {
                        return $im['pageno'] == $pageno + 1;
                    });


                    if (count($signatureimage) > 0) {

                        foreach ($signatureimage as $signature) {

                            $impath = $signature['src'];
                            $type = pathinfo($impath, PATHINFO_EXTENSION);
                            $data = file_get_contents($impath);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                            // Create the page content with the image and table
                            if ($signature['x'] > 400) {
                                $signaturex = $signature['x'] - 400;
                                $html .= "
                            <div class='image-container' style='right: {$signaturex}; bottom: {$signature['y']}; width: {$signature['width']}px; height: {$signature['height']}px;'>
                            <img src='$base64' style='width: 100%; height: 100%;' />  
                            </div>";
                            } else {
                                $html .= "
                            <div class='image-container' style='left: {$signature['x']}; bottom: {$signature['y']}; width: {$signature['width']}px; height: {$signature['height']}px;'>
                            <img src='$base64' style='width: 100%; height: 100%;' />  
                            </div>";
                            }
                        }
                    }
                }
            }
            if ($pageno == 1) {

                $html .= " 
                <p style='margin-top: 20px;'><strong>Declaration:</strong> I hereby declare that the information provided above is true and accurate to the best of my knowledge and belief.</p>    
                </div>";
            }
            $html .= " <div class='page-break'></div> ";
        }




        $html .= "</body></html>"; 

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the PDF
        $dompdf->render();
        $file_name = $id . '_approval_' . time() . '.pdf';

        $file_path = FCPATH . 'uploads/candidate_documents/' . $file_name;
        file_put_contents($file_path, $dompdf->output());
        $data = [
            'student_id' => $id,
            'filename' => $file_name,
            'staff_id' => $signer_details['picked_by_id'] == 1 ? $staff_details['id'] : NULL,
            'created_at' => date('Y-m-d H:i:s') // optional: to track when the record was created
        ];

        $this->db->insert('document_records', $data); // 'document_records' is the new table where data will be stored

        return $file_path;
    }

    public function createDocument($id)
    {
        $data['test'] = "test";
        $studentdetails = $this->Temporary_admission_model->getstudentdetails($id);
        $data['studentdetails'] = $studentdetails;
        $html = $this->load->view('student/temporary_admission/test', $data, true);

        // Include Dompdf library
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');

        // Use the correct namespace for Dompdf and Options


        // Initialize Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Enable loading of remote content like images
        $dompdf = new Dompdf($options);

        // Load HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        $output = $dompdf->output();
        $file_name = $id . '_approval_' . time() . '.pdf';
        $file_path = FCPATH . 'uploads/candidate_documents/' . $file_name;
        file_put_contents($file_path, $output);
        return $file_name;
    }


    public function sendmail($documentName, $signermail, $tempid)
    {

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $this->load->library('form_validation');
        $this->load->library('email');
        $email_subject = 'Your Registration Details';
        $email_message = '<html><body>';
        $email_message .= '<h3>Thank you for your enquiry. Here are your details:</h3>';
        $email_message .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
        $email_message .= '<tr><th>Field</th><th>Details</th></tr>';

        $email_message .= '<tr><td>Approve</td><td><a href=' . base_url('site/approvemail/' . $signermail . '/' . $tempid) . '>Click here to sign the document</a></td></tr>';
        // $email_message .= '<tr><td>Approve</td><td><a href=' . base_url('site/approvemail/' . $signermail . '/' . $tempid) . ' target="_blank">Click here to sign the document</a></td></tr>';

        $email_message .= '</table>';

        $email_message .= '</body></html>';

        // Send the email using PHPMailer
        $file_path = $documentName;
        $Body = "hai";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "medicalcollege@drmoopensmc.ac.in";
        $mail->Password = "ayxuwqtlvgmxwnbi";
        $mail->setFrom("medicalcollege@drmoopensmc.ac.in");
        $mail->addAddress($signermail);
        $mail->Subject = $email_subject;
        $mail->Body = $email_message;
        $mail->Subject = 'Your Enquiry Has been recieved.We will contact You Soon';
        $mail->msgHTML($email_message);
        $mail->addAttachment($file_path, 'document.pdf');
        // $mail->AltBody = 'HTML messaging not supported';
        $mail->send();
    }


    // public function download($documents) {
    //     $this->load->helper('download');
    //     $filepath = "./uploads/upload_signature/". $documents;
    //     $data = file_get_contents($filepath);
    //     $name = $documents;
    //     force_download($name, $data);
    // }

}
