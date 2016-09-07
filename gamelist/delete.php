<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"]."/static/php/mysqli.inc";
if(!isset($_SESSION["user"])){

}else if($_SESSION["rank"] <= 2){
	echo $mysqli->query("delete from game where game_id = ".$_POST["id"]);
}else{
	echo $mysqli->query("delete from game where game_id = ".$_POST["id"]." and user_id = ".$_SESSION["user"]);
}
?>