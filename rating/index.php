<!-- Rating 페이지 -->
<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.inc";

	?>

	<section class="calendar">
		<table>
			<thead>
				<tr>
					<td>이름</td>
					<td>점수</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
 						<input type="text" name="name1">
					</td>
					<td>
 						<input type="number" name="score1">
					</td>
				</tr>
			</tbody>
		</table>
	</section>
</body>
</html>