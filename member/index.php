<?php
	session_start();
	if(!isset($_SESSION["user"])){
		header("Location: ".$_SERVER['DOCUMENT_ROOT']);
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
	
	<script type="text/javascript">
		function SwitchChart(){
			$(".chart").show();
			$(".memberList").hide();
		}

		function SwitchList(){
			$(".chart").hide();
			$(".memberList").show();
		}
	</script>
</head>
<body>
	<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	include $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";

	if($_SESSION["rank"] > 2){
		echo '<section class ="board">
			<table>
			<thead>
				<tr>
					<th>이름</th>
					<th>학과</th>
					<th>학번</th>
					<th>등급</th>
					<th>활동 지역</th>
					<th>활동 여부</th>
				</tr>
			</thead>
			<tbody>';

		if($result = $mysqli->query("SELECT * FROM user order by entry DESC, rank asc, name asc")){
			while($data = $result->fetch_array(MYSQLI_ASSOC)){
				echo "<tr>";
				echo "<td>".$data["name"]."</td>";
				echo "<td>".$data["major"]."</td>";
				echo "<td>".User::getShortStudentID($data["student_id"])."</td>";
				echo "<td>".User::RankInttoStr($data["rank"])."</td>";
				echo "<td>".$data["location"]."</td>";
				echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
				echo "</tr>";
			}
		}
		echo '</tbody></table></section>';
	}else{
		echo '<section class ="board memberList">
			<a href="/writeMemberExcel.php">엑셀로 다운받기</a>
			<a onclick="SwitchChart()">통계보기</a>
			<table>
			<thead>
				<tr>
					<th>이름</th>
					<th>성별</th>
					<th>단과대</th>
					<th>학과</th>
					<th>학번</th>
					<th>전화 번호</th>
					<th>기수</th>
					<th>등급</th>
					<th>활동 지역</th>
					<th>활동 여부</th>
				</tr>
			</thead>
			<tbody>';

		$total = array();
		if($result = $mysqli->query("SELECT * FROM user order by entry DESC, rank asc, name asc")){
			while($data = $result->fetch_array(MYSQLI_ASSOC)){
				$location = $data["location"];
				$colleage = $data["colleage"];
				$student_id = $data["student_id"];
				$gender = User::GenderInttoStr($data["gender"]);
				$rank = User::RankInttoStr($data["rank"]);


				echo "<tr>";
				echo "<td>".$data["name"]."</td>";
				echo "<td>".$gender."</td>";
				echo "<td>".$colleage."</td>";
				echo "<td>".$data["major"]."</td>";
				echo "<td>".$student_id."</td>";
				echo "<td>".User::AppendPhoneHypen($data["phone"])."</td>";
				echo "<td>".User::AppendClass($data["class"])."</td>";
				echo "<td>".$rank."</td>";
				echo "<td>".$location."</td>";
				echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
				echo "</tr>";

				if($data["entry"] == 1){

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
		}
		echo '</tbody></table></section>';

		echo '<section class="board chart" style="display:none">
			<a onclick="SwitchList()">표 보기</a>';


		foreach ($total as $totalK => $totalV) {
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
						$sum += $v;
					}
					echo "<td>100%</td>";
					echo "</tr>";

				echo '</tbody></table>';
			}
		}

		echo '</section>';
	}
	?>
</body>
</html>