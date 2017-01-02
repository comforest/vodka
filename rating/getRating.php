<?php
	header("Content-Type:application/json");
	
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";

	$arr = array();
	if($result=$mysqli->query("SELECT game_id from rating_game")){
		while($data = $result->fetch_array(MYSQLI_ASSOC)){
			$arr[$data["game_id"]] = asdf($data["game_id"]);
		}
	}

	echo json_encode($arr);

	function asdf($game){
		global $mysqli;
		$arr = array();
		if($result = $mysqli->query("SELECT user_id, rating from rating_user where game_id=$game order by rating desc")){
			$rating = PHP_INT_MAX;
			$rank;
			$i = 1;
			while($data = $result->fetch_array(MYSQLI_ASSOC)){
				if($rating > $data["rating"]) $rank = $i;
				$u = User::FindByID($data["user_id"]);
				$arr[] = array("rank"=>"$rank", "name"=>$u["name"], "nickname"=>$u["nickname"], "rating"=>$data["rating"]);
				++$i;
			}
		}
		return $arr;
	}
?>