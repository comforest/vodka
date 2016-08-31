<?php
	include $_SERVER["DOCUMENT_ROOT"]."/include/mysqli.inc";
	$b = 0;
	if($_POST['val'] == "true"){
		$b = 1;
	}
	$mysqli->query("Update user set fee=$b where user_id=$_POST[id]")
?>