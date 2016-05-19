<?php

	header("Content-Type:application/json");
	$db = mysql_connect('localhost:3306','root','1234');
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("vdk");

	$date = $_POST["year"]."-".$_POST["month"]."-1";
	$ldate = $_POST["year"]."-".((int)$_POST["month"]+1)."-1";
	$query = "SELECT date,text,url FROM calendar WHERE date >= '".$date."' and date < '".$ldate."' ORDER BY date ASC";
	$result = mysql_query($query);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	while($field=@mysql_fetch_field ($result)){

	}

	$arr;
	while($data = mysql_fetch_row($result)){
 		$arr[] = array ('date' => $data[0], 'text' => $data[1], 'url' => $data[2]);
	}


	mysql_close($db);
	echo json_encode($arr);
	
?>