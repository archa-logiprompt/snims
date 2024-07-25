<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Live_class extends Student_Controller {

    function __construct() {
        parent::__construct();
      
		 $this->load->model("live_class_model");
		
		 
    }

    function index() {
       
        $this->session->set_userdata('top_menu', 'live_class');
        $student_id = $this->customlib->getStudentSessionUserID();
        $student = $this->student_model->get($student_id);
        //var_dump($student);
        //exit();
		//$course=$this->student_model->get_course($student_id);
		$class_id = $student['class_id'];
        $section_id = $student['section_id'];
		$data['title'] = 'Exam Marks';
        $data['class_id'] = $class_id;
        $data['section_id'] = $section_id;
        $result_subjects = $this->teachersubject_model->getSubjectByClsandSection($class_id, $section_id,'Theory');
		$getDaysnameList = $this->customlib->getDaysname();
        $data['getDaysnameList'] = $getDaysnameList;
        	
         $final_array = array();
		 
            if (!empty($result_subjects)) {
                foreach ($result_subjects as $subject_k => $subject_v) {
					
                    $result_array = array();
                    foreach ($getDaysnameList as $day_key => $day_value) {
                        $where_array = array(
                            'teacher_subject_id' => $subject_v['id'],
                            'day_name' => $day_value);
							
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
								$obj->class_uploader_id=$ress['class_uploader_id'];
								$obj->vtime=$ress['time'];
								$obj->v_date=$ress['v_date'];
								$obj->video=$ress['video'];
								
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
                    }
					
					
                    $final_array[$subject_v['name']] = $result_array;
					//$final_array['teacher_name']=$subject_v['teacher_name'];
                }
            }
			
            $data['result_array'] = $final_array;
            $this->load->view('layout/student/header', $data);
            $this->load->view('user/live_class/liveclasstimetableList', $data);
            $this->load->view('layout/student/footer', $data);
        
    }

   


 function live_class_join($id)
 {
	 
    $data['title'] = 'Live Class'; 
	$data['class']=$this->live_class_model->get_apid($id);
	 $this->load->view('layout/student/header', $data);
	$this->load->view('user/live_class/class_start',$data);
	 $this->load->view('layout/student/footer', $data);
	 
	 
	 }


 function uploaded_class($id)
 {
	 
	 
	 $data['uploaded']=$this->live_class_model->uploaded_class($id);
	 
	 $this->load->view('layout/student/header', $data);
	 $this->load->view('user/live_class/uploaded_class',$data);
	 $this->load->view('layout/student/footer', $data);
	 
	 
	 
	 }
	 
	 
	 
	 function view_class($id)
 {
	 
	 
	 $data['video']=$this->live_class_model->view_class($id);
	 
	 $this->load->view('layout/student/header', $data);
	 $this->load->view('user/live_class/view_class',$data);
	 $this->load->view('layout/student/footer', $data);
	 
	 
	 
	 }

	 


 function attendance()
 {
	 
	 $start_time=$this->input->post('start_time');
	 date_default_timezone_set('Asia/Kolkata');
     $currentTime = date('h:i A', time () );
	
	  $datetime1= new DateTime($start_time);
      $datetime2= new DateTime($currentTime);
	  $interval = $datetime1->diff($datetime2);
	  $hours=$interval->format('%h');
	  $min=$interval->format('%i');
      $totalmin=(($hours *60)+$min);
	
	  if($totalmin > 10)
	  {
		   $data=array(
	   'student_id'=>$this->input->post('student_id'),
	   'live_class_id'=>$this->input->post('live_class_id'),
	   'date'=>date('Y-m-d'), 
	   'type'=>'Late'
	   );
		  }
		  else{
	  
	   $data=array(
	   'student_id'=>$this->input->post('student_id'),
	   'live_class_id'=>$this->input->post('live_class_id'),
	   'date'=>date('Y-m-d'), 
	   'type'=>'Present'
	   );
	   
		  }
	$this->live_class_model->attendance($data); 
	
	 
	 }




}

?>