<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
        $this->load->library('encoding_lib');
        $this->load->helper('lang');
        $this->load->model("classteacher_model");
        $this->load->model("timeline_model");
        $this->blood_group = $this->config->item('bloodgroup');
        $this->role;
    }

    function index()
    {

        $data['title'] = 'Student List';
        $student_result = $this->student_model->get();
        $data['studentlist'] = $student_result;
        $this->load->view('layout/header', $data);
        $this->load->view('student/studentList', $data);
        $this->load->view('layout/footer', $data);
    }

    function studentreport()
    {
        if (!$this->rbac->hasPrivilege('student_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/studentreport');
        $data['title'] = 'student fee';
        $data['title'] = 'student fee';
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;
        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $userdata = $this->customlib->getUserData();
        $carray = array();
        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('student/studentReport', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $class = $this->input->post('class_id');
                $section = $this->input->post('section_id');
                $category_id = $this->input->post('category_id');
                $gender = $this->input->post('gender');
                $rte = $this->input->post('rte');
                $search = $this->input->post('search');
                if (isset($search)) {
                    if ($search == 'search_filter') {
                        $resultlist = $this->student_model->searchByClassSectionCategoryGenderRte($class, $section, $category_id, $gender, $rte);
                        $data['resultlist'] = $resultlist;
                    }
                    $data['class_id'] = $class;
                    $data['section_id'] = $section;
                    $data['category_id'] = $category_id;
                    $data['gender'] = $gender;
                    $data['rte_status'] = $rte;
                    $this->load->view('layout/header', $data);
                    $this->load->view('student/studentReport', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
        }
    }

    public function download($student_id, $doc)
    {
        $this->load->helper('download');
        $filepath = "./uploads/student_documents/$student_id/" . $this->uri->segment(4);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }

    function view($id)
    {


        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }

        $data['title'] = 'Student Details';
        $student = $this->student_model->get($id);
        $gradeList = $this->grade_model->get();
        $studentSession = $this->student_model->getStudentSession($id);
        $timeline = $this->timeline_model->getStudentTimeline($id, $status = '');
        $data["timeline_list"] = $timeline;

        $student_session_id = $studentSession["student_session_id"];

        $student_session = $studentSession["session"];
        // $data["session"] = $student_session;       
        $current_student_session = $this->student_model->get_studentsession($student['student_session_id']);

        $data["session"] = $current_student_session["session"];
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);

        $student_discount_fee = $this->feediscount_model->getStudentFeesDiscount($student['student_session_id']);
        $data['student_discount_fee'] = $student_discount_fee;
        $data['student_due_fee'] = $student_due_fee;
        $siblings = $this->student_model->getMySiblings($student['parent_id'], $student['id']);

        $examList = $this->examschedule_model->getExamByClassandSection($student['class_id'], $student['section_id']);
        $data['examSchedule'] = array();
        if (!empty($examList)) {
            $new_array = array();
            foreach ($examList as $ex_key => $ex_value) {
                $array = array();
                $x = array();
                $exam_id = $ex_value['exam_id'];
                $student['id'];
                $exam_subjects = $this->examschedule_model->getresultByStudentandExam($exam_id, $student['id']);
                foreach ($exam_subjects as $key => $value) {
                    $exam_array = array();
                    $exam_array['exam_schedule_id'] = $value['exam_schedule_id'];
                    $exam_array['exam_id'] = $value['exam_id'];
                    $exam_array['full_marks'] = $value['full_marks'];
                    $exam_array['passing_marks'] = $value['passing_marks'];
                    $exam_array['exam_name'] = $value['name'];
                    $exam_array['exam_type'] = $value['type'];
                    $exam_array['attendence'] = $value['attendence'];
                    $exam_array['get_marks'] = $value['get_marks'];
                    $x[] = $exam_array;
                }
                $array['exam_name'] = $ex_value['name'];
                $array['exam_result'] = $x;
                $new_array[] = $array;
            }
            $data['examSchedule'] = $new_array;
        }
        $student_doc = $this->student_model->getstudentdoc($id);
        $data['student_doc'] = $student_doc;
        $data['student_doc_id'] = $id;
        $category_list = $this->category_model->get();
        $data['category_list'] = $category_list;
        $data['gradeList'] = $gradeList;
        $data['student'] = $student;
        $data['siblings'] = $siblings;
        $class_section = $this->student_model->getClassSection($student["class_id"]);
        $data["class_section"] = $class_section;
        $session = $this->setting_model->getCurrentSession();

        $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"], $session);
        $data["studentlistbysection"] = $studentlistbysection; 

        // Bottom Tab
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['id']);
        $fee_excess = $this->studentfeemaster_model->getFeeexcess($id);
        $data['fee_excess'] = $fee_excess;
        $fee_advance = $this->studentfeemaster_model->getFeeadvance($id);
        $data['fee_advance'] = $fee_advance;
 
        $data['excess_balance'] = $this->db->select('amount')->where('student_id', $id)->get('excess_balance')->row()->amount;
        $data['advance_balance'] = $this->db->select('amount')->where('student_id', $id)->get('advance_balance')->row()->amount;
 
        $this->load->view('layout/header', $data);
        $this->load->view('student/studentShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function exportformat()
    {
        $this->load->helper('download');
        $filepath = "./backend/import/import_student_sample_file.csv";
        $data = file_get_contents($filepath);
        $name = 'import_student_sample_file.csv';

        force_download($name, $data);
    }

    function delete($id)
    {
        if (!$this->rbac->hasPrivilege('student', 'can_delete')) {
            access_denied();
        }
        $this->student_model->remove($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Record Deleted Successfully');
        redirect('student/search');
    }

    function doc_delete($id, $student_id)
    {
        $this->student_model->doc_delete($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Document Deleted Successfully');
        redirect('student/view/' . $student_id);
    }

    function returnsubmit($student_id, $id)
    {
        $this->student_model->returnsubmit($id);
        $this->session->set_flashdata('msg', '<i class="fa fa-check-square-o" aria-hidden="true"></i> Document return submit Successfully');
        redirect('student/view/' . $student_id);
    }

    function create()
    {
        if (!$this->rbac->hasPrivilege('student', 'can_add')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/create');
        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $data['title'] = 'Add Student';
        $data['title_list'] = 'Recently Added Student';
        $setting_result = $this->setting_model->get();
        //$student_categorize = $setting_result[0]["student_categorize"];
        //$data["student_categorize"] = $student_categorize ;
        $data["student_categorize"] = 'class';
        $session = $this->setting_model->getCurrentSession();
        $student_result = $this->student_model->getRecentRecord();
        $data['studentlist'] = $student_result;
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
        $sch = $this->student_model->getscholarship();
        $data['sch'] = $sch;

        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $houses = $this->student_model->gethouselist();
        $data['houses'] = $houses;
        $data["bloodgroup"] = $this->blood_group;
        $hostelList = $this->hostel_model->get();
        $data['hostelList'] = $hostelList;
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;

        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_is', 'Guardian', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('rte', 'RTE', 'trim|required|xss_clean');

        $this->form_validation->set_rules('father_name', 'Father Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('father_phone', 'Father Phone', 'trim|required|required|numeric|max_length[25]|min_length[3]');


        $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|required|numeric|max_length[25]|min_length[3]');
        $this->form_validation->set_rules('admission_no', 'Admission No', 'trim|required|xss_clean|is_unique[students.admission_no]');
        /*$this->form_validation->set_rules('kuhs_reg','KUHS Registeration Number','trim|required|xss_clean');
              $this->form_validation->set_rules('annual_income','Annual income','trim|required|xss_clean');*/
        $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        $this->form_validation->set_rules(
            'roll_no',
            'Roll No.',
            array(
                'trim',
                array('check_exists', array($this->student_model, 'valid_student_roll'))
            )
        );


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('layout/header', $data);
            $this->load->view('student/studentCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');

            $fees_discount = $this->input->post('fees_discount');
            $feeyear = $this->input->post('year');

            $vehroute_id = $this->input->post('vehroute_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }

            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $data = array(

                'centre_id' => $centre_id,
                'admission_no' => $this->input->post('admission_no'),
                'roll_no' => $this->input->post('roll_no'),
                'admission_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date'))),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'full_name' => $this->input->post('firstname') . ' ' . $this->input->post('lastname'),
                'mobileno' => $this->input->post('mobileno'),
                'rte' => $this->input->post('rte'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'guardian_is' => $this->input->post('guardian_is'),
                'pincode' => $this->input->post('pincode'),
                'religion' => $this->input->post('religion'),
                'cast' => $this->input->post('cast'),
                'nationality' => $this->input->post('nationality'),
                'previous_school' => $this->input->post('previous_school'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address' => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'image' => 'uploads/student_images/no_image.png',
                'category_id' => $this->input->post('category_id'),
                'adhar_no' => $this->input->post('adhar_no'),
                'samagra_id' => $this->input->post('samagra_id'),
                'kuhs_reg_no' => $this->input->post('kuhs_reg'),
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'father_name' => $this->input->post('father_name'),
                'father_phone' => $this->input->post('father_phone'),
                'father_occupation' => $this->input->post('father_occupation'),
                'mother_name' => $this->input->post('mother_name'),
                'mother_phone' => $this->input->post('mother_phone'),
                'mother_occupation' => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email' => $this->input->post('guardian_email'),
                'annual_income' => $this->input->post('annual_income'),
                'gender' => $this->input->post('gender'),
                'guardian_name' => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone' => $this->input->post('guardian_phone'),
                'guardian_address' => $this->input->post('guardian_address'),
                'vehroute_id' => $vehroute_id,
                'hostel_room_id' => $hostel_room_id,
                'school_house_id' => $this->input->post('house'),
                'year' => $this->input->post('year'),
                'blood_group' => $this->input->post('blood_group'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'note' => $this->input->post('note'),
                'scholarship' => $this->input->post('scholarship'),


                'previous_school' => $this->input->post('previous_school'),
                'qualifying_exam' => $this->input->post('qualifying_exam'),
                'regno' => $this->input->post('regno'),
                'monthyear' => $this->input->post('monthyear'),
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
                'total_mark' => $this->input->post('total_mark'),
                'total_maxmark' => $this->input->post('total_maxmark'),
                'total_per' => $this->input->post('eng_per'),
                'neetname' => $this->input->post('neetname'),
                'neetrank' => $this->input->post('neetrank'),
                'totmark' => $this->input->post('totmark'),
                'maxmark' => $this->input->post('maxmark'),






                'med_previous_school'=>$this->input->post('med_previous_school'),
                'med_qualifying_exam'=>$this->input->post('med_qualifying_exam'),
                'med_regno'=>$this->input->post('med_regno'),
                'med_year'=>$this->input->post('med_year'),
                'dfs'=>$this->input->post('dfs'),
                'first_mbbs_scored'=>$this->input->post('first_mbbs_scored'),
                'first_mbbs_max'=>$this->input->post('first_mbbs_max'),
                'first_mbbs_per'=>$this->input->post('first_mbbs_per'),
                'first_mbbs_year'=>$this->input->post('first_mbbs_year'),
                'second_mbbs_scored'=>$this->input->post('second_mbbs_scored'),
                'second_mbbs_max'=>$this->input->post('second_mbbs_max'),
                'second_mbbs_per'=>$this->input->post('second_mbbs_per'),
                'second_mbbs_year'=>$this->input->post('second_mbbs_year'),
                'third_mbbs_scored'=>$this->input->post('third_mbbs_scored'),
                'third_mbbs_max'=>$this->input->post('third_mbbs_max'),
                'third_mbbs_per'=>$this->input->post('third_mbbs_per'),
                'third_mbbs_year'=>$this->input->post('third_mbbs_year'),
                'third_mbbs_scored2'=>$this->input->post('third_mbbs_scored2'),
                'third_mbbs_per2'=>$this->input->post('third_mbbs_per2'),
                'third_mbbs_year2'=>$this->input->post('third_mbbs_year2'),
                'med_total_scored'=>$this->input->post('med_total_scored'),
                'med_total_max'=>$this->input->post('med_total_max'),
                'med_total_per'=>$this->input->post('med_total_per'),
                'med_total_year'=>$this->input->post('med_total_year'),









                'virtual_acc_no' => 'SJCN' . $this->input->post('admission_no') . date('Y'),
                'is_active' => 'yes',
                'measurement_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')))
            );
            // var_dump( $data);exit;
            $insert_id = $this->student_model->add($data);

            $data_new = array(
                'student_id' => $insert_id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'session_id' => $session,
                'fees_discount' => $fees_discount
            );



            $student_session_id = $this->student_model->add_student_session($data_new);

            $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
            $sibling_id = $this->input->post('sibling_id');
            $data_student_login = array(
                'username' => $this->student_login_prefix . $insert_id,
                'password' => $user_password,
                'user_id' => $insert_id,
                'role' => 'student'
            );
            $this->user_model->add($data_student_login);
            if ($sibling_id > 0) {
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student = array(
                    'id' => $insert_id,
                    'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
            } else {
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                $temp = $insert_id;
                $data_parent_login = array(
                    'username' => $this->parent_login_prefix . $insert_id,
                    'password' => $parent_password,
                    'user_id' => 0,
                    'role' => 'parent',
                    'childs' => $temp
                );

                $ins_parent_id = $this->user_model->add($data_parent_login);
                $update_student = array(
                    'id' => $insert_id,
                    'parent_id' => $ins_parent_id
                );
                $this->student_model->add($update_student);
            }


            /* $promote_fee=$this->studentfeemaster_model->promote_fee($feeyear,$class_id,$section_id);
                      
                      $data_promote=array(
                      'student_session_id'=> $student_session_id,
                      'fee_session_group_id'=>$promote_fee['fee_session_group_id'],
                      'student_id'=>$insert_id
                      
                      );
                      
                      $this->studentfeemaster_model->add_promote($data_promote);*/


            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $insert_id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }
            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $insert_id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $insert_id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $insert_id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["first_doc"]["name"]);
                $first_title = $this->input->post('first_title');
                $file_name = $_FILES['first_doc']['name'];
                $exp = explode(' ', $file_name);
                $imp = implode('_', $exp);
                $img_name = $uploaddir . $imp;
                move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $first_title, 'doc' => $imp);
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["second_doc"]) && !empty($_FILES['second_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["second_doc"]["name"]);
                $second_title = $this->input->post('second_title');
                $file_name = $_FILES['second_doc']['name'];
                $exp = explode(' ', $file_name);
                $imp = implode('_', $exp);
                $img_name = $uploaddir . $imp;
                move_uploaded_file($_FILES["second_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $second_title, 'doc' => $imp);
                $this->student_model->adddoc($data_img);
            }

            if (isset($_FILES["fourth_doc"]) && !empty($_FILES['fourth_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["fourth_doc"]["name"]);
                $fourth_title = $this->input->post('fourth_title');
                $file_name = $_FILES['fourth_doc']['name'];
                $exp = explode(' ', $file_name);
                $imp = implode('_', $exp);
                $img_name = $uploaddir . $imp;
                move_uploaded_file($_FILES["fourth_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $fourth_title, 'doc' => $imp);
                $this->student_model->adddoc($data_img);
            }
            if (isset($_FILES["fifth_doc"]) && !empty($_FILES['fifth_doc']['name'])) {
                $uploaddir = './uploads/student_documents/' . $insert_id . '/';
                if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                    die("Error creating folder $uploaddir");
                }
                $fileInfo = pathinfo($_FILES["fifth_doc"]["name"]);
                $fifth_title = $this->input->post('fifth_title');
                $file_name = $_FILES['fifth_doc']['name'];
                $exp = explode(' ', $file_name);
                $imp = implode('_', $exp);
                $img_name = $uploaddir . $imp;

                move_uploaded_file($_FILES["fifth_doc"]["tmp_name"], $img_name);
                $data_img = array('student_id' => $insert_id, 'title' => $fifth_title, 'doc' => $imp);
                $this->student_model->adddoc($data_img);
            }
            $sender_details = array('student_id' => $insert_id, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
            $this->mailsmsconf->mailsms('student_admission', $sender_details);
            $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $this->input->post('mobileno'), 'email' => $this->input->post('email'));
            $this->mailsmsconf->mailsms('login_credential', $student_login_detail);

            if ($sibling_id > 0) {

            } else {
                $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $this->input->post('guardian_phone'), 'email' => $this->input->post('guardian_email'));
                $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);
            }



            $this->session->set_flashdata('msg', '<div class="alert alert-success">Student added Successfully</div>');
            redirect('student/create');
        }
    }

    function create_doc()
    {
        $student_id = $this->input->post('student_id');
        if (isset($_FILES["first_doc"]) && !empty($_FILES['first_doc']['name'])) {
            $uploaddir = './uploads/student_documents/' . $student_id . '/';
            if (!is_dir($uploaddir) && !mkdir($uploaddir)) {
                die("Error creating folder $uploaddir");
            }
            $fileInfo = pathinfo($_FILES["first_doc"]["name"]);
            $first_title = $this->input->post('first_title');
            $file_name = $_FILES['first_doc']['name'];
            $exp = explode(' ', $file_name);
            $imp = implode('_', $exp);
            $img_name = $uploaddir . basename($imp);
            move_uploaded_file($_FILES["first_doc"]["tmp_name"], $img_name);
            $data_img = array('student_id' => $student_id, 'title' => $first_title, 'doc' => $imp);
            $this->student_model->adddoc($data_img);
        }
        redirect('student/view/' . $student_id);
    }

    function return_doc()
    {
        $documents = $this->input->post('documents');
        $this->form_validation->set_rules('returnfor', 'returnfor', 'trim|required|xss_clean');
        $this->form_validation->set_rules('return_date', 'return_date', 'trim|required|xss_clean');
        if (empty($documents)) {
            $this->form_validation->set_rules('documents', 'documents', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $msg = array(
                'returnfor' => form_error('returnfor'),
                'return_date' => form_error('return_date'),
                'documents' => form_error('documents')
            );

            $array = array('status' => 'fail', 'error' => $msg, 'message' => '');
            echo json_encode($array);
        } else {

            $student_id = $this->input->post('student_id');

            $returnfor = $this->input->post('returnfor');
            $return_date = $this->input->post('return_date');
            $remarks = $this->input->post('remarks');
            $returnsubmitdate = $this->input->post('returnsubmitdate');

            $doc = count($documents);
            //$fdoc=array();
            for ($i = 0; $i < $doc; $i++) {
                $data_img = array(
                    'student_id' => $student_id,
                    'documents' => $documents[$i],
                    'returnfor' => $returnfor,
                    'return_date' => $return_date,
                    'remarks' => $remarks,
                    'returnsubmitdate' => $returnsubmitdate,
                    'status' => 1
                );
                $this->student_model->addreturndoc($data_img);
                //array_push($fdoc,$documents[$i]);
            }
            //$ldoc=implode(',',$fdoc);

            $array = array('status' => 'success', 'error' => '', 'message' => "Return Successfully");
            echo json_encode($array);
            //redirect('student/view/' . $student_id);
        }

    }
    function handle_upload()
    {
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('jpg', 'jpeg', 'png');
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (
                $_FILES["file"]["type"] != 'image/gif' &&
                $_FILES["file"]["type"] != 'image/jpeg' &&
                $_FILES["file"]["type"] != 'image/png'
            ) {
                $this->form_validation->set_message('handle_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('handle_upload', 'Extension not allowed');
                return false;
            }
            if ($_FILES["file"]["size"] > 102400) {
                $this->form_validation->set_message('handle_upload', 'File size shoud be less than 100 kB');
                return false;
            }
            return true;
        } else {
            return true;
        }
    }

    function import()
    {
        if (!$this->rbac->hasPrivilege('import_student', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Import Student';
        $data['title_list'] = 'Recently Added Student';
        $session = $this->setting_model->getCurrentSession();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $category = $this->category_model->get();


        $fields = array('admission_no', 'roll_no', 'firstname', 'lastname', 'gender', 'dob', 'category_id', 'religion', 'cast', 'mobileno', 'email', 'admission_date', 'blood_group', 'school_house_id', 'height', 'weight', 'measurement_date', 'father_name', 'father_phone', 'father_occupation', 'mother_name', 'mother_phone', 'mother_occupation', 'guardian_is', 'guardian_name', 'guardian_relation', 'guardian_email', 'guardian_phone', 'guardian_occupation', 'guardian_address', 'current_address', 'permanent_address', 'bank_account_no', 'bank_name', 'ifsc_code', 'adhar_no', 'samagra_id', 'rte', 'previous_school', 'note');


        $data["fields"] = $fields;
        $data['categorylist'] = $category;
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('file', 'Image', 'callback_handle_csv_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/import', $data);
            $this->load->view('layout/footer', $data);
        } else {

            //$setting_result = $this->setting_model->get();
            // $student_categorize = $setting_result[0]["student_categorize"];
            $student_categorize = 'class';
            if ($student_categorize == 'class') {
                $section = 0;

            } else if ($student_categorize == 'section') {

                $section = $this->input->post('section_id');
            }
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $session = $this->setting_model->getCurrentSession();
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if ($ext == 'csv') {
                    $file = $_FILES['file']['tmp_name'];
                    $this->load->library('CSVReader');
                    $result = $this->csvreader->parse_file($file);
                    // var_dump($result);exit;

                    if (!empty($result)) {
                        $rowcount = 0;
                        for ($i = 1; $i <= count($result); $i++) {

                            $student_data[$i] = array();
                            $n = 0;
                            foreach ($result[$i] as $key => $value) {

                                $student_data[$i][$fields[$n]] = $this->encoding_lib->toUTF8($result[$i][$key]);


                                $student_data[$i]['is_active'] = 'yes';
                                $n++;
                            }

                            $roll_no = $student_data[$i]["roll_no"];
                            $adm_no = $student_data[$i]["admission_no"];
                            $mobile_no = $student_data[$i]["mobileno"];
                            $email = $student_data[$i]["email"];
                            $guardian_phone = $student_data[$i]["guardian_phone"];
                            $guardian_email = $student_data[$i]["guardian_email"];

                            if ($this->form_validation->is_unique($adm_no, 'students.admission_no')) {

                                if (!empty($roll_no)) {

                                    if ($this->student_model->check_rollno_exists($roll_no, 0, $class_id, $section)) {

                                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Record already exists.</div>');
                                        $insert_id = "";
                                    } else {

                                        $insert_id = $this->student_model->add($student_data[$i]);
                                    }
                                } else {
                                    $insert_id = $this->student_model->add($student_data[$i]);

                                }


                            } else {
                                $insert_id = "";
                            }


                            if (!empty($insert_id)) {
                                $data_new = array(
                                    'student_id' => $insert_id,
                                    'class_id' => $class_id,
                                    'section_id' => $section_id,
                                    'session_id' => $session
                                );
                                $this->student_model->add_student_session($data_new);
                                $user_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                                $sibling_id = $this->input->post('sibling_id');
                                $data_student_login = array(
                                    'username' => $this->student_login_prefix . $insert_id,
                                    'password' => $user_password,
                                    'user_id' => $insert_id,
                                    'role' => 'student'
                                );
                                $this->user_model->add($data_student_login);
                                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);
                                $temp = $insert_id;
                                $data_parent_login = array(
                                    'username' => $this->parent_login_prefix . $insert_id,
                                    'password' => $parent_password,
                                    'user_id' => $insert_id,
                                    'role' => 'parent',
                                    'childs' => $temp
                                );
                                $ins_id = $this->user_model->add($data_parent_login);
                                $update_student = array(
                                    'id' => $insert_id,
                                    'parent_id' => $ins_id
                                );
                                $this->student_model->add($update_student);
                                $sender_details = array('student_id' => $insert_id, 'contact_no' => $guardian_phone, 'email' => $guardian_email);
                                $this->mailsmsconf->mailsms('student_admission', $sender_details);


                                $student_login_detail = array('id' => $insert_id, 'credential_for' => 'student', 'username' => $this->student_login_prefix . $insert_id, 'password' => $user_password, 'contact_no' => $mobile_no, 'email' => $email);
                                $this->mailsmsconf->mailsms('login_credential', $student_login_detail);


                                $parent_login_detail = array('id' => $insert_id, 'credential_for' => 'parent', 'username' => $this->parent_login_prefix . $insert_id, 'password' => $parent_password, 'contact_no' => $guardian_phone, 'email' => $guardian_email);
                                $this->mailsmsconf->mailsms('login_credential', $parent_login_detail);
                                $data['csvData'] = $result;
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Students imported successfully</div>');
                                $rowcount++;
                                $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Total ' . count($result) . " records found in CSV file. Total " . $rowcount . ' records imported successfully.</div>');
                            } else {

                                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Records already exists.</div>');
                            }

                        }

                    } else {

                        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">No Data was found.</div>');
                    }
                } else {

                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please upload CSV file only.</div>');
                }
            }

            redirect('student/import');
        }
    }

    function handle_csv_upload()
    {
        $error = "";
        if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
            $allowedExts = array('csv');
            $mimes = array(
                'text/csv',
                'text/plain',
                'application/csv',
                'text/comma-separated-values',
                'application/excel',
                'application/vnd.ms-excel',
                'application/vnd.msexcel',
                'text/anytext',
                'application/octet-stream',
                'application/txt'
            );
            $temp = explode(".", $_FILES["file"]["name"]);
            $extension = end($temp);
            if ($_FILES["file"]["error"] > 0) {
                $error .= "Error opening the file<br />";
            }
            if (!in_array($_FILES['file']['type'], $mimes)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', 'File type not allowed');
                return false;
            }
            if (!in_array($extension, $allowedExts)) {
                $error .= "Error opening the file<br />";
                $this->form_validation->set_message('handle_csv_upload', 'Extension not allowed');
                return false;
            }
            if ($error == "") {
                return true;
            }
        } else {
            $this->form_validation->set_message('handle_csv_upload', 'Please Select file');
            return false;
        }
    }

    function edit($id)
    {
        if (!$this->rbac->hasPrivilege('student', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Student';
        $data['id'] = $id;
        $student = $this->student_model->get($id);
        $genderList = $this->customlib->getGender();
        $data['student'] = $student;
        $data['genderList'] = $genderList;
        $session = $this->setting_model->getCurrentSession();
        $vehroute_result = $this->vehroute_model->get();
        $data['vehroutelist'] = $vehroute_result;
        $class = $this->class_model->get();
        $setting_result = $this->setting_model->get();
        // $student_categorize = $setting_result[0]["student_categorize"];
        // $data["student_categorize"] = $student_categorize ;
        $data["student_categorize"] = 'class';
        $data['classlist'] = $class;
        $feeyear = $this->feemaster_model->getfeeyear();
        $data['feeyearlist'] = $feeyear;
        $sch = $this->student_model->getscholarship();
        $data['sch'] = $sch;
        $category = $this->category_model->get();
        $data['categorylist'] = $category;
        $hostelList = $this->hostel_model->get();
        $data['hostelList'] = $hostelList;
        $houses = $this->student_model->gethouselist();
        $data['houses'] = $houses;
        $data["bloodgroup"] = $this->blood_group;
        $siblings = $this->student_model->getMySiblings($student['parent_id'], $student['id']);
        $data['siblings'] = $siblings;
        $data['siblings_counts'] = count($siblings);
        $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');

        $this->form_validation->set_rules('guardian_is', 'Guardian', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dob', 'Date of Birth', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');
        $this->form_validation->set_rules('rte', 'RTE', 'trim|required|xss_clean');
        $this->form_validation->set_rules('annual_income', 'Annual income', 'trim|required|xss_clean');
        $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|numeric|max_length[25]|min_length[3]');
        $this->form_validation->set_rules(
            'roll_no',
            'Roll No.',
            array(
                'trim',
                array('check_exists', array($this->student_model, 'valid_student_roll'))
            )
        );

        $this->form_validation->set_rules('file', 'Image', 'callback_handle_upload');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $student_id = $this->input->post('student_id');
            $student = $this->student_model->get($student_id);
            $sibling_id = $this->input->post('sibling_id');
            $siblings_counts = $this->input->post('siblings_counts');
            $siblings = $this->student_model->getMySiblings($student['parent_id'], $student_id);
            $total_siblings = count($siblings);


            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $hostel_room_id = $this->input->post('hostel_room_id');
            $fees_discount = $this->input->post('fees_discount');
            $vehroute_id = $this->input->post('vehroute_id');
            if (empty($vehroute_id)) {
                $vehroute_id = 0;
            }
            if (empty($hostel_room_id)) {
                $hostel_room_id = 0;
            }
            $data = array(
                'id' => $id,
                'admission_no' => $this->input->post('admission_no'),
                'roll_no' => $this->input->post('roll_no'),
                'admission_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date'))),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),

                'rte' => $this->input->post('rte'),
                'mobileno' => $this->input->post('mobileno'),
                'email' => $this->input->post('email'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city'),
                'year' => $this->input->post('year'),
                'previous_school' => $this->input->post('previous_school'),
                'guardian_is' => $this->input->post('guardian_is'),
                'pincode' => $this->input->post('pincode'),
                'religion' => $this->input->post('religion'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'current_address' => $this->input->post('current_address'),
                'permanent_address' => $this->input->post('permanent_address'),
                'category_id' => $this->input->post('category_id'),
                'adhar_no' => $this->input->post('adhar_no'),
                'samagra_id' => $this->input->post('samagra_id'),
                'kuhs_reg_no' => $this->input->post('kuhs_reg'),
                'bank_account_no' => $this->input->post('bank_account_no'),
                'bank_name' => $this->input->post('bank_name'),
                'ifsc_code' => $this->input->post('ifsc_code'),
                'nationality' => $this->input->post('nationality'),
                'cast' => $this->input->post('cast'),
                'father_name' => $this->input->post('father_name'),
                'father_phone' => $this->input->post('father_phone'),
                'father_occupation' => $this->input->post('father_occupation'),
                'mother_name' => $this->input->post('mother_name'),
                'mother_phone' => $this->input->post('mother_phone'),
                'mother_occupation' => $this->input->post('mother_occupation'),
                'guardian_occupation' => $this->input->post('guardian_occupation'),
                'guardian_email' => $this->input->post('guardian_email'),
                'gender' => $this->input->post('gender'),
                'annual_income' => $this->input->post('annual_income'),
                'guardian_name' => $this->input->post('guardian_name'),
                'guardian_relation' => $this->input->post('guardian_relation'),
                'guardian_phone' => $this->input->post('guardian_phone'),
                'guardian_address' => $this->input->post('guardian_address'),
                'date_completion' => $this->input->post('course_completion'),
                'vehroute_id' => $vehroute_id,
                'hostel_room_id' => $hostel_room_id,
                'school_house_id' => $this->input->post('house'),
                'blood_group' => $this->input->post('blood_group'),
                'height' => $this->input->post('height'),
                'weight' => $this->input->post('weight'),
                'note' => $this->input->post('note'),
                'scholarship' => $this->input->post('scholarship'),



                'previous_school' => $this->input->post('previous_school'),
                'qualifying_exam' => $this->input->post('qualifying_exam'),
                'regno' => $this->input->post('regno'),
                'monthyear' => $this->input->post('monthyear'),
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
                'total_mark' => $this->input->post('total_mark'),
                'total_maxmark' => $this->input->post('total_maxmark'),
                'total_per' => $this->input->post('eng_per'),
                'neetname' => $this->input->post('neetname'),
                'neetrank' => $this->input->post('neetrank'),
                'totmark' => $this->input->post('totmark'),
                'maxmark' => $this->input->post('maxmark'),






                'med_previous_school'=>$this->input->post('med_previous_school'),
                'med_qualifying_exam'=>$this->input->post('med_qualifying_exam'),
                'med_regno'=>$this->input->post('med_regno'),
                'med_year'=>$this->input->post('med_year'),
                'dfs'=>$this->input->post('dfs'),
                'first_mbbs_scored'=>$this->input->post('first_mbbs_scored'),
                'first_mbbs_max'=>$this->input->post('first_mbbs_max'),
                'first_mbbs_per'=>$this->input->post('first_mbbs_per'),
                'first_mbbs_year'=>$this->input->post('first_mbbs_year'),
                'second_mbbs_scored'=>$this->input->post('second_mbbs_scored'),
                'second_mbbs_max'=>$this->input->post('second_mbbs_max'),
                'second_mbbs_per'=>$this->input->post('second_mbbs_per'),
                'second_mbbs_year'=>$this->input->post('second_mbbs_year'),
                'third_mbbs_scored'=>$this->input->post('third_mbbs_scored'),
                'third_mbbs_max'=>$this->input->post('third_mbbs_max'),
                'third_mbbs_per'=>$this->input->post('third_mbbs_per'),
                'third_mbbs_year'=>$this->input->post('third_mbbs_year'),
                'third_mbbs_scored2'=>$this->input->post('third_mbbs_scored2'),
                'third_mbbs_per2'=>$this->input->post('third_mbbs_per2'),
                'third_mbbs_year2'=>$this->input->post('third_mbbs_year2'),
                'med_total_scored'=>$this->input->post('med_total_scored'),
                'med_total_max'=>$this->input->post('med_total_max'),
                'med_total_per'=>$this->input->post('med_total_per'),
                'med_total_year'=>$this->input->post('med_total_year'),


                
                'measurement_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('measure_date')))
            );
            $this->student_model->add($data);
            $data_new = array(
                'student_id' => $id,
                'class_id' => $class_id,
                'section_id' => $section_id,
                'session_id' => $session,
                'fees_discount' => $fees_discount
            );
            $insert_id = $this->student_model->add_student_session($data_new);
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = $id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'image' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($_FILES["father_pic"]) && !empty($_FILES['father_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["father_pic"]["name"]);
                $img_name = $id . "father" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["father_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'father_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }


            if (isset($_FILES["mother_pic"]) && !empty($_FILES['mother_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["mother_pic"]["name"]);
                $img_name = $id . "mother" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["mother_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'mother_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }


            if (isset($_FILES["guardian_pic"]) && !empty($_FILES['guardian_pic']['name'])) {
                $fileInfo = pathinfo($_FILES["guardian_pic"]["name"]);
                $img_name = $id . "guardian" . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["guardian_pic"]["tmp_name"], "./uploads/student_images/" . $img_name);
                $data_img = array('id' => $id, 'guardian_pic' => 'uploads/student_images/' . $img_name);
                $this->student_model->add($data_img);
            }

            if (isset($siblings_counts) && ($total_siblings == $siblings_counts)) {
                //if there is no change in sibling
            } else if (!isset($siblings_counts) && $sibling_id == 0 && $total_siblings > 0) {
                // add for new parent
                $parent_password = $this->role->get_random_password($chars_min = 6, $chars_max = 6, $use_upper_case = false, $include_numbers = true, $include_special_chars = false);

                $data_parent_login = array(
                    'username' => $this->parent_login_prefix . $student_id . "_1",
                    'password' => $parent_password,
                    'user_id' => "",
                    'role' => 'parent',
                );

                $update_student = array(
                    'id' => $student_id,
                    'parent_id' => 0,
                );
                $ins_id = $this->user_model->addNewParent($data_parent_login, $update_student);
            } else if ($sibling_id != 0) {
                //join to student with new parent
                $student_sibling = $this->student_model->get($sibling_id);
                $update_student = array(
                    'id' => $student_id,
                    'parent_id' => $student_sibling['parent_id'],
                );
                $student_sibling = $this->student_model->add($update_student);
            } else {

            }


            $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">Student Record Updated successfully</div>');
            redirect('student/search');
        }
    }

    function search()
    {

        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/search');
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentSearch', $data);
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
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');

                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
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
            $this->load->view('layout/header', $data);
            $this->load->view('student/studentSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    function passedout()
    {

        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/search');
        $data['title'] = 'Student Search';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/passedoutstudents', $data);
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
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');

                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
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
            $this->load->view('layout/header', $data);
            $this->load->view('student/passedoutstudents', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function getByClassAndSection()
    {
        $class = $this->input->get('class_id');
        $section = $this->input->get('section_id');
        //$fee_groups_feetype= $this->input->get('fee_groups_feetype');
        $resultlist = $this->student_model->searchByClassSection($class, $section);
        echo json_encode($resultlist);
    }
    function getByClassAndSectionExcludeMe()
    {
        $class = $this->input->get('class_id');
        $section = $this->input->get('section_id');
        $student_id = $this->input->get('current_student_id');
        $resultlist = $this->student_model->searchByClassSectionWithoutCurrent($class, $section, $student_id);
        echo json_encode($resultlist);
    }

    function getStudentRecordByID()
    {
        $student_id = $this->input->get('student_id');
        $resultlist = $this->student_model->get($student_id);
        echo json_encode($resultlist);
    }

    function uploadimage($id)
    {
        $data['title'] = 'Add Image';
        $data['id'] = $id;
        $this->load->view('layout/header', $data);
        $this->load->view('student/uploadimage', $data);
        $this->load->view('layout/footer', $data);
    }

    public function doupload($id)
    {
        $config = array(
            'upload_path' => "./uploads/student_images/",
            'allowed_types' => "gif|jpg|png|jpeg|df",
            'overwrite' => TRUE,
        );
        $config['file_name'] = $id . ".jpg";
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if ($this->upload->do_upload()) {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();
            $data_record = array('id' => $id, 'image' => $upload_data['file_name']);
            $this->setting_model->add($data_record);

            $this->load->view('upload_success', $data);
        } else {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('file_view', $error);
        }
    }

    function getlogindetail()
    {
        if (!$this->rbac->hasPrivilege('student_parent_login_details', 'can_view')) {
            access_denied();
        }
        $student_id = $this->input->post('student_id');
        $examSchedule = $this->user_model->getStudentLoginDetails($student_id);
        echo json_encode($examSchedule);
    }

    function getUserLoginDetails()
    {
        $studentid = $this->input->post("student_id");
        $result = $this->user_model->getUserLoginDetails($studentid);
        echo json_encode($result);
    }

    function guardianreport()
    {
        if (!$this->rbac->hasPrivilege('guardian_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/guardianreport');
        $data['title'] = 'Student Guardian Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $class_id = $this->input->post("class_id");
        $section_id = $this->input->post("section_id");

        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

            $resultlist = $this->student_model->studentGuardianDetails($carray);
            $data["resultlist"] = $resultlist;
        } else {


            $resultlist = $this->student_model->searchGuardianDetails($class_id, $section_id);
            $data["resultlist"] = $resultlist;
        }

        $this->load->view("layout/header", $data);
        $this->load->view("student/guardianReport", $data);
        $this->load->view("layout/footer", $data);
    }

    function disablestudentslist()
    {

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/disablestudentslist');
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $result = $this->student_model->getdisableStudent();
        $data["resultlist"] = $result;

        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {

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
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');

                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->disablestudentByClassSection($class, $section);
                        $data['resultlist'] = $resultlist;
                        $title = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title'] = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));
                    $resultlist = $this->student_model->disablestudentFullText($search_text);
                    $data['resultlist'] = $resultlist;
                    $data['title'] = 'Search Details: ' . $data['search_text'];
                }
            }
        }

        $this->load->view("layout/header", $data);
        $this->load->view("student/disablestudents", $data);
        $this->load->view("layout/footer", $data);
    }

    function disablestudent($id)
    {

        $data = array('is_active' => "no", 'disable_at' => date("Y-m-d"));
        $this->student_model->disableStudent($id, $data);
        redirect("student/view/" . $id);
    }

    function enablestudent($id)
    {

        $data = array('is_active' => "yes");
        $this->student_model->disableStudent($id, $data);
        redirect("student/view/" . $id);
    }



    function cumulative_record()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $student_id = $this->input->post('student_id');
        $student_session_id = $this->input->post('student_session_id');
        $data['working_days'] = $this->student_model->get_working_days($student_session_id);
        $data['student'] = $this->student_model->get_cumulative_record($student_session_id);
        $data['markdetails'] = $this->student_model->get_markdetails($student_id);

        $data['character'] = $this->student_model->get_remarks($class_id, $section_id, $student_id);


        $data['appearence'] = $this->student_model->get_appearence($student_id);




        $this->load->view("reports/cumulative_record", $data);



    }

    function kuhs()
    {
        if (!$this->rbac->hasPrivilege('update_kuhs', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/update_kuhs');

        $class = $this->class_model->get();
        $data['classlist'] = $class;

        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header', $data);
            $this->load->view('student/update_kuhs', $data);
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
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');

                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchByClassSection($class, $section);
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
            }


            $this->load->view('layout/header', $data);
            $this->load->view('student/update_kuhs', $data);
            $this->load->view('layout/footer', $data);
        }
    }



    function update_kuhs()
    {

        $i = $this->input->post('i');
        foreach ($i as $key => $student_id) {
            $data = array(
                'id' => $student_id,
                'kuhs_reg_no' => $this->input->post('kuhs_' . $student_id)
            );

            $this->student_model->up_kuhs($data);

        }

        $this->session->set_flashdata('msg', '<div student="alert alert-success text-left">Student Record Updated successfully</div>');
        redirect('student/kuhs');
    }


    function feedreport()
    {
        if (!$this->rbac->hasPrivilege('parent_feedback', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'student/feedreport');
        $data['title'] = 'Parent Feedback';
        $userdata = $this->customlib->getUserData();
        $resultlist = $this->student_model->getfeedparent();
        $data["resultlist"] = $resultlist;
        // var_dump($resultlist);

        $this->load->view("layout/header", $data);
        $this->load->view("student/parentfeed", $data);
        $this->load->view("layout/footer", $data);
    }
    function staff_tpreport()
    {
        if (!$this->rbac->hasPrivilege('stafftheory_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Staff TP Report');
        $this->session->set_userdata('sub_menu', 'student/staff_tpreport');
        $data['title'] = 'Staff TP Report';
        $userdata = $this->customlib->getUserData();
        $resultlist = $this->student_model->gettpreport();
        $data["resultlist"] = $resultlist;
        // var_dump($resultlist);

        $this->load->view("layout/header", $data);
        $this->load->view("student/staff_tpreport", $data);
        $this->load->view("layout/footer", $data);
    }


    function staff_clireport()
    {
        if (!$this->rbac->hasPrivilege('staffclini_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Staff Clinical Report');
        $this->session->set_userdata('sub_menu', 'student/staff_clireport');
        $data['title'] = 'Staff Clinical Report';
        $userdata = $this->customlib->getUserData();
        $resultlist = $this->student_model->getclireport();
        $data["resultlist"] = $resultlist;
        // var_dump($resultlist);

        $this->load->view("layout/header", $data);
        $this->load->view("student/staffcli_report", $data);
        $this->load->view("layout/footer", $data);
    }







    function feeds($id)
    {


        if (!$this->rbac->hasPrivilege('parent_feedback', 'can_view')) {
            access_denied();
        }

        $data['title'] = 'Parent Feedback';
        $session = $this->setting_model->getCurrentSession();
        $userdata = $this->customlib->getUserData();
        $resultlist = $this->student_model->getfeedparentnew($id);
        $data["resultlist"] = $resultlist;
        // var_dump($resultlist);
        $parent_id = $resultlist['par_id'];
        $this->load->view('layout/header', $data);
        $this->load->view('student/parfeed', $data);
        $this->load->view('layout/footer', $data);
    }

    public function CheckKuhs()
    {
        $value = $this->input->post('value');
        $result = $this->student_model->CheckKuhsDuplicate($value);

        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode("ok");

        }

    }









}

?>