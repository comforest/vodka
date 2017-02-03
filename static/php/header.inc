<!-- 
	전체 Header
-->
<script type="text/javascript" src="/static/javascript/header.js"></script>

<div id="home">
	<!-- <img src="/static/image/icon.png" alt="error"> -->
</div>
<header class="header">


	<span class="log">
		<?php
		if (isset($_SESSION["user"])) {
			echo '<a id="logout" href="/action/logout.php">로그아웃</a>';
		}else{
			echo '<a id="login" href="/user/login">로그인</a>';
		}
		?>
	</span>
</header>

<aside>
	<nav class="nav">
			<div class="menu">
				<p class="main_menu">일정</p>
				<ul class="detail_menu">
					<a href="/calendar/"><li id="calendar">일정</li></a>
					<a href="/calendar/attend"><li id="attend">출석부</li></a>
				</ul>
			</div>
			<div class="menu select">
				<p class="main_menu">정보</p>
				<ul class="detail_menu">
					<a href="/info/member"><li id="member">회원 목록</li></a>
					<a href="/info/gamelist"><li id="gamelist">보드게임 목록</li></a>
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