<?php
	
	header("Content-Type:application/json");

	$Cid = $_POST["id"];
	$Uid = $_POST["user"];

	include "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";
	
	if($mysqli->query("SELECT * FROM attend WHERE calendar_id=$Cid and user_id=$Uid")->num_rows > 0) return;
	
	include "$_SERVER[DOCUMENT_ROOT]/static/php/userInfo.php";
	$mysqli->query("INSERT into attend value($Cid,$Uid)");

	$user = User::FindByID($Uid);
 	$arr = array ("name"=>$user["name"], "student_id"=>$user["student_id"], "major"=>$user["major"]);

 	$arr = array($arr);
 	echo json_encode($arr);

	
?>