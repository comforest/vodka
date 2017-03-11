<!-- My Page -->
<?php
	session_start();
	if(!isset($_SESSION["user"])){
		echo "<script>
    	alert(\"로그인을 하셔야 이용가능합니다.\");
    	location.href = \"/login\";
    	</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>


	<link rel="stylesheet" type="text/css" href="/static/css/header.css">

	<script type="text/javascript" src="myPage.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
	?>

	<section id="myInfo">
		<h3>내정보</h3>
		<table>
			<?php
			require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
			$user = User::FindByID($_SESSION["user"]);
			echo "<tr>";
			echo "<td>이름</td>";
			echo "<td>".$user["name"]."</td>";
			echo "<td>학과</td>";
			echo "<td>".$user["major"]."</td>";
			echo "<td>학번</td>";
			echo "<td>".$user["student_id"]."</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>활동 지역</td>";
			echo "<td>".$user["location"]."</td>";
			echo "<td>등급</td>";
			echo "<td>".User::RankInttoStr($user["rank"])."</td>";
			echo "</tr>";

			echo "<tr>";
			echo "<td>전화번호</td>";
			echo '<form onsubmit = "editPhone()">';
			echo '<td><input type="text" name="phone" value='.User::AppendPhoneHypen($user["phone"]).'></td>';
			echo '<td><input type="submit" value="수정"></td>';
			echo '</form>';
			echo "</tr>";


			?>
		</table>
	</section>

	<section id="gamelist">
		<h3>내 게임</h3>
		<table>
			<thead>
				<tr>
					<th>
						게임 이름
					</th>
					<th>
						비고
					</th>
				</tr>
			</thead>
			<tbody id="list">
			<?php
 			require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

 			if($result=$mysqli->query("SELECT name,note from game Where user_id = ".$_SESSION["user"])){
 				while($data = $result->fetch_array(MYSQLI_ASSOC)){
 					echo "<tr>";
 					echo "<td>".$data["name"]."</td>";
 					echo "<td>".$data["note"]."</td>";
 					echo "</tr>";
 				}
 			}
			?>
			</tbody>
		</table>
	</section>

</body>
</html>