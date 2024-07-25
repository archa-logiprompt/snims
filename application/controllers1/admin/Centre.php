<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Centre extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('Enc_lib');
    }

    function index() {
        if (!$this->rbac->hasPrivilege('centre', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'centre');
        $this->session->set_userdata('sub_menu', 'centre/centre_detail');
      
	  
	  $centre=$this->classsection_model->get_centre();
	  $data['centrelist']=$centre;
	  
	  
	   
	    $this->load->view('layout/header', $data);
        $this->load->view('admin/centre/centreList', $data);
        $this->load->view('layout/footer', $data);
	    
	}
	
	 
	
	function create()
	{
		
		
		 if (!$this->rbac->hasPrivilege('centre', 'can_add')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'admin/centre');
        $this->session->set_userdata('sub_menu', 'centre/centre_details');
      
	  $this->form_validation->set_rules(
                'centre_code', 'centre_code', array(
            'required',
            array('check_exists_code', array($this->classsection_model, 'check_exists_code'))
                )
        );
	    //$this->form_validation->set_rules('centre_code', 'Centre Code', 'trim|required|xss_clean');
	    $this->form_validation->set_rules('centre_name', 'Centre Name', 'trim|required|xss_clean');
		 $this->form_validation->set_rules('centre_active', 'Centre Active', 'trim|required|xss_clean');
		$this->form_validation->set_rules('centre_email', 'Email', 'valid_email');
		$this->form_validation->set_rules('centre_phone','phone','required|max_length[10]|min_length[10]');
		   $this->form_validation->set_rules('password', 'password', 'trim|required|xss_clean');
	  
	  $centre=$this->classsection_model->get_centre();
	  $data['centrelist']=$centre;
	  
	  
	  
	  
	   if ($this->form_validation->run() == FALSE) {
		   
          $this->load->view('layout/header', $data);
         $this->load->view('admin/centre/centreList', $data);
         $this->load->view('layout/footer', $data);
	    
		  
		    
        }
		else
		{
		    
	   /*if (!empty($_FILES['centre_image']['name'])) {
            $config['upload_path'] = 'uploads/centre_image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['centre_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('centre_image')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
            } else {
                $picture = '';
            }
        } else {
            $picture = 'uploads/centre_image/no_image.png';
        }
	  */
			
			
			$data=array(
			'centre_code'=>$this->input->post('centre_code'),
			'centre_name'=>$this->input->post('centre_name'),
			'centre_add1'=>$this->input->post('centre_add1'),
			'centre_add2'=>$this->input->post('centre_add2'),
			'centre_email'=>$this->input->post('centre_email'),
			'centre_phone'=>$this->input->post('centre_phone'),
			'centre_active'=>$this->input->post('centre_active'),
		    
			);
			      $insert_id=$this->classsection_model->addcentre($data);
				  
				 
				 if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/centre_image/" . $img_name);
               
 }
				$img=array(
				
				'id'=>$insert_id,
				'centre_image'=> $img_name
				
				); 
				 
				 $this->classsection_model->addcentre($img);
				 
				 
				 
				 
				  $data2=array(

				  'centre_id'=>$insert_id,
				  'name'=>$this->input->post('centre_name'),
				  'email'=>$this->input->post('centre_email'),
				  'password'=>$this->enc_lib->passHashEnc($this->input->post('password')),
				  'is_active'=>1,
				  
				  );
				  $id=$this->classsection_model->addcentre_as_staff($data2);
				 
				  $role=array(
				  'staff_id'=>$id,
				  'role_id'=>8
				  
				  );
				 $this->classsection_model->role($role); 
				  
				  $set=array(
				  'id'=>$insert_id,
				  'name'=>$this->input->post('centre_name'),
				  'email'=>$this->input->post('centre_email'),
				  'phone'=>$this->input->post('centre_phone'),
				  'address'=>$this->input->post('centre_add1'),
				  'session_id'=>$this->setting_model->getCurrentSession(),
				  'lang_id'=>4,
				  'theme'=>'red.jpg',
				  'image'=>'1.png',
				  'class_teacher'=>'no'
				  );
			
			$this->setting_model->add_schsetting($set);
			
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Centre  added successfully</div>');
            redirect('admin/centre');
			
		}
	  
		
		
	}
	
	
	
	
	function edit($id) {
       if (!$this->rbac->hasPrivilege('centre', 'can_edit')) {
            access_denied();
        }
		
		
		
      $this->session->set_userdata('top_menu', 'admin/centre');
	//$this->session->set_userdata('sub_menu', 'university');
        //$data['id'] = $id;
        $centre=$this->classsection_model->get_centre();
	    $data['centrelist']=$centre;
		
		 $centre=$this->classsection_model->get_centre($id);
	    $data['centreedit']=$centre;
		$data['id']=$id;
		
		//$scholar= $this->class_model->get_uni($id);
		//$data['marks']=$scholar;
		
		
       $this->form_validation->set_rules('centre_code', 'Centre Code', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('centre_name', 'Centre Name', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('centre_active', 'Centre Active', 'trim|required|xss_clean');
	  
	    if ($this->form_validation->run() == FALSE) {
          
		
		  $this->load->view('layout/header',$data);
        $this->load->view('admin/centre/centreedit',$data);
        $this->load->view('layout/footer',$data);
	
		
        }
		
		
		else
		{ 
		
		
		/*if (!empty($_FILES['centre_image']['name'])) {
            $config['upload_path'] = 'uploads/centre_image/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['file_name'] = $_FILES['centre_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('centre_image')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];
					
					$data=array(
		     'id'=>$this->input->post('id'), 
		    'centre_code'=>$this->input->post('centre_code'),
			'centre_name'=>$this->input->post('centre_name'),
			'centre_add1'=>$this->input->post('centre_add1'),
			'centre_add2'=>$this->input->post('centre_add2'),
			'centre_email'=>$this->input->post('centre_email'),
			'centre_phone'=>$this->input->post('centre_phone'),
			'centre_active'=>$this->input->post('centre_active'),
		    'centre_image'=> $picture,
			
		   );
					
            } else {
				
                $picture = '';
				
				$data=array(
		     'id'=>$this->input->post('id'), 
		    'centre_code'=>$this->input->post('centre_code'),
			'centre_name'=>$this->input->post('centre_name'),
			'centre_add1'=>$this->input->post('centre_add1'),
			'centre_add2'=>$this->input->post('centre_add2'),
			'centre_email'=>$this->input->post('centre_email'),
			'centre_phone'=>$this->input->post('centre_phone'),
			'centre_active'=>$this->input->post('centre_active'),
		   
		   );
				
            }
        } */
		if(empty($_FILES['file']['name']))
			{
		  $data=array(
		    'id'=>$this->input->post('id'), 
		    'centre_code'=>$this->input->post('centre_code'),
			'centre_name'=>$this->input->post('centre_name'),
			'centre_add1'=>$this->input->post('centre_add1'),
			'centre_add2'=>$this->input->post('centre_add2'),
			'centre_email'=>$this->input->post('centre_email'),
			'centre_phone'=>$this->input->post('centre_phone'),
			'centre_active'=>$this->input->post('centre_active'),
		
		);
			}
		
		else {
			
			
				 if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $fileInfo = pathinfo($_FILES["file"]["name"]);
                $img_name = 'id' . $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["file"]["tmp_name"], "./uploads/centre_image/" . $img_name);
				 }
			
            $data=array(
		     'id'=>$this->input->post('id'), 
		    'centre_code'=>$this->input->post('centre_code'),
			'centre_name'=>$this->input->post('centre_name'),
			'centre_add1'=>$this->input->post('centre_add1'),
			'centre_add2'=>$this->input->post('centre_add2'),
			'centre_email'=>$this->input->post('centre_email'),
			'centre_phone'=>$this->input->post('centre_phone'),
			'centre_active'=>$this->input->post('centre_active'),
		    'centre_image'=> $img_name
		   );
        }
	  
		
		   	
         	$insert_id=$this->classsection_model->addcentre($data);
			
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Centre updated successfully</div>');
             redirect('admin/centre');
        }
    
	
	    
	
	
	}
	
	
	function delete($id) {
        if (!$this->rbac->hasPrivilege('centre', 'can_delete')) {
            access_denied();
        }
       
        $this->classsection_model->remove_centre($id);
        redirect('admin/centre');
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
   
	    
    

}


?>