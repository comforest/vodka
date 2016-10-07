<!-- Attend 페이지 -->
<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="attend.css">

	<script type="text/javascript" src="attend.js"></script>
</head>
<body>

	<?php
		include "$_SERVER[DOCUMENT_ROOT]/static/php/header.inc";
	?>

	<section>
		<?php
			include_once "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";

			$query = "SELECT date,text from calendar where calendar_id=$_GET[id]";

			if($result = $mysqli->query($query)){
				$data = $result->fetch_array(MYSQLI_NUM);
				echo "<h1>$data[0] $data[1]</h1>";
			}
		?>

		</sectoin>
		<sectoin class="left-side">
			참석자 명단 <br>

			<table id="list">
			
			</table>
		</sectoin>
		<?php
			if(isset($_SESSION["rank"]) && $_SESSION["rank"]<=2){
				echo "
			<section class='center-side'>
				<form onsubmit='PeopleCheck();return false;'>
					<input type='hidden' name='id' value= '$_GET[id]'>
					<textarea id='people' rows='20'></textarea><br>
					<input type='submit' value='출석하기'>
				</form>
			</section>";
		}
		?>
		<section class="right-side" id="check">
		</section>
	</section>
</body>
</html>