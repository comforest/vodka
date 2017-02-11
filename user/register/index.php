<!-- register -->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="register.css">
	<script type="text/javascript" src="register.js"></script>
</head>
<body>
	<header class="title">
		<h1>V o D K a</h1>
		<h2>회원 가입</h2>
	</header>
	<section id="check" class="register">

		<p class="brief">보드카 회원만 가입이 가능합니다.<br> 동아리 가입때 작성하셨던 정보를 입력해주세요.</p>
		
		<form onsubmit="checkMember();return false;">
			<p class="label">이름</p>
			<input type="text" name="name" placeholder="이름">
			<p class="label">학번</p>
			<input type="text" name="studentID" placeholder="학번">
			<p class="label">전화 번호</p>
			<p class="explain"></p>
			<input type="text" name="phone" placeholder="전화 번호">
			<input type="submit" value="회원 확인">
		</form>

	</section>
	<section id="info" class="register">
		
		<form onsubmit="register();return false;">
			<p class="label">아이디</p>
			<input type="text" name="ID" placeholder="아이디">
			<p class="note"></p>
			
			<p class="label">비밀번호</p>
			<p class="explain">6자 이상 작성해주세요.</p>
			<input type="password" name="pass" placeholder="비밀번호">
			<p class="note"></p>

			<p class="label">비밀번호 확인</p>
			<input type="password" name="passCheck" placeholder="비밀번호">
			<p class="note"></p>


			<p class="label">닉네임</p>
			<p class="explain">게임 레이팅에 사용됩니다. 나중에 변경가능합니다.</p>
			<input type="text" name="nick" placeholder="닉네임">
			<p class="note"></p>
			<input type="submit" value="회원 가입">
		</form>
	</section>
	<footer>
		<p>만일 회원임에도 확인이 되지 않을 경우에는 회장에게 문의하시기 바랍니다.</p>
	</footer>
</body>
</html>