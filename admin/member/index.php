<!-- 관리-회원 페이지 -->
<?php session_start();
if(!isset($_SESSION["rank"])){
	echo "<script>
	alert(\"로그인을 하셔야 이용가능합니다.\");
	// location.href = \"/user/login\";
	</script>";
}else if($_SESSION["rank"] > 2){
	echo "<script>
	alert(\"접근 권한이 없습니다..\");
	location.href = \"/\";
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

	<script type="text/javascript" src="member.js"></script>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
	<link rel="stylesheet" type="text/css" href="member.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.inc";
	?>

	<section>
		<form id="filter" onsubmit="filter();return false;">
			<table>
				<tbody>
					<tr id="Slocation">
						<td>활동 지역</td>
						<td>
							<input class="allCheck" type="checkbox" name="all" checked> 전체
						</td>
						<td>
							<input type="checkbox" name="송도" checked> 송도
						</td>
						<td>
							<input type="checkbox" name="신촌" checked> 신촌
						</td>
						<td>
							<input type="checkbox" name="휴면" checked> 휴면
						</td>
					</tr>

					<tr id="Srank">
						<td>등급</td>
						<td>
							<input class="allCheck" type="checkbox" name="all" checked> 전체
						</td>
						<td><input type="checkbox" name="1" checked> 해</td>
						<td><input type="checkbox" name="2" checked> 달</td>
						<td><input type="checkbox" name="3" checked> 별</td>
						<td><input type="checkbox" name="4" checked> 구름</td>
					</tr>

					<tr>
						<td>출석 수</td>
						<!-- <td>
							<select id="attend_semester">
								<option value="all">
									전체
								</option>
								<option value="present">
									이번 학기
								</option>
								<option value="previous">
									직전 학기
								</option>
							</select>
						</td> -->
						<td>
							<input type="number" name="moreAttend" value="0" min> 이상
						</td>
					</tr>
				</tbody>
			</table>
			<br>
			<input type="submit" value="검색하기">
		</form>
		
		<div id="num"></div>
		<table id="sortTable">
			
		</table>

		<section id="actionDiv">
			<div class="dropdown">
				<button class="dropbtn">활동 지역 변경</button>
				<div class="dropdown-content">
					<button onclick="updateLocation('송도')">송도</button>
					<button onclick="updateLocation('신촌')">신촌</button>
					<button onclick="updateLocation('휴면')">휴면</button>
				</div>
			</div>
			<div class="dropdown">
				<button class="dropbtn">등급 변경</button>
				<div class="dropdown-content">
					<?php
						if(isset($_SESSION["rank"]) && $_SESSION["rank"] <= 1){
							// echo '<button onclick="updateRank(1)">해</button>';
							echo '<button onclick="updateRank(2)">달</button>';
						}
					?>
					<button onclick="updateRank(3)">별</button>
					<button onclick="updateRank(4)">구름</button>
				</div>
			</div>
			<button onclick="deleteMember()">회원 탈퇴</button>
		</section>

	</section>

</body>
</html>