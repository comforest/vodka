<!-- 로그인 페이지 -->
<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


	<link rel="stylesheet" type="text/css" href="login.css">
	<script type="text/javascript" src="login.js"></script>

</head>
<body>
	
	<?php

		if(isset($_SESSION["user"]) && isset($_SESSION["rank"])){
			echo "<script>location.href='/';</script>";
		}

		$userID = "";
		$userPW = "";
		$auto = "";
		if(isset($_COOKIE['userID']) && isset($_COOKIE["userPW"])){
			$userID = $_COOKIE['userID'];
			$userPW = $_COOKIE['userPW'];
			$auto = "checked";
		}
	?>

	<section class="login">
		<form method="POST" onsubmit="login();return false;">
			<h1>V o D K a</h1>
			<p>아이디</p>
			<input type="text" name="id" placeholder="ID" value="<?php echo $userID ?>">
			<p>비밀번호</p>
			<input type="password" name="pass" placeholder="PassWord" value="<?php echo $userPW ?>">
			<input type="submit" value="로그인">
			<p class="auto_login"><input type="checkbox" name="auto" <?php echo $auto ?>> 정보 기억하기</p>
		</form>
	</section>


	<input type="hidden" name="url" value= <?php echo $_SERVER['HTTP_REFERER'] ?>>
</body>
</html>