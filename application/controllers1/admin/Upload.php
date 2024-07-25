<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends Admin_Controller {

    function __construct() {
        parent::__construct();
		//$this->load->library('Spreadsheet_Excel_Reader');
		
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('upload', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'upload');
		
		$list=$this->studentfeemaster_model->get_fees_upload();
		$data['list']=$list;
		
		
		 $this->form_validation->set_rules('name', 'Name', 'required|trim|xss_clean');
			 $this->form_validation->set_rules('date', 'Date', 'required|trim|xss_clean');
			
			if ($this->form_validation->run() == false) {
				
		   
				}
			
			else
			{
			$admin=$this->session->userdata('admin');
			$data=array(
			'centre_id'=>$admin['centre_id'],
			'name'=>$this->input->post('name'),
			'date'=>date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('date'))),
			
			);
			
			$insert_id=$this->studentfeemaster_model->upload_file($data);
			
			
			
			 if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
                $fileInfo = pathinfo($_FILES["documents"]["name"]);
                $img_name = $insert_id . '.' . $fileInfo['extension'];
                move_uploaded_file($_FILES["documents"]["tmp_name"], "./uploads/school_income/" . $img_name);
                $data_img = array('id' => $insert_id, 'file' => 'uploads/school_income/' . $img_name);
                $this->studentfeemaster_model->upload_file($data_img);
            }
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">  File Uploaded </div>');
			$file = base_url().'uploads/school_income/' . $img_name;
			$handle = fopen($file, "r");
			$filesop = fgetcsv($handle, 1000, ",");
			   //redirect('admin/upload');
			  /* $inputFileName = base_url().'uploads/school_income/' . $img_name;
			   require_once  "application\third_party\PHPExcel.php";
			    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			  $excel = new Spreadsheet_Excel_Reader();

		
		$excel->read(base_url().'uploads/school_income/' . $img_name); // set the excel file name here   

		$data['data_excell']=$excel->sheets[0]['cells'];*/

         var_dump($filesop[0]);
        //$this->load->view('excell',$data); 
			   
			}
		
		
		
		 $this->load->view('layout/header',$data);
         $this->load->view('admin/fees_upload/fees_upload',$data);
         $this->load->view('layout/footer',$data);
		
		
		
		
	}
		
	public function download($documents) {
        $this->load->helper('download');
        $filepath = "./uploads/school_income/" . $this->uri->segment(6);
        $data = file_get_contents($filepath);
        $name = $this->uri->segment(6);
        force_download($name, $data);
    }




			
	function delete($id) {
        if (!$this->rbac->hasPrivilege('upload', 'can_delete')) {
            access_denied();
        }
        
        $this->studentfeemaster_model->delete_fees_upload($id);
        redirect('admin/upload');
    }

	
	
			
			
			
        }
		
		

?>