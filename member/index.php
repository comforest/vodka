<?php
	session_start();
	if(!isset($_SESSION["user"])){
		header('Location: $_SERVER["DOCUMENT_ROOT"]');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="/static/css/board.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class ="board">
		<table>
			<thead>
				<tr>
				<?php
					if($_SESSION["rank"] > 2){
						echo "<th>이름</th>";
						echo "<th>학과</th>";
						echo "<th>학번</th>";
						echo "<th>등급</th>";
						echo "<th>활동 지역</th>";
						echo "<th>활동 여부</th>";
					}else{
						echo "<th>이름</th>";
						echo "<th>성별</th>";
						echo "<th>단과대</th>";
						echo "<th>학과</th>";
						echo "<th>학번</th>";
						echo "<th>전화 번호</th>";
						echo "<th>기수</th>";
						echo "<th>등급</th>";
						echo "<th>활동 지역</th>";
						echo "<th>활동 여부</th>";

					}
				?>
				</tr>
			</thead>
			<tbody>

				<?php
				include $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
				include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
				if($result = $mysqli->query("SELECT * FROM user order by entry DESC, rank asc, name asc")){
					while($data = $result->fetch_array(MYSQLI_ASSOC)){
						echo "<tr>";
						if($_SESSION["rank"] > 2){
							echo "<td>".$data["name"]."</td>";
							echo "<td>".$data["major"]."</td>";
							echo "<td>".User::getShortStudentID($data["student_id"])."</td>";
							echo "<td>".User::RankInttoStr($data["rank"])."</td>";
							echo "<td>".$data["location"]."</td>";
							echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
						}else{
							echo "<td>".$data["name"]."</td>";
							echo "<td>".User::GenderInttoStr($data["gender"])."</td>";
							echo "<td>".$data["colleage"]."</td>";
							echo "<td>".$data["major"]."</td>";
							echo "<td>".$data["student_id"]."</td>";
							echo "<td>".User::AppendPhoneHypen($data["phone"])."</td>";
							echo "<td>".User::AppendClass	($data["class"])."</td>";
							echo "<td>".User::RankInttoStr($data["rank"])."</td>";
							echo "<td>".$data["location"]."</td>";
							echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
						}
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</section>
</body>
</html>