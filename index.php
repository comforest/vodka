<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>TEST</title>
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
				
				//Set Date
				$date = "";
				if($_GET["y"] === null || $_GET["m"] === null){
					$date = date("Y-n-1");	
				}else{
					$date = $_GET["y"]."-".$_GET["m"]."-1";
				}

				//Table Head
				echo("<thead>");
				echo("<tr>");
					echo("<th></th><th></th>");
					$y = (int)date("Y",strtotime($date));
					$m = (int)date("n",strtotime($date));
					$url = "index.php?";
					$urledit = "";
					if($m === 1){
						$urledit = $url."y=".($y-1)."&m=12";
					}else{
						$urledit = $url."y=".$y."&m=".($m -1);
					}
					echo("<th><a href=".$url."y=".($y-1)."&m=".$m.">&laquo</a> <a href=".$urledit.">&lt</a></th>");
					echo("<th>".$y."년 ".$m."월</th>");

					if($m === 12){
						$urledit = $url."y=".($y+1)."&m=1";
					}else{
						$urledit = $url."y=".$y."&m=".($m +1);
					}

					echo("<th><a href=".$urledit.">&gt</a> <a href=".$url."y=".($y+1)."&m=".$m.">&raquo</a></th>");
				echo("</tr>");

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
						if($d == 1 && $i == $start){
							echo("<td>".($d++)."</td>");
						}else if ($d > 1 && $d <= $end){
							echo("<td>".($d++)."</td>");
						}else{
							echo("<td></td>");
						}
					}
					echo("</tr>");

					if($d > $end){
						$bool = false;
					}
				}

				?>
			</tbody>
		</table>
	</section>
</body>
</html>