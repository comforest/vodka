<?php
	session_start();

	define("SUCCESS",1);
	define("MYSQL_ERROR",2);
	define("SESSION_MISSING",3);

	if(!isset($_SESSION["register"])){
		echo SESSION_MISSING;
		exit;
	}

	//소금 생성
    $bytes = openssl_random_pseudo_bytes(10, $cstrong);
    $hex   = bin2hex($bytes);
    //hash화
    $pw = $_POST['pw'].$hex;
    $pw = hash('sha256',$pw);

	include_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$query = "UPDATE user set id = '$_POST[id]', password = '$pw',nickname = '$_POST[nick]', hash_salt = '$hex' where user_id = $_SESSION[register]";
	if($mysqli -> query($query)){
		echo SUCCESS;
		session_destroy();
	}else{
		echo MYSQL_ERROR;
	}

?>