<?php

require_once $_SERVER["DOCUMENT_ROOT"]."/Classes/PHPExcel.php";
// 셀서식 날짜로 되어있을때 읽는방법
// echo PHPExcel_Style_NumberFormat::toFormattedString($photo_date, PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);
try {
	$filename = 'excel.xlsx';	
	$excelReader = PHPExcel_IOFactory::createReaderForFile($filename);
	$excelReader->setReadDataOnly(true);
	$excel = $excelReader->load($filename);
	$excel->setActiveSheetIndex(0);
	$sheet = $excel->getActiveSheet();

	$maxRow = $sheet->getHighestRow();
	$maxCol = $sheet-> getHighestColumn();

	$field = array();
	$field["name"] = "이름";
	$field["gender"] = "성별";
	$field["student_id"] = "학번";
	$field["colleage"] = "단과대";
	$field["major"] = "전공";
	$field["phone"] = "전화번호";
	$field["location"] = "활동지역";
	$field["class"] = "기수";
	$field["rank"] = "등급";
	$field["entry"] = "활동 여부";

	$field = array_flip($field);


	$queryStr = "";
	$tdarr = [];
	for($i = 0; getCoulmnIndex($i) != $maxCol; ++$i){
		$th = $sheet->getCell(getCoulmnIndex($i)."1");
		$th = (string)$th;
		if(isset($field[$th])){
			$tdarr[] = getCoulmnIndex($i);
			$queryStr.= ",". $field[$th];
		}
	}
	$queryStr = substr($queryStr, 1);

	require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";	

	for ($i = 2 ; $i <= $maxRow ; $i++) { // 두번째 행부터 읽는다
		$queryStr2 = "";
		foreach($tdarr as $c){
			$str = getCoulmnValue($sheet, $c.$i);
			$id;
			switch($sheet->getCell($c."1")->getValue()){
				case "성별":
					if($str=="남자"){
						$str = 1;
					}else if($str == "여자"){
						$str = 0;
					}
					break;
				case "기수":
					$str = substr($str,0,strlen($str)-3);
					break;
				case "등급":
					$str = changeRank($str);
					break;
				case "학번":
					$id = $str;
					$str = "\"".$str."\"";
					break;
				case "활동 여부":
					if($str == "O"){
						$str = 1;
					}else{
						$str = 0;
					}
					break;
				case "전화번호":
					$str = str_replace("-", "", $str);
				default:
					$str = "\"".$str."\"";
					break;
			}
			$queryStr2 .= ",".$str;
		} 
		$queryStr2 = substr($queryStr2, 1);
		$query="Insert into user(ID,password,".$queryStr.") values(\"".$id."\",\"".$id."\",".$queryStr2.")";
		echo $query."<br>";
		$mysqli->query($query);
	}

	// if($result = $mysql->query($query)){

	// }





	// Iterator 이용
	// $rowIterator = $objWorksheet->getRowIterator();
	// foreach ($rowIterator as $row) { // 모든 행에 대해서
	// 	echo "<tr>";
	// 	$cellIterator = $row->getCellIterator();
	// 	$cellIterator->setIterateOnlyExistingCells(false); 
	// 	foreach ($cellIterator as $cell) { // 해당 열의 모든 셀에 대해서
	// 		echo "<td>",$cell->getValue(),"</td>";//iconv("EUC-KR", "UTF-8",$cell->getValue()), "</td>";
	// 	}
	// 	echo "<tr>";
	// }



}catch (exception $e) {
    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
    echo $e;
}

function getCoulmnValue($sheet, $s){
	$cell = $sheet->getCell($s);
	$str = $cell->getValue();
	if(substr($str,0,1) == "="){
		return $cell->getOldCalculatedValue();
	}
	return $str;
}


/*	changeRank
*	purpose : 숫자 => 보드카 등급
*/
function changeRank($s){
	switch ($s) {
	case "해":
		return 1;			
	case "달";
		return 2;
	case "별";
		return 3;
	case "구름";
		return 4;
	}
	return 5;
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