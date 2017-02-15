<?php
	session_start();
	if(!isset($_SESSION["rank"]) || $_SESSION["rank"] > 2)
		// exit;
		;

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$arr = $_POST["list"];

	foreach ($arr as $key => $value) {
		$query = "UPDATE user set location='$_POST[location]' where user_id = $value";
		if($result = $mysqli->query($query)){
			
		}
	}

?>