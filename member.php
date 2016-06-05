<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="static/css/header.css">
	<link rel="stylesheet" type="text/css" href="static/css/board.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class ="board">
		<table>
			<thead>
				<tr>
					<th>
						이름
					</th>
					<th>
						학과
					</th>
					<th>
						학번
					</th>
					<th>
						등급
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						이호연
					</td>
					<td>
						컴퓨터 과학과
					</td>
					<td>
						15
					</td>	
					<td>
						달
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</body>
</html>