<?php
session_start();
if($_SESSION["rank"] > 2){
	echo "<script>
	alert(\"접근 권한이 없습니다..\");
	location.href = \"/\";
	</script>";
}

	$uploaddir = './uploads/'; 
	$uploadfile = $uploaddir . basename($_FILES['userfile']['name']); 

	echo '<pre>'; 
	 if(($_FILES['userfile']['error'] > 0) || ($_FILES['userfile']['size'] <= 0)){ 
	      echo "파일 업로드에 실패하였습니다."; 
	 } else { 
	      // HTTP post로 전송된 것인지 체크합니다. 
	      if(!is_uploaded_file($_FILES['userfile']['tmp_name'])) { 
	            echo "HTTP로 전송된 파일이 아닙니다."; 
	      } else { 
	            // move_uploaded_file은 임시 저장되어 있는 파일을 ./uploads 디렉토리로 이동합니다. 
	            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) { 
	                 echo "성공적으로 업로드 되었습니다.\n"; 
	            } else { 
	                 echo "파일 업로드 실패입니다.\n"; 
	            } 
	      } 
	 } 


	print_r($_FILES); 
?>