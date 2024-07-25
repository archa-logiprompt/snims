<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class WorkLog extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classteacher_model");
		$this->load->model('Timetablenew_model');
		$this->load->helper('lang');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('work_log', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'worklog/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Work Log';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        $userdata = $this->customlib->getUserData();

        $data['usertype']=$userdata['user_type'];

        $data['is_search'] =false;
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
       
        if ($this->input->server('REQUEST_METHOD') == "POST") {

           $from = $this->input->post('datefrom');
           $to = $this->input->post('dateto');
           $userdata = $this->customlib->getUserData();
           $userid = $userdata['id'];
           $data['is_search'] =true;
           $data['from'] =$from;
           $data['to'] =$to;




           $data['worklog'] = 
           $this->db->where('staff_id',$userid)
            ->where("date>=",$from)
            ->where("date<=",$to)
            ->get('work_log')->result();
 
            $this->load->view('layout/header', $data);
            $this->load->view('admin/worklog/worklog', $data);
            $this->load->view('layout/footer', $data);
                
       
        
    }
    else{
        $this->load->view('layout/header', $data);
        $this->load->view('admin/worklog/worklog', $data);
        $this->load->view('layout/footer', $data);
    }
    }

    function view($id) {
        if (!$this->rbac->hasPrivilege('work_log', 'can_view')) {
            access_denied();
        }
        $data['title'] = 'Mark List';
        $mark = $this->mark_model->get($id);
        $data['mark'] = $mark;
        $this->load->view('layout/header', $data);
        $this->load->view('admin/worklog/timetableShow', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        
        $this->db->where('id',$id)->delete('work_log');
        redirect('admin/worklog/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('work_log', 'can_add')) {
			
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


 
            
        

            if($this->input->post('search')=='Save') {
    
     
                $workids= $this->input->post('workid');
    
                $workarray = [];
                $i=0;
    
                $userdata = $this->customlib->getUserData();
    
    
                $userid = $userdata['id'];
    
    
    
                foreach ($workids as $key => $value) {
                    
                    $count=(count($this->input->post('timefrom')[$value]));
     
                    for($wc=0;$wc<$count;$wc++){
    
                        $workarray[$i]=[
                                'timefrom'=>$this->input->post('timefrom')[$value][$wc],
                                'timeto'=>$this->input->post('timeto')[$value][$wc],
                                'worktype'=>$this->input->post('worktype')[$value][$wc],
                                'class_id'=>$this->input->post('class_id')[$value][$wc],
                                'section_id'=>$this->input->post('section_id')[$value][$wc],
                                'subject_id'=>$this->input->post('subject_id')[$value][$wc],
                                'worktopic'=>$this->input->post('worktopic')[$value][$wc]
                            
                        ];
                        $i++;
    
    
                       
                    }
                    
                    $datajson = json_encode($workarray); 
                     
                    unset($workarray);
                    $i=0; 
                   
        
                    $insert_array=[
                        'staff_id'=>$userid,
                        'log'=>$datajson,
                        'date'=>$this->input->post('date')[$value],
        
                    ]; 
     
        
                    $this->db->insert('work_log',$insert_array);
                } 
                $this->load->view('layout/header', $data);
                $this->load->view('admin/worklog/createworklog', $data);
                $this->load->view('layout/footer', $data);
                    
            }
            
        }
        else{
            $this->load->view('layout/header', $data);
            $this->load->view('admin/worklog/createworklog', $data);
            $this->load->view('layout/footer', $data);
        }
        
         
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('work_log', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Academics');
        $this->session->set_userdata('sub_menu', 'worklog/index');
        $session = $this->setting_model->getCurrentSession();
        $data['title'] = 'Exam Marks';
        $data['exam_id'] = "";
        $data['class_id'] = "";
        $data['section_id'] = "";
        $exam = $this->exam_model->get();
        $class = $this->class_model->get();
        $data['examlist'] = $exam;
        $data['classlist'] = $class;
        
        $data['logid'] = $id;
        $userdata = $this->customlib->getUserData();
        $userid = $userdata['id'];


        $data['usertype']=$userdata['user_type'];

     
        $class = $this->class_model->get('', $classteacher = 'yes');
        $data['classlist'] = $class;
        // $data['sectionlist'] = $this->section_model->getClassBySection($class_id);

        $data['log'] = $this->db->where('id',$id)->get('work_log')->row_array();
        


       
        if ($this->input->server('REQUEST_METHOD') == "POST") {

           $from = $this->input->post('datefrom');
           $to = $this->input->post('dateto');
           $userdata = $this->customlib->getUserData();
           $userid = $userdata['id'];


           $workids= $this->input->post('workid');
    
                $workarray = [];
                $i=0;
    
                $userdata = $this->customlib->getUserData();
    
    
                $userid = $userdata['id'];


                
    
    
    
                
                    
                    $count=(count($this->input->post('timefrom')[0]));
     
                    for($wc=0;$wc<$count;$wc++){
    
                        $workarray[$i]=[
                                'timefrom'=>$this->input->post('timefrom')[0][$wc],
                                'timeto'=>$this->input->post('timeto')[0][$wc],
                                'worktype'=>$this->input->post('worktype')[0][$wc],
                                'class_id'=>$this->input->post('class_id')[0][$wc],
                                'section_id'=>$this->input->post('section_id')[0][$wc],
                                'subject_id'=>$this->input->post('subject_id')[0][$wc],
                                'worktopic'=>$this->input->post('worktopic')[0][$wc]
                            
                        ];
                        $i++;
    
    
                       
                    }

                    
                    $datajson = json_encode($workarray); 
                    
                  
        
                    $insert_array=[
                        'log'=>$datajson,
        
                    ]; 
     
        
                    $this->db->where('id',$id)->update('work_log',$insert_array);
                
                    redirect('admin/worklog/index');
                
       
        
    }
    else{
        $this->load->view('layout/header', $data);
        $this->load->view('admin/worklog/editworklog', $data);
        $this->load->view('layout/footer', $data);
    }
    }


 function check_exists()
 {
	
	$this->Timetablenew_model->valid_check_exists();
	 
	 
	 
 } 


}

?>