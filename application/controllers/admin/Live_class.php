<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Live_class extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
		 $this->load->model("live_class_model");
		 $this->load->helper('string_helper');
		 
    }

    function index() {
        if (!$this->rbac->hasPrivilege('live_class', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'live_class');
        $this->session->set_userdata('sub_menu', 'live_class/live_class');
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
        //    if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getClassbyteacher($userdata["id"]);
        // }
		
        $feecategory = $this->feecategory_model->get();
        $data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/live_class/liveclasstimetable_list', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			
			$admin=$this->session->userdata('admin');
			
			if($admin['roles']['Teacher']) {
                
                $result_subjects=$this->live_class_model->teacher($admin['id'],$class_id,$section_id);	
                
                
			}
			else
			{
                // var_dump("hai");exit;
                $result_subjects = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id,"Theory");
				
            }
            
			$getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $final_array = array();
          
            if (!empty($result_subjects)) {
				
				
                foreach ($result_subjects as $subject_k => $subject_v) {
                   
					 $result_array = array();
                    // if($subject_v['type']=='Theory')
					// {
                    foreach ($getDaysnameList as $day_key => $day_value) {
						
                        // var_dump($day_value);exit;
						if($admin['roles']['Teacher']) {
							
							 $where_array = array(
                            'teacher_subject_id' => $subject_v['id'],
                            'day_name' => $day_value,
							'teacher_id'=>$admin['id']
							
							);
							
						}
						
						else{
							
							 $where_array = array(
                            'teacher_subject_id' => $subject_v['id'],
                            'day_name' => $day_value);
							}
							
							
                        $result = $this->live_class_model->get($where_array);
						
                     
					
					
						
                        if(!empty($result))
						{
							$timearray=array();
							foreach($result as $ress)
							{
							
							
							$teachername=$this->live_class_model->getteacher_name($ress['teacher_id']);
								
								$obj = new stdClass();
								$obj->id=$ress['id'];
								$obj->apid=$ress['apid'];
								$obj->status = $ress['start_time']?"Yes":"No";
								$obj->start_time = $ress['start_time']?$ress['start_time']:"N/A";
								$obj->end_time = $ress['end_time']?$ress['end_time']:"N/A";
								$obj->is_live=$ress['is_live'];
								$obj->teacher=$teachername['name'].' ' .$teachername['surname']; 
								$timearray[] = $obj;
							}
							
								
							$result_array[$day_value] = $timearray;
							
							
                        }
						
					
						else
						{
                            $obj = new stdClass();
                            $obj->status = "No";
							$obj->id="N/A";
							$obj->apid="N/A";
                            $obj->start_time = "N/A";
                            $obj->end_time = "N/A";
                         
							$obj->teacher="N/A";
                            $result_array[$day_value] = $obj;
                        }
                    // }
				
					
                    $final_array[$subject_v['name']] = $result_array;
				
					}
					 	// $final_array['teacher_name']=$subject_v['teacher_name'];
                }
            }
			
			

           
			
            $data['result_array'] = $final_array;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/live_class/liveclasstimetable_list', $data);
            $this->load->view('layout/footer', $data);
        }
    }


   

   

    function create() {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_add')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'live_class');
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
           $this->load->view('admin/live_class/liveclassTimetable', $data);
            $this->load->view('layout/footer', $data);
        } else {
            
            $admin=$this->session->userdata('admin');
            $centre_id=$admin['centre_id'];
            $feecategory_id = $this->input->post('feecategory_id');
            $subject_id = $this->input->post('subject_id');
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			$teacher_id = $this->input->post('teacher_id');
			$apid=$this->input->post('apid');
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
                    'day_name' => $value, 
					'teacher_id'=>$teacher_id,
					'centre_id'=>$admin['centre_id']
                );
                $result = $this->live_class_model->get($where_array);
				
				
                if (empty($result)) {
                    $obj = new stdClass();
                    $obj->starting_time = "";
                    $obj->post_id = 0;
                    $obj->ending_time = "";
                   
                } else {
					$timetable=array();
					foreach( $result as $res)
					{
                    $obj = new stdClass();
					$obj->apid=$res['apid'];
                    $obj->starting_time = $res['start_time'];
                    $obj->post_id = $res['id'];
                    $obj->ending_time = $res['end_time'];
                   
					$timetable[]=$obj;
                }}
                $array[$value] =$timetable; 
            }
            $data['timetableSchedule'] = $array;
            if ($this->input->post('save_exam') == "save_exam") {
				
                $loop = $this->input->post('i');
				$keys=$this->input->post('key');
				$teacher_subject_id=$this->input->post('subject_id');
				
				$this->live_class_model->check_edit($teacher_subject_id,$teacher_id);
				
                foreach ($loop as $key => $value) {
					
				/*	random_string('unique',8);*/
					$start_time=$this->input->post('stime_'.$value);
					$end_time=$this->input->post('etime_'.$value);
					$id=$this->input->post('edit_'.$value);
					$apid=$this->input->post('apid_'.$value);
					
					$c=count($start_time);
					for($i=0;$i<$c;$i++)
					{
					
                    $data = array(
                        'centre_id'=>$admin['centre_id'],
						'teacher_id'=>$teacher_id,
                        'day_name' => $value,
                        'teacher_subject_id' => $this->input->post('subject_id'),
                        'start_time' => $start_time[$i],
                        'end_time' => $end_time[$i],
						'apid'=>$apid[$i],
                        'id' => $id[$i],
					
                    );
					
					
					
                    $this->live_class_model->add($data);
                } }
				
                redirect('admin/live_class');
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/live_class/liveclassTimetable', $data);
            $this->load->view('layout/footer', $data);
        }
    }





    /*function edit($id) {
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

*/
 function check_exists()
 {
	
	$this->timetable_model->valid_check_exists();
	 
	 
	 
 }
 /*function view($id) {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/timetable/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }*/

   /* function delete($id) {
        $data['title'] = 'Mark List';
        $this->mark_model->remove($id);
        redirect('admin/timetable/index');
    }*/



  function class_start()
  {
	$id=$this->input->post('id');
	$status=$this->input->post('status');
	$this->live_class_model->class_active($id,$status);
	$data=array('status'=>$status,'id'=>$id);
	echo json_encode($data);
	   }


 function live_class_start($id)
 {
	 if (!$this->rbac->hasPrivilege('live_class', 'can_view')) {
            access_denied();
        }
		
    $data['title'] = 'Live Class'; 
	$data['class']=$this->live_class_model->get_apid($id);
	$this->load->view('layout/header', $data);
	$this->load->view('admin/live_class/class_start',$data);
	$this->load->view('layout/footer', $data); 
	 
	 
	 }



function uploaded_class_validation()
{
	$this->form_validation->set_rules('upload_date', 'Date', 'trim|required|xss_clean');
    $this->form_validation->set_rules('etime', 'Time', 'trim|required|xss_clean');
   
	 if ($this->form_validation->run() == FALSE) {
		   $data = array(
		 'upload_date' => form_error('upload_date'),
         'etime' => form_error('etime'),
		 );
		 
		$array = array('status' => 'fail', 'error' => $data);
            echo json_encode($array); 
	 }
	 
	 else
	 {
		
		$array = array('status' => 'success', 'error' => '');
            echo json_encode($array); 
		 
		 }
	
	
	}


  
   function uploaded_class()
   {
	   
	   
	    $id=$this->input->post('key_id'); 
		$date=$this->input->post('upload_date');
		$time=$this->input->post('etime');
		
		   
		    if (!empty($_FILES['videofile']['name'])) {
            $config['upload_path'] = 'uploads/gallery/';
            $config['allowed_types'] = 'wmv|mp4|avi|mov|';
            $config['file_name'] = $_FILES['videofile']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('videofile')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }
		
		
           
           /* $upload_path = './upload/school_content/';
            $config['upload_path'] = $upload_path;
         
            $config['allowed_types'] = 'wmv|mp4|avi|mov|';
         
            $config['max_size'] = '';
          
            $config['max_filename'] = '255';
          
            $config['encrypt_name'] = FALSE;
          
            $video_data = array();
          
            $is_file_error = FALSE;
          
            if (!$_FILES) {
                $is_file_error = TRUE;
                $this->handle_error('Select a video file.');
            }
            //if file was selected then proceed to upload
            if (!$is_file_error) {
                //load the preferences
                $this->load->library('upload', $config);
                //check file successfully uploaded. 'video_name' is the name of the input
                if (!$this->upload->do_upload('videofile')) {
                    //if file upload failed then catch the errors
					 $error = array('error' => $this->upload->display_errors());
					
                    $this->handle_error($this->upload->display_errors());
                    $is_file_error = TRUE;
                } else {
                    //store the video file info
                    $video_data = $this->upload->data();
                }
            }
            // There were errors, we have to delete the uploaded video
            if ($is_file_error) {
                if ($video_data) {
                    $file = $upload_path . $video_data['file_name'];
                    if (file_exists($file)) {
                        unlink($file);
                    }
                }
            } else {
                $d['video_name'] = $video_data['file_name'];
                $d['video_path'] = $upload_path;
                $d['video_type'] = $video_data['file_type'];
                $this->handle_success('Video was successfully uploaded to direcoty <strong>' . $upload_path . '</strong>.');
            }
       */
		
		$data=array(
		'live_class_id'=>$id,
		'v_date'=>date('Y-m-d', $this->customlib->datetostrtotime($date)),
		'time'=>$time,
		'video'=>$picture
		
      );
	$this->live_class_model->classupload($data);
	   
	   redirect('admin/live_class');
	    }
  
    public function generate_apid()
  {
	 $id=$this->input->post('timetable_id'); 
	 $data=array(
	 'apid'=>$this->input->post('apid'),
	 'is_live'=>1
	   );
	  
	  $this->live_class_model->add_apid($data,$id);
	  redirect('admin/live_class/live_class_start/'.$id);
	  
	  }
	  
	  
	  public function live_class_attendance()
	{
	if (!$this->rbac->hasPrivilege('live_class_attendance', 'can_view')) {
            access_denied();
        }	
		$this->session->set_userdata('top_menu', 'live_class');
        $this->session->set_userdata('sub_menu', 'live_class/live_class_attendance');
		$class = $this->class_model->get();
        $data['classlist'] = $class;
		$this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) {
		   $this->load->view('layout/header', $data);
           $this->load->view('admin/live_class/liveclass_attendance', $data);
           $this->load->view('layout/footer', $data);
		
		   }  
	       else {
			$admin=$this->session->userdata('admin');
			$class = $this->input->post('class_id');
			$data['class_id']=$class;
            $section = $this->input->post('section_id');
			$data['section_id']=$section;
			$teacher_sub_id=$this->input->post('subject_id');
			$data['subject_id']=$teacher_sub_id;
			$date = $this->input->post('date');
			if($admin['roles']['Teacher']) {
				
				$teacher_id=$admin['id'];
				}
			
			else
			{
				$teacher_id=$this->input->post('teacher_id');
				
				}
				
				$data['teacher_id']=$teacher_id;
			$resultlist = $this->student_model->searchByClassSection($class, $section);
			$arr=array();  
			if(!empty($resultlist))
			{
			
			 foreach($resultlist as $key=>$res)
			 {
				$attendance=$this->live_class_model->getLiveclassAttendance($res['student_id'],$teacher_sub_id,$teacher_id,$date);
				
				if(!empty($attendance))
				{
				 $x['admission_no']=$res['admission_no'];
				 $x['firstname']=$res['firstname'];
				 $x['lastname']=$res['lastname'];
				 $x['type']=$attendance['type'];
				 $arr[]=$x;
				}
				else
				{
				 $x['admission_no']=$res['admission_no'];
				 $x['firstname']=$res['firstname'];
				 $x['lastname']=$res['lastname'];
				 $x['type']='Absent';
				 $arr[]=$x;
					
					}
				
				
				
				}
				}
			  
			   $data['resultlist']=$arr;
		   $this->load->view('layout/header', $data);
           $this->load->view('admin/live_class/liveclass_attendance', $data);
           $this->load->view('layout/footer', $data); 
			   
			   }
	       
	  
	}






}

?>