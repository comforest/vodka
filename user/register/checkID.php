<?php

	define("SUCCESS",1);
	define("ALREADY_EXIST",2);

	include_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "SELECT id from user where id='$_POST[id]'";

	if($result = $mysqli->query($query)){
		if($result->num_rows > 0){
			echo ALREADY_EXIST;
			exit;
		}
	}
	echo SUCCESS;
?>