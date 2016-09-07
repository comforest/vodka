<!-- 관리 페이지 -->
<?php session_start();
if(!isset($_SESSION["rank"])){
	echo "<script>
	alert(\"로그인을 하셔야 이용가능합니다.\");
	location.href = \"/login\";
	</script>";
}else if($_SESSION["rank"] > 2){
	echo "<script>
	alert(\"접근 권한이 없습니다..\");
	location.href = \"/\";
	</script>";
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
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.inc";
	?>
	
</body>
</html>