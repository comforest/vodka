<?php
	header("Content-Type:application/json");

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/userInfo.php";
	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$arr = $_POST['data']['detail'];
	$game = $_POST['data']['game'];

	foreach($arr as $k => $v){
		$nick = strtolower($v['name']);
		$u = User::FindByNickname($nick);

		if(!isset($u['user_id'])){
			echo json_encode(array("status"=>"ErrorNick", "message"=>$u));
			return;			
		}
		$query = "SELECT rating from rating_user where user_id=$u[user_id] and game_id=$game";

		if($result = $mysqli->query($query)){
			if($result->num_rows == 0){
				$mysqli->query("INSERT into rating_user value($game,$data[user_id],500)");
				$arr[$k] = array("rank"=>$arr[$k]["rank"], "score"=>$arr[$k]["score"], "rating"=>500, "user"=>$data["user_id"]);	
			}else if($data = $result->fetch_array(MYSQLI_ASSOC)){
				$arr[$k] = array("rank"=>$arr[$k]["rank"], "score"=>$arr[$k]["score"], "rating"=>$data["rating"], "user"=>$u["user_id"]);
			}
		}
	}


	$date = date("Y-m-d h:i:s",time());
	$json = json_encode($arr);
	$query = "INSERT into rating_info(game_id, time, number, detail) value($game, '$date',".count($arr).", '$json')";
	$mysqli->query($query);






	foreach($arr as $k => $v){
		$query = "UPDATE rating_user set rating = $v[rating] + ".delta($k)." where user_id = $v[user]";
		$mysqli->query($query);
	}
	echo json_encode(array("status"=>"success"));


	function delta($i){
		global $arr;
		$n = count($arr);
		return 100.0 * (($n-$arr[$i]['rank'])/($n-1) - expected($i));
	}

	function expected($i){
		global $arr;
		$sum = 0.0;
		$n = count($arr);
		foreach($arr as $k => $v){
			if($i == $k) continue;
			$sum += winProbability($arr[$i]["rating"],$v["rating"]);
		}
		return $sum/($n-1);
	}

	// winProbability
	// param -	r1 : 자기 rating
	//			r2 : 상대 rating
	function winProbability($r1, $r2){
		$n = 1.0/(1+(pow(10,($r2 - $r1)/500)));
		return $n;
	}
	
?>