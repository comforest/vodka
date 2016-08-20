<!-- game Add Page -->
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

	<link rel="stylesheet" type="text/css" href="../dialog.css">
	<script type="text/javascript" src="addGame.js"></script>
</head>
<body>
	<section class="dialog">
		게임 이름 : <input type="text" name="name"><br>
		비고 : <input type="text" name="note"><br>

		<?php
		if($_SESSION["rank"] <= 2){
			echo '소유자';
			echo '<input type="radio" name="user" value="admin">동아리';
			echo '<input type="radio" name="user" value="my" checked="checked">이호연';
			echo '<input type="radio" name="user" value="search">검색하기';
			echo '<article id="userlist" style="display:none">';
			echo '<input type="text" name="user">';
			echo '<input type="button" onclick="searchUser();" value="찾기"><br>';
			echo '<div id="list"></div>';
			echo '</article>';
		}
		?>

		<input type="submit" value="확인" onclick="addGame();">
	</section>
</body>
</html>	