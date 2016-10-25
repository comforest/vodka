<?php
	header("Content-Type:application/json");
	
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$json = array();

	$query = "SELECT a.user_id, name, location, class, b.fee from user a inner join fee b where a.user_id = b.user_id";
	if($result = $mysqli->query($query)){
		while($data = $result->fetch_array(MYSQLI_ASSOC)){
			$arr = array();
			foreach($data as $key => $value){
				switch($key){
					case "class":
						$value = User::AppendClass($value);
						break;
				}
				$arr[$key] = $value;
			}
			$json[] = $arr;
		}
	}
	echo json_encode($json);
?>