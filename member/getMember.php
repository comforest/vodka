<?php
	header("Content-Type:application/json");
	session_start();

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$json = array();

	if($_SESSION["rank"]<=2){
		$query = "SELECT * FROM user";
	}else{
		$query = "SELECT name, gender, colleage, major,student_id,rank,location FROM user";
	}
	$query .= " where rank <> 0 order by rank asc, location DESC, name asc";
	if($result = $mysqli->query($query)){
		while($data = $result->fetch_array(MYSQLI_ASSOC)){
			$arr = array();
			foreach($data as $key => $value){
				if($key == "user_id" || $key == "id" || $key == "password")	continue;
				switch($key){
					case "gender":
						$value = User::GenderInttoStr($value);
						break;
					case "class":
						$value = User::AppendClass($value);
						break;
					case "rank":
						$value = User::RankInttoStr($value);
						break;
					case "fee":
						$value = User::InttoOX($value);
						break;
					case "phone":
						$value = User::AppendPhoneHypen($value);
						break;
					case "student_id":
						if($_SESSION["rank"] > 2){
							$value = User::getShortStudentID($value);
						}
						break;
					case "user_id": case "ID": case "password":
						continue;
				}
				$arr[$key] = $value;
			}
			$json[] = $arr;
		}
	}
	echo json_encode($json);
?>