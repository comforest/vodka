<?php

	header("Content-Type:application/json");
	include "$_SERVER[DOCUMENT_ROOT]/static/php/mysqli.inc";
	include "$_SERVER[DOCUMENT_ROOT]/static/php/userInfo.php";


	$Cid = $_POST["id"];
	$result = [];

	$arr1 = [];
	$arr2 = [];
	$list = array_unique($_POST["list"]);
	foreach ($list as $k => $v) {
		$user = User::FindByName($v);
		if(count($user) == 1){
			$u = $user[0];
			$Uid = $u["user_id"];
			if($mysqli->query("SELECT * FROM attend WHERE calendar_id=$Cid and user_id=$Uid")->num_rows > 0) continue;

			$mysqli->query("INSERT into attend value($Cid,$Uid)");
 			$arr1[] = array ("name"=>$u["name"], "student_id"=>User::getShortStudentID($u["student_id"]), "major"=>$u["major"]);

		}else if(count($user) > 1){
			$arr3 = [];
			foreach ($user as $key => $u) {
				if($u["location"] == "") continue;
			
				$result = $mysqli->query("SELECT * from attend WHERE calendar_id=$Cid and user_id=$u[user_id]");
				
				$str = "";
				if($result->num_rows == 1) $str.= " checked";
 				$arr3[] = array ("id"=>$u["user_id"], "name"=>$u["name"],"student_id"=>User::getShortStudentID($u["student_id"]),"major"=>$u["major"], "checked"=>$str);

			}
			$arr2[] = $arr3;
		}
	}

	$result = array("complete"=>$arr1,"samename"=>$arr2);
	
	echo json_encode($result);
?>