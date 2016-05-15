<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="login_action.php"  method="POST" >
		ID : <input id="input-id" type="text" name="id" required><br>
		PASSWORD : <input id="input-pw" type="password" name="pass" required><br>
		<input type="submit" value="로그인">
		<input type="hidden" name="url" value= <?php echo $_SERVER['HTTP_REFERER'] ?>>
	</form>
</body>
</html>