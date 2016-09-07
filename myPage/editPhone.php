<?php
	session_start();
	if(!isset($_POST["phone"])){
		echo "<script>
    	alert(\"로그인을 하셔야 이용가능합니다.\");
    	location.href =".$_SERVER['HTTP_REFERER'].";
    	</script>";
	}
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	if($mysqli->query('UPDATE user Set phone="'.$_POST["phone"].'" where user_id = '.$_SESSION["user"])){
		echo true;
	}else{
		echo false;
	}
?>