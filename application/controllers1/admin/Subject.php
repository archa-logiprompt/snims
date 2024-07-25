<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Subject extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('file');
        //   $this->lang->load('message', 'english');
    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/index');
        $data['title'] = 'Add Subject';
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        // var_dump($data['subjectlist']);

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        // var_dump( $centre_id);exit;
        $data['centre_id']=$centre_id;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/subjectList', $data);
        $this->load->view('layout/footer', $data);
    }
    public function subjecthours()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/subjecthours');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2);
        $data['teacherlist'] = $teacher;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['is_search'] = false;

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $class_id = $this->input->post('class_id');
            $sections = $this->section_model->getClassBySection($class_id);

            $data['is_search'] = true;



            foreach ($sections as $key => $section) {


                $where_array = [
                    'section_id' => $section['section_id'],
                    'class_id' => $class_id,
                ];

                $subject_hours = $this->db->where($where_array)->get('subject_hours')->result_array();

                $sections[$key]['subject_hours'] = $subject_hours;


            }


            $data['sections'] = $sections;





            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthours', $data);
            $this->load->view('layout/footer', $data);

        } else {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthours', $data);
            $this->load->view('layout/footer', $data);
        }
    }

 public function academic_date_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('academic_date');

        redirect('admin/subject/academicDate');
    }



    public function combinedSubject()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/combinedsubject');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $subject1 = $this->input->post("sub1");
            $subject2 = $this->input->post("sub2");

            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'subject1' => $subject1,
                'subject2' => $subject2,
            ];

            $this->db->insert('combined_subject', $insert_array);



            redirect('admin/subject/combinedSubject');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['date_items'] = $this->db->get('combined_subject')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/combinedsubject', $data);
        $this->load->view('layout/footer', $data);
    }


    public function combinedSubjectdelete($id)
    {
        $this->db->where('id', $id)->delete('combined_subject');
        redirect('admin/subject/combinedSubject');
    }
    public function combinedSubjectedit($id)
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/combinedsubject');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            // $this->load->view('layout/header', $data);
            // $this->load->view('admin/subject/combinedsubjectedit', $data);
            // $this->load->view('layout/footer', $data);
        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $subject1 = $this->input->post("sub1");
            $subject2 = $this->input->post("sub2");

            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'subject1' => $subject1,
                'subject2' => $subject2,
            ];

            $this->db->where('id', $id)->update('combined_subject', $insert_array);

            redirect('admin/subject/combinedSubjectedit/' . $id);
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;
        $data['itemid'] = $id;

        $res = $this->db->where('id', $id)->get('combined_subject')->row_array();

        $data['item'] = $res;
        $data['items'] = $this->db->get('combined_subject')->result_array();
        $data['class_id'] = $res['class_id'];
        $data['section_id'] = $res['section_id'];

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/combinedsubjectedit', $data);
        $this->load->view('layout/footer', $data);
    }
    public function assignsubjecthours()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/subjecthours');
        $data['title'] = 'Assign Teacher with Class and Subject wise';
        //$teacher = $this->teacher_model->get();
        $teacher = $this->staff_model->getStaffbyrole(2);
        $data['teacherlist'] = $teacher;
        // var_dump($teacher);exit;
        $subject = $this->subject_model->get();
        $data['subjectlist'] = $subject;
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['is_search'] = false;
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $data['is_search'] = true;
            $data['is_update'] = 0;

            // var_dump($this->input->post());exit;
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $data['subjects'] = $this->teachersubject_model->getSubjectByClsandSectionNew($data['class_id'], $data['section_id']);


            // foreach($data['subjects'] as $subject){

            $where_array = [
                'class_id' => $data['class_id'],
                'section_id' => $data['section_id'],

            ];



            $subject_hour[] = $this->db
                ->where($where_array)
                ->get('subject_hours')
                ->result_array();

            // }

            $data['subject_hour'] = $subject_hour[0];


            // var_dump($data['subject_hour']);exit;

            if (count($subject_hour[0]) > 0) {
                $data['is_update'] = 1;
            }


            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthoursassign', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjecthoursassign', $data);
            $this->load->view('layout/footer', $data);

        }
    }


    public function academicDate()
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/academicDate');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dateto', 'Date To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Date From', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $datefrom = $this->input->post("datefrom");
            $dateto = $this->input->post("dateto");


            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'from' => $datefrom,
                'to' => $dateto,
            ];

            $this->db->insert('academic_date', $insert_array);



            redirect('admin/subject/academicDate');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['date_items'] = $this->db->get('academic_date')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/academicdate', $data);
        $this->load->view('layout/footer', $data);
    }
    public function academicDateEdit($id)
    {
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'subject/academicDate');
        $data['title'] = 'Academic Date';
        $data['title_list'] = 'Academic Date';


        $this->form_validation->set_rules('section', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('dateto', 'Date To', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class', 'Date From', 'trim|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {

        } else {

            $class = $this->input->post("class");
            $section = $this->input->post("section");
            $datefrom = $this->input->post("datefrom");
            $dateto = $this->input->post("dateto");


            $insert_array = [
                'class_id' => $class,
                'section_id' => $section,
                'from' => $datefrom,
                'to' => $dateto,
            ];

            $this->db->where('id', $id)->update('academic_date', $insert_array);

            redirect('admin/subject/academicDate');
        }
        $classlist = $this->class_model->get();
        $data['classlist'] = $classlist;

        $sectionlist = $this->section_model->get();
        $data['sectionlist'] = $sectionlist;



        $data['item'] = $this->db->where('id', $id)->get('academic_date')->row_array();
        $data['date_items'] = $this->db->get('academic_date')->result_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/academicdateedit', $data);
        $this->load->view('layout/footer', $data);
    }

    public function savesubjecthour()
    {

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        $subjects = $this->input->post('subject_id');
        $theory_credits = $this->input->post('theory_credits');
        $theory_hours = $this->input->post('theory_hours');
        $lab_credits = $this->input->post('lab_credits');
        $lab_hours = $this->input->post('lab_hours');
        $clinical_credits = $this->input->post('clinical_credits');
        $clinical_hours = $this->input->post('clinical_hours');
        $is_update = $this->input->post('is_update');



        

        foreach ($subjects as $key => $subject) {

            $insert_array = [
                'class_id' => $class_id,
                'section_id' => $section_id,
                'subject_id' => $subject,
                'theory_credits' => $theory_credits[$key],
                'theory_hours' => $theory_hours[$key],
                'lab_credits' => $lab_credits[$key],
                'lab_hours' => $lab_hours[$key],
                'clinical_credits' => $clinical_credits[$key],
                'clinical_hours' => $clinical_hours[$key],

            ]; 

            $where_array = array(
                'class_id' => $class_id,
                'section_id' => $section_id,
                'subject_id' => $subject,
            );

            // Check if the row exists
            $this->db->where($where_array);
            $query = $this->db->get('subject_hours');

            // var_dump($insert_array);exit;
            if ($query->num_rows() > 0) {
                // Row exists, perform an update
                $this->db->where($where_array)->update('subject_hours', $insert_array);
            } else { 
                
                $this->db->insert('subject_hours', $insert_array);
            }
 

        }



        redirect('admin/subject/assignsubjecthours');

    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
        $subject = $this->subject_model->get($id);
        $data['subject'] = $subject;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/subject/subjectShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Subject List';
        $this->subject_model->remove($id);
        redirect('admin/subject/index');
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add subject';
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        // var_dump($data['subjectlist']);exit;
        //$this->form_validation->set_rules('name', 'Subject Name', 'trim|required|xss_clean|callback__check_name_exists');
        $this->form_validation->set_rules('name', 'Subject Name', 'trim|required|xss_clean');
        if ($this->input->post('code')) {
            $this->form_validation->set_rules('code', 'Code', 'trim|required|callback__check_code_exists');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectList', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $data = array(
                'centre_id' => $centre_id,
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'theory' => $this->input->post('theory'),
                'viva' => $this->input->post('viva'),
                'practical' => $this->input->post('practical'),
                'lab' => $this->input->post('lab'),

                'cocurricular' => $this->input->post('cocurricular'),


            );
            // var_dump($data);exit;
            $this->subject_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject added successfully</div>');
            redirect('admin/subject/index');
        }
    }

    public function _check_name_exists()
    {
        $data['name'] = $this->security->xss_clean($this->input->post('name'));
        if ($this->subject_model->check_data_exists($data)) {
            $this->form_validation->set_message('_check_name_exists', 'Name already exists');
            return false;
        } else {
            return true;
        }
    }

    public function _check_code_exists()
    {
        $data['code'] = $this->security->xss_clean($this->input->post('code'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code_exists', 'Code already exists');
            return false;
        } else {
            return true;
        }
    }

    public function _check_code1_exists()
    {
        $data['code1'] = $this->security->xss_clean($this->input->post('code1'));
        if ($this->subject_model->check_code_exists($data)) {
            $this->form_validation->set_message('_check_code1_exists', 'Code already exists');
            return false;
        } else {
            return true;
        }
    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('subject', 'can_edit')) {
            access_denied();
        }
        $subject_result = $this->subject_model->get();
        $data['subjectlist'] = $subject_result;
        $data['title'] = 'Edit Subject';
        $data['id'] = $id;
        $subject = $this->subject_model->get($id);
        $data['subject'] = $subject;
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        // var_dump( $centre_id);exit;
        $data['centre_id']=$centre_id;
        $this->form_validation->set_rules('name', 'Subject', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/subject/subjectEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'code' => $this->input->post('code'),
                'theory' => $this->input->post('theory'),
                'viva' => $this->input->post('viva'),
                'practical' => $this->input->post('practical'),
                'lab' => $this->input->post('lab'),
                'cocurricular' => $this->input->post('cocurricular'),

            );
            $this->subject_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Subject updated successfully</div>');
            redirect('admin/subject/index');
        }
    }

    public function getSubjctByClassandSection()
    {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $date = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id);
        echo json_encode($date);
    }

}