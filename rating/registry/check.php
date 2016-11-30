<?php
	session_start();
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$nickname = $_POST["nickname"];
	if($result=$mysqli->query("SELECT user_id from user where nickname=$nickname")){
		if($result->num_rows == 0){
			$mysqli->query("UPDATE user set nickname='$nickname' where user_id = $_SESSION[user]");
			return true;
		}else{
			return false;
		}
	}
	return -1;

?>