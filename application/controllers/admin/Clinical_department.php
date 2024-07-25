<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Clinical_department extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->config_attendance = $this->config->item('attendence');
        $this->load->model("stuattendence_model");
    }

    function index() {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_department');
        $data['title'] = 'Add clinical_department';
     
         $clinical = $this->student_model->get_clinical_department();
        $data['clinical_department_list'] = $clinical;
// $this->form_validation->set_rules('department_name','Name of department','required');


   $this->form_validation->set_rules(
                'department_name', 'Department Name', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );


        if ($this->form_validation->run() == FALSE) {
            
        } 
		else {
            $data = array(
                'deptname' => $this->input->post('department_name'),
				
            );
            $this->student_model->add_clinical_department($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Department Name Added Successfully</div>');
            redirect('admin/Clinical_department/index');
        }
      
        $this->load->view('layout/header', $data);
        $this->load->view('admin/clinical_rotation/clinical_department/clinical_department', $data);
        $this->load->view('layout/footer', $data);
    }
	
	
	
	
	
	
	
	function delete($id) {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'clinical_department';
        $this->student_model->delete($id);
        redirect('admin/clinical_department/index');
    }
	
	
	
	function edit($id) {
        if (!$this->rbac->hasPrivilege('clinical_department', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_department');
        $data['id'] = $id;
		   $clinical = $this->student_model->get_clinical_department();
        $data['clinical_department_list'] = $clinical;
         

        $department= $this->student_model->department_edit($id);
        $data['department'] = $department;
        
        
		//$this->form_validation->set_rules('department_name','Name of department','required');
		$this->form_validation->set_rules(
                'department_name', 'Department ', array(
            'required',
            array('check_exists', array($this->student_model, 'check_exists'))
                )
        );
	 

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinical_rotation/clinical_department/clinical_edit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
			     'id'=>$this->input->post('id'), 
                 'deptname' => $this->input->post('department_name'),
            );
            $this->student_model->add_clinical_department($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Department Name Updated Successfully</div>');
            redirect('admin/Clinical_department/index');
        }
    }
	
	
	
	function clinical_attendance()
	{
	if (!$this->rbac->hasPrivilege('clinical_attendance', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/clinical_attendance');
	
	    $class = $this->class_model->get();
		$data['classlist'] = $class;
	
	   $this->form_validation->set_rules('class_id','class','trim|required|xss_clean');
	$this->form_validation->set_rules('section_id','section_id','trim|required|xss_clean');
	$this->form_validation->set_rules('group','group');
		
		 if ($this->form_validation->run() == FALSE) {
		 }
		
		else
		{
		 $classid=$this->input->post('class_id');
		 $data['class_id']=$classid;
		 $sectionid=$this->input->post('section_id');
		 $data['section_id']=$sectionid;
		 $groupid=$this->input->post('group');
		 $data['group_id']=$groupid;
		 $subject_id=$this->input->post('subject');
		 $data['subject_id']=$subject_id;
		 $date= date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
	
		 $data['date']=$date;
		
         $getstud=$this->clinicalrotation_model->getstudentsbygroup($classid,$sectionid,$groupid,$date,$subject_id);
		$data['resultlist']=$getstud;
		
		$checkresult=$this->clinicalrotation_model->getpreviousdata($groupid,$date,$subject_id);
		$data['checkres']=$checkresult;
		$attendencetypes = $this->attendencetype_model->get();
        $data['attendencetypeslist'] = $attendencetypes;
		
		}
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_attendance/clinical_attendance',$data);
        $this->load->view('layout/footer', $data);
		
		
	}



	function mark_attendance()
	{
	if (!$this->rbac->hasPrivilege('mark_attendance', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'groupwise_attendance');
        $this->session->set_userdata('sub_menu', 'groupwise_attendance/mark_attendance');
	
	    $class = $this->class_model->get();
		$data['classlist'] = $class;
	
	   $this->form_validation->set_rules('class_id','class','trim|required|xss_clean');
	$this->form_validation->set_rules('section_id','section_id','trim|required|xss_clean');
	$this->form_validation->set_rules('group','group');
		
		 if ($this->form_validation->run() == FALSE) {
		 }
		
		else
		{
		 $classid=$this->input->post('class_id');
		 $data['class_id']=$classid;
		 $sectionid=$this->input->post('section_id');
		 $data['section_id']=$sectionid;
		 $groupid=$this->input->post('group');
		 $data['group_id']=$groupid;
		 $subject_id=$this->input->post('subject');
		 $data['subject_id']=$subject_id;
		 $date= date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date')));
	
		 $data['date']=$date;
		
        $getstud=$this->clinicalrotation_model->getstudentsinavaliablegroup($classid,$sectionid,$groupid,$date,$subject_id);
		$data['resultlist']=$getstud;
		
		$checkresult=$this->clinicalrotation_model->getbatchpreviousdata($groupid,$date,$subject_id);
		$data['checkres']=$checkresult;
		$attendencetypes = $this->attendencetype_model->getbatchatttendype();
        $data['attendencetypeslist'] = $attendencetypes;
		
		}
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_attendance/attendance_marking',$data);
        $this->load->view('layout/footer', $data);
		
		
	}
	
	
	
	function getGroupByClassandSection()
	{
	
	
	$classid=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$result=$this->clinicalrotation_model->getgroup($classid,$section_id);
	echo json_encode($result);
		
	}


	function getourgroup()
	{
	
	
	$classid=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$result=$this->clinicalrotation_model->getavailablegroups($classid,$section_id);
	echo json_encode($result);
		
	}
	
	
	
	function save_attendance()
	{
	   $this->form_validation->set_rules('student_session[]','Student session','trim|required|xss_clean');
	  if ($this->form_validation->run() == FALSE) {
		 }
		 
		 else
		 {
			$class_id=$this->input->post('class_id');
		    $date=$this->input->post('date'); 
			$student_session_id=$this->input->post('student_session');
			$session_id=$this->setting_model->getCurrentSession();
			
			
			foreach($student_session_id as $key=>$val)
			{
			
			$update=$this->input->post('attendendence_id'.$val);
			
			if($this->input->post('attendencetype'.$val)==1)
			{
				$total_min=8;
			}
			else
			{
				$total_min="";
			}
			
			if($update !=0)
			{
			
			$data=array(
			'id'=>$update,
			'sid'=>$admin['id'],
			'student_session_id'=>$val,
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min

			);
				
			}else{
			
			$data=array(
			'student_session_id'=>$val,
			'sid'=>$admin['id'],
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min
			
			);
			
			}
			
			$this->clinicalrotation_model->insert($data);


			$admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $sub=getsubjectid($this->input->post('subject_id'));
            $subjectid=$sub;
            $date = $this->input->post('date');
            

           //echo $hours; exit;
           $session_id=$this->setting_model->getCurrentSession();
           $marray = array('class_id' => $class,
                        'section_id'=>$section,
                        'subject_id'=> $subjectid,
                        'status'=>0,
                        'sid'=>$admin['id'],
                        'session_id'=>$session_id,
                        'date' => date('Y-m-d', $this->customlib->datetostrtotime($date)));
                        
               $insert_id = $this->stuattendence_model->cliniadds($marray);
          // print_r($this->db->last_query());exit;
               // $this->session->set_flashdata('msg', '<div class="alert alert-success text-left"> Attendance Saved Successfully</div>');

			}
		
			
			
            redirect('admin/Clinical_department/clinical_attendance');
			 
			 
			 
		 }
	}


	function save_batchattendance()
	{
	   $this->form_validation->set_rules('student_session[]','Student session','trim|required|xss_clean');
	  if ($this->form_validation->run() == FALSE) {
		 }
		 
		 else
		 {
			$class_id=$this->input->post('class_id');
		    $date=$this->input->post('date'); 
			$student_session_id=$this->input->post('student_session');
			$session_id=$this->setting_model->getCurrentSession();
			$admin=$this->session->userdata('admin');
			
			foreach($student_session_id as $key=>$val)
			{
			
			$update=$this->input->post('attendendence_id'.$val);
			
			if($this->input->post('attendencetype'.$val)==1)
			{
				$total_min=8;
			}
			else
			{
				$total_min="";
			}
			
			if($update !=0)
			{
			
			$data=array(
			'id'=>$update,
			'sid'=>$admin['id'],
			'student_session_id'=>$val,
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min

			);
				
			}else{
			
			$data=array(
			'student_session_id'=>$val,
			'sid'=>$admin['id'],
			'session_id'=>$session_id,
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
			'attendence_type_id'=>$this->input->post('attendencetype'.$val),
			'group_id'=>$this->input->post('group_id'),
			'subject_id'=>$this->input->post('subject_id'),
			'total_minutes'=>$total_min
			
			);
			
			}
		
			$this->clinicalrotation_model->insertbatchwiseattendance($data);
            // print_r($this->db->last_query());exit;

			}
		
            redirect('admin/Clinical_department/mark_attendance');
			 
		 }
	}
		
	
	
	function clinical_mark_reg()
	{
	 if (!$this->rbac->hasPrivilege('marks_register', 'can_view')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_rotation/marks_register');	
		
		$class = $this->class_model->get();
	  	$data['classlist'] = $class;
	$this->form_validation->set_rules('exam', 'Exam type','trim|required|xss_clean');
	$this->form_validation->set_rules('class_id', 'Class','trim|required|xss_clean');
	
	if($this->form_validation->run()==FALSE)
	{
	    $this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_marks',$data);
        $this->load->view('layout/footer', $data);	
	}
	
	
	else
	{
		
		$exam=$this->input->post('exam');
		$data['exam']=$exam;
		$class_id=$this->input->post('class_id');
		$data['class_id']=$class_id;
		$section_id=$this->input->post('section_id');
		
		$studentList = $this->student_model->searchByClassSection($class_id, $section_id);
		
		
		
		$sublist=$this->clinicalrotation_model->get_subject_list($class_id,$section_id);

        // var_dump($studentList);exit;
		
		$stdarr=array();
		
		if(!empty($studentList))
		{
			foreach($studentList as $key=>$stud)
			{
			  $arr=array();
			   $arr['student_session_id']=$stud['student_session_id'];
			   $arr['student_id']=$stud['id'];
			   $arr['admission_no']=$stud['admission_no'];
			   $arr['roll_no']=$stud['roll_no'];
			   $arr['firstname']=$stud['firstname'];
			   $arr['lastname']=$stud['lastname'];
			   $x=array();
			   foreach($sublist as $s_key=>$sub)
			   {
				$subar=array();  
				 $subar['subject_id']=$sub['subject_id'];
				 $subar['type']=$sub['type'];
				 $subar['name']=$sub['name'];
                 if($exam=='internal_mark'){

                     $subar['mark'] = $this->getInternalMark($stud['student_session_id'],$sub['subject_id'],'internal');
                 }
                 if($exam=='university_exam'){

                     $subar['mark'] = $this->getInternalMark($stud['student_session_id'],$sub['subject_id'],'university');
                 }
				 $x[]=$subar; 
				   }
			    $arr['subarr']=$x;
				$stdarr[]=$arr;
			}
			
			$data['studmarklist']=$stdarr;
		}
		
		
		if($this->input->post('save_exam')=='save_exam')
		{
		 
		 
		 $stud_session=$this->input->post('student');
		 $subject=$this->input->post('subject');
		 if($exam=='internal_mark')
		 {
		 foreach($stud_session as $stud)
		 {
			 foreach($subject as $sub)
			 {
				$ar['marks']=0;
				$ar['attendance']='present';
				$ar['student_session_id']=$stud;
				$ar['subject_id']=$sub;
				$stud_absent=$this->input->post('student_absent'.$stud.'_'.$sub);
				if($stud_absent=='')
				{
					$ar['marks']=$this->input->post('studentmark'.$sub.'_'.$stud);
					
					}
					else
					{
					   $ar['attendance']=$this->input->post('student_absent'.$stud.'_'.$sub);	
						}
						
						
				     $this->clinicalrotation_model->add_internal_mark($ar);	
				
				 }
		      }
			  
		 }
		 else if($exam=='university_exam')
		 {
			 foreach($stud_session as $stud)
		 {
			 foreach($subject as $sub)
			 {
				$ar['marks']=0;
				$ar['attendance']='present';
				$ar['student_session_id']=$stud;
				$ar['subject_id']=$sub;
				$stud_absent=$this->input->post('student_absent'.$stud.'_'.$sub);
				if($stud_absent=='')
				{
					$ar['marks']=$this->input->post('studentmark'.$sub.'_'.$stud);
					
					}
					else
					{
					   $ar['attendance']=$this->input->post('student_absent'.$stud.'_'.$sub);	
						}
						
						
				     $this->clinicalrotation_model->add_university_mark($ar);	
				
				 }
		      }
			 
			 }
		 
		 
			 
		   redirect('admin/clinical_department/clinical_mark_reg');
			}
		  $this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/clinical_marks',$data);
        $this->load->view('layout/footer', $data);
		}
		
		
		
	}


    public function getInternalMark($student_session_id,$subject_id,$type){
        if($type=='internal'){
            $table='clinical_internal_mark';
        }else{
            
            $table='clinical_university_mark';
        }
        $result = $this->db->where([
            'student_session_id'=>$student_session_id,
            'subject_id'=>$subject_id,
        ])
        ->order_by('id',"DESC")
        ->get($table)
        ->row();

        return $result->marks;
    }
	
	public function attendancereportold(){
		

        if (!$this->rbac->hasPrivilege('clinical_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'clinical_rotation');
        $this->session->set_userdata('sub_menu', 'clinical_department/clinicalattendencereport');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;
        $data['title'] = 'Attendance Report';
        $data['title_list'] = 'Attendance Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $groupid=$this->input->post('group');
		$data['group_id']=$groupid;
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
        $this->form_validation->set_rules('group','group','trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);

        } else {
        	$groupid=$this->input->post('group');
		    $data['group_id']=$groupid;
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
			 $subject = $this->input->post('subject_id');
            $month = $this->input->post('month');
            $data['class_id'] = $class;
            $data['section_id'] = $section;
			 $data['subject_id'] = $subject;
            $data['month_selected'] = $month;
            $studentlist = $this->student_model->searchByClassSection($class, $section,$subject);
            // var_dump($studentlist);
            // print_r($this->db->last_query());exit;
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
            //var_dump($student_result);

            $data['no_of_days'] = $num_of_days;
            $date_result = array();
			 $monthAttendance = array();
			   $s = array();
            for ($i = 1; $i <= $num_of_days; $i++) {
                $att_date = $year . "-" . $month_number . "-" . sprintf("%02d", $i);
                $attendence_array[] = $att_date;
                //var_dump(att_date);
                $res = $this->clinicalrotation_model->searchAttendenceReportupdate($class, $section, $subject,$att_date,$groupid);
			    // print_r($this->db->last_query());exit;
                $student_result = $res;
				//var_dump($student_result);
              //  $s = array();
                foreach ($res as $result_k => $result_v) {
					//var_dump($result_v);
                    $s[$result_v['student_session_id']] = $result_v;
					//var_dump($s[$result_v['student_session_id']]);
                }
                $date_result[$att_date] = $s;
				//var_dump($date_result[$att_date]);
          
			
			
        //    print_r($attendence_array);
           // $monthAttendance = array();
			//var_dump($res);
            foreach ($res as $result_k => $result_v) {
				//var_dump($result_k);
                $date = $year . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['student_session_id']);
            } 
			//print_r($monthAttendance);
			 				//echo $monthAttendance;

            $data['monthAttendance'] = $monthAttendance;
            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
			//var_dump($data['attendence_array'])."<br/>";
			}

			//var_dump($data['resultlist'])."<br/>";
			//var_dump($data['attendence_array'])."<br/>";
			//var_dump($student_result)."<br/>";
          //  exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
        //var_dump($studentlist);
       
		}
		public function attendancereport(){
		

        if (!$this->rbac->hasPrivilege('clinical_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Attendance');
        $this->session->set_userdata('sub_menu', 'clinical_department/clinicalattendencereport');
        $attendencetypes = $this->attendencetype_model->getAttType();
        $data['attendencetypeslist'] = $attendencetypes;

        $data['title'] = 'Attendance Report';
        $data['title_list'] = 'Attendance Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $groupid=$this->input->post('group');
		$data['group_id']=$groupid;
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
        $this->form_validation->set_rules('group','group','trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        } else {
        	$groupid=$this->input->post('group');
		    $data['group_id']=$groupid;
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
			 $subject = $this->input->post('subject_id');
            $month = $this->input->post('month');
            $data['class_id'] = $class;
            $data['section_id'] = $section;
			 $data['subject_id'] = $subject;
            $data['month_selected'] = $month;
            $studentlist = $this->student_model->searchByClassSection($class, $section,$subject);
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
                $res = $this->clinicalrotation_model->searchAttendenceReportupdate($class, $section, $subject,$att_date,$groupid);
               // var_dump($res);echo '</br>';echo '</br>';echo '</br>';echo '</br>';
				if(!empty($res))
				{
                $student_result = $res;
				}

                $s = array();
                foreach ($res as $result_k => $result_v) {
					//var_dump($result_v);
                    $s[$result_v['student_session_id']] = $result_v;
					//var_dump($s[$result_v['student_session_id']]);
                }
                $date_result[$att_date] = $s;
				//var_dump($date_result[$att_date]);
          
			
			
        //    print_r($attendence_array);
            $monthAttendance = array();
			//var_dump($res);
            foreach ($student_result as $result_k => $result_v) {
				//var_dump($result_v);
                $date = $year . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendance($newdate, 1, $result_v['student_session_id'],$subject);
				
            

             }

			 //var_dump($student_result);
            $data['monthAttendance'] = $monthAttendance;
            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
        }
          //var_dump($student_result);
			//var_dump($data['attendence_array'])."<br/>";
			
			//var_dump($data['resultlist'])."<br/>";
			//var_dump($data['attendence_array'])."<br/>";
			//var_dump($student_result)."<br/>";
          //  exit;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/classattendencereport', $data);
            $this->load->view('layout/footer', $data);
        }
    
		}
	
	
	
	 function monthAttendance($st_month, $no_of_months, $student_id) {

        $record = array();

        $r = array();
        $month = date('m', strtotime($st_month));
        $year = date('Y', strtotime($st_month));

        foreach ($this->config_attendance as $att_key => $att_value) {

            $s = $this->clinicalrotation_model->count_attendance_obj($month, $year, $student_id, $att_value);


            $attendance_key = $att_key;


            $r[$attendance_key] = $s;
        }

        $record[$student_id] = $r;

        return $record;
    }
    function getGroupByClassSectionandsubject()
	{
	
	
	$classid=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$subject_id=$this->input->post('subject_id');
	$result=$this->clinicalrotation_model->getgroupnew($classid,$section_id,$subject_id);
	echo json_encode($result);
		
	}


	function getavailbatchs()
	{
	
	
	$classid=$this->input->post('class_id');
	$section_id=$this->input->post('section_id');
	$subject_id=$this->input->post('subject_id');
	$result=$this->clinicalrotation_model->getavailbatchs($classid,$section_id,$subject_id);
	echo json_encode($result);
		
	}


	public function batchwiseattendancereport(){
		

        if (!$this->rbac->hasPrivilege('batchwise_report', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'groupwise_attendance');
        $this->session->set_userdata('sub_menu', 'groupwise_attendance/batchwise_report');
        $attendencetypes = $this->attendencetype_model->getAttTypeforbatch();
        $data['attendencetypeslist'] = $attendencetypes;

        $data['title'] = 'Attendance Report';
        $data['title_list'] = 'Attendance Report';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $groupid=$this->input->post('group');
		$data['group_id']=$groupid;
        $userdata = $this->customlib->getUserData();
        $data['monthlist'] = $this->customlib->getMonthDropdown();
        $data['yearlist'] = $this->stuattendence_model->batchwiseYearCount();
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
        $this->form_validation->set_rules('group','group','trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/batchattreport', $data);
            $this->load->view('layout/footer', $data);
        } else {
        	$groupid=$this->input->post('group');
		    $data['group_id']=$groupid;
            $resultlist = array();
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
			 $subject = $this->input->post('subject_id');
            $month = $this->input->post('month');
            $data['class_id'] = $class;
            $data['section_id'] = $section;
			 $data['subject_id'] = $subject;
            $data['month_selected'] = $month;
            $studentlist = $this->student_model->searchAllByClassSection($class, $section,$subject);

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
                $res = $this->clinicalrotation_model->searchBatchwiseupdate($class, $section, $subject,$att_date,$groupid);
               // var_dump($res);echo '</br>';echo '</br>';echo '</br>';echo '</br>';
				if(!empty($res))
				{
                $student_result = $res;
				}

                $s = array();
                foreach ($res as $result_k => $result_v) {
					//var_dump($result_v);
                    $s[$result_v['student_session_id']] = $result_v;
					//var_dump($s[$result_v['student_session_id']]);
                }
                $date_result[$att_date] = $s;

            $monthAttendance = array();
			//var_dump($res);
            foreach ($student_result as $result_k => $result_v) {
                $date = $year . "-" . $month;
                $newdate = date('Y-m-d', strtotime($date));
                $monthAttendance[] = $this->monthAttendancelatest($newdate, 1, $result_v['student_session_id'],$subject);
				
            

             }

            $data['monthAttendance'] = $monthAttendance;
            $data['resultlist'] = $date_result;
            $data['attendence_array'] = $attendence_array;
            $data['student_array'] = $student_result;
        }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/clinicalattendence/batchattreport', $data);
            $this->load->view('layout/footer', $data);
        }
    
		}
	function monthAttendancelatest($st_month, $no_of_months, $student_id,$subject_id) {

        $record = array();

        $r = array();
        $month = date('m', strtotime($st_month));
        $year = date('Y', strtotime($st_month));

        foreach ($this->config_attendance as $att_key => $att_value) {

            $s = $this->clinicalrotation_model->count_attendance_objlatest($month, $year, $student_id, $att_value,$subject_id);


            $attendance_key = $att_key;


            $r[$attendance_key] = $s;
        }

        $record[$student_id] = $r;

        return $record;
    }
	
	
	
	
	
	
	}

?>