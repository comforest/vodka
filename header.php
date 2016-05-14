<header class="header">
	<?php 
		if($_SESSION['user_id'] == ''){
			echo '<a href="\login.php">로그인</a>';
		}else{
			echo '<a href="\login.php">로그아웃</a>';
		}
	?>

	<nav class="nav">
		<ul>
			<li class="nav-icon">
				<img src="image/icon.png" alt="error">
				VDK
			</li>
			<li><a href="index.php">Home</a></li><!-- 
			 --><li><a href="notice.php">Notice</a></li><!-- 
			 --><li><a href="gamelist.php">Board Game List</a></li><!-- 
			 --><li><a href="member.php">Member List</a></li><!-- 
			 --><li><a href="">Free Board</a></li><!-- 
			 --><li><a href="">About</a></li>
		</ul>
	</nav>
</header>