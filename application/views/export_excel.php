<?php
// Load the PhpSpreadsheet library if not autoloaded
// require_once(APPPATH . 'third_party/PhpSpreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet
$spreadsheet = new Spreadsheet();

// Create a new worksheet
$worksheet = $spreadsheet->getActiveSheet();

// Set the worksheet title
$worksheet->setTitle('Monthly Academic Report');

// Add data to the worksheet (you can replace this with your actual data)
$worksheet->setCellValue('A1', 'Date');
$worksheet->setCellValue('B1', 'Week 1');
$worksheet->setCellValue('C1', 'Week 2');
$worksheet->setCellValue('D1', 'Week 3');
// ... Add more columns and data as needed

// Set column widths (optional)
$worksheet->getColumnDimension('A')->setWidth(15);
$worksheet->getColumnDimension('B')->setWidth(15);
$worksheet->getColumnDimension('C')->setWidth(15);
$worksheet->getColumnDimension('D')->setWidth(15);
// ... Set widths for other columns as needed

// Create a writer
$writer = new Xlsx($spreadsheet);

// Set response headers for downloading the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="academic_report.xlsx"');
header('Cache-Control: max-age=0');

// Write the Excel file to the output
$writer->save('php://output');

// Exit to prevent further output
exit;
