<!-- 관리-회원 페이지 -->
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

</head>
<body>

	<section>
		 <form enctype="multipart/form-data" action="memberUpload.php" method="POST">		
		    신입 회원 목록을 양식에 맞춰 입력해주세요.<br>
		    <input name="userfile" type="file" /><br><br>
		    <input type="submit" value="파일 전송" />
		 </form>
	 	<br> <br> <br>
	    <a href="pattern.php">
	    	<button>양식 다운 받기</button>
	    </a>
	</section>

</body>
</html>