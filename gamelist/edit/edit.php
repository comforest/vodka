<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	

	$query = "UPDATE game set name='$_POST[name]', note='$_POST[note]', difficulty='$_POST[difficulty]' WHERE game_id=$_POST[id]";
	print_r($_POST);
	echo $query;
	$mysqli->query($query);
?> 	