<?php
	session_start();

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "SELECT * FROM user Where id =\"".$_POST["id"]."\" and password = \"".$_POST["pass"]."\"";
	if($result = $mysqli->query($query)){
		if($data = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['user'] = $data['user_id'];
			$_SESSION['rank'] = $data['rank'];
			header('Location: '. $_POST["url"]);
		}else{
			//TODO 로그인 실패
		}
	}
?>