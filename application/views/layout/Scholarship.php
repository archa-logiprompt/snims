<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Scholarship extends Admin_Controller {

    function __construct() {
        parent::__construct();
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('scholarship', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'Scholarship');
		$this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
		$data['title'] = 'Scholarship List';
		$sch= $this->student_model->getscholarship();
		$data['sch']=$sch;
		
		
		$this->form_validation->set_rules('name', 'Name', 'required');
       
		  if ($this->form_validation->run() == FALSE) {
		  
		  }
		  
		else
		{
		   $data=array(
		   'name'=>$this->input->post('name'),
		   'description'=>$this->input->post('description'),
		   'valid_from'=>$this->input->post('valid_from'),
		   'valid_to'=>$this->input->post('valid_to'),
		    'session_id' => $this->setting_model->getCurrentSession()
		   );	
			
			 $feegroup_result = $this->student_model->scholarship($data);
			 $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Scholarship added successfully</div>');
            redirect('admin/scholarship/index');
			
		}
		
		
		
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/scholarship/scholarship',$data);
        $this->load->view('layout/footer',$data);
		
		
		}
		
		

    function delete($id) {
        if (!$this->rbac->hasPrivilege('scholarship', 'can_delete')) {
            access_denied();
        }
        //$data['title'] = 'Fees Master List';
        $this->student_model->removescholar($id);
         redirect('admin/scholarship/index');
    }



    function edit($id) {
        if (!$this->rbac->hasPrivilege('scholarship', 'can_edit')) {
            access_denied();
        }
      $this->session->set_userdata('top_menu', 'Scholarship');
	$this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
        //$data['id'] = $id;
        $sch= $this->student_model->getscholarship();
		$data['sch']=$sch;
		$scholar= $this->student_model->getscholarship($id);
		$data['scholar']=$scholar;
		
		
       $this->form_validation->set_rules('name', 'Name', 'required');
		
        if ($this->form_validation->run() == FALSE) {
          
		$this->load->view('layout/header',$data);
        $this->load->view('admin/scholarship/scholarship_edit',$data);
        $this->load->view('layout/footer',$data);
		
        }else
		{
		   $data=array(
		   'id'=>$this->input->post('id'), 
		   'name'=>$this->input->post('name'),
		   'description'=>$this->input->post('description'),
		   'valid_from'=>$this->input->post('valid_from'),
		   'valid_to'=>$this->input->post('valid_to'),
		    'session_id' =>$this->setting_model->getCurrentSession()
		   );	
         	 $feegroup_result = $this->student_model->scholarship($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Scholarship updated successfully</div>');
             redirect('admin/scholarship/index');
        }
    
	
	
	}
	
	
	
	 function assign($id) {
        if (!$this->rbac->hasPrivilege('scholarship', 'can_view')) {
           access_denied();
        }
        $this->session->set_userdata('top_menu', 'Scholarship');
       $this->session->set_userdata('sub_menu', 'scholarship/scholarship_details');
        $data['id'] = $id;
        $student=$this->student_model->getstudent_scholarship($id);
	    $data['sch']= $student ; 

	    $this->load->view('layout/header', $data);
        $this->load->view('admin/scholarship/assign', $data);
        $this->load->view('layout/footer', $data);
    }


 function applyscholar() {
	 
	$this->load->view('layout/header');
        $this->load->view('admin/scholarship/applyscholarship');
        $this->load->view('layout/footer'); 
	 
	 
	 
 }



/*function search() {

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
            $this->load->view('scholarship/scholarshipSearch', $data);
            $this->load->view('layout/footer', $data);
        }
    }*/


/*function view($id) {

        
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
       
        $data["session"]  = $current_student_session["session"]; 
        $student_due_fee = $this->studentfeemaster_model->getStudentFees($student['student_session_id']);
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
        
        $studentlistbysection = $this->student_model->getStudentClassSection($student["class_id"],$session);
        $data["studentlistbysection"] = $studentlistbysection;
        $this->load->view('layout/header', $data);
        $this->load->view('scholarship/assign', $data);
        $this->load->view('layout/footer', $data);
    }


*/

}


?>