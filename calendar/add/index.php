<!-- 일정 추가 페이지 -->
<?php session_start();
if(!isset($_SESSION["rank"])){
	echo "<script>
	alert(\"로그인을 하셔야 이용가능합니다.\");
	location.href = \"/user/login\";
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

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">

	<script type="text/javascript" src="add.js"></script>
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/static/php/header.php";
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	?>
	<script type="text/javascript">select_menu("calendar");</script>

	<section>
		<form onsubmit="addCalendar();return false;">
			<table>
				<tr>
					<td>반복</td>
					<td>
						<select id="repeat">
							<option value="none">-선택-</option>
							<option value="no-repeat">반복 없음</option>
							<option value="mon">매주 월요일</option>
							<option value="tue">매주 화요일</option>
							<option value="wed">매주 수요일</option>
							<option value="thu">매주 목요일</option>
							<option value="fri">매주 금요일</option>
							<option value="sat">매주 토요일</option>
							<option value="sun">매주 일요일</option>
						</select>
					</td>
				</tr>

				<tr>
					<td>일정 종류</td>
					<td>
						<select id="type">
							<option value="none">-선택-</option>
							<?php
								if($result = $mysqli->query("SELECT calendar_type, text from calendar_type order by calendar_type asc")){
									while($data = $result->fetch_array(MYSQLI_ASSOC)){
										echo "<option value='$data[calendar_type]'>$data[text]</option>";
									}
								}
							?>
						</select>
					</td>
				</tr>

				<tr>
					<td>시작 날짜</td>
					<td>
						<input type="date" name="start_date">
					</td>
				</tr>

				<tr>
					<td>종료 날짜</td>
					<td>
						<input type="date" name="end_date">
					</td>
				</tr>

				<tr>
					<td>일정</td>
					<td>
						<input type="text" name="title">
					</td>
				</tr>

				<tr>
					<td colspan="2">
						<input type="submit" value="확인">
					</td>
				</tr>
			</table>
		</form>
	</section>
</body>
</html>