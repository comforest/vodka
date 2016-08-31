<!-- 회비 페이지 -->
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

	<script type="text/javascript" src="fee.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>
	<section class = "board" id= "List"></section>
	
</body>
</html>