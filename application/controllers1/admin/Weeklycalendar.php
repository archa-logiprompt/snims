<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Weeklycalendar extends Admin_Controller {

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
        $this->session->set_userdata('sub_menu', 'weeklycalendar/index');
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
       
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar/weeklycalendar', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $class_id = $this->input->post('class_id');
            $section_id = $this->input->post('section_id');
            $data['class_id'] = $class_id;
            $data['section_id'] = $section_id;


            $data['class_name']=$this->db->select('class')->where('id',$class_id)->get('classes')->row()->class;
            $data['section_name']=$this->db->select('section')->where('id',$section_id)->get('sections')->row()->section;

            


            $wherearray = [
                'course_id'=>$class_id,
                'batch_id'=>$section_id,
            ];
            $data['weekcalendar']=$this->db->where($wherearray)->get('week_calendar')->result_array();

            // var_dump($this->db->last_query());exit;
            


            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar/weeklycalendar', $data);
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
        $this->load->view('admin/weeklycalendar/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        
        $this->db->where('id',$id)->delete('week_calendar');
        redirect('admin/weeklycalendar/index');
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

        
       
        if ($this->input->server('REQUEST_METHOD') == "POST") {



            if($this->input->post('search')=='Search'){

                $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
                $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/header', $data);
                    $this->load->view('admin/weeklycalendar/createcalendar', $data);
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
                $this->load->view('admin/weeklycalendar/createcalendar', $data);
                $this->load->view('layout/footer', $data);

            }
            
        }

        if($this->input->post('search')=='Save') {
            //    var_dump($this->input->post('search'));
          

            $planids= $this->input->post('planid');

            $planarray = [];
            $i=0;
            
            foreach ($planids as $key => $value) {

                $planarray[$i]['datefrom'] = $this->input->post('datefrom')[$value];
                $planarray[$i]['dateto'] = $this->input->post('dateto')[$value];
                $planarray[$i]['plan'] = $this->input->post('plan')[$value];
                
                $i++;
            }

            $class_id=$this->input->post('class_id');
            $section_id= $this->input->post('section_id');
           
            $datajson= json_encode($planarray);

            $insert_array=[
                'course_id'=>$class_id,
                'batch_id'=>$section_id,
                'plan'=>$datajson,

            ];

            $this->db->insert('week_calendar',$insert_array);

           
            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar/createcalendar', $data);
            $this->load->view('layout/footer', $data);
                
        }
        if($this->input->post('search')=='Update') {
            //    var_dump($this->input->post('search'));
          

            $planids= $this->input->post('planid');

            $planarray = [];
            $i=0;
            
            foreach ($planids as $key => $value) {

                $planarray[$i]['datefrom'] = $this->input->post('datefrom')[$value];
                $planarray[$i]['dateto'] = $this->input->post('dateto')[$value];
                $planarray[$i]['plan'] = $this->input->post('plan')[$value];
                
                $i++;
            }

            $class_id=$this->input->post('class_id');
            $section_id= $this->input->post('section_id');
           
            $datajson= json_encode($planarray);

            $insert_array=[
                'plan'=>$datajson,
            ];
            
            $planid = $this->input->post('hiddenplanid');


        //    var_dump($datajson);exit;
             
            
            $this->db->where('id',$planid)->update('week_calendar',$insert_array);

            
           

            $this->load->view('layout/header', $data);
            $this->load->view('admin/weeklycalendar/createcalendar', $data);
            $this->load->view('layout/footer', $data);
                
        }
    }
    else{
        $this->load->view('layout/header', $data);
        $this->load->view('admin/weeklycalendar/createcalendar', $data);
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
            $this->load->view('admin/weeklycalendar/timetableEditnew', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'name' => $this->input->post('name'),
                'note' => $this->input->post('note'),
            );
            $this->mark_model->add($data);
            $this->session->set_flashdata('msg', '<div mark="alert alert-success text-center">Employee added successfully</div>');
            redirect('admin/weeklycalendar/index');
        }
    }


 function check_exists()
 {
	
	$this->Timetablenew_model->valid_check_exists();
	 
	 
	 
 } 


}

?>