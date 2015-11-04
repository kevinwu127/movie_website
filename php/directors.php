<?php
	include 'dbconnection.php';

	$result = mysql_query("SELECT id, CONCAT(first, ' ', last) AS name FROM Director");
	$data = array();
	while ( $row = mysql_fetch_assoc($result) )
	{
		/*$data['id'] = $row['id'];
		$data['name'] = $row['first'] . " " . $row['last'];*/
		$data[] = $row;
	}

	echo json_encode($data);

	// Close connection
    mysql_close($db_connection);
?>