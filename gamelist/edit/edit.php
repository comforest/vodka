<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	

	$query = "UPDATE game set name='$_POST[name]', note='$_POST[note]' WHERE game_id=$_POST[id]";
	print_r($_POST);
	echo $query;
	$mysqli->query($query);
?> 	