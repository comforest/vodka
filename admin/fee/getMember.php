<?php
	header("Content-Type:application/json");
	
	include $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";

	$json = array();

	$query = "SELECT user_id, name, location, class, fee FROM user where location <> '' Order by class desc, name asc";
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