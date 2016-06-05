<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>
	<link rel="stylesheet" type="text/css" href="static/css/header.css">
	<link rel="stylesheet" type="text/css" href="static/css/board.css">
</head>
<body>
	<?php 
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class="board">
		<table>
			<thead>
				<tr>
					<th>
						게임 이름
					</th>
					<th>
						소유자
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						르아브르
					</td>
					<td>
						이호연
					</td>
				</tr>
			</tbody>
		</table>	
	</section>
	
</body>
</html>