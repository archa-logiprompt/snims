<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Excel_export extends Admin_Controller {

    function __construct() {
        parent::__construct();
		//$this->load->library('Spreadsheet_Excel_Reader');
		require_once APPPATH.'third_party/excel/PHPExcel.php';
		require_once APPPATH.'third_party/excel/PHPExcel/IOFactory.php';
        $this->excel = new PHPExcel(); 
    }

    function index() {
		
		$date_from=$this->input->post('date_from');
		$date_to=$this->input->post('date_to');
		$income_head=$this->input->post('income_head');
		$resultList = $this->income_model->search("", $date_from, $date_to,$income_head);
       
		
		
		
	$file_directory = 'uploads/school_income/';
   $new_file_name =rand(000000, 999999) .".". $file_info["extension"];
   /*$objPHPExcel = $objReader->load($file_directory . $new_file_name);*/

 $this->excel->setActiveSheetIndex(0);
  $table_columns = array("Slno","Bill No", "Bill Date\n","Fees Head","Description","Name","Fee Amount(₹)","Cancelled\n Bill no"," Cancelled\nBill Date"," Cancelled\nAmount");
  
    $collegename=strtoupper($this->setting_model->getCurrentSchoolName()); 
     $heading="Collection Report From ".$date_from." to ".$date_to;
	 
	//$this->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(35);
      //$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
	  $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	  //$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	  $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	  $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	  $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	  
	 
	  
      $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('2')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('3')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('4')->getFont()->setBold(true);
	  //$this->excel->getActiveSheet()->getStyle('6')->getFont()->setBold(true);
	  
	  $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(16);
	  $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);

   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, 1, $collegename );
   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, $heading);
   
 $column = 0;

  foreach($table_columns as $field)
  {
    $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
	 $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setWrapText(true);
	 $this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setWrapText(true);
	 $this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setWrapText(true);
	 
   $column++;
  }
  
  
   $excel_row = 5;
     
	$count = 1;
	$total=0;
	$deleted_amount=0;
	  
    foreach ($resultList as $key => $value) {
		$total=$total+$value['amount'];
  $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $this->excel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
  
  
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,$count );
  
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,$value['invoice_no']);
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,$value['date'] );
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,$value['name'] );
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,$value['mode'].'  '.$value['description'] ); 
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,$value['person_name']);
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,$value['amount']);
  
	 
	 if($value['is_cancelled']==1) { $deleted_amount=$deleted_amount+$value['amount'];
	 
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,$value['invoice_no']);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,$value['cancelled_date']);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$value['amount']);
	 }
	 else
	 {
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,'');
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,'');
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,''); 
		 
		 }
	  
	   $count ++;
       $excel_row++;
	    }                          
	
   $excel_row=$excel_row+1;
	$this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,"Total" );
	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total );
	
	 $excel_row=$excel_row+1;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Collection :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
	 $excel_row=$excel_row+1;
	 
	 $total_collection=$total-$deleted_amount;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Deleted Amount :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$deleted_amount);
	 $excel_row=$excel_row+1;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Total Collection :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total_collection);
	  $excel_row=$excel_row+1;
	  $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Refund");
	   $excel_row=$excel_row+1;
	   $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Cash in Hand :");
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
		
		
		$excel_row=$excel_row+2;
	   $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,"Grand Total:");
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
		

  $object_writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Collection Report.xls"');
  $object_writer->save('php://output');
 		
	}
	
	
	
	function mess_excel() {
		
		$date_from=$this->input->post('date_from');
		$date_to=$this->input->post('date_to');
		$income_head=$this->input->post('income_head');
		$resultList = $this->income_model->mess_collection_report($date_from, $date_to,$incomehead);
       
		
		
		
	$file_directory = 'uploads/school_income/';
   $new_file_name =rand(000000, 999999) .".". $file_info["extension"];
   /*$objPHPExcel = $objReader->load($file_directory . $new_file_name);*/

 $this->excel->setActiveSheetIndex(0);
  $table_columns = array("Slno","Bill No", "Bill Date\n","Fees Head","Description","Name","Fee Amount(₹)","Cancelled\n Bill no"," Cancelled\nBill Date"," Cancelled\nAmount");
  
    $collegename=strtoupper($this->setting_model->getCurrentSchoolName());
	$report="Mess Collection Report"; 
     $heading="Collection Report From ".$date_from." to ".$date_to;
	 
	//$this->excel->getActiveSheet()->getRowDimension('6')->setRowHeight(35);
      //$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
	  $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
	  //$this->excel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	  $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
	  $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
	  $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
	  $this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
	  
	 
	  
      $this->excel->getActiveSheet()->getStyle('1')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('2')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('3')->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->getStyle('4')->getFont()->setBold(true);
	  //$this->excel->getActiveSheet()->getStyle('6')->getFont()->setBold(true);
	  
	  $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(16);
	  $this->excel->getActiveSheet()->getStyle('A3')->getFont()->setSize(12);
	   $this->excel->getActiveSheet()->getStyle('E2')->getFont()->setSize(14);

   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 1, $collegename );
   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, 2, $report);
   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, 3, $heading);
   
 $column = 0;

  foreach($table_columns as $field)
  {
     $this->excel->getActiveSheet()->setCellValueByColumnAndRow($column, 4, $field);
	 $this->excel->getActiveSheet()->getStyle('I4')->getAlignment()->setWrapText(true);
	 $this->excel->getActiveSheet()->getStyle('H4')->getAlignment()->setWrapText(true);
	 $this->excel->getActiveSheet()->getStyle('J4')->getAlignment()->setWrapText(true);
	 
   $column++;
  }
  
  
   $excel_row = 5;
     
	$count = 1;
	$total=0;
	$deleted_amount=0;
	  
    foreach ($resultList as $key => $value) {
		$total=$total+$value['amount'];
  $this->excel->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $this->excel->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $this->excel->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $this->excel->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
	$this->excel->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);
  
  
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,$count );
  
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,$value['invoice_no']);
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,$value['date'] );
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row,$value['name'] );
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,$value['mode'].'  '.$value['description'] ); 
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,$value['person_name']);
  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row,$value['amount']);
  
	 
	 if($value['is_cancelled']==1) { $deleted_amount=$deleted_amount+$value['amount'];
	 
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,$value['invoice_no']);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,$value['cancelled_date']);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$value['amount']);
	 }
	 else
	 {
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,'');
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,'');
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,''); 
		 
		 }
	  
	   $count ++;
       $excel_row++;
	    }                          
	
   $excel_row=$excel_row+1;
	$this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,"Total" );
	$this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total );
	
	 $excel_row=$excel_row+1;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Collection :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
	 $excel_row=$excel_row+1;
	 
	 $total_collection=$total-$deleted_amount;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Deleted Amount :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$deleted_amount);
	 $excel_row=$excel_row+1;
	 $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Total Collection :");
	 $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total_collection);
	  $excel_row=$excel_row+1;
	  $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	  $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Refund");
	   $excel_row=$excel_row+1;
	   $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row,"Cash in Hand :");
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
		
		
		$excel_row=$excel_row+2;
	   $this->excel->getActiveSheet()->getStyle($excel_row)->getFont()->setBold(true);
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row,"Grand Total:");
	   $this->excel->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total);
		

  $object_writer = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
  header('Content-Type: application/vnd.ms-excel');
  header('Content-Disposition: attachment;filename="Collection Report.xls"');
  $object_writer->save('php://output');
 		
	}
		
	
	
	
	
	
	
	
		
}

?>