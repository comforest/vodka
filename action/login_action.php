<?php
	session_start();
	
	if($_POST["id"] == "" || $_POST["pass"] == ""){

		echo false;
		return;
	}
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$pass = $_POST["pass"];
	// $pass = hash('sha256',$_POST["pass"])
	$query = "SELECT * FROM user Where id =\"$_POST[id]\" and password = \"$pass\"";
	if($result = $mysqli->query($query)){
		if($data = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['user'] = $data['user_id'];
			$_SESSION['rank'] = $data['rank'];
			echo "$data[name]($data[nickname])";
			// header('Location: '. $_POST["url"]);
		}else{
			//TODO 로그인 실패
			echo false;
		}
	}
?>