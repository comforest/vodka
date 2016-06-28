<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>VoDKa</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="static/css/header.css">
	<link rel="stylesheet" type="text/css" href="static/css/board.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section class ="board">
		<table>
			<thead>
				<tr>
					<th> 이름 </th>
					<th> 학과 </th>
					<th> 학번 </th>
					<th> 등급 </th>
					<th> 활동 지역 </th>
					<th> 활동 여부 </th>
				</tr>
			</thead>
			<tbody>

				<?php
				include $_SERVER["DOCUMENT_ROOT"]."/function/userInfo.php";
				include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
				if($result = $mysqli->query("SELECT * FROM user order by entry DESC, rank asc, name asc")){
					while($data = $result->fetch_array(MYSQLI_ASSOC)){
						echo "<tr>";
						echo "<td>".$data["name"]."</td>";
						echo "<td>".$data["major"]."</td>";
						echo "<td>".(User::getShortStudentID($data["student_id"]))."</td>";
						echo "<td>".(User::RankInttoStr($data["rank"]))."</td>";
						echo "<td>".$data["location"]."</td>";
						echo "<td>".User::EntryInttoStr($data["entry"])."</td>";
						echo "</tr>";
					}
				}
				?>
			</tbody>
		</table>
	</section>
</body>
</html>