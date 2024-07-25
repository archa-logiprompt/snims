<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ExamSchedule extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
    }

    function index() {
        if (!$this->rbac->hasPrivilege('exam_schedule', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'examschedule/index');
        $data['title'] = 'Exam Schedule';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        $admin=$this->session->userdata('admin');
        $data['centre_id'] = $admin['centre_id'];
        // var_dump($data['centre_id']);exit;
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sub_type', 'Type', 'trim|required|xss_clean');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_schedule/examList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data['student_due_fee'] = array();
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');
			$data['sub_type']=$this->input->post('sub_type');
			if($data['sub_type']=='Theory')
			{
            $examSchedule = $this->examschedule_model->getExamByClassandSection($data['class_id'], $data['section_id']);
			 
			}
			elseif($data['sub_type']=='Practical')
			{
				 $examSchedule = $this->examschedule_model->practicalByClassandSection($data['class_id'], $data['section_id']);
				
				}
                elseif($data['sub_type']=='Viva')
            {
                 $examSchedule = $this->examschedule_model->vivaByClassandSection($data['class_id'], $data['section_id']);
                
                }
			
            $data['examSchedule'] = $examSchedule;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_schedule/examList', $data);
            $this->load->view('layout/footer', $data);
        }
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('exam_schedule', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Exam Schedule List';
        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/exam_schedule/examShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        //  if(!$this->rbac->hasPrivilege('exam_schedule','can_delete')){
        // access_denied();
        // }
        $data['title'] = 'Exam Schedule List';
        $this->exam_model->remove($id);
        redirect('admin/exam_schedule/index');
    }
function create() {
        if (!$this->rbac->hasPrivilege('exam_schedule', 'can_add')) {
            access_denied();
        }
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
                   
                    
        $admin=$this->session->userdata('admin');
        $data['centre_id'] = $admin['centre_id'];

        $data['teacherlist']=$this->staff_model->getStaffbyrole(2);
        // var_dump($data['teacherlist']);exit;
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        //$data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //     if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //   $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		$this->form_validation->set_rules('sub_type', 'Subject type', 'trim|required|xss_clean');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_schedule/examCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $admin=$this->session->userdata('admin');
             $centre_id=$admin['centre_id'];
            $feecategory_id = $this->input->post('feecategory_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			$sub_type=$this->input->post('sub_type');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			$data['sub_type']=$sub_type;
            // var_dump($data['sub_type']);
			if($sub_type=='Theory')
				{
			 $examSchedule = $this->teachersubject_model->getDetailbyClsandSection($class_id, $section_id, $exam_id,$sub_type);

				}
				elseif($sub_type=='Practical')
				{
					 $examSchedule = $this->teachersubject_model->getPracticalbyClsandSection($class_id, $section_id, $exam_id,$sub_type);
					
					}
                    elseif($sub_type=='Viva')
                {
                     $examSchedule = $this->teachersubject_model->getVivabyClsandSection($class_id, $section_id, $exam_id,$sub_type);
                    // var_dump($examSchedule);

                    }
			
			 $data['examSchedule'] = $examSchedule;
             //var_dump( $examSchedule);
            if ($this->input->post('save_exam') == "save_exam") {
                $i = $this->input->post('i');
				
				
					
				if($sub_type=='Theory')
				{
                foreach ($i as $key => $value) {
					$ab=$this->input->post('date_' . $value);
					
					if(!empty($ab)){
                    $data = array(
                        'centre_id'=>$centre_id,
                        'session_id' => $session,
                        'teacher_subject_id' => $value,
                        'exam_id' => $this->input->post('exam_id'),
                        'date_of_exam' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_' . $value))),
                        'start_to' => $this->input->post('stime_' . $value),
                        'end_from' => $this->input->post('etime_' . $value),
                        'room_no' => $this->input->post('room_' . $value),
                        'full_marks' => $this->input->post('fmark_' . $value),
                        'passing_marks' => $this->input->post('pmarks_' . $value),
                        'teacher'=>$this->input->post('teacher_' .$value),
                        'topics'=>$this->input->post('topic_' . $value)
                    );

                    $this->exam_model->add_exam_schedule($data);
                }
				}
				  redirect('admin/examschedule');
				}
				
				
				elseif($sub_type=='Practical')
				{
				 foreach ($i as $key => $value) {
					 $ab=$this->input->post('date_' . $value);
					
					if(!empty($ab)){
                    $data = array(
                        'centre_id'=>$centre_id,
                        'session_id' => $session,
                        'teacher_subject_id' => $value,
                        'exam_id' => $this->input->post('exam_id'),
                        'date_of_exam' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_' . $value))),
                        'start_to' => $this->input->post('stime_' . $value),
                        'end_from' => $this->input->post('etime_' . $value),
                        'room_no' => $this->input->post('room_' . $value),
                        'full_marks' => $this->input->post('fmark_' . $value),
                        'passing_marks' => $this->input->post('pmarks_' . $value),
                           'teacher'=>$this->input->post('teacher_' .$value),
                        'topics'=>$this->input->post('topic_' . $value)
                    );

                    $this->exam_model->add_practical_schedule($data);
					}
                }
				
				
		 

                redirect('admin/examschedule');
            }

           elseif($sub_type=='Viva')
                {
                 foreach ($i as $key => $value) {
                     $ab=$this->input->post('date_' . $value);
                    
                    if(!empty($ab)){
                    $data = array(
                        'centre_id'=>$centre_id,
                        'session_id' => $session,
                        'teacher_subject_id' => $value,
                        'exam_id' => $this->input->post('exam_id'),
                        'date_of_exam' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date_' . $value))),
                        'start_to' => $this->input->post('stime_' . $value),
                        'end_from' => $this->input->post('etime_' . $value),
                        'room_no' => $this->input->post('room_' . $value),
                        'full_marks' => $this->input->post('fmark_' . $value),
                        'passing_marks' => $this->input->post('pmarks_' . $value),
                           'teacher'=>$this->input->post('teacher_' .$value),
                        'topics'=>$this->input->post('topic_' . $value)
                    );

                    $this->exam_model->add_viva_schedule($data);
                    }
                }
                
                
                
                redirect('admin/examschedule');
            }


			}
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_schedule/examCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function edit($id) {
        if (!$this->rbac->hasPrivilege('exam_schedule', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Exam Schedule';
        $data['id'] = $id;
        $exam = $this->exam_model->get($id);
        $data['exam'] = $exam;
        $this->form_validation->set_rules('name', 'Exam Schedule', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/exam_schedule/examEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->exam_model->add($data);
            $this->session->set_flashdata('msg', '<div exam="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/exam_schedule/index');
        }
    }

    function getexamscheduledetail() {
        $exam_id = $this->input->post('exam_id');
        $section_id = $this->input->post('section_id');
        $class_id = $this->input->post('class_id');
	    $sub_type=$this->input->post('sub_type');
		
		if($sub_type=='Theory')
		{ 
        $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
		}
		elseif($sub_type=='Practical')
		{
		$examSchedule = $this->examschedule_model->practicalDetailbyClsandSection($class_id, $section_id, $exam_id);	
			}

            elseif($sub_type=='Viva')
        {
        $examSchedule = $this->examschedule_model->vivaDetailbyClsandSection($class_id, $section_id, $exam_id);    
            }
        echo json_encode($examSchedule);
    }
	
	function deleted($id,$eid,$type) {

        $data['title'] = 'Exam List';
		 $data = array(); 
// 		if(!empty($id)){
// 			$id1 = $this->examschedule_model->remove($id,$eid);
// 			if($id1){
//                     $data['statusMsg'] = 'deleted successfully';
//                 }else{
//                     $data['statusMsg'] = 'please try again';
//                 }
            // }
        
        $this->examschedule_model->remove($eid,$type);
        redirect('admin/examschedule/index',$data);
    }

}

?>