<?php
header("Content-Type:application/json");
$mysqli = new mysqli("localhost", "root", "", "vodka");

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$date = $_POST["year"]."-".$_POST["month"]."-1";
$ldate = $_POST["year"]."-".((int)$_POST["month"]+1)."-1";
$query = "SELECT date,text FROM calendar WHERE date >= '".$date."' and date < '".$ldate."' ORDER BY date ASC";
/* Select queries return a resultset */
if ($result = $mysqli->query($query)) {
	$arr = [];
	while($data = $result->fetch_array(MYSQLI_NUM)){
 		$arr[] = array ('date' => $data[0], 'text' => $data[1]);//, 'url' => $data[2]);
	}

	echo json_encode($arr);
    /* free result set */
    $result->close();
}

$mysqli->close();
?>