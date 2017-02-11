<?php
	session_start();


	if($_POST["id"] == "" || $_POST["pass"] == ""){

		echo false;
		return;
	}
	include_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$pass = $_POST["pass"];
	// $pass = hash('sha256',$_POST["pass"])
	$query = "SELECT * FROM user Where id =\"$_POST[id]\" and password = \"$pass\"";
	if($result = $mysqli->query($query)){
		if($data = $result->fetch_array(MYSQLI_ASSOC)){
			$_SESSION['user'] = $data['user_id'];
			$_SESSION['rank'] = $data['rank'];

			if($_POST["auto"]){
				setcookie("userID",$_POST["id"],time()+3600*24*180,"/");
				setcookie("userPW",$_POST["pass"],time()+3600*24*180,"/");
			}else{
				setcookie("userID","",0);
				setcookie("userPW","",0);				
			}
			echo true;
		}else{
			//TODO 로그인 실패
			echo false;
		}
	}
?>