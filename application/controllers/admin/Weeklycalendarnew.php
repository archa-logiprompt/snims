<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Weeklycalendarnew extends Admin_Controller
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
        $this->session->set_userdata('sub_menu', 'weeklycalendarnew/index');
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
        $this->form_validation->set_rules('week', 'Week', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $daterange = explode('-', $this->input->post('date'));
            $week_number = $this->input->post('week');

            $data['week_number'] = $week_number;

            $data['is_search'] = true;

            $month = $daterange[0];
            $year = $daterange[1];

            $weeks = $this->getweeks($month, $year);

            $weekcalendar = $weeks[$week_number];
            $array_count = (count($weekcalendar)) - 1;

            $data['weekcalendar'] = $weekcalendar;

            $start = $this->getDayFormat($weekcalendar[0]);
            $end = $this->getDayFormat($weekcalendar[$array_count]);

            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;

            $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
            $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

            $wherearray = [
                'class_id' => $class_id,
                'section_id' => $section_id,
            ];

            // 'date >=' => $start,
            // 'date <=' => $end,

            $data['weekcalendar'] = $this->db
                ->where($wherearray)
                // ->where("date >= DATE_FORMAT(STR_TO_DATE('$start', '%d/%m/%Y'), '%Y-%m-%d')")
                // ->where("date <= DATE_FORMAT(STR_TO_DATE('$end', '%d/%m/%Y'), '%Y-%m-%d')")
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN STR_TO_DATE('$start', '%d/%m/%Y') AND STR_TO_DATE('$end', '%d/%m/%Y')")
                ->order_by('date')
                ->get('weekly_calendar')
                ->result_array();


            // print_r($this->db->last_query());exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    public function periodtiming(){
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'weeklycalendarnew/periodtiming'); 
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


        $classandsection = [];
        foreach ($class as $classname) {

            $sections = $this->db
                            ->select('sections.*')
                            ->from('class_sections')
                            ->join('sections', 'sections.id = class_sections.section_id')
                            ->join('classes', 'classes.id = class_sections.class_id')
                            ->where('class_id', $classname['id'])
                            ->get()
                            ->result_array();


            $periodtiming = [];
            foreach($sections as $section){
            
                $periodtimingdata = $this->db->where([
                        'class_id'=>$classname['id'],
                        'section_id'=>$section['id'],
                    ])->get('period_timing')->result();

                if(!empty($periodtimingdata)){
                    $periodtiming[]= $periodtimingdata;
                }
            }
            
        
            $classandsection[] = [
                'class' => $classname,
                'sections' => $sections,
                'periodtiming' => $periodtiming,
            ];
        }

       $data['class_sections'] = $classandsection;
    //    var_dump($classandsection);
    //    exit;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendarnew/periodtimingsindex', $data);
        $this->load->view('layout/footer', $data);
        
    }
    public function periodtimingTemplateCreate($class_id,$section_id,$is_update=false){
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'weeklycalendarnew/periodtiming'); 
        $data['title'] = 'Assign Teacher with Class and Subject wise'; 

        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;

        // $perioddata = $this->db->where([
        //     'class_id'=>$class_id,
        //     'section_id'=>$section_id,
        // ])->get('period_timing')->row();

        // if($perioddata){

        //     $data['is_update'] = true;
        //     $data['perioddata'] = $perioddata;
            
        // }else{
            
        //     $data['is_update'] = false;
        // }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendarnew/periodtimings', $data);
        $this->load->view('layout/footer', $data);
    } 
    public function periodtimingTemplateEdit($period_id){
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'weeklycalendarnew/periodtiming'); 
        $data['title'] = 'Assign Teacher with Class and Subject wise'; 
 

        $perioddata = $this->db->where([
            'id'=>$period_id,
        ])->get('period_timing')->row();

        if($perioddata){
            $data['is_update'] = true;
            $data['perioddata'] = $perioddata;
            
        }else{
            
            $data['is_update'] = false;
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendarnew/periodtimings', $data);
        $this->load->view('layout/footer', $data);
    } 
    public function periodtimingTemplateRemove($period_id){
      
        $this->db->where([
            'id'=>$period_id,
        ])->delete('period_timing');

        redirect('admin/weeklycalendarnew/periodtiming');
 
    
    } 
    public function periodtimingTemplateUse($class_id,$section_id,$period_id){
      
        $this->db->where([
            'class_id'=>$class_id,
            'section_id'=>$section_id
        ])->update('period_timing',['is_active'=>0]);
        
        $this->db->where([
            'id'=>$period_id,
        ])->update('period_timing',['is_active'=>1]);

        redirect('admin/weeklycalendarnew/periodtiming');
 
    
    } 


    public function savePeriodAttendance(){
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $templatename = $this->input->post('templatename');
 
          
            $time_from_1 = $this->input->post('time_from_1');
            $time_to_1 = $this->input->post('time_to_1');
            $time_from_2 = $this->input->post('time_from_2');
            $time_to_2 = $this->input->post('time_to_2');
            $time_from_3 = $this->input->post('time_from_3');
            $time_to_3 = $this->input->post('time_to_3');
            $time_from_4 = $this->input->post('time_from_4');
            $time_to_4 = $this->input->post('time_to_4');
            $time_from_5 = $this->input->post('time_from_5');
            $time_to_5 = $this->input->post('time_to_5');
            $time_from_6 = $this->input->post('time_from_6');
            $time_to_6 = $this->input->post('time_to_6');
            $time_from_7 = $this->input->post('time_from_7');
            $time_to_7 = $this->input->post('time_to_7');
            $time_from_8 = $this->input->post('time_from_8');
            $time_to_8 = $this->input->post('time_to_8');
            
            $insert_array = [
                'class_id'=>$class_id,
                'section_id'=>$section_id,
                'template_name'=>$templatename,
                'period_one_from'=>$this->convertTimeTo12HR($time_from_1),
                'period_one_to'=>$this->convertTimeTo12HR($time_to_1),
                'period_two_from'=>$this->convertTimeTo12HR($time_from_2),
                'period_two_to'=>$this->convertTimeTo12HR($time_to_2),
                'period_three_from'=>$this->convertTimeTo12HR($time_from_3),
                'period_three_to'=>$this->convertTimeTo12HR($time_to_3),
                'period_four_from'=>$this->convertTimeTo12HR($time_from_4),
                'period_four_to'=>$this->convertTimeTo12HR($time_to_4),
                'period_five_from'=>$this->convertTimeTo12HR($time_from_5),
                'period_five_to'=>$this->convertTimeTo12HR($time_to_5),
                'period_six_from'=>$this->convertTimeTo12HR($time_from_6),
                'period_six_to'=>$this->convertTimeTo12HR($time_to_6),
                'period_seven_from'=>$this->convertTimeTo12HR($time_from_7),
                'period_seven_to'=>$this->convertTimeTo12HR($time_to_7),
                'period_eight_from'=>$this->convertTimeTo12HR($time_from_8),
                'period_eight_to'=>$this->convertTimeTo12HR($time_to_8)
            ];

            $is_update = $this->input->post('is_update');
            
            
            if($is_update){
                
                $period_id = $this->input->post('period_id');

                $this->db->where('id',$period_id)->update('period_timing',$insert_array);

            }else{

                $this->db->insert('period_timing',$insert_array);
            }
 


            redirect('admin/weeklycalendarnew/periodtiming');
    }

    function convertTimeTo12HR($time){
        if($time!=''){

            $twelveHourTime = date("h:i A", strtotime($time));
            return $twelveHourTime;
        }else{
            return '';
        }


    }
//     public function search()
//     {
//         if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
//             access_denied();
//         }
//         $this->session->set_userdata('top_menu', 'Academics');
//         $this->session->set_userdata('sub_menu', 'weeklycalendarnew/index');
//         $session = $this->setting_model->getCurrentSession();
//         $data['title'] = 'Exam Marks';
//         $data['exam_id'] = "";
//         $data['class_id'] = "";
//         $data['section_id'] = "";
//         $exam = $this->exam_model->get();
//         $class = $this->class_model->get();
//         $data['examlist'] = $exam;
//         $data['classlist'] = $class;
//         $userdata = $this->customlib->getUserData();

//         $data['week_days'] = $this->getweeks(3, 2023);
//         // var_dump($week['week 4']);
//         // exit;
//         $data['is_search'] = false;


//         $test = $this->input->post('week');
//         // var_dump();exit;

//         //weekly
//         if (!empty($test)) {
//             $data['is_weekly'] = true;


//             // var_dump($data);exit;
//             $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('week', 'Week', 'trim|required|xss_clean');
//             if ($this->form_validation->run() == false) {
//                 $this->load->view('layout/header', $data);
//                 $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
//                 $this->load->view('layout/footer', $data);
//             } else {

//                 $class_id = $this->input->post('class_id');
//                 $section_id = $this->input->post('section_id');
//                 $daterange = explode('-', $this->input->post('date'));
//                 $week_number = $this->input->post('week');

//  $data['period_list'] = $this->db->where([
//                     'class_id'=>$class_id,
//                     'section_id'=>$section_id
//                 ])->get('period_timing')->row();

//                 $data['week_number'] = $week_number;

//                 $data['is_search'] = true;

//                 $month = $daterange[0];
//                 $year = $daterange[1];
//                 $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
//                 // var_dump($data['month_name']);exit;
//                 $data['month'] = $month;
//                 $data['year'] = $year;



//                 $weeks = $this->getweeks($month, $year);
//                 $data['test'] = $weeks;

//                 $weekcalendar = $weeks[$week_number];
//                 // var_dump($weekcalendar);exit;

//                 $array_count = (count($weekcalendar)) - 1;
//                 // var_dump($array_count);exit;

//                 $data['weekcalendar'] = $weekcalendar;
//                 // count(($weekcalendar))-1;
//                 // var_dump($weekcalendar);exit;

//                 $start = $this->getDayFormat($weekcalendar[0]);
//                 // var_dump($start);exit;
//                 $end = $this->getDayFormat($weekcalendar[$array_count]);
//                 // var_dump($end);exit;

//                 $data['class_id'] = $class_id;
//                 $data['section_id'] = $section_id;

//                 $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
//                 $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

//                 $wherearray = [
//                     'class_id' => $class_id,
//                     'section_id' => $section_id,
//                 ];
//                 $start_date = $start;
//                 $end_date = $end;
//                 $data['dateStart'] = $start_date;
//                 $data['dateEnd'] = $end_date;

//                 $start_date_converted = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
//                 $end_date_converted = DateTime::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

//                 $sql = "SELECT * FROM `weekly_calendar` WHERE STR_TO_DATE(date, '%d/%m/%Y') BETWEEN ? AND ? AND class_id = ? AND section_id = ?";
//                 $query = $this->db->query($sql, array($start_date_converted, $end_date_converted, $class_id, $section_id));
//                 $data['weekcalendar'] = $query->result_array();

//                 // print_r($this->db->last_query()); exit;
//                 $this->load->view('layout/header', $data);
//                 $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
//                 $this->load->view('layout/footer', $data);

//             }

//         } else {
//             $class_id = $this->input->post('class_id');
//             // var_dump($class_id);exit;
//             $section_id = $this->input->post('section_id');
//             $data['class_id']=$class_id;
//             $data['section_id']=$section_id;
//              $data['period_list'] = $this->db->where([
//                 'class_id'=>$class_id,
//                 'section_id'=>$section_id
//             ])->get('period_timing')->row();
//             // var_dump($section_id);exit;

//             // $class_id = $class_id ;// Replace with your actual class_id
//             // $section_id = $section_id; // Replace with your actual section_id

//             $data['test1'] = $this->db
//                 ->query(' SELECT subject AS distinct_value, COUNT(*) AS value_count FROM (
//                     SELECT eight_to_nine_subject AS subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT nine_to_ten_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT ten_to_eleven_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT eleven_to_twelve_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT twelve_to_one_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT two_to_three_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT three_to_four_subject FROM weekly_calendar
//                     UNION ALL
//                     SELECT four_to_five_subject FROM weekly_calendar
//                 ) AS combined_data
//                 GROUP BY subject')
//                 ->result_array();

//                 $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
//                 $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;






//             // echo $this->db->last_query();
//             // exit;
//             $data['table'] = 1;
//             $data['is_weekly'] = false;
//             $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
//             $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
//             // $this->form_validation->set_rules('week', 'Week', 'trim|required|xss_clean');
//             if ($this->form_validation->run() == false) {
//                 $this->load->view('layout/header', $data);
//                 $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
//                 $this->load->view('layout/footer', $data);
//             } else {
//                 $data['date'] = $this->input->post('date');
//                 $data['is_search'] = true;
//                 $daterange = explode('-', $this->input->post('date'));

//                 $month = $daterange[0];
//                 $year = $daterange[1];

//                 $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
//                 $data['year'] = $year;
//                 $start = date("Y-m-01", strtotime("$year-$month-01"));

//                 $end = date("Y-m-t", strtotime("$year-$month-01"));

//                 $class_id = $this->input->post('class_id');
//                 $section_id = $this->input->post('section_id');
//                 $daterange = explode('-', $this->input->post('date'));
//                 $week_number = $this->input->post('week');

//                 $data['week_number'] = $week_number;

//                 $data['is_search'] = true;


//                 $month = $daterange[0];
//                 $year = $daterange[1];

//                 $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
//                 // var_dump($data['month_name']);exit;
//                 $data['month'] = $month;
//                 $data['year'] = $year;

//                 $startDate = new DateTime("$year-$month-01");

//                 // Get the last day of the month
//                 $endDate = new DateTime("$year-$month-" . $startDate->format('t'));

//                 // Loop through the days of the month
//                 $currentDate = clone $startDate;
//                 while ($currentDate <= $endDate) {
//                     // echo $currentDate->format('d-m-Y') . '<br>';
//                     $currentDate->modify('+1 day');
//                 }
//                 // exit;


//                 $weeks = $this->getweeks($month, $year);

//                 $data['test'] = $weeks;

//                 $daysInMonths = $this->getDatesForMonth($month, $year);


//                 $chunks = $this->array_chunk_fixed($daysInMonths, 5);
//                 // Print the array
//                 $separatedArray = [];
//                 foreach ($chunks as $key => $chunk) {
//                     $separatedArray[$key] = $chunk;
//                 }

//                 // Print the separated array
//                 // dd/mm/Y
//                 // var_dump($separatedArray);exit;
//                 $data['daysarr'] = $separatedArray;



//                 $data['weekcalendar'] = $this->db->select('*')->from('weekly_calendar')->where('section_id', $section_id)->where('class_id', $class_id)->like('date', '__%' . $month . '%___', '!', false)->order_by('date')->get()->result_array();

//                 foreach ($daysInMonths as $date) {
//                     // Check if the date exists in the original array
//                     $found = false;
//                     foreach ($data['weekcalendar'] as $entry) {
//                         if ($entry['date'] === $date) {
//                             $found = true;
//                             $modifiedArray[] = $entry; // Add the existing entry to the modified array
//                             break;
//                         }
//                     }

//                     // If the date was not found in the original array, add it with default values
//                     if (!$found) {
//                         $modifiedArray[] = [
//                             'id' => '',
//                             // You can set other fields to default values here
//                             'class_id' => '',
//                             'section_id' => '',
//                             'date' => $date,
//                             // Add other fields with default values
//                         ];
//                     }
//                 }

//                 // var_dump($modifiedArray);
//                 // exit;
//                 $data['weekcalendar'] = $modifiedArray;
//                 // print_r($this->db->last_query($data));exit;
//                 // echo $this->db->get()->result_array();
//                 $data['dummy'] = 1;

//                 $wherearray = [
//                     'class_id' => $class_id,
//                     'section_id' => $section_id,
//                 ];
//                 $totalcalendar = $this->db->select('*')
//                     ->from('weekly_calendar')
//                     ->where($wherearray)
//                     ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();


//                 $data['totalcalendar'] = $totalcalendar;


//                 $subjects = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);
//                 $monthcalendar = $this->db->select('*')
//                     ->from('weekly_calendar')
//                     ->where($wherearray)
//                     ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();
//                 $data['monthcalendar'] = $monthcalendar;

//                 $data['subjects_teachers'] = $this->get_subject_teachers($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);


//                 // $data['classid'] = ;

//                 $this->load->view('layout/header', $data);
//                 $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
//                 $this->load->view('layout/footer', $data);
//             }
//             // var_dump($data['dummy']);exit;

//         }


//     }

public function search()
    {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'weeklycalendarnew/index');
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


        $test = $this->input->post('week');
        // var_dump();exit;

        //weekly
        if (!empty($test)) {
            $data['is_weekly'] = true;


            // var_dump($data);exit;
            $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('week', 'Week', 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
                $this->load->view('layout/footer', $data);
            } else {

                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $daterange = explode('-', $this->input->post('date'));
                $week_number = $this->input->post('week');


                $data['period_list'] = $this->db->where([
                    'class_id'=>$class_id,
                    'section_id'=>$section_id
                ])->get('period_timing')->row();
 



                $data['week_number'] = $week_number;

                $data['is_search'] = true;

                $month = $daterange[0];
                $year = $daterange[1];
                $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
                // var_dump($data['month_name']);exit;
                $data['month'] = $month;
                $data['year'] = $year;



                $weeks = $this->getweeks($month, $year);
                $data['test'] = $weeks;

                $weekcalendar = $weeks[$week_number];
                // var_dump($weekcalendar);exit;

                $array_count = (count($weekcalendar)) - 1;
                // var_dump($array_count);exit;

                $data['weekcalendar'] = $weekcalendar;
                // count(($weekcalendar))-1;
                // var_dump($weekcalendar);exit;

                $start = $this->getDayFormat($weekcalendar[0]);
                // var_dump($start);exit;
                $end = $this->getDayFormat($weekcalendar[$array_count]);
                // var_dump($end);exit;

                $data['class_id'] = $class_id;
                $data['section_id'] = $section_id;

                $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
                $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;

                $wherearray = [
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                ];
                $start_date = $start;
                $end_date = $end;
                $data['dateStart'] = $start_date;
                $data['dateEnd'] = $end_date;

                $start_date_converted = DateTime::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
                $end_date_converted = DateTime::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');

                $sql = "SELECT * FROM weekly_calendar WHERE STR_TO_DATE(date, '%d/%m/%Y') BETWEEN ? AND ? AND class_id = ? AND section_id = ?";
                $query = $this->db->query($sql, array($start_date_converted, $end_date_converted, $class_id, $section_id));
                $data['weekcalendar'] = $query->result_array();

                // print_r($this->db->last_query()); exit;
                $this->load->view('layout/header', $data);
                $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
                $this->load->view('layout/footer', $data);

            }

        } else {
            $class_id = $this->input->post('class_id');
            // var_dump($class_id);exit;
            $section_id = $this->input->post('section_id');
            $data['class_id']=$class_id;
            $data['section_id']=$section_id;
            // var_dump($section_id);exit;
            $data['period_list'] = $this->db->where([
                'class_id'=>$class_id,
                'section_id'=>$section_id
            ])->get('period_timing')->row();
 

            // $class_id = $class_id ;// Replace with your actual class_id
            // $section_id = $section_id; // Replace with your actual section_id

            $data['test1'] = $this->db
                ->query(' SELECT subject AS distinct_value, COUNT(*) AS value_count FROM (
                    SELECT eight_to_nine_subject AS subject FROM weekly_calendar
                    UNION ALL
                    SELECT nine_to_ten_subject FROM weekly_calendar
                    UNION ALL
                    SELECT ten_to_eleven_subject FROM weekly_calendar
                    UNION ALL
                    SELECT eleven_to_twelve_subject FROM weekly_calendar
                    UNION ALL
                    SELECT twelve_to_one_subject FROM weekly_calendar
                    UNION ALL
                    SELECT two_to_three_subject FROM weekly_calendar
                    UNION ALL
                    SELECT three_to_four_subject FROM weekly_calendar
                    UNION ALL
                    SELECT four_to_five_subject FROM weekly_calendar
                ) AS combined_data
                GROUP BY subject')
                ->result_array();

                $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
                $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;






            // echo $this->db->last_query();
            // exit;
            $data['table'] = 1;
            $data['is_weekly'] = false;
            $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
            $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
            $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
            // $this->form_validation->set_rules('week', 'Week', 'trim|required|xss_clean');
            if ($this->form_validation->run() == false) {
                $this->load->view('layout/header', $data);
                $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
                $this->load->view('layout/footer', $data);
            } else {
                $data['date'] = $this->input->post('date');
                $data['is_search'] = true;
                $daterange = explode('-', $this->input->post('date'));

                $month = $daterange[0];
                $year = $daterange[1];

                $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
                $data['year'] = $year;
                $start = date("Y-m-01", strtotime("$year-$month-01"));

                $end = date("Y-m-t", strtotime("$year-$month-01"));

                $class_id = $this->input->post('class_id');
                $section_id = $this->input->post('section_id');
                $daterange = explode('-', $this->input->post('date'));
                $week_number = $this->input->post('week');

                $data['week_number'] = $week_number;

                $data['is_search'] = true;


                $month = $daterange[0];
                $year = $daterange[1];

                $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
                // var_dump($data['month_name']);exit;
                $data['month'] = $month;
                $data['year'] = $year;

                $startDate = new DateTime("$year-$month-01");

                // Get the last day of the month
                $endDate = new DateTime("$year-$month-" . $startDate->format('t'));

                // Loop through the days of the month
                $currentDate = clone $startDate;
                while ($currentDate <= $endDate) {
                    // echo $currentDate->format('d-m-Y') . '<br>';
                    $currentDate->modify('+1 day');
                }
                // exit;


                $weeks = $this->getweeks($month, $year);

                $data['test'] = $weeks;

                $daysInMonths = $this->getDatesForMonth($month, $year);


                $chunks = $this->array_chunk_fixed($daysInMonths, 5);
                // Print the array
                $separatedArray = [];
                foreach ($chunks as $key => $chunk) {
                    $separatedArray[$key] = $chunk;
                }

                // Print the separated array
                // dd/mm/Y
                // var_dump($separatedArray);exit;
                $data['daysarr'] = $separatedArray;



                $data['weekcalendar'] = $this->db->select('*')->from('weekly_calendar')->where('section_id', $section_id)->where('class_id', $class_id)->like('date', '%' . $month . '%_', '!', false)->order_by('date')->get()->result_array();

                foreach ($daysInMonths as $date) {
                    // Check if the date exists in the original array
                    $found = false;
                    foreach ($data['weekcalendar'] as $entry) {
                        if ($entry['date'] === $date) {
                            $found = true;
                            $modifiedArray[] = $entry; // Add the existing entry to the modified array
                            break;
                        }
                    }

                    // If the date was not found in the original array, add it with default values
                    if (!$found) {
                        $modifiedArray[] = [
                            'id' => '',
                            // You can set other fields to default values here
                            'class_id' => '',
                            'section_id' => '',
                            'date' => $date,
                            // Add other fields with default values
                        ];
                    }
                }

                // var_dump($modifiedArray);
                // exit;
                $data['weekcalendar'] = $modifiedArray;
                // print_r($this->db->last_query($data));exit;
                // echo $this->db->get()->result_array();
                $data['dummy'] = 1;

                $wherearray = [
                    'class_id' => $class_id,
                    'section_id' => $section_id,
                ];
                $totalcalendar = $this->db->select('*')
                    ->from('weekly_calendar')
                    ->where($wherearray)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();


                $data['totalcalendar'] = $totalcalendar;


                $subjects = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);
                $monthcalendar = $this->db->select('*')
                    ->from('weekly_calendar')
                    ->where($wherearray)
                    ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")->get()->result_array();
                $data['monthcalendar'] = $monthcalendar;

                $data['subjects_teachers'] = $this->get_subject_teachers($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray);


                // $data['classid'] = ;

                $this->load->view('layout/header', $data);
                $this->load->view('admin/weeklycalendarnew/weeklycalendar', $data);
                $this->load->view('layout/footer', $data);
            }
            // var_dump($data['dummy']);exit;

}


}

    public function get_subject_teachers($subjects, $totalcalendar, $start, $end, $monthcalendar, $wherearray)
    {
        foreach ($subjects as $subject) {

            $subject_id = $subject['id'];

            $subject_teachers = array();

            $teachers = $this->teachersubject_model->get_subjectteachers($subject['id']);

            foreach ($teachers as $teacher) {

                $subject_teachers[] = $teacher['name'];

            }

            $subjects_teachers[$subject['name']]['teacher'] = $subject_teachers;
            $subjects_teachers[$subject['name']]['subject_id'] = $subject['subject_id'];
            $subjects_teachers[$subject['name']]['id'] = $subject['id'];

            $count = 0;


            // var_dump($start);exit;
            foreach ($monthcalendar as $key => $value) {
                foreach ($value as $subjectkey => $subjectvalue) {

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
            $subjects_teachers[$subject['name']]['alloted_hours_this_month'] = $count;

            $totalcount = 0;
            $totalcountmonth = 0;
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
            $subjects_teachers[$subject['name']]['total_hours'] = $totalcount;
            $subjects_teachers[$subject['name']]['total_hours_month'] = $totalcountmonth;

            $completed_hours = $this->db
                ->join('weekly_calendar', 'period_report.calendar_id=weekly_calendar.id')
                ->where($wherearray)
                ->where('subject_id', $subject_id)
                ->where("STR_TO_DATE(date, '%d/%m/%Y') BETWEEN '$start' AND '$end'")
                ->get('period_report')
                ->result_array();

            // $completed_hours=$this->db->select('weekly_calendar.*')->from()
            // echo $this->db->last_query();
            // var_dump($completed_hours);
            // exit;
            $completed_hours_count = 0;

            foreach ($completed_hours as $key => $value) {
                if ($value['period'] == 'ten_to_eleven' || $value['period'] == 'eleven_to_twelve') {
                    $completed_hours_count += 0.75;
                } else {
                    $completed_hours_count += 1;

                }

            }
            // var_dump($completed_hours_count);exit;
            // print_r($this->db->last_query($completed_hours));exit;

            $subjects_teachers[$subject['name']]['completed_hours'] = $completed_hours_count;

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

            $subjects_teachers[$subject['name']]['completed_hours_this_month'] = $completed_hours_this_month_count;

            $filtered_array = [];

            // var_dump($subjects_teachers);
            // exit;
        }
        // $balance=$completed_hours_this_month-$total_hours;

        return $subjects_teachers;
    }


        public function checkDateCalendar(){
            $classid = $this->input->post('class_id');
            $sectionid = $this->input->post('section_id');
            $date = $this->input->post('date');

             $calendarid = $this->db->where([
                 'class_id'=>$classid,
                 'section_id'=>$sectionid,
                 'date'=>$date,
                 ])->get('weekly_calendar')->row()->id;
            
            echo json_encode(['msgid'=>$calendarid]);
        }

   
    public function printwithheaderandfooter()
    {
        $content = $this->input->post('data'); 
        $decompressedData =  (base64_decode($content));
          
        $this->load->library('m_pdf');
        $this->load->library('encryption');
        $this->m_pdf->pdf->SetMargins(0, 20, 30);
        // $centre_id = $this->getCentreId();
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
        
        // var_dump($centre_id);exit;
        if ($centre_id == '1') {
    
            
            $headerfilepath = FCPATH . "/uploads/snconheader.jpg";
            $footerfilepath = FCPATH . "/uploads/footer.png";
        } 
        else if($centre_id=='2')
    
    
        {
            
            $headerfilepath = FCPATH . "/uploads/header.png";
            $footerfilepath = FCPATH . "/uploads/footer.png";
        }
        else{
           
    
            $headerfilepath = FCPATH . "/uploads/header.png";
            $footerfilepath = FCPATH . "/uploads/footer.png";
        }
        // $headerfilepath = FCPATH . "/uploads/header.png";
        // $footerfilepath = FCPATH . "/uploads/footer.png";
        
        // Define the HTML structure for the content
        $html = $decompressedData;
        
        // Set the header and footer
        $header = "<div style='text-align: center;'><img src='" . $headerfilepath . "' alt='Header Image' style='width: 100%;height:11%;'></div>";
        $footer = "<div style='text-align: center;'><img src='" . $footerfilepath . "' alt='Footer Image' style='width: 100%;height:6%;'></div>";
        
        $this->m_pdf->pdf->SetHTMLHeader($header);
        $this->m_pdf->pdf->SetHTMLFooter($footer);
        
        // Encrypt the content
        // $encryptedContent = $this->encryption->encrypt($content);
        
        // Generate a timestamp to append to the filename
        $timestamp = date('YmdHis'); // Format: YearMonthDayHourMinutesSeconds
        $filename = 'pdf_' . $timestamp . '.pdf'; // Construct the new filename
        $serverFilePath = FCPATH.'uploads/' . $filename;
        
        // Save the PDF to the server with the new filename
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($serverFilePath, 'F');
        
        echo json_encode('uploads/' . $filename);
    }
    
    
        public function viewDecryptedContent()
    {
        // Retrieve the encrypted content from your database or source
        $fileContents = file_get_contents('admin/monthlyacademicreport/monthlyacademicreport');
        $encryptedContent = trim($fileContents); // Get the encrypted content
    
        // Decrypt the content
        $decryptedContent = $this->encryption->decrypt($encryptedContent);
    
        // Now you can display or work with the decrypted content
        // For example, you can echo it to your view
        echo $decryptedContent;
    }

    
    public function index2()
    {

        // Get the value of the "test" query parameter from the URL



        // $data['exam_id'] = "";
        // $data['class_id'] = "";
        // $data['section_id'] = "";
        // $exam = $this->exam_model->get();
        // $class = $this->class_model->get();
        // $data['examlist'] = $exam;
        // $data['classlist'] = $class;
        // $class_id = $this->input->post('class_id');
        // $section_id = $this->input->post('section_id');
        // $daterange = explode('-', $this->input->post('date'));

        // echo json_encode($this->input->post());exit;
        $content = $this->input->post('data');


        // $data['week_number'] = $week_number;

        // $data['is_search'] = true;

        // $month = $daterange[0];
        // $year = $daterange[1];
        // $data['month_name'] = date('F', mktime(0, 0, 0, $month, 1));
        // // var_dump($data['month_name']);exit;
        // $data['month'] = $month;
        // $data['year'] = $year;
        // $data['class_name'] = $this->db->select('class')->where('id', $class_id)->get('classes')->row()->class;
        // $data['section_name'] = $this->db->select('section')->where('id', $section_id)->get('sections')->row()->section;


        //Load the library
        $this->load->library('html2pdf');

        //Set folder to save PDF to
        $this->html2pdf->folder('assets/pdfs/');

        //Set the filename to save/download as
        $this->html2pdf->filename('test5.pdf');

        //Set the paper defaults
        $this->html2pdf->paper('a4', 'portrait');

        $data = array(
            'title' => 'PDF Created',
            'message' => 'Hello World!'
        );
        // $content='<h1>sadsa</h1><h2>fdsf</h2>';
        $c = "
        <style>
        @page { margin: 180px 50px; }
         #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; }
         #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 150px;}
         #footer .page:after { content: counter(page, upper-roman); }
        </style>
                
        <div id='header'>
        <img src='uploads/header.png'   alt='Header Image' style='width: 100%;'>
        </div>
        $content
        <div id='footer'>
        <img src='uploads/footer.png'   alt='Header Image' style='width: 100%;'>
        </div> 
                
        ";

        //Load html view
        $this->html2pdf->html($c);

        if ($this->html2pdf->create('save')) {
            //     redirect(base_url('assets/pdfs/test2.pdf'));

            echo json_encode('saved');
        }

    }

    public function mail_pdf()
    {
        //Load the library
        $this->load->library('html2pdf');

        $this->html2pdf->folder('./assets/pdfs/');
        $this->html2pdf->filename('email_test.pdf');
        $this->html2pdf->paper('a4', 'portrait');

        $data = array(
            'title' => 'PDF Created',
            'message' => 'Hello World!'
        );
        //Load html view
        $this->html2pdf->html($this->load->view('pdf', $data, true));

        //Check that the PDF was created before we send it
        if ($path = $this->html2pdf->create('save')) {

            $this->load->library('email');

            $this->email->from('your@example.com', 'Your Name');
            $this->email->to('someone@example.com');

            $this->email->subject('Email PDF Test');
            $this->email->message('Testing the email a freshly created PDF');

            $this->email->attach($path);

            $this->email->send();

            echo $this->email->print_debugger();

        }

    }

    function getDatesForMonth($month, $year)
    {
        $numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $dates = [];

        for ($day = 1; $day <= $numDays; $day++) {
            $date = date("d/m/Y", mktime(0, 0, 0, $month, $day, $year));
            $dates[] = $date;
        }

        return $dates;
    }

    function array_chunk_fixed($array, $chunk_size)
    {
        $chunks = [];
        for ($i = 0; $i < count($array); $i += $chunk_size) {
            $chunks[] = array_slice($array, $i, $chunk_size);
        }
        return $chunks;
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

        $data['period_list'] = $this->db->where([
            'class_id'=>$data['class_id'],
            'section_id'=>$data['section_id'],
            'is_active'=>1
        ])->get('period_timing')->row();

        // $data['view_period_list'] = $this->db->where




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
                    // echo $this->db->last_query();exit;
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

    public function savecalendar()
    {
        $subjects = $this->input->post('subject_id');
        $issubject=0;
        foreach($subjects as $subject){
            if($subject!=""){
                $issubject=1;
                break;
            }
        }
        
        
        
        $teachers = $this->input->post('teacher_id');
        $date = $this->input->post('event_dates');
        $class = $this->input->post('hidden_class');
        $section = $this->input->post('hidden_section');
        $activity = $this->input->post('activity_id');
        $isactivity=0;
        foreach($activity as $activities){
            if($activities!=""){
                $isactivity=1;
                break;
            }
        }
        if ($isactivity==0 && $issubject==0){
            echo json_encode('fail');
        }
        else{
            $isHoliday = in_array('holiday', $activity);

        $active_period_id = $this->db->where([
            'class_id' => $class,
            'section_id' => $section,
            'is_active'=>1
        ])->get('period_timing')->row()->id;

        // Define an array to hold the values for insertion
        $insert_array = [
            'class_id' => $class,
            'section_id' => $section,
            'date' => $date,
            'period_id'=>$active_period_id,
            'eight_to_nine_subject' => $isHoliday ? 'holiday' : $subjects[0],
            'eight_to_nine_teacher' => $isHoliday ? 'holiday' : $teachers[0],
            'nine_to_ten_subject' => $isHoliday ? 'holiday' : $subjects[1],
            'nine_to_ten_teacher' => $isHoliday ? 'holiday' : $teachers[1],
            'ten_to_eleven_subject' => $isHoliday ? 'holiday' : $subjects[2],
            'ten_to_eleven_teacher' => $isHoliday ? 'holiday' : $teachers[2],
            'eleven_to_twelve_subject' => $isHoliday ? 'holiday' : $subjects[3],
            'eleven_to_twelve_teacher' => $isHoliday ? 'holiday' : $teachers[3],
            'twelve_to_one_subject' => $isHoliday ? 'holiday' : $subjects[4],
            'twelve_to_one_teacher' => $isHoliday ? 'holiday' : $teachers[4],
            'two_to_three_subject' => $isHoliday ? 'holiday' : $subjects[5],
            'two_to_three_teacher' => $isHoliday ? 'holiday' : $teachers[5],
            'three_to_four_subject' => $isHoliday ? 'holiday' : $subjects[6],
            'three_to_four_teacher' => $isHoliday ? 'holiday' : $teachers[6],
            'four_to_five_subject' => $isHoliday ? 'holiday' : $subjects[7],
            'four_to_five_teacher' => $isHoliday ? 'holiday' : $teachers[7],
            'eight_to_nine_activity' => $isHoliday ? 'holiday' : $activity[0],
            'nine_to_ten_activity' => $isHoliday ? 'holiday' : $activity[1],
            'ten_to_eleven_activity' => $isHoliday ? 'holiday' : $activity[2],
            'eleven_to_twelve_activity' => $isHoliday ? 'holiday' : $activity[3],
            'twelve_to_one_activity' => $isHoliday ? 'holiday' : $activity[4],
            'two_to_three_activity' => $isHoliday ? 'holiday' : $activity[5],
            'three_to_four_activity' => $isHoliday ? 'holiday' : $activity[6],
            'four_to_five_activity' => $isHoliday ? 'holiday' : $activity[7],
        ];

        // Insert data into the 'weekly_calendar' table
        $this->db->insert('weekly_calendar', $insert_array);

        echo json_encode('success');
        }

        // Check if any of the fields contain 'holiday'
        
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


        // $period_list = $this->db->where([
        //     'class_id'=>$class,
        //     'section_id'=>$section,
        // ])->get('period_timing')->row();

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

            $period_list = $this->db->where([
                'id'=>$value['period_id'] 
            ])->get('period_timing')->row();



            if ($value['eight_to_nine_teacher'] != 0) {
                $name .= "$period_list->period_one_from - $period_list->period_one_to : " . $this->getStaffName($value['eight_to_nine_teacher']) . "" . $this->getSubjectName($value['eight_to_nine_subject']) . "\n";
            } else if ($value['eight_to_nine_activity'] != '') {
                $name .= "$period_list->period_one_from - $period_list->period_one_to : $value[eight_to_nine_activity]\n";
            }

            if ($value['nine_to_ten_teacher'] != 0) {
                $name .= "$period_list->period_two_from - $period_list->period_two_to : " . $this->getStaffName($value['nine_to_ten_teacher']) . "" . $this->getSubjectName($value['nine_to_ten_subject']) . "\n";
            } else if ($value['nine_to_ten_activity'] != '') {
                $name .= "$period_list->period_two_from - $period_list->period_two_to : $value[nine_to_ten_activity]\n";
            }

            if ($value['ten_to_eleven_teacher'] != 0) {
                $name .= "$period_list->period_three_from - $period_list->period_three_to : " . $this->getStaffName($value['ten_to_eleven_teacher']) . "" . $this->getSubjectName($value['ten_to_eleven_subject']) . "\n";
            } else if ($value['ten_to_eleven_activity'] != '') {
                $name .= "$period_list->period_three_from - $period_list->period_three_to : $value[ten_to_eleven_activity]\n";
            }

            if ($value['eleven_to_twelve_teacher'] != 0) {
                $name .= "$period_list->period_four_from - $period_list->period_four_to : " . $this->getStaffName($value['eleven_to_twelve_teacher']) . "" . $this->getSubjectName($value['eleven_to_twelve_subject']) . "\n";
            } else if ($value['eleven_to_twelve_activity'] != '') {
                $name .= "$period_list->period_four_from - $period_list->period_four_to : $value[eleven_to_twelve_activity]\n";
            }

            if ($value['twelve_to_one_teacher'] != 0) {
                $name .= "$period_list->period_five_from - $period_list->period_five_to : " . $this->getStaffName($value['twelve_to_one_teacher']) . "" . $this->getSubjectName($value['twelve_to_one_subject']) . "\n";
            } else if ($value['twelve_to_one_activity'] != '') {
                $name .= "$period_list->period_five_from - $period_list->period_five_to : $value[twelve_to_one_activity]\n";
            }

            if ($value['two_to_three_teacher'] != 0) {
                $name .= "$period_list->period_six_from - $period_list->period_six_to : " . $this->getStaffName($value['two_to_three_teacher']) . "" . $this->getSubjectName($value['two_to_three_subject']) . "\n";
            } else if ($value['two_to_three_activity'] != '') {
                $name .= "$period_list->period_six_from - $period_list->period_six_to : $value[two_to_three_activity]\n";
            }

            if ($value['three_to_four_teacher'] != 0) {
                $name .= "$period_list->period_seven_from - $period_list->period_seven_to : " . $this->getStaffName($value['three_to_four_teacher']) . "" . $this->getSubjectName($value['three_to_four_subject']) . "\n";
            } else if ($value['three_to_four_activity'] != '') {
                $name .= "$period_list->period_seven_from - $period_list->period_seven_to : $value[three_to_four_activity]\n";
            }

            if ($value['four_to_five_teacher'] != 0) {
                $name .= "$period_list->period_eight_from - $period_list->period_eight_to : " . $this->getStaffName($value['four_to_five_teacher']) . "" . $this->getSubjectName($value['four_to_five_subject']) . "\n";
            } else if ($value['four_to_five_activity'] != '') {
                $name .= "$period_list->period_eight_from - $period_list->period_eight_to : $value[four_to_five_activity]\n";
            }

            // echo $this->getDayFormatYDM($value['date']);
            // echo '<br/>';

            $eventdata[] = array(
                'id' => $value['id'],
                'title' => $name,
                'start' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),
                'end' => (date("Y-m-d", strtotime($this->getDayFormatYDM($value['date'])))),

            );
            $name = '';

        }
        // exit;
        echo json_encode($eventdata);

    }

    public function getDayFormatYDM($date)
    {
        $date_string = $date;
        $date_format = 'd/m/Y';
        $dateformat = DateTime::createFromFormat($date_format, $date_string);
        return $dateformat->format('Y-m-d');
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

        $timetable = $this->db
        ->select('weekly_calendar.*,period_timing.*')
        ->join('period_timing','period_timing.id=weekly_calendar.period_id')
        ->where('weekly_calendar.id', $id)->get('weekly_calendar')->row_array();
 

        $periods = [];
 
        foreach ($timetable as $key => $value) { 
            if (strpos($key, 'period') === 0 && strpos($key, '_from') !== false) {
                
                $period_number = substr($key, strpos($key, '_') + 1, strpos($key, '_from') - strpos($key, '_') - 1);
                $to_key = str_replace('_from', '_to', $key);
                $periods['period_' . $period_number] = $value . ' - ' . $timetable[$to_key];
            }
        }
  
        $timetablearr = array_merge($timetable,$periods);
        
        echo json_encode($timetablearr); 

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