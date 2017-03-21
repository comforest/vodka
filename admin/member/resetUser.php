<?php
	session_start();
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/checkLogin.php";
	header("Content-Type:application/json");

	$json = [];
	if(!checkAdmin()){
		notAdminJson();
	}

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$arr = $_POST["list"];

	foreach ($arr as $key => $value) {
		$query = "UPDATE user set location='$_POST[location]' where user_id = $value and rank > $_SESSION[rank]";
		if($result = $mysqli->query($query)){
			$json[] = $value;
		}
	}

	$json = array("status"=>"success","message"=>$json);
	echo json_encode($json);

?>