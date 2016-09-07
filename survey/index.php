<!-- 메인 페이지 -->
<?php session_start() ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="survey.css">
</head>
<body>

<section>
	<?php
	if(isset($_SESSION["user"])){
		echo '<h3 style="margin-bottom:0px;">활동 여부 및 지역</h3>';
		echo '<p style="margin:5px 0px 15px 0px;">신촌정모 매주 화요일 7시<br>송도정모 매주 목요일 8시</p>';
		echo '<form action="report.php" method="POST">';

		include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
		$user = User::FindByID($_SESSION["user"]);

		echo '<input type="radio" name="sur" value="sin" required>신촌<br>';
		echo '<input type="radio" name="sur" value="song">송도<br>';
		echo '<input type="radio" name="sur" value="rest">휴면<br>';
		echo '<input type="radio" name="sur" value="exit">탈퇴<br>';
		

		echo '<br><h3 style="margin-bottom:0px;">내정보</h3>';
		echo '<p style="margin:5px 0px 15px 0px;">전화번호 외의 정보가 변경되었을 경우 옐로아이디 또는 회장에게 직접 연락바랍니다.</p>';
		echo '<table>';
		echo "<tr>";
		echo "<td>이름</td>";
		echo "<td>".$user["name"]."</td>";
		echo "<td>학과</td>";
		echo "<td>".$user["major"]."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>활동 지역</td>";
		echo "<td>".$user["location"]."</td>";
		echo "<td>등급</td>";
		echo "<td>".User::RankInttoStr($user["rank"])."</td>";
		echo "</tr>";

		echo "<tr>";
		echo "<td>전화번호</td>";
		echo '<td><input type="text" name="phone" value='.User::AppendPhoneHypen($user["phone"]).'></td>';
		echo "</tr>";


		echo '<tr id="addGame" style="display:none">';
		echo '<td colspan="4">';
		echo '<p style="margin-bottom:5px;">동아리방에 비치하고 싶은 보드게임, 물품 등을 써주세요.</p>';
		echo '<textarea name="list" style="width:450px; height:100px;"></textarea>';
		echo '</td>';
		echo '</tr>';

		echo '<tr>';
		echo '<td><input type="submit" value="보내기"></td>';
		echo '</tr>';
 		echo'</form></table>';
	}else{
		echo '<form action="login.php" method="POST">';
		echo '이름 : <input type="text" name="name"> <br>';
		echo '학번 : <input type="text" name="student"> <br>';
		echo '<input type="submit">';
		echo '</form>';
	}
	?>
</section>
<script type="text/javascript">
	$( "input[type='radio']" ).change(function() {
		if($("input[value='song']").is(":checked")){
			$("#addGame").show();
		}else{
			$("#addGame").hide();
		}

	});
</script>
</body>
</html>