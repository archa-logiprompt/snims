<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklycalendarstudent extends Student_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
		$this->load->model('Timetablenew_model');
		$this->load->helper('lang');
    }

    function index() {
        // if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
        //     access_denied();
        // }
        $this->session->set_userdata('top_menu', 'Weeklycalendarstudent');
        // $this->session->set_userdata('sub_menu', 'Weeklycalendarstudent/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        // $exam = $this->exam_model->get();
        // $class = $this->class_model->get();
        // $data['examlist'] = $exam;
        // $data['classlist'] = $class;
        // $userdata = $this->customlib->getUserData();

        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);

        // var_dump($student['class_id']);exit;
       
     
            $class_id = $student['class_id'];
            $section_id = $student['section_id'];
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;


            $data['class_name']=$this->db->select('class')->where('id',$class_id)->get('classes')->row()->class;
            $data['section_name']=$this->db->select('section')->where('id',$section_id)->get('sections')->row()->section;

            


            $wherearray = [
                'course_id'=>$class_id,
                'batch_id'=>$section_id,
            ];
            $data['weekcalendar']=$this->db->where($wherearray)->get('week_calendar')->result_array();
            $data['period_list'] = $this->db->where([
                'class_id'=>$class_id,
                'section_id'=>$section_id,
            ])->get('period_timing')->row();

            // var_dump($this->db->last_query());exit;
            
            $this->load->view('layout/student/header', $data); 
            $this->load->view('student/student_weekly_calendar', $data);
            $this->load->view('layout/student/footer', $data);
		
    }

   
    function create() {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_add')) {
			
            access_denied();
        }
		
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['subject_id'] = "";
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
		$data['department_id']="";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $data['isupdate'] =false;
        $data['issearch'] =false;

        
        $event_colors = array("#03a9f4", "#c53da9", "#757575", "#8e24aa", "#d81b60", "#7cb342", "#fb8c00", "#fb3b3b");
        $data["event_colors"] = $event_colors;
        if ($this->input->server('REQUEST_METHOD') == "POST") {



            if($this->input->post('search')=='Search'){

                $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
                    $this->load->view('layout/footer', $data);
                } else {

                $data['class_id'] = $this->input->post('class_id');
                $data['section_id'] = $this->input->post('section_id');
                $data['issearch'] = true;

                
                $wherearray = [
                    'course_id'=> $data['class_id'],
                    'batch_id'=>  $data['section_id'],
                ];
                $data['weekcalendar']=$this->db->where($wherearray)->get('week_calendar')->result_array();


                $data['isupdate'] = !empty($data['weekcalendar']);

           

                
                $this->load->view('layout/header', $data);
                $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
                $this->load->view('layout/footer', $data);

            }
            
        }
 
    }
    else{
        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendarnew/createcalendar', $data);
        $this->load->view('layout/footer', $data);
    }
        
         
    }

    function getSubjctByClassandSectionNew() {
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
        $data = $this->teachersubject_model->getSubjectByClsandSectionNew($class_id, $section_id);
        echo json_encode($data);
    }

    function get_subjectteachers() {
        $subject_id = $this->input->post('subject_id');

        $data = $this->teachersubject_model->get_subjectteachers($subject_id);
        echo json_encode($data);
    }
 
 function getcalendar(){

    $section = $this->input->post('section_id');
    $class = $this->input->post('class_id');



    $calendar =
    $this->db 
    ->where([
        'section_id'=>$section,
        'class_id'=>$class
    ])
    ->get('weekly_calendar')->result_array();
    
    
        
    $eventdata = [];

 
    $name ='';
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
 
        $eventdata[] = array(
        'id'=>$value['id'],
        'title' => $name,
        'start' => (date("Y-d-m", strtotime($value['date']))),
        'end' => (date("Y-d-m", strtotime($value['date']))),
        
    );  
    $name ='';

    }
    
   
       echo json_encode($eventdata);
         
    
 } 

 function view_event($id){

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


    // $timetable = $this->db->where('id',$id)->get('weekly_calendar')->row();
    //  echo json_encode($timetable);
 }


 function getStaffName($id){

     

    $name = $this->db->select('staff.name')->where('staff.id',$id)->get('staff')->row();

    return $name->name;

 }
 function getSubjectName($id){

     

    $name = $this->db->select('subjects.name')->from('subjects')->join('teacher_subjects','teacher_subjects.subject_id=subjects.id')->where('teacher_subjects.id',$id)->get()->row();

    return " (".substr($name->name,0,4).")";

 }


}

?>