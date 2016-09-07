<?php
	session_start();

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "SELECT * FROM user Where name =\"".$_POST["name"]."\" and student_id = \"".$_POST["student"]."\"";
	if($result = $mysqli->query($query)){
		if($data = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['user'] = $data['user_id'];
			$_SESSION['rank'] = $data['rank'];
			header('Location: /survey');
		}else{
			//TODO 로그인 실패
		}
	}
?>