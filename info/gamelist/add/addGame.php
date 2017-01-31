<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	$user;
	switch ($_POST["user"]) {
		case 'my':
			$user = $_SESSION["user"];
			break;
		case 'admin':
			$user = User::GetAdmin()["user_id"];
			break;
		default:
			$user = $_POST["user"];
			break;
	}


	$query = "Insert into game(user_id,name,note,difficulty) values($user,'$_POST[name]','$_POST[note]',$_POST[difficulty])";
	$mysqli->query($query);
	print_r($_POST);
	echo $query;
?>