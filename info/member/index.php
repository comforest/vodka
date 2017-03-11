<!-- Member 페이지 -->
<?php
	session_start();
	if(!isset($_SESSION["user"])){
		echo "<script>
    	alert(\"로그인을 하셔야 이용가능합니다.\");
    	location.href = \"/user/login\";
    	</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="/static/css/board.css">
	
	<script type="text/javascript" src="member.js"></script>
</head>
<body>

	<?php
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$total = array();
	if($result = $mysqli->query("SELECT * FROM user WHERE location <> ''")){
		while($data = $result->fetch_array(MYSQLI_ASSOC)){
			$location = $data["location"];
			$colleage = $data["colleage"];
			$student_id = $data["student_id"];
			$gender = User::GenderInttoStr($data["gender"]);
			$rank = User::RankInttoStr($data["rank"]);

			if(!isset($total["단과대"]["전체"]["$colleage"])){
				$total["단과대"]["전체"]["$colleage"] = 0;
			}
			if(!isset($total["학번"]["전체"][USER::getShortStudentID($student_id)])){
				$total["학번"]["전체"][USER::getShortStudentID($student_id)] = 0;
			}
			if(!isset($total["성별"]["전체"][$gender])){
				$total["성별"]["전체"][$gender] = 0;
			}
			if(!isset($total["등급"]["전체"][$rank])){
				$total["등급"]["전체"][$rank] = 0;
			}

			if(!isset($total["단과대"]["$location"]["$colleage"])){
				$total["단과대"]["$location"]["$colleage"] = 0;
			}
			if(!isset($total["학번"]["$location"][USER::getShortStudentID($student_id)])){
				$total["학번"]["$location"][USER::getShortStudentID($student_id)] = 0;
			}
			if(!isset($total["성별"]["$location"]["$gender"])){
				$total["성별"]["$location"]["$gender"] = 0;
			}
			if(!isset($total["등급"]["$location"][$rank])){
				$total["등급"]["$location"][$rank] = 0;
			}


			++$total["단과대"]["전체"]["$colleage"];
			++$total["학번"]["전체"][USER::getShortStudentID($student_id)];
			++$total["성별"]["전체"]["$gender"];
			++$total["등급"]["전체"][$rank];
			++$total["단과대"]["$location"]["$colleage"];
			++$total["학번"]["$location"][USER::getShortStudentID($student_id)];
			++$total["성별"]["$location"]["$gender"];
			++$total["등급"]["$location"][$rank];
			
		}
	}

	echo '<section class="board" id = "chart" style="display:none">
		<a onclick="SwitchList()">표 보기</a>';


	foreach ($total as $totalK => $totalV) {
		echo "<br><br>";
		foreach ($totalV as $key => $value) {
			ksort($value);
			echo "<p>$key $totalK 분표</p>
				<table>
				<thead>
					<tr>";
				foreach ($value as $k=>$v) {
					echo "<th>$k</th>";
				}
				echo '<th>합계</th>';
				echo '</tr>
				</thead>
				<tbody>
				<tr>';
				$sum = 0;
				foreach ($value as $k=>$v) {
					echo "<td>$v"."명</td>";
					$sum += $v;
				}
				echo "<td>$sum"."명</td>";
				echo "</tr>";
				echo "<tr>";

				foreach ($value as $k=>$v) {
					echo "<td>".(round($v/$sum,2)*100)."%</td>";
				}
				echo "<td>100%</td>";
				echo "</tr>";

			echo '</tbody></table>';
		}
	}

	echo '</section>';
	
	?>
	<section class = "board" id= "sortTable"></section>

	<script type="text/javascript">select_menu("member");</script>
</body>
</html>