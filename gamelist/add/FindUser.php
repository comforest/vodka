<?php 
header("Content-Type:application/json");
require_once $_SERVER["DOCUMENT_ROOT"]."/include/userInfo.php";
$arr = User::FindbyName($_POST["user"]);
echo json_encode($arr);
?>