<!-- game Edit Page -->
<?php session_start();
	if(!isset($_SESSION["user"])){
		echo '<script> 
			alert("잘못 된 접근입니다."); 
			window.close(); 
			</script>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>VoDKa</title>

	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../dialog.css">


	
	<script type="text/javascript">
		function editGame(){
			var id = <?php echo $_POST['id']?>;
			var name = $("input[name=\'name\']").val();
			var note = $("input[name=\'note\']").val();
			var difficulty = $("input[name=\'difficulty\']").val();
			$.ajax({
				url:"edit.php",
				type:"post",
				data:{id:id,note:note,name:name,difficulty:difficulty},
				success:function(data){
					opener.location.reload(true);
					window.close();
				}
			});		
		}
	</script>
	
</head>
<body>
	<section class="addGame">
		게임 이름 : <input type="text" name="name" value=<?php echo $_POST["game"]?> ><br>
		난이도 : <input type="number" name="difficulty" min="1" max="5" value=<?php echo $_POST["diff"]?>><br>
		비고 : <input type="text" name="note" value=<?php echo $_POST["note"]?> ><br>

		<input type="submit" value="확인" onclick="editGame();">
	</section>
</body>
</html>