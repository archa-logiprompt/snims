<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stuattendence extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->config->load("mailsms");
        $this->load->library('mailsmsconf');
        $this->load->library('smsgateway');
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("classteacher_model");
    }

    public function index()
    {

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/index');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {
                $carray[] = $cvalue["id"];
            }
        }
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['subject_id'] = "";
        $data['date'] = "";
        $data['stime'] = "";
        $data['etime'] = "";
        $data['topic'] = "";
        $data['stopic'] = "";
        $data['types'] = "";
        $data['total_hour'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin = $this->session->userdata('admin');
            $centre_id = $admin['centre_id'];
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $date = $this->input->post('date');
            $types = $this->input->post('types');
            $etime = $this->input->post('etime');
            $stime = $this->input->post('stime');
            $topic = $this->input->post('topic');
            $stopic = $this->input->post('stopic');
            $session_id = $this->setting_model->getCurrentSession();
            // var_dump($session_id);
            $student_list = $this->stuattendence_model->get();

           
            $data['studentlist'] = $student_list;
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['date'] = $date;
            $data['stime'] = $stime;
            $data['types'] = $types;
            $data['etime'] = $etime;
            $data['topic'] = $topic;
            $data['stopic'] = $stopic;
            //$data['total_hour'] = $total_hour;
            $search = $this->input->post('search');
            $holiday = $this->input->post('holiday');
            if ($search == "saveattendence") {
                $class = $this->input->post('class_id');
                $section = $this->input->post('section_id');
                $sub = getsubjectid($this->input->post('subject_id'));
                $subjectid = $sub;
                $date = $this->input->post('date');
                $etime = strtotime($this->input->post('etime'));
                $stime = strtotime($this->input->post('stime'));
                $topic = $this->input->post('topic');
                $stopic = $this->input->post('stopic');
                $types = $this->input->post('types');

                // $total_hour=strtotime($etime)-strtotime($stime);
                $hours = round(abs($etime - $stime) / 60, 2);
                $total_hour = ($hours / 60);

                //echo $hours; exit;
                $session_id = $this->setting_model->getCurrentSession();
                $marray = array('class_id' => $class,
                    'section_id' => $section,
                    'subject_id' => $subjectid,
                    'stime' => $stime,
                    'etime' => $etime,
                    'topic' => $topic,
                    'stopic' => $stopic,
                    'types' => $types,
                    'status' => 0,
                    'sid' => $admin['id'],
                    'session_id' => $session_id,
                    'total_hour' => $total_hour,
                    'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                $insert_id = $this->stuattendence_model->adds($marray);
                $session_ary = $this->input->post('student_session');

                $absent_student_list = array();
                $test = array();

                foreach ($session_ary as $key => $value) {
                    //echo 1;
                    $remark = $this->input->post('remarks' . $value);

                    $checkForUpdate = $this->input->post('attendendence_id' . $value);
                    $type = $this->input->post('attendencetype' . $value);

                    if ($checkForUpdate != 0) {
                        $session_id = $this->setting_model->getCurrentSession();
                        if (isset($holiday)) {

                            $arr = array('id' => $checkForUpdate,
                                'centre_id' => $centre_id,

                                'student_session_id' => $value,
                                'session_id' => $session_id,
                                'attendence_type_id' => 5,
                                'subject_id' => $subject,
                                'total_hour' => $total_hour,
                                'stime' => date('Y-m-d', $this->customlib->datetostrtotime($stime)),
                                'etime' => date('Y-m-d', $this->customlib->datetostrtotime($etime)),
                                'topic' => $topic,
                                'stopic' => $stopic,
                                'types' => $types,
                                'status' => 0,
                                'remark' => $this->input->post("remarks" . $value),
                                'staff_id' => $admin['id'],
                                //var_dump($admin);
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                        } else {
                            $admin = $this->session->userdata('admin');

                            $centre_id = $admin['centre_id'];
                            $arr = array('id' => $checkForUpdate,
                                'centre_id' => $centre_id,
                                'student_session_id' => $value,
                                'session_id' => $session_id,
                                'attendence_type_id' => $this->input->post('attendencetype' . $value),
                                'subject_id' => $subject,
                                'total_hour' => $total_hour,
                                'stime' => date('Y-m-d', $this->customlib->datetostrtotime($stime)),
                                'etime' => date('Y-m-d', $this->customlib->datetostrtotime($etime)),
                                'topic' => $topic,
                                'stopic' => $stopic,
                                'types' => $types,
                                'status' => 0,
                                'remark' => $this->input->post("remarks" . $value),
                                'staff_id' => $admin['id'],
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                        }
                        // var_dump($arr);exit;
                        $insert_id = $this->stuattendence_model->add($arr);
                        // print_r($this->db->last_query());exit;

                    } else {
                        $session_id = $this->setting_model->getCurrentSession();

                        if (isset($holiday)) {
                            $arr = array('student_session_id' => $value,
                                'centre_id' => $centre_id,
                                'session_id' => $session_id,
                                'attendence_type_id' => 5,
                                'subject_id' => $subject,
                                'total_hour' => $total_hour,
                                'stime' => date('Y-m-d', $this->customlib->datetostrtotime($stime)),
                                'etime' => date('Y-m-d', $this->customlib->datetostrtotime($etime)),
                                'topic' => $topic,
                                'types' => $types,
                                'status' => 0,
                                'stopic' => $stopic,
                                'remark' => $this->input->post("remarks" . $value),
                                'staff_id' => $admin['id'],
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                        } else {

                            $arr = array('student_session_id' => $value,
                                'centre_id' => $centre_id,
                                'session_id' => $session_id,
                                'attendence_type_id' => $this->input->post('attendencetype' . $value),
                                'subject_id' => $subject,
                                'total_hour' => $total_hour,
                                'stime' => date('Y-m-d', $this->customlib->datetostrtotime($stime)),
                                'etime' => date('Y-m-d', $this->customlib->datetostrtotime($etime)),
                                'topic' => $topic,
                                'stopic' => $stopic,
                                'types' => $types,
                                'status' => 0,
                                'remark' => $this->input->post("remarks" . $value),
                                'staff_id' => $admin['id'],
                                'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                        }

                        $insert_id = $this->stuattendence_model->add($arr);
                        //var_dump($arr);exit;
                        if ($arr['attendence_type_id'] == 4) {
                            $absent_student = $this->stuattendence_model->getparentstudentdetail($arr);
                            $d = date('Y-m-d', $this->customlib->datetostrtotime($date));
                            //$msg='ATTENDANCE- Dear Parent,  Your ward '.$absent_student[0]['firstname'].' was absent today '.$d.' for the class '.$absent_student[0]['class'].$absent_student[0]['section'].'

//Pushpagiri College of Dental Sciences';
                            $class = substr($absent_student[0]['class'], 0, 5);
//$result = substr($myStr, 0, 5);
                            $msg = 'ATTENDANCE- Dear Parent,  Your ward ' . $absent_student[0]['firstname'] . ' was absent today ' . $d . ' for the class ' . $class . '(' . $absent_student[0]['section'] . ')

Pushpagiri Dental Sciences';
                            if ($absent_student[0]['father_phone'] != "") {
                                $tid = '1207166202780330832';
                                $this->smsgateway->sendSMSdynamic($absent_student[0]['father_phone'], $msg, $tid);
                            }
                            //var_dump($absent_student);exit;
                            //  print_r($this->db->last_query());
                        }
                        $a = $arr;
                        //var_dump($a);
                        $absent_config = $this->config_attendance['absent'];
                        if ($arr['attendence_type_id'] == $absent_config) {
                            $absent_student_list[] = $value;
                        }
                    }
                    $test[] = $a;
                }
                //$insert_id = $this->stuattendence_model->add($arr);
                $absent_config = $this->config_attendance['absent'];
                if (!empty($absent_student_list)) {
                    $this->mailsmsconf->mailsms('absent_attendence', $absent_student_list, $date);
                }
                $data['value'] = $test;

                $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Attendance Saved Successfully</div>');
                // redirect('admin/stuattendence/index');
            }
            $attendencetypes = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $resultlist = $this->stuattendence_model->searchAttendenceClassSection($class, $section, $subject, date('Y-m-d', $this->customlib->datetostrtotime($date)));
            $data['resultlist'] = $resultlist;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendenceList', $data);
            $this->load->view('layout/footer', $data);
        }

    }

    public function attendencereport()
    {
        if (!$this->rbac->hasPrivilege('student_attendance', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/attendenceReport');
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['date'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
			$subject=$this->input->post('subject_id');
            $date = $this->input->post('date');
            $student_list = $this->stuattendence_model->get();
            $data['studentlist'] = $student_list;
            $data['class_id'] = $class;
			$data['subject_id']= $subject;
            $data['section_id'] = $section;
            $data['date'] = $date;
            $search = $this->input->post('search');
            if ($search == "saveattendence") {
                $session_ary = $this->input->post('student_session');
                foreach ($session_ary as $key => $value) {
                    $checkForUpdate = $this->input->post('attendendence_id' . $value);
                    if ($checkForUpdate != 0) {
                        $arr = array(
                            'id' => $checkForUpdate,
                            'student_session_id' => $value,
                            'attendence_type_id' => $this->input->post('attendencetype' . $value),
                            'date' => date('Y-m-d', $this->customlib->datetostrtotime($date))
                        );
                        $insert_id = $this->stuattendence_model->add($arr);
                    } else {
                        $arr = array(
                            'student_session_id' => $value,
                            'attendence_type_id' => $this->input->post('attendencetype' . $value),
                            'date' => date('Y-m-d', $this->customlib->datetostrtotime($date))
                        );
                        $insert_id = $this->stuattendence_model->add($arr);
                    }
                }
            }
            $attendencetypes = $this->attendencetype_model->get();
            $data['attendencetypeslist'] = $attendencetypes;
            $resultlist = $this->stuattendence_model->searchAttendenceClassSectionPrepare($class, $section,$subject, date('Y-m-d', $this->customlib->datetostrtotime($date)));
            $data['resultlist'] = $resultlist;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    


    public function classattendencereport()
    {

        if (!$this->rbac->hasPrivilege('student_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereport');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->stuattendence_model->attendanceYearCount();
        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['subject_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $month = $this->input->post('month');
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['month_selected'] = $month;
            $studentlist = $this->student_model->searchByClassSection($class, $section, $subject);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $this->setting_model->getStartMonth();
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($month));
            $year = $this->input->post('year');
            $data['year_selected'] = $year;
            if (!empty($year)) {

                $year = $this->input->post("year");
            } else {

                if ($month_number >= $startMonth && $month_number <= 12) {
                    $year = $centenary . $year_first_substring;
                } else {
                    $year = $centenary . $year_second_substring;
                }
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
                $attendence_array[] = $att_date;

                $res = $this->stuattendence_model->searchAttendenceReport($class, $section, $subject, $att_date);
                $student_result = $res;
                $s = array();
                foreach ($res as $result_k => $result_v) {
                    $s[$result_v['student_session_id']] = $result_v;
                }
                $date_result[$att_date] = $s;
            }

            //    print_r($attendence_array);
            $monthAttendance = array();
            foreach ($res as $result_k => $result_v) {

                $date = $year . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['student_session_id'], $subject);
            }
            $data['monthAttendance'] = $monthAttendance;

            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            //  exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function classattendencereportbyperiod()
    {

        if (!$this->rbac->hasPrivilege('student_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereportbyperiod');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['types'] = "";
        $data['subject_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereportbyperiods', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $types = $this->input->post('types');
            $from = date('Y-m-d', strtotime($this->input->post('from')));
            $to = date('Y-m-d', strtotime($this->input->post('to')));
            //    var_dump($to);
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['types'] = $types;
            $data['subject_id'] = $subject;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
            $studentlist = $this->student_model->searchByClassSection($class, $section, $subject);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $from;
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($from));
            $year = date("Y", strtotime($from));
            $data['year_selected'] = $year;

            if (!empty($year)) {
                $year = date("Y", strtotime($from));
            } else {
                if ($month_number >= $startMonth && $month_number <= 12) {
                    $year = $centenary . $year_first_substring;
                } else {
                    $year = $centenary . $year_second_substring;
                }
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);

                $attendence_array[] = $att_date;
                //$res=$this->stuattendence_model->searchAttendenceReportbyperiod($class,$section,$subject,$from,$to);

                $res = $this->stuattendence_model->searchAttendenceReport($class, $section, $subject, $att_date);
                //

                $student_result = $res;
                // var_dump($student_result);

                $s = array();
                foreach ($student_result as $result_k => $result_v) {
                    $s[$result_v['student_session_id']] = $result_v;
                }
                $date_result[$att_date] = $s;

            }

            $monthAttendance = array();
            foreach ($student_result as $result_k => $result_v) {
                $date = $year . "-" . $month;
                //$newdate = date('Y-m-d', strtotime($date));
                $newdate = date('Y-m-d', strtotime($from));
                // $monthAttendance[] = $this->monthAttendancebyperiod($newdate, 1, $result_v['student_session_id']);
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['student_session_id'], $subject);
            }
            $data['monthAttendance'] = $monthAttendance;

            $data['resultlist'] = $date_result;
            // var_dump(  $data['resultlist']["2022-04-12"]['606']['key']);
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            // exit;
            //var_dump($data['monthAttendance']);
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereportbyperiods', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    public function monthAttendancebyperiod($st_month, $no_of_months, $student_id)
    {

        $record = array();

        $r = array();
        $month = date('m', strtotime($st_month));
        $year = date('Y', strtotime($st_month));

        foreach ($this->config_attendance as $att_key => $att_value) {

            $s = $this->stuattendence_model->count_attendance_objbyperiod($month, $year, $student_id, $att_value);

            $attendance_key = $att_key;

            $r[$attendance_key] = $s;
        }

        $record[$student_id] = $r;

        return $record;
    }

    public function monthAttendance($st_month, $no_of_months, $student_id, $sub)
    {

        $record = array();

        $r = array();
        $month = date('m', strtotime($st_month));
        $year = date('Y', strtotime($st_month));

        foreach ($this->config_attendance as $att_key => $att_value) {

            $s = $this->stuattendence_model->count_attendance_obj($month, $year, $student_id, $att_value, $sub);

            $attendance_key = $att_key;

            $r[$attendance_key] = $s;
        }

        $record[$student_id] = $r;

        return $record;
    }

    public function classattendencereportbyday()
    {

        if (!$this->rbac->hasPrivilege('student_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/classattendencereportbyday');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        //$data['monthlist'] = $this->customlib->getMonthDropdown();
        //$data['yearlist'] = $this->stuattendence_model->attendanceYearCount();

        $data['class_id'] = "";
        $data['section_id'] = "";
        $data['subject_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');

        if ($this->form_validation->run() == false) {

            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereportbyday', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $from = date('Y-m-d', strtotime($this->input->post('from')));
            $to = date('Y-m-d', strtotime($this->input->post('to')));

            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
            $studentlist = $this->student_model->searchByClassSection($class, $section, $subject);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $from;
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($from));
            $year = date("Y", strtotime($from));
            $data['year_selected'] = $year;

            if (!empty($year)) {
                $year = date("Y", strtotime($from));
            } else {
                if ($month_number >= $startMonth && $month_number <= 12) {
                    $year = $centenary . $year_first_substring;
                } else {
                    $year = $centenary . $year_second_substring;
                }
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);

                $attendence_array[] = $att_date;
                $res = $this->stuattendence_model->searchAttendenceReportbyperiod($class, $section, $subject, $from, $to);

                $student_result = $res;
                $s = array();
                if (!empty($res)) {
                    $res2 = $this->stuattendence_model->checksearchAttendenceReportbyperiod($class, $section, $subject, $att_date);
                    foreach ($res2 as $result_k => $result_v) {
                        $s[$result_v['student_session_id']] = $result_v;
                    }
                } 

                $date_result[$att_date] = $s;

            }

            $monthAttendance = array();
            foreach ($res as $result_k => $result_v) {
                $date = $year . "-" . $month;
                //$newdate = date('Y-m-d', strtotime($date));
                $newdate = date('Y-m-d', strtotime($from));
                $monthAttendance[] = $this->monthAttendancebyperiod($newdate, 1, $result_v['student_session_id']);
            }
            $data['monthAttendance'] = $monthAttendance;

            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;

            // exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/classattendencereportbyday', $data);
            $this->load->view('layout/footer', $data);
        }
    }
    public function attendencereports()
    {

        if (!$this->rbac->hasPrivilege('student_attendance_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'stuattendence/attendence');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Add Fees Type';
        $data['title_list'] = 'Fees Type List';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->stuattendence_model->attendanceYearCount();
        $data['class_id'] = "";
        $data['section_id'] = "";
        //$data['subject_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendence', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            //$subject = $this->input->post('subject_id');
            $month = $this->input->post('month');
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            //$data['subject_id'] = $subject;
            $data['month_selected'] = $month;
            $studentlist = $this->student_model->searchByClassSection($class, $section, $subject);
            $session_current = $this->setting_model->getCurrentSessionName();
            $startMonth = $this->setting_model->getStartMonth();
            $centenary = substr($session_current, 0, 2); //2017-18 to 2017
            $year_first_substring = substr($session_current, 2, 2); //2017-18 to 2017
            $year_second_substring = substr($session_current, 5, 2); //2017-18 to 18
            $month_number = date("m", strtotime($month));
            $year = $this->input->post('year');
            $data['year_selected'] = $year;
            if (!empty($year)) {

                $year = $this->input->post("year");
            } else {

                if ($month_number >= $startMonth && $month_number <= 12) {
                    $year = $centenary . $year_first_substring;
                } else {
                    $year = $centenary . $year_second_substring;
                }
            }

            $num_of_days = cal_days_in_month(CAL_GREGORIAN, $month_number, $year);
            $attr_result = array();
            $attendence_array = array();
            $student_result = array();
            $data['no_of_days'] = $num_of_days;
            $date_result = array();
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
                $attendence_array[] = $att_date;

                $res = $this->stuattendence_model->searchAttendenceReport($class, $section, $subject, $att_date);
                $student_result = $res;
                $s = array();
                foreach ($res as $result_k => $result_v) {
                    $s[$result_v['student_session_id']] = $result_v;
                }
                $date_result[$att_date] = $s;
            }

            //    print_r($attendence_array);
            $monthAttendance = array();
            foreach ($res as $result_k => $result_v) {

                $date = $year . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['student_session_id'], $subject);
            }
            $data['monthAttendance'] = $monthAttendance;

            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
            //  exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/attendence', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    

}
