<?php
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel.php";

/** PHPExcel_Writer_Excel2007 */
include $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel/Writer/Excel2007.php";
include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

$head = [];
setting("name","이름");
setting("gender","성별");
setting("student_id","학번");
setting("colleage","단과대");
setting("major","전공");
setting("phone","전화번호");
setting("location","활동지역");
setting("class","기수");
setting("rank","등급");
setting("note","비고");
// Add some data
$objPHPExcel->setActiveSheetIndex(0);
$sheet = $objPHPExcel->getActiveSheet();

$s = "";
foreach($head as $k => $v){
	$c = getCoulmnIndex($k);
	$sheet->SetCellValue($c.'1', $v["korean"]);
	$s .= ",".$v["english"];
	$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setAutoSize(false);
	$objPHPExcel->getActiveSheet()->getColumnDimension($c)->setWidth("17");
}

$s = substr($s, 1);

$index = 2;
if($result = $mysqli->query("SELECT $s from user where rank > 0")){
	while($data = $result->fetch_array(MYSQLI_ASSOC)){
		foreach ($head as $k => $v) {
			$c = getCoulmnIndex($k).$index;
			$d = $data[$v["english"]];
			switch ($v["english"]) {
				case 'gender':
					$d = USER::GenderInttoStr($d);
					break;
				case 'rank':
					$d = USER::RankInttoStr($d);
					break;
				case 'class':
					$d = USER::AppendClass($d);
					break;
				case 'phone':
					$d = USER::AppendPhoneHypen($d);
					break;
			}
			$sheet->SetCellValue($c,$d);
		}
		++$index;
	}
}



// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('회원목록');

		

$filename = iconv("UTF-8", "EUC-KR", "회원목록");
 
//Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');




function setting($eng,$kor){
	global $head;
	$head[] = array("english"=>$eng,"korean"=>$kor);
}

/*	getCoulmnIndex
*	purpose : x번째 => 엑셀 형식(AB)로 변경
*	param : $i - i번째
*	return : 엑셀 형식 Coulmn
*/
function getCoulmnIndex($i){
	$str = "";
	if($i > 25){
		$str = $str.getCoulmnIndex($i/26-1);
	}
	$str = $str.chr($i%26+65);

	return $str;
}
?>