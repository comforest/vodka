<?php
	session_start();
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	include $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
	$phone = User::RemovePhoneHypen($_POST["phone"]);
	
	echo '감사합니다.<br>';

	switch ($_POST["sur"]) {
		case 'sin':
			$n = "신촌";
			echo '2016학년도 2학기 회비는 10,000원이며, 9월 11일까지 <b>우리 1002-153-381193 박준성</b>으로 입금해주시면 됩니다.
감사합니다!';
			break;
		case 'song':
			$n = "송도";
			echo '2016학년도 2학기 회비는 10,000원이며, 9월 11일까지 <b>우리 1002-153-381193 박준성</b>으로 입금해주시면 됩니다.
감사합니다!';

			if($_POST["list"] != ""){
				$query = "INSERT INTO survey VALUES($_SESSION[user],'$_POST[list]')";
				$mysqli->query($query);
			}
			break;
		case 'rest':
			echo '카카오톡 옐로아이디로 매 학기 연락 드릴 예정이니 차단하지 말아주세요.';
			$n = "X";
			break;
		case 'exit':
			echo '회원 조사가 끝난 후 일괄적으로 개인정보 삭제가 진행될 예정입니다.';
			$n = "탈퇴";
			break;
	}

	$query = "UPDATE user set phone='$phone', note='$n' where user_id=$_SESSION[user]";
	$mysqli->query($query);
	
?>