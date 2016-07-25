<?php session_start() ?>
<!-- 메인 페이지 -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="static/css/header.css">
	<link rel="stylesheet" type="text/css" href="calendar.css">
	<script type="text/javascript" src="calendar.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class="calendar">
		<article></article>
		<?php
			if(isset($_SESSION["rank"]) && $_SESSION["rank"] >= 2){
				echo '<a class="editCalendar" href=""><p>일정 수정</p></a>';
			}
		?>
	</section>
</body>
</html>