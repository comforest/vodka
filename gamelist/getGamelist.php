<?php
header("Content-Type:application/json");
$json = array();
require_once $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
require_once $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
$query = "SELECT name, user_id, note from game Order by name asc";

if($result = $mysqli->query($query)){
	while($data = $result->fetch_array(MYSQLI_NUM)){
		$json[] = array("game"=>$data[0],"user"=>USER::FindByID($data[1])["name"],"note"=>$data[2],"id"=>$data[1]);
	}
}
echo json_encode($json);
?>