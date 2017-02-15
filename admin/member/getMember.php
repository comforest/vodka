<?php
	header("Content-Type:application/json");
	
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$json = array();

	$query = "SELECT user_id, name, student_id, major, location, rank from user where rank <> 0";
	if($result = $mysqli->query($query)){
		while($data = $result->fetch_array(MYSQLI_ASSOC)){
			$arr = array();
			foreach($data as $key => $value){
				switch($key){
					case "student_id":
						$value = User::getShortStudentID($value);
						break;
					case "class":
						$value = User::AppendClass($value);
						break;
					case "rank":
						$value = User::RankInttoStr($value);
						break;
				}
				$arr[$key] = $value;
			}
			$json[] = $arr;
		}
	}
	echo json_encode($json);
?>