<?php
	include 'dbconnection.php';

	$result = mysql_query("SELECT id, title FROM Movie");
	$data = array();
	while ( $row = mysql_fetch_assoc($result) )
		$data[] = $row;
	echo json_encode($data);
	
	// Close connection
    mysql_close($db_connection);

?>