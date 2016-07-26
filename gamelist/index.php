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
					<th>
						게임 이름
					</th>
					<th>
						소유자
					</th>
					<th>
						비고
					</th>
				</tr>
			</thead>
			<tbody>
			<?php
				require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
				require_once $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
				if($result = $mysqli->query("SELECT * from game ORDER BY name ASC")){
					while($data = $result->fetch_array(MYSQLI_ASSOC)){
						echo '<tr>';
						echo '<td>'.$data["name"].'</td>';
						echo '<td>'.USER::FindByID($data["user_id"])["name"].'</td>';
						echo '<td>'.$data["note"].'</td>';
						echo "<td><a>X</a></td>";
						echo '</tr>';
					}
				}
			?>
			</tbody>
		</table>
	</section>
</body>
</html>