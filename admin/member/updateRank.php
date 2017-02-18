<?php
	session_start();
	header("Content-Type:application/json");

	$json = [];
	if(!isset($_SESSION["rank"]) || $_SESSION["rank"] > 2){
		$json = array("status"=>"ErrorRank");
		echo json_encode($json);
		exit;
	}
		
	if(!isset($_POST["rank"]) || $_POST["rank"] <= $_SESSION["rank"]){
		$json = array("status"=>"ErrorRank");
		echo json_encode($json);
		exit;
	}
		

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";

	$arr = $_POST["list"];

	foreach ($arr as $key => $value) {
		$query = "UPDATE user set rank=$_POST[rank] where user_id = $value and rank > $_SESSION[rank]";
		if($result = $mysqli->query($query)){
			$json[] = $value;
 		}
	}

	$json = array("status"=>"success","message"=>$json);
	echo json_encode($json);
?>