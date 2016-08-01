<!-- My Page -->
<?php
	session_start();
	if(!isset($_SESSION["user"])){
		echo "<script>
    	alert(\"로그인을 하셔야 이용가능합니다.\");
    	location.href = \"/login.php\";
    	</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<link rel="stylesheet" type="text/css" href="/static/css/header.css">
</head>
<body>

	<?php
		include $_SERVER["DOCUMENT_ROOT"]."/include/header.inc";
	?>

	<section id="myInfo">
		<h3>내정보</h3>
	</section>

	<section id="gamelist">
		<h3>내 게임</h3>
	</section>

</body>
</html>