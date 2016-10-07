<?php
	$Cid = $_POST["id"];
	$Uid = $_POST["user"];
	include "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";
	
	if($mysqli->query("SELECT * FROM attend WHERE calendar_id=$Cid and user_id=$Uid")->num_rows > 0) return;
	$mysqli->query("INSERT into attend value($Cid,$Uid)");
	print_r($_POST);
?>