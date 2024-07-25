<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mark extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('smsgateway');
        $this->load->library('mailsmsconf');
		$this->load->helper('lang');
        $this->load->model("classteacher_model");
    }

    function index() {
		
        // if(!$this->rbac->hasPrivilege('marks_register','can_view')){
        // access_denied();
        // }
		
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/index');
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
		
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        // 		$data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        //   }
		
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		  $this->form_validation->set_rules('sub_type', 'Type', 'trim|required|xss_clean');
		
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			$sub_type=$this->input->post('sub_type');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			$data['sub_type']=$sub_type;
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
			
			
            $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
            $data['examSchedule'] = array();
            if (!empty($examSchedule)) {
                $new_array = array();
                $data['examSchedule']['status'] = "yes";
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['id'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {

                        
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
						$exam_array['subject_id'] = $ex_value['subject_id'];
						$exam_array['teacher_subject_id'] = $ex_value['teacher_subject_id'];
						$exam_array['teacher_id'] = $ex_value['teacher_id'];
                        $exam_array['exam_id'] = $ex_value['exam_id'];
                        $exam_array['full_marks'] = $ex_value['full_marks'];
                        $exam_array['passing_marks'] = $ex_value['passing_marks'];
                        $exam_array['exam_name'] = $ex_value['name'];
                        $exam_array['exam_type'] = $ex_value['type'];
						if($sub_type=='Theory')
						{
                        $student_exam_result = $this->examresult_model->get_result($ex_value['id'], $stu_value['id']);
						}
						elseif($sub_type=='Practical')
						{
							 $student_exam_result = $this->examresult_model->get_practicalexam_result($ex_value['id'], $stu_value['id']);
							
							}

                        elseif($sub_type=='Viva')
                        {
                             $student_exam_result = $this->examresult_model->get_vivaexam_result($ex_value['id'], $stu_value['id']);
                            
                            }    
						
                        if (empty($student_exam_result)) {
                            
                        } else {
                            $exam_array['attendence'] = $student_exam_result->attendence;
                            $exam_array['get_marks'] = $student_exam_result->get_marks;
                        }
                        $x[] = $exam_array;
                    }
                    if (empty($x)) {
                        $data['examSchedule']['status'] = "no";
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }

                $data['examSchedule']['result'] = $new_array;
            } else {
                $s = array('status' => 'no');
                $data['examSchedule'] = $s;
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markList', $data);
            $this->load->view('layout/footer', $data);
        }
    }


        function earnedmark() {
      
        $this->session->set_userdata('top_menu', 'Examinations');
        $this->session->set_userdata('sub_menu', 'mark/earnedmark');
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
       
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
       
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
   
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markEarnList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $feecategory_id = $this->input->post('feecategory_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $sub_type=$this->input->post('sub_type');
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id; 
            $data['studentList'] = $this->student_model->searchByClassSectionFull($class_id, $section_id);
            $data['examsubjects'] = $this->examschedule_model->getSubjectsFull($exam_id);


             // var_dump($data['examsubjects']);
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markEarnList', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    function view($id) {
        if (!$this->rbac->hasPrivilege('marks_register', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/mark/markShow', $data);
        $this->load->view('layout/footer', $data);
    }
	

    function delete($id) {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/mark/index');
    }

    function create() {
        // if(!$this->rbac->hasPrivilege('marks_register','can_add')){
        // access_denied();
        // }
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Schedule';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassbyteacher($userdata["id"]);
        // } 
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('exam_id', 'Exam', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		/*$this->form_validation->set_rules('date', 'date', 'trim|required|xss_clean');*/
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        } else {

            $admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];
           
            $feecategory_id = $this->input->post('feecategory_id');
            $exam_id = $this->input->post('exam_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			$sub_type=$this->input->post('sub_type');
			 $date=$this->input->post('date');
			 $data['date'] = $date;
            $data['exam_id'] = $exam_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			$data['sub_type']=$sub_type;
            $userdata = $this->customlib->getUserData();
            $getTeacherSubjects = array();
            if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
                $getTeacherSubjects = $this->examschedule_model->getTeacherSubjects($class_id, $section_id, $userdata["id"]);
            }
            
            $data["teacher_subjects"] = $getTeacherSubjects;
			if($sub_type=='Theory')
			{
            $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);
            // exit;
			}
			elseif($sub_type=='Practical')
			{
				 $examSchedule = $this->examschedule_model->practicalDetailbyClsandSection($class_id, $section_id, $exam_id);
				
				}
            elseif($sub_type=='Viva')
            {
                 $examSchedule = $this->examschedule_model->vivaDetailbyClsandSection($class_id, $section_id, $exam_id);
                
                }





            $studentList = $this->student_model->searchByClassSection($class_id, $section_id);
            if (!empty($examSchedule)) {
                $new_array = array();
                foreach ($studentList as $stu_key => $stu_value) {
                    $array = array();
                    $array['student_id'] = $stu_value['id'];
                    $array['admission_no'] = $stu_value['admission_no'];
                    $array['roll_no'] = $stu_value['roll_no'];
                    $array['firstname'] = $stu_value['firstname'];
                    $array['lastname'] = $stu_value['lastname'];
                    $array['dob'] = $stu_value['dob'];
                    $array['father_name'] = $stu_value['father_name'];
                    $x = array();
                    foreach ($examSchedule as $ex_key => $ex_value) {
                        $exam_array = array();
                        $exam_array['exam_schedule_id'] = $ex_value['id'];
                        $exam_array['exam_id'] = $ex_value['exam_id'];
                        $exam_array['subject_id'] = $ex_value['subject_id'];
                        $exam_array['full_marks'] = $ex_value['full_marks'];
                        $exam_array['passing_marks'] = $ex_value['passing_marks'];
                        $exam_array['exam_name'] = $ex_value['name'];
                        $exam_array['exam_type'] = $ex_value['type'];
						if($sub_type=='Theory')
						{
                        $student_exam_result = $this->examresult_model->get_exam_result($ex_value['id'], $stu_value['id']);
						}
						elseif($sub_type=='Practical')
						{
							 $student_exam_result = $this->examresult_model->get_practicalexam_result($ex_value['id'], $stu_value['id']);
							
							}
                            elseif($sub_type=='Viva')
                        {
                             $student_exam_result = $this->examresult_model->get_vivaexam_result($ex_value['id'], $stu_value['id']);
                            
                            }
						
                        $exam_array['attendence'] = $student_exam_result->attendence;
                        $exam_array['get_marks'] = $student_exam_result->get_marks;
                        $x[] = $exam_array;
                    }
                    $array['exam_array'] = $x;
                    $new_array[] = $array;
                }
                $data['examSchedule'] = $new_array;
            }
            if ($this->input->post('save_exam') == "save_exam") {
                $ex_array = array();
                $exam_id = $this->input->post('exam_id');
                $student_array = $this->input->post('student');
				$date=$this->input->post('date');
				$exam_array = $this->input->post('exam_schedule');
				$sub_type=$this->input->post('sub_type');
				
				if($sub_type=='Theory')
				{
                foreach ($student_array as $key => $student) {
                    foreach ($exam_array as $key => $exam) {
						
                        $record['get_marks'] = 0;
                        $record['attendence'] = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks'] = $this->input->post('student_number' . $student . "_" . $exam);
                        } else {
                            $record['attendence'] = $this->input->post('student_absent' . $student . "_" . $exam);
                        }
						
						$record['exam_schedule_id'] = $exam;
                        $record['student_id'] = $student;
						 
                        $inserted_id = $this->examresult_model->add_exam_result($record); 
						
						$exam_type = $this->examresult_model->get_examtype($exam_id);
						 
						if($exam_type =='university exam')
						{
							$sub_exam['exam_schedule_id'] = $exam;
                            $sub_exam['student_id'] = $student;
							$sub_exam['class_id']= $class_id;
							$sub_exam['section_id']=$section_id;
							$sub_exam['date']= $date;
							$sub_exam['no_chances'] =1; 
							$sub_exam['get_marks'] = $record['get_marks'];
						     $sub_exam['centre_id']= $centre_id;
							$this->examresult_model->add_supp_exam_result($sub_exam);
							
							$uni_mark['class_id']=$class_id;
							$uni_mark['section_id']=$section_id;
							$uni_mark['student_id']=$student;
							$uni_mark['subject_id']=$this->input->post('subject_id'.$student."_".$exam);
							$uni_mark['marks']=$record['get_marks'];
							$uni_mark['class_id']=$class_id;
							$uni_mark['centre_id']= $centre_id;
							$uni_mark['exam_schedule_id'] = $exam;
							
							$insert=$this->mark_model->adduniversitymark($uni_mark);
						     }
						
                        if ($inserted_id) {
                            $ex_array[$student] = $exam_id;
                        }
                    } 
					$appearence=array('student_id'=>$student,
                                       'centre_id'=>$centre_id,
									  'class_id'=>$class_id,
									  'section_id'=>$section_id,
									  'date'=>$date,
									  'appeared'=>1);

                                      
                $this->examresult_model->add_appearence($appearence); 
                // var_dump($this->db->last_query());exit;
                }
				
				}
				
				elseif($sub_type=='Practical')
				{
				foreach ($student_array as $key => $student) {
                    foreach ($exam_array as $key => $exam) {	
					
					$record['get_marks'] = 0;
                        $record['attendence'] = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks'] = $this->input->post('student_number' . $student . "_" . $exam);
                        } else {
                            $record['attendence'] = $this->input->post('student_absent' . $student . "_" . $exam);
                        }
						
						$record['practical_schedule_id'] = $exam;
                        $record['student_id'] = $student;
						 
                        $inserted_id = $this->examresult_model->add_practicalexam_result($record); 
						
						$exam_type = $this->examresult_model->get_examtype($exam_id);
						
						if($exam_type =='university exam')
						{
							
							
							$uni_mark['class_id']=$class_id;
							$uni_mark['section_id']=$section_id;
							$uni_mark['student_id']=$student;
							$uni_mark['subject_id']=$this->input->post('subject_id'.$student."_".$exam);
							$uni_mark['marks']=$record['get_marks'];
							$uni_mark['class_id']=$class_id;
							$uni_mark['centre_id']= $centre_id;
							$uni_mark['practical_schedule_id'] = $exam;
							
							$insert=$this->mark_model->add_prac_univer_mark($uni_mark);
							
							 }
						
						if ($inserted_id) {
                            $ex_array[$student] = $exam_id;
                        }
                   }
				     }
					}
         
         elseif($sub_type=='Viva')
                {
                foreach ($student_array as $key => $student) {
                    foreach ($exam_array as $key => $exam) {    
                    
                    $record['get_marks'] = 0;
                        $record['attendence'] = "pre";
                        if ($this->input->post('student_absent' . $student . "_" . $exam) == "") {
                            $record['get_marks'] = $this->input->post('student_number' . $student . "_" . $exam);
                        } else {
                            $record['attendence'] = $this->input->post('student_absent' . $student . "_" . $exam);
                        }
                        
                        $record['viva_schedules_id'] = $exam;
                        $record['student_id'] = $student;
                         
                        $inserted_id = $this->examresult_model->add_vivaexam_result($record); 
                        
                        $exam_type = $this->examresult_model->get_examtype($exam_id);
                        
                        if($exam_type =='university exam')
                        {
                            
                            
                            $uni_mark['class_id']=$class_id;
                            $uni_mark['section_id']=$section_id;
                            $uni_mark['student_id']=$student;
                            $uni_mark['subject_id']=$this->input->post('subject_id'.$student."_".$exam);
                            $uni_mark['marks']=$record['get_marks'];
                            $uni_mark['class_id']=$class_id;
                            $uni_mark['centre_id']= $centre_id;
                            $uni_mark['viva_schedules_id'] = $exam;
                            
                            $insert=$this->mark_model->add_viva_univer_mark($uni_mark);
                            
                             }
                        
                        if ($inserted_id) {
                            $ex_array[$student] = $exam_id;
                        }
                   }
                     }
                    }


				
                if (!empty($ex_array)) {
                    $this->mailsmsconf->mailsms('exam_result', $ex_array, NULL, $exam_array);
                } 
                
                
                redirect('admin/mark');
            }

            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markCreate', $data);
            $this->load->view('layout/footer', $data);
        }
    }
	/////////////////////////ck////////////////////////////////
	
	function appeared() 
	{
		$exam_id = $this->input->post('exam_id');
        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');
		$student = $this->input->post('student_id');
		$date=$this->input->post('date');
		$appearenceid=$this->input->post('appearence');
				
		$ex_array = array();
        $exam_id = $this->input->post('exam_id');
        $student_array = $this->input->post('student'); 
        $exam_array = $this->input->post('exam_schedule');
        //foreach ($student_array as $key => $student) 
		//{ 
        	foreach ($exam_array as $key => $exam) 
			{ 		
                $sub_exam['get_marks'] = $this->input->post('mark_'.$exam); 
				$sub_exam['exam_schedule_id'] = $exam;
                $sub_exam['student_id'] = $student;
				$sub_exam['class_id']= $class_id;
				$sub_exam['section_id']=$section_id;
				$sub_exam['date']= $date;
				$sub_exam['no_chances'] =$appearenceid; 
				//$sub_exam['get_marks'] = $record['get_marks'];  
				$this->examresult_model->add_supp_exam($sub_exam); 
			}
					
			$appearence=array('student_id'=>$student,
							  'class_id'=>$class_id,
							  'section_id'=>$section_id,
							  'date'=>$date, 
							  'appeared'=>$appearenceid);
				
			$this->examresult_model->add_supp_appearence($appearence);		  
		//}  
       redirect('admin/mark/supplementry_exam');
	}
	
	//////////////////////////////////////////////////////////

    function edit($id) {
        if (!$this->rbac->hasPrivilege('marks_register', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Mark';
        $data['id'] = $id;
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->form_validation->set_rules('name', 'Mark', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/markEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee details added to Database!!!</div>');
            redirect('admin/mark/index');
        }
    }
 
  	function internalmarks()
  	{ 
		$data['title']='Exam Schedule'; 
	    $data['classlist']="";
		$data['class_id'] = "";
        $data['section_id'] = "";
	  	$this->session->set_userdata('top_menu', 'Examinations');
      	$this->session->set_userdata('sub_menu', 'mark/internalmarks');
	  	$class = $this->class_model->get();
	  	$data['classlist'] = $class;
	 	$this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
      	$this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
	  
	  	if ($this->form_validation->run() == FALSE) 
	  	{
	  		$this->load->view('layout/header',$data);
      		$this->load->view('admin/mark/internalmarks',$data);
      		$this->load->view('layout/footer',$data);
	  	}
	  	else
	  	{
	 		$class_id = $this->input->post('class_id');
     		$section_id = $this->input->post('section_id');
			$sub_type=$this->input->post('sub_type');  
			$data['class_id'] = $class_id;
        	$data['section_id'] = $section_id; 
			$data['sub_type']= $sub_type;
			$studentList = $this->student_model->searchByClassSection($class_id, $section_id);
		
		    $subject=$this->examschedule_model->get_subject($section_id,$class_id,$sub_type);
			
			$arr=array();
		 
			if(!empty($studentList))
			{
				foreach($studentList as $key => $stud)
				{
		 			$array=array(); 
					$array['student_id'] = $stud['id'];
					$array['admission_no'] = $stud['admission_no'];
					$array['roll_no'] = $stud['roll_no'];
					$array['firstname'] = $stud['firstname'];
					$array['lastname'] = $stud['lastname']; 
					$z=array();
		 			foreach($subject as $key=>$sub)
		 			{
						$subarr=array();
						$subarr['subject_id']=$sub['subject_id'];
						$subarr['name'] =$sub['name'];
						$subarr['type'] =$sub['type'];
						if($sub_type=='Theory')
						{
						$studentmark=$this->mark_model->get_mark($sub['subject_id'], $stud['id'],$section_id);
						}
						elseif($sub_type=='Practical')
						{
							
							$studentmark=$this->mark_model->get_practicalmark($sub['subject_id'], $stud['id'],$section_id);
							
							}
						$subarr['mark']=$studentmark->marks;
						$z[]=$subarr; 
			 		}
		    		$array['sub_array']=$z;
					$arr[]=$array;
			
				} 
				$data['studentList']=$arr;
			}
		
			$this->load->view('layout/header',$data);
			$this->load->view('admin/mark/internalmarks',$data);
			$this->load->view('layout/footer',$data);
		 
			if($this->input->post('save_exam')=='save_exam')
			{
		 		$student_array=$this->input->post('student');
		 		$subject_array=$this->input->post('subject');
		        $sub_type=$this->input->post('sub_type'); 
				foreach($student_array as $key=>$student)
				{
					foreach($subject_array as $key=>$subject)
					{
			  			$internal['session_id']=$this->setting_model->getCurrentSession();
						$internal['class_id']=$class_id ;
						$internal['section_id']= $section_id;
						$internal['student_id']=$student;
						$internal['subject_id']=$subject;
						$internal['marks']=$this->input->post('studentmark'.$subject."_".$student); 
						if($sub_type=='Theory')
						{
			 			$insert=$this->mark_model->addinternal($internal);
						}
						elseif($sub_type=='Practical')
						{
							$insert=$this->mark_model->add_practical_internal($internal);
							}
					} 
				}
				
				$this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Internal marks are recorded</div>'); 
				redirect('admin/mark/internalmarks'); 
			} 
        }  
  	}
 
	function universitymarks()
	{ 
		$data['title']='Exam Schedule'; 
		$data['classlist']="";
	 
		$this->session->set_userdata('top_menu', 'Examinations');
    	$this->session->set_userdata('sub_menu', 'marks/universitymarks'); 
	 
		$class = $this->class_model->get();
	  	$data['classlist'] = $class;
		 
	 	$this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
      	$this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		 
	 	if ($this->form_validation->run() == FALSE) 
		{
            $this->load->view('layout/header', $data);
            $this->load->view('admin/mark/universitymarks', $data);
            $this->load->view('layout/footer', $data);
	 	}
	 	else 
		{ 	
			$class_id = $this->input->post('class_id'); 
     		$section_id = $this->input->post('section_id');  
			$data['class_id'] = $class_id;
        	$data['section_id'] = $section_id;  
			$studentList = $this->student_model->searchByClassSection($class_id, $section_id);
			//$data['studentList']=$studentList;
			$subject=$this->examschedule_model->get_subject($section_id,$class_id);
			//$data['subject']=$subject;
			$arr=array(); 
			if(!empty($studentList))
			{
				foreach($studentList as $key => $stud)
				{
					$array=array();
					$array['student_id'] = $stud['id'];
					$array['admission_no'] = $stud['admission_no'];
					$array['roll_no'] = $stud['roll_no'];
					$array['firstname'] = $stud['firstname'];
					$array['lastname'] = $stud['lastname'];
					$z=array();
			 
					foreach($subject as $key=>$sub)
					{
						$subarr=array();
						$subarr['subject_id']=$sub['subject_id'];
						$subarr['name'] =$sub['name'];
						$subarr['type'] =$sub['type'];
						$subarr['mark'] =$sub['mark'];
						$studentmark=$this->mark_model->get_university_mark($sub['subject_id'], $stud['id']);
						$subarr['mark']=$studentmark->marks;
						$z[]=$subarr;
					}
					$array['sub_array']=$z;
					$arr[]=$array; 
				} 
				$data['studentList']=$arr;
			}
		
			$this->load->view('layout/header',$data);
			$this->load->view('admin/mark/universitymarks',$data);
			$this->load->view('layout/footer',$data);
	 
			if($this->input->post('save_exam')=='save_exam')
			{ 
				$student_array=$this->input->post('student');
				$subject_array=$this->input->post('subject');
				foreach($student_array as $key=>$student)
				{
					foreach($subject_array as $key=>$subject)
					{
						$uni_mark['session_id']=$this->setting_model->getCurrentSession();
						$uni_mark['class_id']=$class_id ;
						$uni_mark['section_id']= $section_id;
						$uni_mark['student_id']=$student;
						$uni_mark['subject_id']=$subject;
						$uni_mark['marks']=$this->input->post('student_number'.$subject."_".$student); 
						$insert=$this->mark_model->adduniversitymark($uni_mark);
					}
				}
				$this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Recorded university marks</div>');
				redirect('admin/mark/universitymarks');
			} 
	  	} 
   	}

	function supplementry_exam()
  	{
		if (!$this->rbac->hasPrivilege('supplementry_exam', 'can_view')) {
            access_denied();
        }
	  
		$this->session->set_userdata('top_menu', 'Examinations');
    	$this->session->set_userdata('sub_menu', 'marks/supplementry');
	 	$class = $this->class_model->get();
	 	$data['classlist'] = $class;
	 	$exam = $this->exam_model->get();
	 	$data['examlist'] = $exam;
	 
	  
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
	  	if ($this->form_validation->run() == FALSE) {
           
        } 
		else 
		{
	    	$class_id=$this->input->post('class_id');
	        $section_id=$this->input->post('section_id'); 
	  		$studentList = $this->student_model->searchByClassSection($class_id, $section_id);
	  		/* $examSchedule = $this->examschedule_model->getDetailbyClsandSection($class_id, $section_id, $exam_id);*/ 
	   		$data['examSchedule'] = $studentList;
        }
	
	    $this->load->view('layout/header',$data);
		$this->load->view('admin/mark/supplementry',$data);
		$this->load->view('layout/footer',$data);  
  	}
 
	function supple_report()
	{ 
		$student_id=$this->input->post('student_id');
		$data['exam']=$this->mark_model->get_mark_details($student_id); 
		$this->load->view('reports/supplementry_report',$data);	
	}

 	function supply_exam_result()
	{
		$this->mark_model->get_supply_details();
	}
}
?>