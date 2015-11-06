<?php
	
	include ('dbconnection.php');

	$review = $_POST['review'];
	$review = htmlspecialchars($review);
	$review = mysql_real_escape_string($review);

	$reviewer = $_POST['reviewer'];
	$reviewer = htmlspecialchars($reviewer);
	$reviewer = mysql_real_escape_string($reviewer);

	$rating = $_POST['review_rating'];

	$id = $_POST['id'];

	$result = mysql_query("INSERT INTO Review (name, time, mid, rating, comment) 
						   VALUES( '$reviewer', now(), '$id', '$rating', '$review' )");

	if (!$result)
	{
		die('Invalid query: ' .mysql_error());
	}
	else
	{
		$average_result = mysql_result(mysql_query("SELECT AVG(rating) FROM Review WHERE mid='$id'"), 0);
		$review_count = mysql_result(mysql_query("SELECT COUNT(*) FROM Review WHERE mid='$id'"), 0);
		$timestamp = mysql_result(mysql_query("SELECT MAX(time) FROM Review WHERE mid='$id'"), 0);

		$arr = array('review' => $review,
					 'reviewer' => $reviewer,
					 'rating' => $rating,
					 'id' => $id,
					 'average' => $average_result,
					 'count' => $review_count,
					 'time' => $timestamp);
		echo json_encode($arr);
	}

	// Close connection
    mysql_close($db_connection);

?>