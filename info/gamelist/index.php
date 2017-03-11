<!-- GameList 페이지 -->
<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="/static/css/board.css">

	<script type="text/javascript" src="gamelist.js"></script>
</head>
<body>
	<?php 
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
	?>
	<script type="text/javascript">select_menu("gamelist");</script>


	<h2>보드게임 목록</h2>

	<section class="board gamelist">
		<?php
			if(isset($_SESSION["rank"])){
				if($_SESSION["rank"] > 2){
					echo '<a onclick="showDialog(\'add\',400,200)">보드게임 추가하기</a>';
				}else{
					echo '<a onclick="showDialog(\'add\',400,450)">보드게임 추가하기</a>';
				}
			}
		?>
		<table id="sortTable">
			<thead>
				<tr>
					<th id="difficulty">
						난이도
					</th>
					<th id="game">
						게임 이름
					</th>
					<th id="user">
						소유자
					</th>
					<th id="note">
						비고
					</th>
				</tr>
			</thead>
			<tbody>
			
			</tbody>
		</table>
	</section>

	<form name="dummy" method="POST" action="edit/index.php" style="display:none">
		<input type="text" name="game">
		<input type="text" name="note">
		<input type="text" name="diff">
		<input type="text" name="id">
	</form>
</body>
</html>