<!-- 
	전체 Header
-->
<script type="text/javascript" src="/static/javascript/header.js"></script>

<header>
	<div id="home">
		<!-- <img src="/static/image/icon.png" alt="error"> -->
	</div>
	<nav class="nav">
		<ul>
			<li><a href="/">Home</a></li><!-- 
			 --><li><a href="/notice">Notice</a></li><!-- 
			 --><li><a href="/gamelist">Board Game List</a></li><!-- 
			 --><li><a href="/member">Member List</a></li><!-- 
			 --><li><a href="/myPage">My Page</a></li><!-- 
			 --><li><a href="">About</a></li><!--
			 --><?php
			 	if(isset($_SESSION['rank']) && $_SESSION['rank'] <= 2)
			 		echo '<li><a href="/admin/fee">회비 관리</a></li>';
			 	?>
		</ul>
	</nav>
</header>

<aside>
	<section class="login">
		<div>
			<input type="text" name="id" placeholder="ID">
			<input type="text" name="PW" placeholder="PassWord">
		</div><input type="submit" value="로그인">
	</section>
</aside>