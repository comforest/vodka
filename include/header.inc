<!-- 
	전체 Header
-->
<header class="header">
	<?php 
		if(!isset($_SESSION['user'])){
			echo '<a href="/login">로그인</a>';
		}else{
			echo '<a href="/action/logout_action.php">로그아웃</a>';
		}
	?>

	<nav class="nav">
		<ul>
			<li class="nav-icon">
				<img src="/static/image/icon.png" alt="error">
				VDK
			</li>
			<li><a href="/">Home</a></li><!-- 
			 --><li><a href="/notice">Notice</a></li><!-- 
			 --><li><a href="/gamelist">Board Game List</a></li><!-- 
			 --><li><a href="/member">Member List</a></li><!-- 
			 --><li><a href="/myPage">My Page</a></li><!-- 
			 --><li><a href="">About</a></li>
		</ul>
	</nav>
</header>