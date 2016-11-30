<!-- Rating Add 페이지 -->
<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<script type="text/javascript" src='rating_add.js'></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.inc";
	?>

	<section>
		<select onchange='setInput()''>
			<?php
				include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
				if($result = $mysqli->query("SELECT game_id,game,max from rating_game")){
					while($data = $result->fetch_array(MYSQLI_ASSOC)){
						echo "<option value='$data[game_id]' data-member=$data[max]>$data[game]</option>";
					}
				}
			?>			
		</select>

		<table>
			<thead>
				<tr>
					<td></td>
					<td>닉네임</td>
					<td>점수</td>
				</tr>
			</thead>
			<tbody id="player-list">
				<tr>
					<td>플레이어 1</td>
					<td>
 						<input class="name" type="text" name="name1">
					</td>
					<td>
 						<input type="number" name="score1">
					</td>
				</tr>
				<tr>
					<td>플레이어 2</td>
					<td>
 						<input class="name" type="text" name="name2">
					</td>
					<td>
 						<input type="number" name="score2">
					</td>
				</tr>
				<tr>
					<td>플레이어 3</td>
					<td>
 						<input class="name" type="text" name="name3">
					</td>
					<td>
 						<input type="number" name="score3">
					</td>
				</tr>
				<tr>
					<td>플레이어 4</td>
					<td>
 						<input class="name" type="text" name="name4">
					</td>
					<td>
 						<input type="number" name="score4">
					</td>
				</tr>
				<tr>
					<td>플레이어 5</td>
					<td>
 						<input class="name" type="text" name="name5">
					</td>
					<td>
 						<input type="number" name="score5">
					</td>
				</tr>

			</tbody>
			<tfoot>
				<tr>
					<td></td>
					<td></td>
					<td><button onclick="saveInfo()">전송</button></td>
				</tr>
			</tfoot>
		</table>
	</section>
</body>
</html>