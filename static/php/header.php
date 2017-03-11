<!-- 
	전체 Header
-->
<script type="text/javascript" src="/static/javascript/header.js"></script>

<div id="home">
	<!-- <img src="/static/image/icon.png" alt="error"> -->
</div>
<header class="header">


	<?php
	if (isset($_SESSION["user"])) {
		require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
		echo '<a id="logout" href="/action/logout.php">로그아웃</a>';
	}else{
		echo '<a id="login" href="/user/login">로그인</a>';
	}
	?>
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
			<div class="menu">
				<p class="main_menu">정보</p>
				<ul class="detail_menu">
					<a href="/info/member"><li id="member">회원 목록</li></a>
					<a href="/info/gamelist"><li id="gamelist">보드게임 목록</li></a>
				</ul>
			</div>
			<div class="menu">
				<p class="main_menu">레이팅</p>
				<ul class="detail_menu">
					<a href="/rating"><li id="rating">레이팅 현황</li></a>
					<a href="/rating/add"><li id="addRating">레이팅 등록</li></a>
				</ul>
			</div>
			<?php
				if(isset($_SESSION["rank"]) && $_SESSION["rank"] <= 2){
					echo '
					<div class="menu">
						<p class="main_menu">관리 페이지</p>
						<ul class="detail_menu">
							<a href="/admin/member"><li id="adminMember">맴버 정보</li></a>
						</ul>
					</div>
					';
				}
			?>
		</nav>
</aside>