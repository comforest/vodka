<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	$query = 'Insert into game(user_id,name,note) values('.$_SESSION["user"].',"'.$_POST["name"].'","'.$_POST["note"].'")';
	$mysqli->query($query);
	print_r($_POST);
	echo $query;
?>