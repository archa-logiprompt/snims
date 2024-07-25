<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Monthlyacademicreport extends Admin_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->model("classteacher_model");
        $this->load->model('Timetablenew_model');
        $this->load->helper('lang');

    }

    public function index()
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'monthly_academic_report/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['week_days'] = $this->getweeks(3, 2023);
        // var_dump($week['week 4']);
        // exit;
        $data['is_search'] = false;

        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/monthlyacademicreport/monthlyreport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $daterange = explode('-', $this->input->post('date'));

            $data['is_search'] = true;

            $month = $daterange[0];
            $year = $daterange[1];

            $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
            $data['year'] = $year;

            $start = date("Y-m-01", strtotime("$year-$month-01"));

            $end = date("Y-m-t", strtotime("$year-$month-01"));

            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;

            $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
            $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

            $wherearray = [
                'class_id' => $class_id,
                'section_id' => $section_id,
            ];

            $monthcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();

            $data['monthcalendar'] = $monthcalendar;


            $totalcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->get()->result_array();

            $data['totalcalendar'] = $totalcalendar;

            $subjects = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);

            $data['subjects_teachers_theory'] = $this->get_subject_teachers_theory($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

            $data['subjects_teachers_theory'] = $this->get_subject_teachers_practical($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

            // var_dump( $data['subjects_teachers_theory']);exit;

            $this->load->view('layout/header', $data);
            $this->load->view('admin/monthlyacademicreport/monthlyreport', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function fullreport()
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'monthly_academic_report/fullindex');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['week_days'] = $this->getweeks(3, 2023);
        // var_dump($week['week 4']);
        // exit;
        $data['is_search'] = false;

        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/monthlyacademicreport/monthlyreport_full', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $daterange = explode('-', $this->input->post('date'));

            $data['is_search'] = true;

            $month = $daterange[0];
            $year = $daterange[1];

            $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
            $data['year'] = $year;

            $start = date("Y-m-01", strtotime("$year-$month-01"));

            $end = date("Y-m-t", strtotime("$year-$month-01"));

            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;

            $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
            $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

            $wherearray = [
                'class_id' => $class_id,
                'section_id' => $section_id,
            ];

            $monthcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();

            $data['monthcalendar'] = $monthcalendar;

            $totalcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();

            // var_dump($totalcalendar);exit;
            $data['totalcalendar'] = $totalcalendar;

            $subjects = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);
            // var_dump($subjects);exit;
            $data['subjects_teachers_theory'] = $this->get_subject_teachers_theory($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

            $data['subjects_teachers_practical'] = $this->get_subject_teachers_practical($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);
            // var_dump( $data['subjects_teachers_theory']);

            // exit;

            $data['exam_list'] = $this->db
                ->from('exams')
                ->select('subjects.name as subname,exams.name as examname,date_of_exam')
                ->join('exam_schedules', 'exams.id=exam_schedules.exam_id')
                ->join('teacher_subjects', 'exam_schedules.teacher_subject_id=teacher_subjects.id')
                ->join('subjects', 'teacher_subjects.subject_id=subjects.id')
                ->where('exams.class_id', $class_id)
                ->where('exams.section_id', $section_id)
                ->where('date_of_exam>=', $start)
                ->where('date_of_exam<=', $end)
                ->get()
                ->result_array();

            // var_dump($data['exam_list']);exit;

            $data['userdata'] = $userdata;

            // print_r($this->db->last_query());exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/monthlyacademicreport/monthlyreport_full', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    public function get_subject_teachers_theory($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray)
    {



        foreach ($subjects as $subject) {
            if ($subject['theory'] != null) {

                $subject_id = $subject['id'];

                $subject_teachers = array();

                $teachers = $this->teachersubject_model->get_subjectteachers($subject['id']);

                foreach ($teachers as $teacher) {
                    $subject_teachers[] = $teacher['name'];

                }

                $subjects_teachers_theory[$subject['name']]['teacher'] = $subject_teachers;
                $subjects_teachers_theory[$subject['name']]['subject_id'] = $subject['subject_id'];
                $subjects_teachers_theory[$subject['name']]['id'] = $subject['id'];

                $count = 0;



                foreach ($monthcalendar as $key => $value) {
                    foreach ($value as $subjectkey => $subjectvalue) {
                        // var_dump($subjectvalue==$subject_id?$subjectvalue:'');

                        if ($subjectvalue == $subject_id) {

                            if (substr($subjectkey, -7) === 'subject') {
                                if (($subjectkey === 'ten_to_eleven_subject' || $subjectkey === 'eleven_to_twelve_subject')) {
                                    $count += 0.75;
                                } else {
                                    $count++;
                                }
                            }
                        }

                    }
                }


                $subjects_teachers_theory[$subject['name']]['alloted_hours_this_month'] = $count;

                $totalcount = 0;
                $totalcountmonth = 0;
                // var_dump($totalcalendar);exit;
                foreach ($totalcalendar as $key => $value) {
                    foreach ($value as $totalkey => $totalvalue) {

                        if ($totalvalue == $subject_id) {

                            if (substr($totalkey, -7) === 'subject') {
                                if (($totalkey === 'ten_to_eleven_subject' || $totalkey === 'eleven_to_twelve_subject')) {
                                    $totalcount += 0.75;
                                } else {
                                    $totalcount++;
                                }


                                $date = DateTime::createFromFormat('d/m/Y', $value['date']);
                                $formattedDate = $date->format('Y-m-d');
                                $from = strtotime($formattedDate);

                                if ($from <= strtotime($end)) {
                                    if (($totalkey === 'ten_to_eleven_subject' || $totalkey === 'eleven_to_twelve_subject')) {
                                        $totalcountmonth += 0.75;
                                    } else {
                                        $totalcountmonth++;
                                    }
                                }
                            }

                        }
                    }
                }
                $subjects_teachers_theory[$subject['name']]['total_hours'] = $totalcount;
                $subjects_teachers_theory[$subject['name']]['total_hours_month'] = $totalcountmonth;

                $completed_hours = $this->db
                    ->join('weekly_calendar', 'period_report.calendar_id=weekly_calendar.id')
                    ->join('subjects', 'period_report.calendar_id=weekly_calendar.id')
                    ->where($wherearray)
                    ->where('subject_id', $subject_id)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")
                    ->get('period_report')
                    ->result_array();

                // var_dump($completed_hours);exit;
                $completed_hours_count = 0;

                foreach ($completed_hours as $key => $value) {
                    if ($value['period'] == 'ten_to_eleven' || $value['period'] == 'eleven_to_twelve') {
                        $completed_hours_count += 0.75;
                    } else {
                        $completed_hours_count += 1;

                    }

                }
                // print_r($this->db->last_query($completed_hours));exit;

                $subjects_teachers_theory[$subject['name']]['completed_hours'] = $completed_hours_count;

                $completed_hours_this_month = $this->db
                    ->join('weekly_calendar', 'period_report.calendar_id=weekly_calendar.id')
                    ->where($wherearray)
                    ->where('subject_id', $subject_id)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")
                    ->get('period_report')
                    ->result_array();

                $completed_hours_this_month_count = 0;
                foreach ($completed_hours_this_month as $key => $value) {
                    if ($value['period'] == 'ten_to_eleven' || $value['period'] == 'eleven_to_twelve') {
                        $completed_hours_this_month_count += 0.75;
                    } else {
                        $completed_hours_this_month_count += 1;

                    }

                }

                $subjects_teachers_theory[$subject['name']]['completed_hours_this_month'] = $completed_hours_this_month_count;

                $filtered_array = [];
            }


        }
        // exit;

        return $subjects_teachers_theory;
    }

    public function get_subject_teachers_practical($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray)
    {



        foreach ($subjects as $subject) {
            if ($subject['practical'] != null) {

                $subject_id = $subject['id'];

                $subject_teachers = array();

                $teachers = $this->teachersubject_model->get_subjectteachers($subject['id']);

                foreach ($teachers as $teacher) {
                    $subject_teachers[] = $teacher['name'];

                }

                $subjects_teachers_practical[$subject['name']]['teacher'] = $subject_teachers;
                $subjects_teachers_practical[$subject['name']]['subject_id'] = $subject['subject_id'];
                $subjects_teachers_practical[$subject['name']]['id'] = $subject['id'];

                $count = 0;



                foreach ($monthcalendar as $key => $value) {
                    foreach ($value as $subjectkey => $subjectvalue) {
                        // var_dump($subjectvalue==$subject_id?$subjectvalue:'');

                        if ($subjectvalue == $subject_id) {

                            if (substr($subjectkey, -7) === 'subject') {
                                if (($subjectkey === 'ten_to_eleven_subject' || $subjectkey === 'eleven_to_twelve_subject')) {
                                    $count += 0.75;
                                } else {
                                    $count++;
                                }
                            }
                        }

                    }
                }


                $subjects_teachers_practical[$subject['name']]['alloted_hours_this_month'] = $count;

                $totalcount = 0;
                $totalcountmonth = 0;
                // var_dump($totalcalendar);exit;
                foreach ($totalcalendar as $key => $value) {
                    foreach ($value as $totalkey => $totalvalue) {

                        if ($totalvalue == $subject_id) {

                            if (substr($totalkey, -7) === 'subject') {
                                if (($totalkey === 'ten_to_eleven_subject' || $totalkey === 'eleven_to_twelve_subject')) {
                                    $totalcount += 0.75;
                                } else {
                                    $totalcount++;
                                }


                                $date = DateTime::createFromFormat('d/m/Y', $value['date']);
                                $formattedDate = $date->format('Y-m-d');
                                $from = strtotime($formattedDate);

                                if ($from <= strtotime($end)) {
                                    if (($totalkey === 'ten_to_eleven_subject' || $totalkey === 'eleven_to_twelve_subject')) {
                                        $totalcountmonth += 0.75;
                                    } else {
                                        $totalcountmonth++;
                                    }
                                }
                            }

                        }
                    }
                }
                $subjects_teachers_practical[$subject['name']]['total_hours'] = $totalcount;
                $subjects_teachers_practical[$subject['name']]['total_hours_month'] = $totalcountmonth;

                $completed_hours = $this->db
                    ->join('weekly_calendar', 'period_report.calendar_id=weekly_calendar.id')
                    ->join('subjects', 'period_report.calendar_id=weekly_calendar.id')
                    ->where($wherearray)
                    ->where('subject_id', $subject_id)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")
                    ->get('period_report')
                    ->result_array();

                // var_dump($completed_hours);exit;
                $completed_hours_count = 0;

                foreach ($completed_hours as $key => $value) {
                    if ($value['period'] == 'ten_to_eleven' || $value['period'] == 'eleven_to_twelve') {
                        $completed_hours_count += 0.75;
                    } else {
                        $completed_hours_count += 1;

                    }

                }
                // print_r($this->db->last_query($completed_hours));exit;

                $subjects_teachers_practical[$subject['name']]['completed_hours'] = $completed_hours_count;

                $completed_hours_this_month = $this->db
                    ->join('weekly_calendar', 'period_report.calendar_id=weekly_calendar.id')
                    ->where($wherearray)
                    ->where('subject_id', $subject_id)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")
                    ->get('period_report')
                    ->result_array();

                $completed_hours_this_month_count = 0;
                foreach ($completed_hours_this_month as $key => $value) {
                    if ($value['period'] == 'ten_to_eleven' || $value['period'] == 'eleven_to_twelve') {
                        $completed_hours_this_month_count += 0.75;
                    } else {
                        $completed_hours_this_month_count += 1;

                    }

                }

                $subjects_teachers_practical[$subject['name']]['completed_hours_this_month'] = $completed_hours_this_month_count;

                $filtered_array = [];
            }


        }
        // exit;

        return $subjects_teachers_practical;
    }

    public function getDayFormat($date)
    {
        $date_string = $date;
        $date_format = 'd/m/Y';
        $dateformat = DateTime::createFromFormat($date_format, $date_string);
        return $dateformat->format('d/m/Y');
    }

    public function getweeks($month, $year)
    {

        // Define the year and month for which to generate the array
        $year = $year;
        $month = $month; // March

        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // Initialize the array to hold the weeks of the month
        $weeksOfMonth = array();

        // Set the starting date to the first day of the month
        $currentDate = new DateTime("$year-$month-01");

        // Add the dates from the first day of the month to the next Saturday to the first week of the array
        $weekIndex = 1;
        while ($currentDate->format('w') != 6) {
            if ($currentDate->format('w') != 0) {
                $weeksOfMonth['week ' . $weekIndex][] = $currentDate->format('d') . '/' . $currentDate->format('m') . '/' . $currentDate->format('Y');
            }
            $currentDate->add(new DateInterval('P1D'));
        }
        if ($currentDate->format('w') != 0) {
            $weeksOfMonth['week ' . $weekIndex][] = $currentDate->format('d') . '/' . $currentDate->format('m') . '/' . $currentDate->format('Y');
        }
        $currentDate->add(new DateInterval('P1D'));
        $weekIndex++;

        // Add the remaining dates to the remaining weeks of the array
        while ($currentDate->format('n') == $month) {
            if ($currentDate->format('w') != 0) {
                $weeksOfMonth['week ' . $weekIndex][] = $currentDate->format('d') . '/' . $currentDate->format('m') . '/' . $currentDate->format('Y');
            }
            if ($currentDate->format('w') == 6 || $currentDate->format('d') == $numDays) {
                // If it's Saturday or the last day of the month, move to the next index
                $weekIndex++;
            }
            $currentDate->add(new DateInterval('P1D'));
        }
        return ($weeksOfMonth);
    }

    public function view($id)
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendarnew/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    public function delete($id)
    {

        $this->db->where('id', $id)->delete('week_calendar');
        redirect('admin/weeklycalendarnew/index');
    }

    public function create()
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_add')) {

            access_denied();
        }

        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['subject_id'] = "";
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['department_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $data['isupdate'] = false;
        $data['issearch'] = false;

        $event_colors = array("#03a9f4", "#c53da9", "#757575", "#8e24aa", "#d81b60", "#7cb342", "#fb8c00", "#fb3b3b");
        $data["event_colors"] = $event_colors;
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            if ($this->input->post('search') == 'Search') {

                $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                if ($this->form_validation->run() == false) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
                    $this->load->view('layout/footer', $data);
                } else {

                    $data['class_id'] = $this->input->post('class_id');
                    $data['section_id'] = $this->input->post('section_id');
                    $data['issearch'] = true;

                    $wherearray = [
                        'course_id' => $data['class_id'],
                        'batch_id' => $data['section_id'],
                    ];
                    $data['weekcalendar'] = $this->db->where($wherearray)->get('week_calendar')->result_array();

                    $data['isupdate'] = !empty($data['weekcalendar']);

                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
                    $this->load->view('layout/footer', $data);

                }

            }

        } else {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
            $this->load->view('layout/footer', $data);
        }

    }


    public function monthlyattendancereport()
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'monthly_academic_report/monthlyperiodreport');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $data['date'] = date('m-Y');
        $data['week_days'] = $this->getweeks(3, 2023);
        // var_dump($week['week 4']);
        // exit;
        $data['is_search'] = false;

        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/monthlyacademicreport/monthlyperiodreport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $daterange = explode('-', $this->input->post('date'));

            $data['date'] = $this->input->post('date');
            $data['is_search'] = true;
            $month = $daterange[0];
            $year = $daterange[1];

            $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
            $data['year'] = $year;
            $start = date("Y-m-01", strtotime("$year-$month-01"));

            $end = date("Y-m-t", strtotime("$year-$month-01"));

            $data['class_id'] = $class_id;

            $data['section_id'] = $section_id;

            $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;

            $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

            $data['students'] =
                $this->db->from('student_session')
                    ->join('students', 'student_session.student_id=students.id')
                    ->where(['class_id' => $data['class_id'], 'section_id' => $data['section_id']])
                    ->get()->result_array();
            // echo $this->db->last_query();exit;

            $wherearray = [
                'class_id' => $class_id,
                'section_id' => $section_id,
            ];

            $monthcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();
            $data['monthcalendar'] = $monthcalendar;
            //  echo $this->db->last_query();exit;
            $totalcalendar = $this->db->select('*')
                ->from('weekly_calendar')
                ->where($wherearray)
                ->get()->result_array();

            $data['totalcalendar'] = $totalcalendar;

            $subjects = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);

            if ($this->input->post('subject_id')) {

                $data['all_subject'] = false;

                $data['subject_id'] = $this->input->post('subject_id');

                $data['subject_name'] =
                    $this->db->select('subjects.name')
                        ->from('subjects')
                        ->join('teacher_subjects', 'subjects.id=teacher_subjects.subject_id')
                        ->where('teacher_subjects.id', $data['subject_id'])->get()->row()->name;

                $subject_id = $data['subject_id'];

                $callback = function ($item) use ($subject_id) {

                    return $item['id'] == $subject_id;
                };

                $subjects = array_filter($subjects, $callback);



                $data['subjects_teachers_theory'] = $this->get_subject_teachers_theory($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

                $data['subjects_teachers_theory'] = $this->get_subject_teachers_practical($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

                $this->load->view('layout/header', $data);
                $this->load->view('admin/monthlyacademicreport/monthlyperiodreport', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $data['all_subject'] = true;
                $data['start'] = $start;
                $data['end'] = $end;
                $data['subjects_list'] = $subjects;
                $data['subjects_teachers_theory'] = $this->get_subject_teachers_theory($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);

                $data['subjects_teachers_theory'] = $this->get_subject_teachers_practical($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);
                // var_dump($data['subjects_teachers_theory']);exit;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/monthlyacademicreport/monthlyperiodreport', $data);
                $this->load->view('layout/footer', $data);
            }

        }
    }

    public function savecalendar()
    {
        $subjects = $this->input->post('subject_id');
        $teachers = $this->input->post('teacher_id');
        $date = $this->input->post('event_dates');
        $class = $this->input->post('hidden_class');
        $section = $this->input->post('hidden_section');

        $activity = $this->input->post('activity_id');

        // var_dump($activity);exit;

        $insert_array = [
            'class_id' => $class,
            'section_id' => $section,
            'date' => $date,
            'eight_to_nine_subject' => $subjects[0],
            'eight_to_nine_teacher' => $teachers[0],
            'nine_to_ten_subject' => $subjects[1],
            'nine_to_ten_teacher' => $teachers[1],
            'ten_to_eleven_subject' => $subjects[2],
            'ten_to_eleven_teacher' => $teachers[2],
            'eleven_to_twelve_subject' => $subjects[3],
            'eleven_to_twelve_teacher' => $teachers[3],
            'twelve_to_one_subject' => $subjects[4],
            'twelve_to_one_teacher' => $teachers[4],
            'two_to_three_subject' => $subjects[5],
            'two_to_three_teacher' => $teachers[5],
            'three_to_four_subject' => $subjects[6],
            'three_to_four_teacher' => $teachers[6],
            'four_to_five_subject' => $subjects[7],
            'four_to_five_teacher' => $teachers[7],
            'eight_to_nine_activity' => $activity[0],
            'nine_to_ten_activity' => $activity[1],
            'ten_to_eleven_activity' => $activity[2],
            'eleven_to_twelve_activity' => $activity[3],
            'twelve_to_one_activity' => $activity[4],
            'two_to_three_activity' => $activity[5],
            'three_to_four_activity' => $activity[6],
            'four_to_five_activity' => $activity[7],

        ];

        $this->db->insert('weekly_calendar', $insert_array);

        echo json_encode('success');

    }

    public function edit($id)
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Mark';
        $data['id'] = $id;
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendarnew/timetableEditnew', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee added successfully</div>');
            redirect('admin/weeklycalendarnew/index');
        }
    }

    public function check_exists()
    {

        $this->Timetablenew_model->valid_check_exists();

    }
    public function getcalendar()
    {

        $section = $this->input->post('section_id');
        $class = $this->input->post('class_id');

        $calendar =
            $this->db
                ->where([
                    'section_id' => $section,
                    'class_id' => $class,
                ])
                ->get('weekly_calendar')->result_array();

        $eventdata = [];

        $name = '';
        foreach ($calendar as $key => $value) {

            if ($value['eight_to_nine_teacher'] != 0) {
                $name .= "08 - 09 AM : " . $this->getStaffName($value['eight_to_nine_teacher']) . "" . $this->getSubjectName($value['eight_to_nine_subject']) . "\n";
            } else if ($value['eight_to_nine_activity'] != '') {
                $name .= "08 - 09 AM : $value[eight_to_nine_activity]\n";
            }

            if ($value['nine_to_ten_teacher'] != 0) {
                $name .= "09 - 10 AM : " . $this->getStaffName($value['nine_to_ten_teacher']) . "" . $this->getSubjectName($value['nine_to_ten_subject']) . "\n";
            } else if ($value['nine_to_ten_activity'] != '') {
                $name .= "09 - 10 AM : $value[nine_to_ten_activity]\n";
            }

            if ($value['ten_to_eleven_teacher'] != 0) {
                $name .= "10 - 11 AM : " . $this->getStaffName($value['ten_to_eleven_teacher']) . "" . $this->getSubjectName($value['ten_to_eleven_subject']) . "\n";
            } else if ($value['ten_to_eleven_activity'] != '') {
                $name .= "10 - 11 AM : $value[ten_to_eleven_activity]\n";
            }

            if ($value['eleven_to_twelve_teacher'] != 0) {
                $name .= "11 - 12 PM : " . $this->getStaffName($value['eleven_to_twelve_teacher']) . "" . $this->getSubjectName($value['eleven_to_twelve_subject']) . "\n";
            } else if ($value['eleven_to_twelve_activity'] != '') {
                $name .= "11 - 12 PM : $value[eleven_to_twelve_activity]\n";
            }

            if ($value['twelve_to_one_teacher'] != 0) {
                $name .= "12 - 01 PM : " . $this->getStaffName($value['twelve_to_one_teacher']) . "" . $this->getSubjectName($value['twelve_to_one_subject']) . "\n";
            } else if ($value['twelve_to_one_activity'] != '') {
                $name .= "12 - 01 PM : $value[twelve_to_one_activity]\n";
            }

            if ($value['two_to_three_teacher'] != 0) {
                $name .= "02 - 03 PM : " . $this->getStaffName($value['two_to_three_teacher']) . "" . $this->getSubjectName($value['two_to_three_subject']) . "\n";
            } else if ($value['two_to_three_activity'] != '') {
                $name .= "02 - 03 PM : $value[two_to_three_activity]\n";
            }

            if ($value['three_to_four_teacher'] != 0) {
                $name .= "03 - 04 PM : " . $this->getStaffName($value['three_to_four_teacher']) . "" . $this->getSubjectName($value['three_to_four_subject']) . "\n";
            } else if ($value['three_to_four_activity'] != '') {
                $name .= "03 - 04 PM : $value[three_to_four_activity]\n";
            }

            if ($value['four_to_five_teacher'] != 0) {
                $name .= "04 - 05 PM : " . $this->getStaffName($value['four_to_five_teacher']) . "" . $this->getSubjectName($value['four_to_five_subject']) . "\n";
            } else if ($value['four_to_five_activity'] != '') {
                $name .= "04 - 05 PM : $value[four_to_five_activity]\n";
            }

            $eventdata[] = array(
                'id' => $value['id'],
                'title' => $name,
                'start' => (date("Y-d-m", strtotime($value['date']))),
                'end' => (date("Y-d-m", strtotime($value['date']))),

            );
            $name = '';

        }

        echo json_encode($eventdata);

    }

    public function updatecalendar()
    {

        $subjects = $this->input->post('subject_id');
        $teachers = $this->input->post('teacher_id');
        $id = $this->input->post('hidden_id');
        $activity = $this->input->post('activity_id');

        $insert_array = [

            'eight_to_nine_subject' => $subjects[0],
            'eight_to_nine_teacher' => $teachers[0],
            'nine_to_ten_subject' => $subjects[1],
            'nine_to_ten_teacher' => $teachers[1],
            'ten_to_eleven_subject' => $subjects[2],
            'ten_to_eleven_teacher' => $teachers[2],
            'eleven_to_twelve_subject' => $subjects[3],
            'eleven_to_twelve_teacher' => $teachers[3],
            'twelve_to_one_subject' => $subjects[4],
            'twelve_to_one_teacher' => $teachers[4],
            'two_to_three_subject' => $subjects[5],
            'two_to_three_teacher' => $teachers[5],
            'three_to_four_subject' => $subjects[6],
            'three_to_four_teacher' => $teachers[6],
            'four_to_five_subject' => $subjects[7],
            'four_to_five_teacher' => $teachers[7],
            'eight_to_nine_activity' => $activity[0],
            'nine_to_ten_activity' => $activity[1],
            'ten_to_eleven_activity' => $activity[2],
            'eleven_to_twelve_activity' => $activity[3],
            'twelve_to_one_activity' => $activity[4],
            'two_to_three_activity' => $activity[5],
            'three_to_four_activity' => $activity[6],
            'four_to_five_activity' => $activity[7],
        ];

        $this->db->where('id', $id)->update('weekly_calendar', $insert_array);

        echo json_encode('success');
    }

    public function view_event($id)
    {

        $timetable = $this->db->where('id', $id)->get('weekly_calendar')->row();
        echo json_encode($timetable);
    }

    public function getStaffName($id)
    {

        $name = $this->db->select('staff.name')->where('staff.id', $id)->get('staff')->row();

        return $name->name;

    }
    public function getSubjectName($id)
    {

        $name = $this->db->select('subjects.name')->from('subjects')->join('teacher_subjects', 'teacher_subjects.subject_id=subjects.id')->where('teacher_subjects.id', $id)->get()->row();

        return " (" . substr($name->name, 0, 4) . ")";

    }
    


}