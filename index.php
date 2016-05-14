<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>
	<link rel="stylesheet" type="text/css" href="\css\nav.css">
	<link rel="stylesheet" type="text/css" href="\css\calendar.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/html/menu.html";	
	?>

	<section class="calendar">
		<table>
			<?php

				
				//Set Date & URL
				$date = "";
				if($_GET["y"] === null || $_GET["m"] === null){
					$date = date("Y-n-1");	
				}else{
					$date = $_GET["y"]."-".$_GET["m"]."-1";
				}
				$y = (int)date("Y",strtotime($date));
				$m = (int)date("n",strtotime($date));

				function getURL($fy, $fm){
					return "index.php?y=".$fy."&m=".$fm;
				}
				$url = "";

				//Table Head
				echo("<thead>");
				echo("<tr>");
				if($m === 1){
					$url = getURL($y-1, 12);
				}else{
					$url = getURL($y,$m-1);
				}
				echo("<th colspan='7'>");
				echo("<a href=".getURL($y-1,$m).">&laquo</a>");
				echo("<a href=".$url.">&lt</a>");


				echo($y."년 ".$m."월");


				if($m === 12){
					$url = getURL($y+1, 1);
				}else{
					$url = getURL($y,$m+1);
				}

				echo("<a href=".$url.">&gt</a>");
				echo("<a href=".getURL($y+1, $m).">&raquo</a>");
				echo("</th>");
				echo("</tr>");

				//Table Head - Day
				echo("<tr>
					<th>일요일</th><th>월요일</th><th>화요일</th>
					<th>수요일</th><th>목요일</th><th>금요일</th>
					<th>토요일</th>
					</tr>");

				echo("</thead>");


				//Table Body - Body
				echo("<tbody>");
				$start = date('w', strtotime($date));
				$end = date("t", strtotime($date));
				$d = 1;
				$bool = true;
				while($bool){
					echo("<tr>");
					for($i = 0; $i < 7; ++$i){
						if(($d == 1 && $i == $start || ($d > 1 && $d <= $end))){
							echo("<td>");
							echo "<p>".$d++."</p>";
							echoSchedule($d);
							echo("</td>");
						}else{
							echo("<td></td>");
						}
					}
					echo("</tr>");

					if($d > $end){
						$bool = false;
					}
				}
				echo "</tbody>";

				function echoSchedule($d){
					// TODO
					// DB에서 일정 데이터 가져와서 표시
					global $y, $m;
					echo "<a href='#'> TEST </a>";
				}

			?>
		</table>
	</section>
</body>
</html>