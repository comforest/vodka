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
		$query = "UPDATE user set id=null, password=null,hash_salt=null where user_id = $value and (rank > $_SESSION[rank] or user_id = $_SESSION[user]) ";
		if($result = $mysqli->query($query)){
			$json[] = $value;
		}
	}

	$json = array("status"=>"success","message"=>$json);
	echo json_encode($json);

?>