<?php
	$Cid = $_POST["id"];
	$Uid = $_POST["user"];
	include "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";
	
	$mysqli->query("DELETE t1 FROM attend t1 JOIN user t2 Where t1.user_id = t2.user_id and t1.calendar_id=$Cid and t2.student_id='$Uid'");

?>