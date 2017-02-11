<?php
	session_start();

	define("SUCCESS",1);
	define("MYSQL_ERROR",2);
	define("SESSION_MISSING",3);

	if(!isset($_SESSION["register"])){
		echo SESSION_MISSING;
		exit;
	}

	include_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "UPDATE user set id = '$_POST[id]', password = '$_POST[pw]',nickname = '$_POST[nick]' where user_id = $_SESSION[register]";
	if($mysqli -> query($query)){
		echo SUCCESS;
	}else{
		echo MYSQL_ERROR;
	}

	session_destroy();
?>