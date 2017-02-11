<?php

	session_start();
	define("SUCCESS",1);
	define("ALREADY_EXIST",2);
	define("NONE_EXIST",3);

	include_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "SELECT user_id, id from user where name='$_POST[name]' and student_id = '$_POST[studentID]' and phone = '$_POST[phone]'";

	if($result = $mysqli->query($query)){
		if($data = $result->fetch_array(MYSQLI_ASSOC)){
			if($data["id"] == "" || $data["id"] == NULL){
				echo SUCCESS;
				$_SESSION["register"] = $data["user_id"];
				exit;
			}else{
				echo ALREADY_EXIST;
				exit;
			}
		}
	}
	echo NONE_EXIST;
?>