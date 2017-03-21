<!-- 회비 페이지 -->
<?php 
session_start();
include $_SERVER["DOCUMENT_ROOT"]."/static/php/checkLogin.php";

if(!checkLogin()){
	notLoginIndex();
}
if(!checkAdmin()){
	notAdminIndex();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="/static/css/board.css">

	<script type="text/javascript" src="fee.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
	?>
	<section class = "board">
		<a onclick="showName()">회비 내지 않은 사람 이름 나열하기</a><br>
		<a onclick="showPhone()">회비 내지 않은 사람 휴대폰 나열하기</a><br>
		<article id = "note"></article>
		<article id="List"></article>
	</section>
	
</body>
</html>