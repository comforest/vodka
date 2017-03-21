<?php


function checkLogin(){
	return isset($_SESSION['user']) && isset($_SESSION['rank']);
}

function checkAdmin(){
	return checkLogin() && $_SESSION['rank'] <= 2;
}

function notLoginIndex(){
	echo "<script>
	alert(\"로그인을 하셔야 이용가능합니다.\");
	location.href = \"/user/login\";
	</script>";
}

function notAdminIndex(){
	echo "<script>
	alert(\"접근 권한이 없습니다..\");
	location.href = \"/\";
	</script>";
}

function notAdminJson(){
	$json = array("status"=>"ErrorRank");
	echo json_encode($json);
	exit;
}

?>