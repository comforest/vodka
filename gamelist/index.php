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

	<link rel="stylesheet" type="text/css" href="gamelist.css">
	<script type="text/javascript" src="gamelist.js"></script>
</head>
<body>
	<?php 
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class="board gamelist">
		<?php
			if(isset($_SESSION["rank"])){
				if($_SESSION["rank"] > 2){
					echo '<a onclick="showAddGame()">보드게임 추가하기</a>';
				}else{
					echo '<a onclick="showAddGameRank()">보드게임 추가하기</a>';
				}
			}
		?>
		<table>
			<thead>
				<tr>
					<th onclick="sortJson('game')">
						게임 이름
					</th>
					<th onclick="sortJson('user')">
						소유자
					</th>
					<th onclick="sortJson('note')">
						비고
					</th>
				</tr>
			</thead>
			<tbody id="list">
			
			</tbody>
		</table>
	</section>
</body>
</html>