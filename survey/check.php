<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>
</head>
<body>
	<table>
	<tr>
		<th>이름</th>
		<th>내용</th>
	</tr>
	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
		$query="SELECT * from survey";
		if($result = $mysqli->query($query)){
			while($data = $result->fetch_array(MYSQLI_ASSOC)){
				$user = USER::FindByID($data["user_id"]);
				echo "<tr>";
				echo "<td>$user[name]</td>";
				echo "<td>$data[text]</td>";
				echo "</tr>";
			}
		}
	?>
	</table>
</body>
</html>