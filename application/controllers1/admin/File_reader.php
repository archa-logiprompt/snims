<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_reader extends Admin_Controller {

    function __construct() {
        parent::__construct();
		//$this->load->library('Spreadsheet_Excel_Reader');
		require_once APPPATH.'third_party/excel/PHPExcel.php';
        $this->excel = new PHPExcel(); 
    }

    function index() {
		
		if (!$this->rbac->hasPrivilege('file_reader', 'can_view')) {
            access_denied();
        }
		$this->session->set_userdata('top_menu', 'Fees Collection');
        $this->session->set_userdata('sub_menu', 'file_reader');

         $class = $this->class_model->get();
         $data['classlist'] = $class;
		
		  $class_id=$this->input->post('class_id');
		  $section_id=$this->input->post('section_id');

		
		 $this->form_validation->set_rules('class_id', 'Course', 'required|trim|xss_clean');
			 $this->form_validation->set_rules('section_id', 'Section', 'required|trim|xss_clean');
			
			if ($this->form_validation->run() == false) 
            {
				
		   
			}
			
			else
			{

        if (isset($_FILES["documents"]) && !empty($_FILES['documents']['name'])) {
		   $file_info = pathinfo($_FILES["documents"]["name"]);
           $file_directory = 'uploads/school_income/';
           $new_file_name =rand(000000, 999999) .".". $file_info["extension"];

    if(move_uploaded_file($_FILES["documents"]["tmp_name"], $file_directory.$new_file_name))
       {   
    $file_type	= PHPExcel_IOFactory::identify($file_directory .$new_file_name);
    $objReader	= PHPExcel_IOFactory::createReader($file_type);
     $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($file_directory . $new_file_name);
    $sheet_data	= $objPHPExcel->getActiveSheet();
     $header=true;
      if ($header) {
        $highestRow = $sheet_data->getHighestRow();
        $highestColumn = $sheet_data->getHighestColumn();
        $headingsArray = $sheet_data->rangeToArray('A1:' . $highestColumn . '1', null, true, true, true);
        $headingsArray = $headingsArray[1];
        $r = -1;
        $namedDataArray = array();
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $sheet_data->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach ($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                }
            }
        }
    }
    else {
        //excel sheet with no header
        $namedDataArray = $sheet_data->toArray(null, true, true, true);
    }
     
     


     foreach($namedDataArray as $data)
    {
         

             $this->file_reader_model->postDiamond($data,$class_id,$section_id);


       
     /*if (array_search($data['Admission Number'], $no) !== false  && array_search($data['Date'], $date) !== false) {
        
          //array_push($t,$data);
         
         $this->file_reader_model->posttotalfee($data,$class_id,$section_id,$invoice);

   
      } else {

        $this->file_reader_model->postDiamond($data,$class_id,$section_id);
      	//
       //array_push($outPutArray,$data);
       $no[] = $data['Admission Number'];
       $date[]=$data['Date'];
    
         }*/

        
         }
        
          redirect('admin/file_reader');
        
          }
           }

           }
		
		 $this->load->view('layout/header',$data);
         $this->load->view('admin/file_reader/file_reader',$data);
         $this->load->view('layout/footer',$data);
		
		
	}
		
	
	
			
        }
		
		

?>