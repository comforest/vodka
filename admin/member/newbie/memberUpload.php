<?php
session_start();
if($_SESSION["rank"] > 2){
	echo "<script>
	alert(\"접근 권한이 없습니다..\");
	location.href = \"/\";
	</script>";
}

if(($_FILES['userfile']['error'] > 0) || ($_FILES['userfile']['size'] <= 0)){
	echo "파일 업로드에 실패하였습니다."; 
	exit;
}

if($_FILES['userfile']['type'] != "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"){
	echo "파일이 엑셀 형식이 아닙니다.";
	exit;
}


require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/PHPExcel.php";
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";	
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";


try {
	$filename = $_FILES['userfile']['tmp_name'];	
	$excelReader = PHPExcel_IOFactory::createReaderForFile($filename);
	$excelReader->setReadDataOnly(true);
	$excel = $excelReader->load($filename);
	$excel->setActiveSheetIndex(0);
	$sheet = $excel->getActiveSheet();

	$maxRow = $sheet->getHighestRow();
	$maxCol = $sheet-> getHighestColumn();

	$field = array();
	$field["이름"] = "name";
	$field["성별"] = "gender";
	$field["학번"] = "student_id";
	$field["단과대"] = "colleage";
	$field["전공"] = "major";
	$field["학과"] = "major";
	$field["전화번호"] = "phone";
	$field["활동지역"] = "location";
	$field["비고"] = "note";


	$arr = [];
	$index = 0;
	for ($i = 2 ; $i <= $maxRow ; $i++) { // 두번째 행부터 읽는다
		$ch = true;
		for($j = 0; getCoulmnIndex($j) != $maxCol; $j ++){
			if(!$ch) continue;
			$c = getCoulmnIndex($j);
			$head = (string)$sheet->getCell($c."1")->getValue();
			if(isset($field[str_replace(" ","",$head)])){
				$f = $field[$head];
				$str = getCoulmnValue($sheet, $c.$i);
				if($head == "이름" || $head == "성별"){
					if($str == "" || $str == null){
						$ch = false;
						continue;
					}
				}
				
				switch($head){
					case "성별":
						$arr[$index][$f] = User::GenderStrtoInt($str);
						break;
					case "전화번호":
						$arr[$index][$f] = User::RemovePhoneHypen($str);
						break;
					default:
						$arr[$index][$f] = $str;
						break;
				}
			}
		}
		if($ch)	++$index;
	}

	print_r($arr);

	$class = User::GetRecentClass();

	foreach($arr as $u){
		$queryStr = "";
		$queryStr2 = "";
		foreach($u as $k => $v){
			$queryStr .= ",".$k;
			switch($k){
				case "gender":
					$queryStr2 .= ",$v";
					break;
				default:
					$queryStr2 .= ",\"$v\"";
					break;
			}
		}
		$queryStr = substr($queryStr,1,strlen($queryStr));
		$queryStr2 = substr($queryStr2,1,strlen($queryStr2));
		$query="INSERT into user(ID,password,class,rank,$queryStr) values(\"$u[student_id]\",\"$u[student_id].\",$class,4,$queryStr2)";
		
		$mysqli->query($query);
		echo $query."<br>";
	}

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