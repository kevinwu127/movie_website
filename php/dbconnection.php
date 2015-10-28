<?php
	// Connect to database
	$db_connection = mysql_connect("localhost:1438", "cs143", "");
	// Check if the connection succeeded
	if (!db_connection) {
		$err = mysql_error($db_connection);
		print "Connection failed: $err <br />";
		exit(1);
	}
	// Select the database
	$db = mysql_select_db("CS143", $db_connection);

	if (!$db) {
		print "error, no database selected";
	}
?>