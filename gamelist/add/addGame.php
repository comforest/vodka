<?php
	session_start();
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	require_once $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
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


	$query = 'Insert into game(user_id,name,note) values('.$user.',"'.$_POST["name"].'","'.$_POST["note"].'")';
	$mysqli->query($query);
	print_r($_POST);
	echo $query;
?>