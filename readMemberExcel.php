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

	require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";	
	require_once $_SERVER["DOCUMENT_ROOT"]."/function/userInfo.php";

	$arr = array();
	for ($i = 2 ; $i <= $maxRow ; $i++) { // 두번째 행부터 읽는다
		for($j = 0; getCoulmnIndex($j) != $maxCol; $j ++){
			$c = getCoulmnIndex($j);
			$head = (string)$sheet->getCell($c."1")->getValue();
			if(isset($field[$head])){
				$f = $field[$head];
				$str = getCoulmnValue($sheet, $c.$i);
				switch($head){
					case "성별":
						$arr[$i-2][$f] = User::GenderStrtoInt($str);
						break;
					case "기수":
						$arr[$i-2][$f] = substr($str,0,strlen($str)-3);
						break;
					case "등급":
						$arr[$i-2][$f] = User::RankStrtoInt($str);
						break;
					case "활동 여부":
						$arr[$i-2][$f] = User::EntryStrtoInt($str);
						break;
					case "전화번호":
						$arr[$i-2][$f] = str_replace("-", "", $str);
						break;
					default:
						$arr[$i-2][$f] = $str;
						break;
				}
			}
		}
	}
	for($i = 0; $i < count($arr); ++$i){

		$query = "";
		$user = User::FindByStudentID($arr[$i]["student_id"]);
		if(count($user) > 0){
			$query = "UPDATE user SET ";
			$queryStr = "";
			foreach($arr[$i] as $k => $v){
				$queryStr .= ",".$k."=";
				switch($k){
					case "gender": case "class": case "rank": case "entry":
						$queryStr .= $v;
						break;
					default:
						$queryStr .= "\"".$v."\"";
						break;
				}
			}
			$queryStr = substr($queryStr,1,strlen($queryStr));
			$query .= $queryStr." WHERE user_id = ".$user["user_id"];
			echo $query."<br>";
		}else if(count($user) == 0){
			$query="INSERT into user(ID,password,".$queryStr.") values(\"".$arr[$i]["student_id"]."\",\"".$arr[$i]["student_id"]."\",".$queryStr2.")";
			$queryStr;
			$queryStr2;
			foreach($arr[$i] as $k => $v){
				$queryStr .= ",".$k;
				switch($k){
					case "gender": case "class": case "rank": case "entry":
						$queryStr .= ",".$v;
						break;
					default:
						$queryStr .= ",\"".$v."\"";
						break;
				}
			}
			$queryStr = substr($queryStr,1,strlen($queryStr));
			$queryStr2 = substr($queryStr2,1,strlen($queryStr2));
		}

		$mysqli->query($query);
	}






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