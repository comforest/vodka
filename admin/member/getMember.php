<?php
	header("Content-Type:application/json");
	
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$json = array();

	$query = "SELECT t1.user_id, name, student_id, major, location, rank, count(t2.user_id) as totalAttend from user as t1 left join attend as t2 on t1.user_id = t2.user_id where t1.rank <> 0 group by user_id order by location asc, rank asc, totalAttend desc";
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
				}
				$arr[$key] = $value;
			}
			$json[] = $arr;
		}
	}else{
		json_encode(array("status"=>"Error"));
	}
	echo json_encode($json);
?>