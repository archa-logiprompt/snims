<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Assign_ward extends Admin_Controller {

    function __construct() {
        parent::__construct();
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('viewassign_ward', 'can_add')) {
            access_denied();
        }
		
		$this->session->set_userdata('top_menu', 'clinical_rotation');
		$this->session->set_userdata('sub_menu', 'clinical_rotation/assign_ward');
		
		$class = $this->class_model->get();
        $data['classlist'] = $class;
		
		$search = $this->input->post('search');
	    $class = $this->input->post('class_id');
		$data['class_id']=$class;
        $section = $this->input->post('section_id');
		$data['section_id']=$section;
		if(isset($search))
		{
		if($search =='search_filter')
		
		{
			 $this->form_validation->set_rules('class_id','Course','trim|required|xss_clean');
		     $this->form_validation->set_rules('section_id','Section','trim|required|xss_clean');
			
			 if($this->form_validation->run() == FALSE)
				   {
					  
					  $this->load->view('layout/header', $data);
                      $this->load->view('admin/clinical_rotation/assign_ward/assign_ward',$data);
                      $this->load->view('layout/footer', $data);
					  
					  }
			
			
			else
			{
				
				 $student_list = $this->student_model->searchbygroup($class, $section);
		         $data['group_list']=$student_list;
		         $warddetail =  $this->db->select('*,clinical_department.id as wardid,warddetail.id as detailid')->join('clinical_department','warddetail.deptnames=clinical_department.id')->get('warddetail')->result_array();
				//  echo $this->db->last_query();
				 $data['warddetails']= $warddetail;
					
			}
			
		}
		
		
		}
		
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_ward/assign_ward',$data);
        $this->load->view('layout/footer',$data);
		
		
		}



		
		

    
   function assign()
	 {
		
		
		if (!$this->rbac->hasPrivilege('assign_ward', 'can_add')) {
			
            // access_denied();
        }
		//$this->session->set_userdata('top_menu', 'clinical_rotation');
		//$this->session->set_userdata('sub_menu', 'clinical_rotation/assign_ward');
		
		
		
		$this->form_validation->set_rules('wardname','Ward Name','trim|required|xss_clean');
		$this->form_validation->set_rules('startdate','start date','trim|required|xss_clean');
		$this->form_validation->set_rules('enddate','end date','trim|required|xss_clean');		
		
		if ($this->form_validation->run() == false) {
            $data = array(
                'wardname' => form_error('wardname'),
            );
		
		 $array = array('status' => 'fail', 'error' =>$data);
            echo json_encode($array);
		}
		else{
			
		    $class_id=$this->input->post('class_id');
			$section_id=$this->input->post('section_id');
			$group_id = $this->input->post('group_id'); 
		    $ward_id=$this->input->post('wardname');
			$startdate=$this->input->post('startdate');
			$enddate=$this->input->post('enddate'); 
		    
			 foreach($group_id as $key=>$student)
			 {
				
				$data=array(
			    'class_id'=>$class_id,
				'section_id'=>$section_id,    
				'group_id'=>$student, 
			    'ward_id'=>$ward_id,
				'datefrom'=>$startdate,
				'dateto'=>$enddate,
				'session_id'=> $this->setting_model->getCurrentSession()
				);
				$result = $this->student_model->check_Exits_group($data);
               
			  
			   if ($result==false) {
                $this->student_model->assign_ward($data);
			  
        
            } 
			
			else {
                
				
				$array = array('status' => 'fail', 'error' => '', 'message' => 'Record already Exist');
				 echo json_encode($array);
            }
       
		}
				
		$array = array('status' => 'success', 'error' => '', 'message' => 'Record Saved Successfully');
         echo json_encode($array);		
		
		
			 
		 }
		 
		 	
	 }
		 
	 

	function viewassign_ward()
	{
		
		if (!$this->rbac->hasPrivilege('viewassign_ward', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'clinical_rotation');
		$this->session->set_userdata('sub_menu', 'clinical_rotation/assign_ward');
		
		 $class = $this->class_model->get();
         $data['classlist'] = $class;
		 $search = $this->input->post('search');
		 $class_id=$this->input->post('class_id');
		 
		 if(isset($search))
		{
		if($search =='search_filter')
		
		{
			
			if($class_id=='all')
			{
				
			
			$warddetail=$this->student_model->viewallassign_ward();
	       $data['warddetails']= $warddetail;
			
				
				
			}
			else{
			
			 $this->form_validation->set_rules('class_id','Course','trim|required|xss_clean');
		     $this->form_validation->set_rules('section_id','Section','trim|required|xss_clean');
			
			
			 if($this->form_validation->run() == FALSE)
				   {
					  
					  
					  }
			
			else{
				
			$class_id=$this->input->post('class_id');
			$section_id=$this->input->post('section_id');	
				
		  $warddetail=$this->student_model->viewassign_ward($class_id,$section_id);

		//   var_dump($warddetail);exit;
	       $data['warddetails']= $warddetail;
				
				
				
			}
		
			}
		
		
		}
		
		
		}
		 
		 
		
		$this->load->view('layout/header',$data);
        $this->load->view('admin/clinical_rotation/assign_ward/viewassign_ward',$data);
        $this->load->view('layout/footer',$data);
		
	}
	



 function getstudentdetail()
 {
	 //$section_id=$this->input->post('section_id');
	 //$class_id=$this->input->post('class_id');
	 $group_id=$this->input->post('group_id');
	 
	 
	 $studentdetail=$this->student_model->getstudentdetail($group_id);
	 echo json_encode( $studentdetail);
	  
 }

 
function get_time()
 {
	
	 $id=$this->input->post('id');
	 
	 
	 $list=$this->clinicalrotation_model->getsession_list($id);
	 echo json_encode( $list);
	  
 }


function deletes($groupid,$from,$to){
	//echo $id;
	 if (!$this->rbac->hasPrivilege('viewassign_ward', 'can_delete')) {
            access_denied();
        }
        $datefrom='';
        $dateto='';
        $this->clinicalrotation_model->deletes($groupid,$from,$to);
        redirect('admin/assign_ward/viewassign_ward');
	}


}


?>