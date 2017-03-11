<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel.php";

/** PHPExcel_Writer_Excel2007 */
include $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel/Writer/Excel2007.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
// $objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
// $objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
// $objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
// $objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
// $objPHPExcel->getProperties()->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.");


// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', '이름');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', '성별');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', '학번');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', '단과대');
$objPHPExcel->getActiveSheet()->SetCellValue('E1', '전공');
$objPHPExcel->getActiveSheet()->SetCellValue('F1', '전화번호');
$objPHPExcel->getActiveSheet()->SetCellValue('G1', '활동지역');
$objPHPExcel->getActiveSheet()->SetCellValue('H1', '비고');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('양식');

		

$filename = iconv("UTF-8", "EUC-KR", "신입회원목록 양식");
 
// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

?>