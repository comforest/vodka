<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<script type="text/javascript" src="rating.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
	?>

	<section>

		<select onchange='setTable()''>
			<?php
				require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
				if($result = $mysqli->query("SELECT game_id,game,max from rating_game")){
					while($data = $result->fetch_array(MYSQLI_ASSOC)){
						echo "<option value='$data[game_id]' data-member=$data[max]>$data[game]</option>";
					}
				}
			?>			
		</select>

		<article id="list">
			
		</article>
	</section>
</body>
</html>