<!-- Nickname 페이지 -->
<?php 
	session_start();
	if(!isset($_SESSION["user"])){
		echo "<script>
    	alert(\"로그인을 하셔야 이용가능합니다.\");
    	location.href = \"/login\";
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
	<script type="text/javascript" src="registry.js"></script>
</head>
<body>

	<section>
	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.inc";
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";

		if(isset(User::FindByID($_SESSION["user"])['nickname'])){
			echo '이미 닉네임이 존재합니다.';
		}else{
			echo '
				닉네임 입력 : <input type="text" name="nickname">
				<button onclick="registry()">확인</button>
			';
		}
	?>
	</section>

</body>
</html>