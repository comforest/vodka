<!-- 공지사항 페이지 -->
<?php session_start();
	if(!isset($_SESSION["rank"]) && $_SESSION["rank"] > 2){
		echo "<script>
    	alert(\"잘못 된 접근입니다.\");
    	location.href = \"/login\";
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
	<section> 
		<form> 
			
		</form>
	</section>
	<section> 

	</section>
	
</body>
</html>