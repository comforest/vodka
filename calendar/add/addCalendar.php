<?php
	session_start();
	header("Content-Type:application/json");

	define("ERROR_UNDEFINE", 1);
	define("ERROR_DATAMISSING", 2);
	define("ERROR_ENDDATE", 3);

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/checkLogin.php";

	if(!checkAdmin()){
		notAdminJson();
	}

	if(!isset($_POST["data"])){
		$json = array("status"=>"Error","message"=>"Data missing","ErrorCode"=>ERROR_DATAMISSING);
		echo json_encode($json);
		exit;
	}

	$json = [];

	include $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
	$data = $_POST["data"];

	if($data["group"] === "true"){

		if(!isset($data["date"])){
			$json = array("status"=>"Error","message"=>"End date early","ErrorCode"=>ERROR_ENDDATE);			
		}

		$time = time();

		$query = "";
		foreach ($data["date"] as $key => $value) {
			$query .= "INSERT into calendar(date,text,type,calendar_group) value('$value','$data[text]',$data[type],$time);";
		}
		if($mysqli->multi_query ($query)){
			$json = array("status"=>"success");
			echo json_encode($json);
			exit;
		}
	}else{
		$sd = $data["start_date"];
		$ed = $data["end_date"];
		
		if($sd > $ed){
			$json = array("status"=>"Error","message"=>"End date early","ErrorCode"=>ERROR_ENDDATE);			
			echo json_encode($json);	
			exit;
		}

		$query = "INSERT into calendar(date,end_date,text,type) value('$data[start_date]','$data[end_date]','$data[text]',$data[type])";
		
		if($mysqli->query($query)){
			$json = array("status"=>"success");
			echo json_encode($json);
			exit;
		}

	}


	$json = array("status"=>"Error","ErrorCode"=>ERROR_UNDEFINE);
	echo json_encode($json);

?>