<?php
	session_start();
	$id = "admin";
	$pass = "1234";
	if(strcmp($id,$_POST["id"]) == 0 && strcmp($pass, $_POST["pass"]) == 0){
		$_SESSION['user'] = $id;
		header('Location: '. $_POST["url"]);
		echo $_POST["url"];
	}else{
		echo $_POST["id"];
		echo $_POST["pass"];
	}
?>