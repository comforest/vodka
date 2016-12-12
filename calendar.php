<?php
/*
달력 일정 가져오기
POST year, month
*/

header("Content-Type:application/json");
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";	

$y = $_POST["year"];
$m = $_POST["month"];
$ly = $y;
$lm = $m + 1;
if($lm > 12){
	$lm = 1;
	++$ly;
}
$date = "$y-$m-1";
$ldate = "$ly-$lm-1";


$query = "SELECT calendar_id,date,text,type FROM calendar WHERE date >= '$date' and date < '$ldate' ORDER BY date ASC";
if ($result = $mysqli->query($query)) {
	$arr = [];
	while($data = $result->fetch_array(MYSQLI_NUM)){
		$arr[] = array ('id'=>$data[0], 'date' => $data[1], 'text' => $data[2], 'type' => $data[3]);
	}
	echo json_encode($arr);

    $result->close();
}

$mysqli->close();
?>