<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class TemporaryUser extends Temporary_Student_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("live_class_model");
        $this->load->model("Temporary_admission_model");
        $this->load->library('form_validation');
    }

    public function index()
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
        $section= $this->Temporary_admission_model->getsections();
        $data['section']=$section;
         $data['commentdetails']=$this->Temporary_admission_model->commentdetails($userdata['id']);
         $existing_details=$this->Temporary_admission_model->getexistingdetails($userdata['id']);
         $data['existing_details']=$existing_details;
         $getdatafromstudentdetails=$this->Temporary_admission_model->getdatafromstudentdetails($userdata['id']);
         $data['getdatafromstudentdetails']= $getdatafromstudentdetails;
 
         
        $this->load->view('temporarystudent/header',$data);
        $this->load->view('temporarystudent/home', $data);
    }


    public function create()
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
        
        $existing_details=$this->Temporary_admission_model->getexistingdetails($userdata['id']);
        $data['existing_details']=$existing_details;

        $getdatafromstudentdetails=$this->Temporary_admission_model->getdatafromstudentdetails($userdata['id']);
        $data['getdatafromstudentdetails']= $getdatafromstudentdetails;
        $data['commentdetails']=$this->Temporary_admission_model->commentdetails($userdata['id']);

        $section= $this->Temporary_admission_model->getsections();
        $data['section']=$section;
      
        // var_dump(  $data['getdatafromstudentdetails']);exit;
        // $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('admission_no', 'Admission Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('kuhs_reg', 'centre or board registration', 'trim|required|xss_clean');
        $this->form_validation->set_rules('roll_no', 'Roll Number', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class Id', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('section_id', 'Section Id', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('lastname', 'Last Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('dob', 'DOB', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('age', 'Age', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('category_id', 'Category Id', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('religion', 'Religion', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('cast', 'Cast', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('mobileno', 'Mobile Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('year', 'Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('admission_date', 'Admission Date', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('file', 'File', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('blood_group', 'Blood Group', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('height', 'Height', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('weight', 'Weight', 'trim|required|xss_clean');



        // $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('annual_income', 'Annual Income', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('adhar_no', 'Adhar Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('fees_discount', 'Fees Discount', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('father_name', 'Father Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('father_phone', 'Father Phone', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('father_occupation', 'Father Occupation', 'trim|required|xss_clean');



        // $this->form_validation->set_rules('father_pic', 'father Picture', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('mother_name', 'Mother Name', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('mother_phone', 'Mother Phone', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('mother_occupation', 'Mother Occupation', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('mother_pic', 'Mother Pic', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_is', 'Guardian Is', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_name', 'Guardian Name', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('guardian_relation', 'Guardian Relation', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_phone', 'Guardian Phone', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_occupation', 'Guardian Occupation', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_email', 'Guardian Email', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_pic', 'Guardian Picture', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('guardian_address', 'Guardian Address', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('autofill_current_address', 'Autofill Current Address', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('current_address', 'Current Address', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('permanent_address', 'Permanent Address', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('qualifying_exam', 'Qualifying Exam', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('regno', 'Register Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('monthyear', 'Month Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('total_mark', 'Total Mark', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('neetrank', 'Neet Rank', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('totmark', 'Total Mark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('chem_markob', 'Chemistry Markob', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('chem_maxmark', 'Chemistry Maxmark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('chem_per', 'Chemistry per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('phy_markob', 'physics Markob', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('phy_maxmark', 'physics Maxmark', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('phy_per', 'physics per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bio_markob', 'Biology Markob', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bio_maxmark', 'Biology Maxmark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bio_per', 'Biology per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('tot1', 'Total1', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('tot2', 'Total2', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('tot3', 'Total3', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('eng_markob', 'English Markob', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('eng_maxmark', 'English Maxmark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('eng_per', 'English Per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('total_maxmark', 'Total Maxmark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('total_per', 'Total Per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_previous_school', 'Previous School', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_qualifying_exam', 'Med Qualifying Exam', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('med_regno', 'Med Register Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_year', 'Med Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('dfs', 'DFS', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('first_mbbs_scored', 'First MBBS Scored', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('first_mbbs_max', 'First MBBS Max', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('first_mbbs_per', 'First MBBS Per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('first_mbbs_year', 'First MBBS Year', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('second_mbbs_scored', 'Second MBBS Scored', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('second_mbbs_max', 'Second MBBS Max', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('second_mbbs_per', 'Second MBBS Per', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('second_mbbs_year', 'Second MBBS Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_scored', 'Third MBBS Scored', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_max', 'Third MBBS Max', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_per', 'Third MBBS Per', 'trim|required|xss_clean');


        // $this->form_validation->set_rules('third_mbbs_year', 'Third MBBS Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_scored2', 'Third MBBS Scored2', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_max2', 'Third MBBS Max2', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_per2', 'Third MBBS Per2', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('third_mbbs_year2', 'Third MBBS Year2', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_total_scored', 'Med Total Scored', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_total_per', 'Med Total Per', 'trim|required|xss_clean');



        // $this->form_validation->set_rules('med_total_year', 'Med Total Year', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('med_total_max', 'Med Total Max', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_reg', 'Neet Register Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_rank', 'Neet Rank', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_marks', 'Neet Marks', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_phy_mark_obtained', 'Neet physics Mark Obtained', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_chem_mark_obtained', 'Neet chemistry MarK Obtained', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('neet_bio_mark_biology', 'Neet Biology Mark', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('neet_percentile', 'Neet Percentile', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('keam_roll_no', 'keam Roll Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('kerala_medical_rank', 'Kerala Medical Rank', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('seat_type', 'SeatType', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bank_account_no', 'Bank Account Number', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('bank_name', 'Bank Name', 'trim|required|xss_clean');

        // $this->form_validation->set_rules('ifsc_code', 'IFSC Code', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('samagra_id', 'Samagra Id', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('rte', 'RTE', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('previous_school', 'Previous School', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('note', 'Note', 'trim|required|xss_clean');
        // $this->form_validation->set_rules('scholarship', 'Scholarship', 'trim|required|xss_clean');



        if ($this->form_validation->run() == FALSE) {

            $this->load->view('temporarystudent/header', $data);
            $this->load->view('temporarystudent/home', $data);
        } else {

            $data = array(
                'user_id'=>$userdata['id'],
                'admission_no' => $this->input->post('admission_no'),
                'kuhs_reg' => $this->input->post('kuhs_reg'),
                'roll_no' => $this->input->post('roll_no'),
                'class_id' => $this->input->post('class_id'),
                'section_id' => $this->input->post('section_id'),
                // 'full_name' => $this->input->post('firstname') . ' ' . $this->input->post('lastname'),
                // 'firstname' => $this->input->post('firstname'),
                // 'lastname' => $this->input->post('lastname'),
                'gender' => $this->input->post('gender'),
                'dob' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('dob'))),
                'age' => $this->input->post('age'),
                'category_id' => $this->input->post('category_id'),
                'religion' => $this->input->post('religion'),
                'cast' => $this->input->post('cast'),
                // 'mobileno' => $this->input->post('mobileno'),
                // 'email' => $this->input->post('email'),

                'year' => $this->input->post('year'),
                'admission_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('admission_date'))),
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

                'previous_school'=>$this->input->post('previous_school'),
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

            $this->session->set_flashdata('msg1', '<div class="alert alert-success">Student data has been Updated Successfully</div>');
            redirect('temporary_user/TemporaryUser');
        }
    }

    function getByClass()
    {
        $class_id = $this->input->get('class_id');
        $data = $this->Temporary_admission_model->getSectionByClass($class_id);
        return ($data);
    }
}
