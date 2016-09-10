<?php
include $_SERVER["DOCUMENT_ROOT"]."/static/php/security/mysql_data.php";	
$mysqli = new mysqli($mysql_server, $mysql_id, $mysql_pass, $mysql_db);
 
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>