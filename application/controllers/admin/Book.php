<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Book extends Admin_Controller {

    function __construct() {
        parent::__construct();
		require_once APPPATH.'third_party/excel/PHPExcel.php';
        $this->excel = new PHPExcel(); 
        $this->load->model("file_reader_model");
    }

    public function index() {
        if (!$this->rbac->hasPrivilege('books', 'can_view')) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $listbook = $this->book_model->listbook();
        $data['listbook'] = $listbook;
        $this->load->view('layout/header');
        $this->load->view('admin/book/createbook', $data);
        $this->load->view('layout/footer');

    }

    public function getall() {
        if (!$this->rbac->hasPrivilege('books', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/getall');
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $listbook = $this->book_model->getBookwithQty();
        $data['listbook'] = $listbook;

        $this->load->view('layout/header');
        $this->load->view('admin/book/getall', $data);
        $this->load->view('layout/footer');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('books', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        $this->form_validation->set_rules('book_title', 'Book Title', 'required|is_unique[books.book_title]');

        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/header');
            $this->load->view('admin/book/createbook', $data);
            $this->load->view('layout/footer');
        } else {
            $admin=$this->session->userdata('admin');
            $data = array(
                'centre_id'=>$admin['centre_id'],
                'book_title' => $this->input->post('book_title'),
                'book_no' => $this->input->post('book_no'),
                'isbn_no' => $this->input->post('isbn_no'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => $this->input->post('postdate')?date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))):date('Y-m-d'),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Book added successfully</div>');
            redirect('admin/book/index');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('books', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Book';
        $data['title_list'] = 'Book Details';
        $data['id'] = $id;
        $editbook = $this->book_model->get($id);
        $data['editbook'] = $editbook;
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/header');
            $this->load->view('admin/book/editbook', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'book_title' => $this->input->post('book_title'),
                'book_no' => $this->input->post('book_no'),
                'isbn_no' => $this->input->post('isbn_no'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Book updated successfully</div>');
            redirect('admin/book/index');
        }
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('books', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->book_model->remove($id);
        redirect('admin/book/getall');
    }

       public function getAvailQuantity() {

        $book_id = $this->input->post('book_id');
        $available=0;
        if ($book_id != "") {
            $result=$this->bookissue_model->getAvailQuantity($book_id);
            $available=$result->qty-$result->total_issue;
        }
        $result_final = array('status' => '1', 'qty' => $available);
        echo json_encode($result_final);
    }
	
	
	
	public function file_import()
	{
	if (!$this->rbac->hasPrivilege('books', 'can_add')) {
            access_denied();
        }	
		$this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/file_import');
		
		 $this->load->view('layout/header',$data);
         $this->load->view('admin/book/file_reader',$data);
         $this->load->view('layout/footer',$data);
		 }
	
	
	 public function read_file()
	 {
		 
		 if (!$this->rbac->hasPrivilege('books', 'can_add')) {
            access_denied();
        }
		 
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
         

             $this->file_reader_model->add_book($data);


       
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
         
          redirect('admin/book/file_import');
        
          }
        }
	
	
	
	
	
	
	

}

?>