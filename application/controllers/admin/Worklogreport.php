<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Worklogreport extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("classteacher_model");
        $this->load->model('Timetablenew_model');
        $this->load->model('teacher_model');
        $this->load->helper('lang');
    }

    function index()
    {
        if (!$this->rbac->hasPrivilege('work_log', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'worklog_report/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Work Log Report';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $teacher = $this->staff_model->getStaffbyrole(2);
        $data['teacherlist'] = $teacher;

        $data['usertype'] = $userdata['user_type'];
        $data['userid'] = $userdata['id'];

        // var_dump($data['usertype']);exit;

        $data['is_search'] = false;
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->form_validation->set_rules('datefrom', 'Date From', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dateto', 'Date To', 'trim|required|xss_clean');
            if ($data['usertype'] == 'Super Admin') {

                $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/worklog_report/worklog', $data);
                $this->load->view('layout/footer', $data);
            } else {

                //    $from = $this->input->post('datefrom');
                //    $to = $this->input->post('dateto');
                //    var_dump($to);exit;
                $userdata = $this->customlib->getUserData();
                $teacher_id = $this->input->post('teacher_id');
                $data['is_search'] = true;

                $from = date('d/m/Y', $this->customlib->datetostrtotime($this->input->post('datefrom')));
                $to = date('d/m/Y', $this->customlib->datetostrtotime($this->input->post('dateto')));
                                //    var_dump($from);exit;
                                //    var_dump($to);exit;

                $data['from']=$from;
                $data['to']=$to;




                $data['worklog'] =
                $this->db
                ->select('*')
                ->from('period_report')
                ->join('weekly_calendar', 'weekly_calendar.id=period_report.calendar_id')
                ->where('teacher_id', $teacher_id)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') >= STR_TO_DATE('$from', '%d/%m/%Y')")
                ->where("STR_TO_DATE(date, '%d/%m/%Y') <= STR_TO_DATE('$to', '%d/%m/%Y')")
                ->order_by("EXTRACT(YEAR_MONTH FROM STR_TO_DATE(date, '%d/%m/%Y'))")
                ->get()
                ->result();
            
            

                // print_r($this->db->last_query());
                // exit;

                $this->load->view('layout/header', $data);
                $this->load->view('admin/worklog_report/worklog', $data);
                $this->load->view('layout/footer', $data);
            }


        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/worklog_report/worklog', $data);
            $this->load->view('layout/footer', $data);
        }
    }






    function view($id)
    {
        if (!$this->rbac->hasPrivilege('work_log_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'worklog_report/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;

        $data['logid'] = $id;
        $userdata = $this->customlib->getUserData();
        $userid = $userdata['id'];


        $data['usertype'] = $userdata['user_type'];


        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        // $data['sectionlist'] = $this->section_model->getClassBySection($class_id);

        $data['log'] = $this->db->where('id', $id)->get('work_log')->row_array();

        $this->load->view('layout/header', $data);
        $this->load->view('admin/worklog_report/editworklog', $data);
        $this->load->view('layout/footer', $data);
    }




}

?>