<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Staffevaluation extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
        $this->load->model("stuattendence_model");
        $this->load->model("Teachersubject_model");
    }

    function index() {
        if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'evaluation/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
       // $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
       // $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        //if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/staffevaluation/classroomteaching', $data);
            $this->load->view('layout/footer', $data);
        //} else {
            //$class_id = $this->input->post('class_id');
            //$section_id = $this->input->post('section_id');
            //$data['class_id'] = $class_id;
            //$data['section_id'] = $section_id;
             
            
             
			//var_dump($final_array);
					//exit();
            /*$data['result_array'] = $final_array;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableList', $data);
            $this->load->view('layout/footer', $data);*/
        //}
    }
	function classroomscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/classroomscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/classroomteachingscore', $data);
        $this->load->view('layout/footer', $data);
		}
	function teachinglectures(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/teachinglectures');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/teachinglectures', $data);
        $this->load->view('layout/footer', $data);
		}
	function teachinglecturesscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/teachinglecturesscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/teachinglecturesscore', $data);
        $this->load->view('layout/footer', $data);
		}
	function dentalclinicbased(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/dentalclinicbased');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/dentalclinicbased', $data);
        $this->load->view('layout/footer', $data);
		}
	function dentalclinicbasedscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/dentalclinicbasedscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/dentalclinicbasedscore', $data);
        $this->load->view('layout/footer', $data);
		}
	function patientcare(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/patientcare');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/patientcare', $data);
        $this->load->view('layout/footer', $data);
		}
	function patientcarescore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/patientcarescore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/patientcarescore', $data);
        $this->load->view('layout/footer', $data);
		}
	function scheduledevelopment(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/scheduledevelopment');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/scheduledevelopment', $data);
        $this->load->view('layout/footer', $data);
		}
	function scheduledevelopmentscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/scheduledevelopmentscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/scheduledevelopmentscore', $data);
        $this->load->view('layout/footer', $data);
		}
	function researchsupervision(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/researchsupervision');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/researchsupervision', $data);
        $this->load->view('layout/footer', $data);
		}
	function researchsupervisionscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/researchsupervisionscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/researchsupervisionscore', $data);
        $this->load->view('layout/footer', $data);
		}
	function participationfaculty(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/participationfaculty');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/participationfaculty', $data);
        $this->load->view('layout/footer', $data);
		}
	function participationfacultyscore(){
		 if (!$this->rbac->hasPrivilege('staff_evaluation', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Staff Evaluation');
        $this->session->set_userdata('sub_menu', 'admin/participationfacultyscore');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Staff Evaluation';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $userdata = $this->customlib->getUserData();
		$this->load->view('layout/header', $data);
        $this->load->view('admin/staffevaluation/participationfacultyscore', $data);
        $this->load->view('layout/footer', $data);
		}

    function view($id) {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/timetable/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_add')) {
            access_denied();
        }
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['subject_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
		$data['teacher_id']="";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }    
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		 $this->form_validation->set_rules('teacher_id', 'Teacher', 'trim|required|xss_clean');
		 
		  /*$this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
                )
        );*/
		
		 	
		       
		 
		 
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $admin=$this->session->userdata('admin');
             $centre_id=$admin['centre_id'];
            $feecategory_id = $this->input->post('feecategory_id');
            $subject_id = $this->input->post('subject_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			 $teacher_id = $this->input->post('teacher_id');
            $data['subject_id'] = $subject_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			$data['teacher_id']=$teacher_id;
            $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $array = array();
            $data['timetableSchedule'] = array();
            foreach ($getDaysnameList as $key => $value) {
                $where_array = array(
                    'teacher_subject_id' => $subject_id,
                    'day_name' => $value
                );
                $result = $this->timetable_model->get($where_array);
				
				
                if (empty($result)) {
                    $obj = new stdClass();
                    $obj->starting_time = "";
                    $obj->post_id = 0;
                    $obj->ending_time = "";
                    $obj->room_no = "";
                } else {
					$timetable=array();
					foreach( $result as $res)
					{
                    $obj = new stdClass();
                    $obj->starting_time = $res['start_time'];
                    $obj->post_id = $res['id'];
                    $obj->ending_time = $res['end_time'];
                    $obj->room_no = $res['room_no'];
					$timetable[]=$obj;
                }}
                $array[$value] =$timetable; 
            }
            $data['timetableSchedule'] = $array;
            if ($this->input->post('save_exam') == "save_exam") {
				
                $loop = $this->input->post('i');
				$keys=$this->input->post('key');
				
                foreach ($loop as $key => $value) {
					
					
					$start_time=$this->input->post('stime_'.$value);
					$end_time=$this->input->post('etime_'.$value);
					$room_no=$this->input->post('room_' . $value);
					$c=count($start_time);
					for($i=0;$i<$c;$i++)
					{
					
				    //check_exits($value,$start_time, $end_time,$subject_id);
					
				    $datetime1= new DateTime($start_time[$i]);
					$datetime2= new DateTime($end_time[$i]);
					$interval = $datetime1->diff($datetime2);
                    $hours=$interval->format('%h');
					$min=$interval->format('%i');
					$totalmin=(($hours *60)+$min);
					
					
                    $data = array(
                        'centre_id'=>$centre_id,
                        'day_name' => $value,
                        'teacher_subject_id' => $this->input->post('subject_id'),
                        'start_time' => $start_time[$i],
                        'end_time' => $end_time[$i],
                        'room_no' =>$room_no[$i] ,
						'total_time'=>$totalmin, 
                        'id' => $this->input->post('edit_'.$value),
					
                    );
                    $this->timetable_model->add($data);
                } }
                redirect('admin/timetable');
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Mark';
        $data['id'] = $id;
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee added successfully</div>');
            redirect('admin/timetable/index');
        }
    }


 function check_exists()
 {
	
	$this->timetable_model->valid_check_exists();
	 
	 
	 
 }

 

function staffReport() {

        if (!$this->rbac->hasPrivilege('staff_report', 'can_view')) {
            access_denied();
        }
        // $userdata = $this->customlib->getUserData();
        // $dept=$userdata['department'];
        // echo $dept;
        $this->session->set_userdata('top_menu', 'staff_evaluation');
        $this->session->set_userdata('sub_menu', 'staffevaluation/staffReport');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        //$data['monthlist'] = $this->customlib->getMonthDropdown();
        //$data['yearlist'] = $this->stuattendence_model->attendanceYearCount();
        
        
        $data['class_id'] = "";
        $data['section_id'] = "";
         $data['subject_id'] = "";
         $data['staff_id'] = "";
         $data['session_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
         $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/staffReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin=$this->session->userdata('admin');
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $sub=getsubjectid($this->input->post('subject_id'));
            $staff = $this->input->post('staff_id');
            $session = $this->input->post('session_id');
            $from = date('Y-m-d',strtotime($this->input->post('from')));
            $to = date('Y-m-d',strtotime($this->input->post('to')));
            
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['staff_id'] = $staff;
            $data['session_id'] = $session;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
			
			$report = $this->stuattendence_model->staffreport($class, $section, $sub,$staff,$from,$to,$session_id);
			
			
			
           
            $data['report'] = $report;
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/staffReport', $data);
            $this->load->view('layout/footer', $data);
        }
    }
function staffReportApprove() {

        if (!$this->rbac->hasPrivilege('staff_reportapprove', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $dept=$userdata['department'];
        // echo $dept;
        $this->session->set_userdata('top_menu', 'staff_reportapprove');
        $this->session->set_userdata('sub_menu', 'staffevaluation/staffReportApprove');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();

        $data['session_id'] = "";
        
            $admin=$this->session->userdata('admin');
            //var_dump($userdata);exit;
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            
            $data['session_id'] = $session;
            
            
            $report = $this->stuattendence_model->staffreportapprove($session_id,$dept);
        
           
            $data['report'] = $report;
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/staffReportapprove', $data);
            $this->load->view('layout/footer', $data);
        // }
    }





function clinicalReportApprove() {

        if (!$this->rbac->hasPrivilege('clinical_reportapprove', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $dept=$userdata['department'];
        // echo $dept;
        $this->session->set_userdata('top_menu', 'clinical_reportapprove');
        $this->session->set_userdata('sub_menu', 'staffevaluation/clinicalReportApprove');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        // var_dump($attendencetypes);
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();

        $data['session_id'] = "";
        
            $admin=$this->session->userdata('admin');
            // var_dump($userdata);exit;
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            
            $data['session_id'] = $session;
            
            
            $report = $this->stuattendence_model->clinicalreportapprove($session_id,$dept);
            $data['report'] = $report;
           // var_dump($data['report']);
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/clinicalReportapprove', $data);
            $this->load->view('layout/footer', $data);
        // }
    }

function approvenew($id) {
    
    $this->stuattendence_model->approvenew($id);

redirect('admin/staffevaluation/clinicalReportApprove');


}






 
function approve($id) {
    
    $this->stuattendence_model->approve($id);

redirect('admin/staffevaluation/staffReportApprove');


}



function MyReport() {

        if (!$this->rbac->hasPrivilege('my_report', 'can_view')) {
            access_denied();
        }
        // $userdata = $this->customlib->getUserData();
        // $dept=$userdata['department'];
        // echo $dept;
        $userdata = $this->customlib->getUserData();
        $staff=$userdata['id'];
        $this->session->set_userdata('top_menu', 'my_report');
        $this->session->set_userdata('sub_menu', 'staffevaluation/MyReport');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        //$data['monthlist'] = $this->customlib->getMonthDropdown();
        //$data['yearlist'] = $this->stuattendence_model->attendanceYearCount();
        
        $data['class_id'] = "";
        $data['section_id'] = "";
         $data['subject_id'] = "";
         $data['staff_id'] = "";
         $data['session_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
         $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/myReport', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin=$this->session->userdata('admin');
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $sub=getsubjectid($this->input->post('subject_id'));
            // $staff = $this->input->post('staff_id');
            $session = $this->input->post('session_id');
            $from = date('Y-m-d',strtotime($this->input->post('from')));
            $to = date('Y-m-d',strtotime($this->input->post('to')));
            
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            // $data['staff_id'] = $staff;
            $data['session_id'] = $session;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
            
            // var_dump($staff);exit;
            $report = $this->stuattendence_model->myreport($class, $section, $sub,$from,$to,$session_id,$staff);
            
            
           
            $data['report'] = $report;
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/myReport', $data);
            $this->load->view('layout/footer', $data);
        }
    }
function hodReportview() {

        if (!$this->rbac->hasPrivilege('hodview_report', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $dept=$userdata['department'];
        // $userdata = $this->customlib->getUserData();
        // $dept=$userdata['department'];
        // echo $dept;
        $this->session->set_userdata('top_menu', 'HodReportview');
        $this->session->set_userdata('sub_menu', 'staffevaluation/hodReportview');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();
        //      if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        //$data['monthlist'] = $this->customlib->getMonthDropdown();
        //$data['yearlist'] = $this->stuattendence_model->attendanceYearCount();
        
        
        $data['class_id'] = "";
        $data['section_id'] = "";
         $data['subject_id'] = "";
         $data['staff_id'] = "";
         $data['session_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
         $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/hodReportview', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $userdata = $this->customlib->getUserData();
            $dept=$userdata['department'];
            $admin=$this->session->userdata('admin');
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $sub=getsubjectid($this->input->post('subject_id'));
            $staff = $this->input->post('staff_id');
            $session = $this->input->post('session_id');
            $from = date('Y-m-d',strtotime($this->input->post('from')));
            $to = date('Y-m-d',strtotime($this->input->post('to')));
            
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['staff_id'] = $staff;
            $data['session_id'] = $session;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
            
            $report = $this->stuattendence_model->hdreport($class, $section, $sub,$staff,$from,$to,$session_id,$dept);
            
            
            
           
            $data['report'] = $report;
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/hodReportview', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function hodclinicalReportview() {

        if (!$this->rbac->hasPrivilege('hodviewclinical_report', 'can_view')) {
            access_denied();
        }
        $userdata = $this->customlib->getUserData();
        $dept=$userdata['department'];
        $this->session->set_userdata('top_menu', 'hodviewclinical_report');
        $this->session->set_userdata('sub_menu', 'staffevaluation/hodclinicalReportview');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Report';
        $data['title_list'] = 'Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $session_id=$this->setting_model->getCurrentSession();
        $data['class_id'] = "";
        $data['section_id'] = "";
         $data['subject_id'] = "";
         $data['staff_id'] = "";
         $data['session_id'] = "";
        $data['date'] = "";
        $data['month_selected'] = "";
        $data['year_selected'] = "";
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
         $this->form_validation->set_rules('from', 'From', 'trim|required|xss_clean');
        $this->form_validation->set_rules('to', 'To', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        //$this->form_validation->set_rules('month', 'Month', 'trim|required|xss_clean');
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/hodclinicalReportview', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $userdata = $this->customlib->getUserData();
            $dept=$userdata['department'];
            $admin=$this->session->userdata('admin');
            $session_id=$this->setting_model->getCurrentSession();
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $subject = $this->input->post('subject_id');
            $sub=getsubjectid($this->input->post('subject_id'));
            $staff = $this->input->post('staff_id');
            $session = $this->input->post('session_id');
            $from = date('Y-m-d',strtotime($this->input->post('from')));
            $to = date('Y-m-d',strtotime($this->input->post('to')));
            
            $data['class_id'] = $class;
            $data['section_id'] = $section;
            $data['subject_id'] = $subject;
            $data['staff_id'] = $staff;
            $data['session_id'] = $session;
            $data['from'] = $from;
            $data['to'] = $to;
            $data['month_selected'] = date("m", strtotime($from));
            
            $report = $this->stuattendence_model->hdclinireport($class, $section, $sub,$staff,$from,$to,$session_id,$dept);
            // print_r($this->db->last_query());exit;
            
            
           
            $data['report'] = $report;
           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/stuattendence/hodclinicalReportview', $data);
            $this->load->view('layout/footer', $data);
        }
    }









}




?>