<?php

	header("Content-Type:application/json");
	$db = mysqli_connect('localhost:3306','root','1234',"vdk");
	if (!$db) {
		die('Could not connect: ' . mysqli_error());
	}

	$date = $_POST["year"]."-".$_POST["month"]."-1";
	$ldate = $_POST["year"]."-".((int)$_POST["month"]+1)."-1";
	$query = "SELECT date,text,url FROM calendar WHERE date >= '".$date."' and date < '".$ldate."' ORDER BY date ASC";
	$result = mysqli_query($query);
	if (!$result) {
		die('Invalid query: ' . mysqli_error());
	}

	while($field=mysqli_fetch_field ($result)){

	}

	$arr;
	while($data = mysqli_fetch_row($result)){
 		$arr[] = array ('date' => $data[0], 'text' => $data[1], 'url' => $data[2]);
	}


	mysqli_close($db);
	echo json_encode($arr);
	
?>