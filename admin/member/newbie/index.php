<!-- 관리-회원 페이지 -->
<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/static/php/checkLogin.php";

if(!checkLogin()){
	notLoginIndex();
}
if(!checkAdmin()){
	notAdminIndex();
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