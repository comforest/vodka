<?php session_start();
	if(!isset($_SESSION["user"])){
		echo '<script> 
			alert("잘못 된 접근입니다."); 
			window.close(); 
			</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../gamelist.css">
	<script type="text/javascript" src="addGame.js"></script>
</head>
<body>
	<form class="addGame" onsubmit="addGame();return false;">
		게임 이름 : <input type="text" name="name"><br>
		비고 : <input type="text" name="note"><br>

		<?php
		if($_SESSION["rank"] <= 2){
			echo '소유자';
			echo '<input type="radio" name="user" value="동아리">동아리';
			echo '<input type="radio" name="user" value="이호연">이호연';
			echo '<input type="radio" name="user" value="검색">검색하기';
			echo '<form id="userlist" onsubmit="searchUser();return false;">';
			echo '<input type="text" name="user">';
			echo '<input type="submit" value="찾기"><br>';
			echo '<article id="list"></article>';
			echo '</form>';
		}
		?>

		<input type="submit" value="확인">
	</form>
</body>
</html>