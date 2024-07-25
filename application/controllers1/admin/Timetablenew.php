<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Timetablenew extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
		$this->load->model('Timetablenew_model');
		$this->load->helper('lang');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('class_timetable', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'timetable/index');
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
        //$feecategory = $this->feecategory_model->get();
        //$data['feecategorylist'] = $feecategory;
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableListnew', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
            $result_subjects = $this->teachersubject_model->getDepartmentByClsandSection($class_id, $section_id);
			//var_dump($result_subjects);
			$getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $final_array = array();
            if (!empty($result_subjects)) {
                foreach ($result_subjects as $subject_k => $subject_v) {
					
                    $result_array = array();
                    foreach ($getDaysnameList as $day_key => $day_value) {
                        $where_array = array(
                            'subject_id' => $subject_v->subject_id,
                            'day_name' => $day_value);
							
                        $result = $this->Timetablenew_model->get($where_array);
						
                        if(!empty($result))
						{
							$timearray=array();
							foreach($result as $ress)
							{
								$obj = new stdClass();
								$obj->status = $ress['start_time']?"Yes":"No";
								$obj->start_time = $ress['start_time']?$ress['start_time']:"N/A";
								$obj->end_time = $ress['end_time']?$ress['end_time']:"N/A";
								$obj->room_no = $ress['room_no']?$ress['room_no']:"N/A";
								$obj->department=getdep($ress['department_id']); 
								$obj->subject=getsub($ress['subject_id']); 
								$timearray[] = $obj;
							}
							$result_array[$day_value] = $timearray;
                        } 
						else
						{
                            $obj = new stdClass();
                            $obj->status = "No";
                            $obj->start_time = "N/A";
                            $obj->end_time = "N/A";
                            $obj->room_no = "N/A";
							$obj->department="N/A";
							$obj->subject="N/A";
                            $result_array[$day_value] = $obj;
                        }
                    }
					
                    $final_array[$subject_v->name] = $result_array;
					//$final_array['teacher_name']=$subject_v['teacher_name'];
                }
            }
			//var_dump($final_array);
					//exit();
            $data['result_array'] = $final_array;
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableListnew', $data);
            $this->load->view('layout/footer', $data);
		}
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
		$data['department_id']="";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get('', $classteacher = 'yes');
        //$data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();
        //   if(($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")){
        //  $data["classlist"] =   $this->customlib->getclassteacher($userdata["id"]);
        // }    
        //$feecategory = $this->feecategory_model->get();
		//var_dump($_POST);
        //$data['feecategorylist'] = $feecategory;
		
        //$this->form_validation->set_rules('subject_id', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
		 //$this->form_validation->set_rules('department_id', 'Department','trim|required|xss_clean');
		 
		  /*$this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'valid_check_exists'))
                )
        );*/
		
		 	
		 // var_dump($this->input->post('subject_id'));     
		 
		 
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreatenew', $data);
            $this->load->view('layout/footer', $data);
        } else {
			//var_dump('subject_id');
            
            $admin=$this->session->userdata('admin');
             $centre_id=$admin['centre_id'];
            //$feecategory_id = $this->input->post('feecategory_id');
			//var_dump($this->input->post('subject_id'));
            $subject_id = implode(',',$this->input->post('subject_id'));
			
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
			$department_id =implode(',',$this->input->post('department_id')) ;
            $data['subject_id'] = $subject_id;
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;
			$data['department_id']=$department_id;
            $getDaysnameList = $this->customlib->getDaysname();
            $data['getDaysnameList'] = $getDaysnameList;
            $array = array();
            $data['timetableSchedule'] = array();
            foreach ($getDaysnameList as $key => $value) {
                $where_array = array(
                    'department_id' => $department_id,
                    'day_name' => $value
                );
                $result = $this->Timetablenew_model->get($where_array);
				$timetable=array();
				
               if (empty($result)) {
                    $obj = new stdClass();
                    $obj->starting_time = "";
                    $obj->post_id = 0;
                    $obj->ending_time = "";
                    $obj->room_no = "";
                } else {
					
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
				//var_dump($array[$value]);
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
						'class_id'=>$class_id,
						'section_id'=>$section_id,
						'subject_id'=>$this->input->post('subject_id'),
                        'day_name' => $value,
                        'department_id' => $this->input->post('department_id'),
                        'start_time' => $start_time[$i],
                        'end_time' => $end_time[$i],
                        'room_no' =>$room_no[$i] ,
						'total_time'=>$totalmin, 
                        'id' => $this->input->post('edit_'.$value),
					
                    );
                    $this->Timetablenew_model->add($data);
                } }
                //redirect('admin/timetablenew'); 
            }
            $this->load->view('layout/header', $data);
            $this->load->view('admin/timetable/timetableCreatenew', $data);
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
            $this->load->view('admin/timetable/timetableEditnew', $data);
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
	
	$this->Timetablenew_model->valid_check_exists();
	 
	 
	 
 }
 /*?><!--public function creater()
{
    $data= array(
       
        'subjects' => implode(",",$this->input->post('subjects')) 
    );
  $this->Timetablenew_model->add($data);
}
--><?php */


}

?>