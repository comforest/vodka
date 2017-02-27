<?php
	session_start();
	// header("Content-Type:application/json");

	$json = [];
	if(!isset($_SESSION["rank"]) || $_SESSION["rank"] > 2){
		$json = array("status"=>"ErrorRank");
		echo json_encode($json);
		exit;
	}

	if(!isset($_POST["data"])){
		$json = array("status"=>"Error","message"=>"Data missing");
		echo json_encode($json);
		exit;
	}


	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$data = $_POST["doata"];

	if($data["group"] === "true"){

		print_r($data);

		$time = time() - 1480000000;

		foreach ($data["date"] as $key => $value) {
			echo $query = "INSERT into calendar(date,text,type,calendar_group) value('$value','$data[text]',$data[type],$time)";
			// $mysqli->query($query);
		}
	}else{
		$sd = $data["start_date"];
		$ed = $data["end_date"];
		
		if($sd > $ed){
			$json = array("status"=>"Error","message"=>"End date early");
			echo json_encode($json);	
			exit;
		}

		$query = "INSERT into calendar(date,end_date,text,type) value('$data[start_date]','$data[end_date]','$data[text]',$data[type])";

		$mysqli->query($query);

	}



?>