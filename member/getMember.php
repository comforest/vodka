<?php
	header("Content-Type:application/json");
	session_start();

	include $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";

	$json = array();

	if($_SESSION["rank"]<=2){
		$query = "SELECT * FROM user";
	}else{
		$query = "SELECT name, gender, colleage, major,student_id,rank,location,entry FROM user";
	}
	$query .= " order by entry DESC, rank asc, name asc";
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
					case "entry":
						$value = User::EntryInttoStr($value);
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