<!-- 
	전체 Header
-->
<script type="text/javascript" src="/static/javascript/header.js"></script>

<div id="home">
	<!-- <img src="/static/image/icon.png" alt="error"> -->
</div>
<header class="header">



	<!-- <section class='login_active'>
		<?php
		if (isset($_SESSION["user"])) {
			include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
			$user = User::FindByID($_SESSION["user"]);
			echo "<p>$user[name]($user[nickname])</p>";
		}
		?>

	</section>
	-->


	<?php
		if(!isset($_SESSION["user"])){
	?>
	<section class="login">

		<form method="POST" class="login_input" onsubmit="login();return false;">
			<div>
				<input type="text" name="id" placeholder="ID">
				<input type="password" name="pass" placeholder="PassWord">
			</div><input type="submit" value="로그인">
		</form>
		<!-- <input type="checkbox"> 자동 로그인 -->
	</section>

	<?php } ?> 
</header>

<aside>
	<nav class="nav">
			<div class="menu">
				<p class="main_menu">일정</p>
				<ul class="detail_menu">
					<a href="/calendar/"><li>일정</li></a>
					<a href="/calendar/attend"><li>출석부</li></a>
				</ul>
			</div>
			<div class="menu select">
				<p class="main_menu">정보</p>
				<ul class="detail_menu">
					<a href="/info/member"><li class="select_menu">회원 목록</li></a>
					<a href="/info/gamelist"><li>보드게임 목록</li></a>
				</ul>
			</div>
			<div class="menu">
				<p class="main_menu">레이팅</p>
				<ul class="detail_menu">
					<li>일정</li>
					<li>출석부</li>
				</ul>
			</div>
		</nav>
</aside>