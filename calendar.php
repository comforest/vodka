<?php
	$db = mysql_connect('localhost:3306','root','1234');
	if (!$db) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("vdk");

	$result = mysql_query("SELECT * FROM calendar");
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	}

	while($field=@mysql_fetch_field ($result)){

	}

	while($data = mysql_fetch_row($result)){
		foreach($data as $i){
			echo "<p>".$i.	"</p>";
		}
	}
	mysql_close($db);
?>