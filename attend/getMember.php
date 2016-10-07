<?php
	header("Content-Type:application/json");
	
	session_start();

	$arr=[];
	include_once "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";
	$query = "SELECT name,student_id,major from user as t1 JOIN attend as t2 where t1.user_id = t2.user_id and t2.calendar_id=$_GET[id]";
	if($result = $mysqli->query($query)){
		while($user = $result->fetch_array(MYSQLI_ASSOC)){
		 	$arr[] = array ("name"=>$user["name"], "student_id"=>$user["student_id"], "major"=>$user["major"]);
		}
	}

	$d = isset($_SESSION["rank"]) && $_SESSION["rank"]<=2;
	$arr = array("member"=>$arr,"d"=>$d);
	echo json_encode($arr);

?>