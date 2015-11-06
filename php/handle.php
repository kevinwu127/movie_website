<?php 

	include ('dbconnection.php');

	switch($_POST['type']) {
		case 'actor':
			
			$actorFirst = $_POST['actorFirst'];
			$actorFirst = htmlspecialchars($actorFirst);
			$actorFirst = mysql_real_escape_string($actorFirst);

			$actorLast = $_POST['actorLast'];
			$actorLast = htmlspecialchars($actorLast);
			$actorLast = mysql_real_escape_string($actorLast);

			$actorGender = $_POST['gender'];

			$actorDob = $_POST['actorDob'];
			$actorDob = htmlspecialchars($actorDob);
			$actorDob = mysql_real_escape_string($actorDob);
			$actorDob = date('Y-m-d', strtotime(str_replace('-', '/', $actorDob)));

			$actorDod = $_POST['actorDod'];
			$actorDod = htmlspecialchars($actorDod);
			$actorDod = mysql_real_escape_string($actorDod);
			if ($actorDod != "")
				$actorDod = date('Y-m-d', strtotime(str_replace('-', '/', $actorDod)));
			else
				$actorDod = "NULL";

			$id_query = "SELECT id 
						 FROM MaxPersonID";
			$result = mysql_query($id_query);

			$id = mysql_result($result, 0) + 1;
			
			$query = "INSERT INTO Actor ( id, last, first, sex, dob, dod )
					  VALUES ( '$id', '$actorLast', '$actorFirst', '$actorGender', '$actorDob'," . ($actorDod == "NULL" ? $actorDod : "'$actorDod'") . ")";

			$add_result = mysql_query($query);
			if( !$add_result )
				die('Invalid query: ' .mysql_error());
			else
			{
				$update_id_query = "UPDATE MaxPersonID
									SET id = id + 1";
				$update_result = mysql_query($update_id_query);
				if( !$update_result )
					die('Invalid query: ' .mysql_error());
				else
					echo "Successfully added " . $actorFirst . " " . $actorLast . " to the Actor Table!";
			}

			break;
		case 'director':

			$directorFirst = $_POST['directorFirst'];
			$directorFirst = htmlspecialchars($directorFirst);
			$directorFirst = mysql_real_escape_string($directorFirst);

			$directorLast = $_POST['directorLast'];
			$directorLast = htmlspecialchars($directorLast);
			$directorLast = mysql_real_escape_string($directorLast);

			$directorDob = $_POST['directorDob'];
			$directorDob = htmlspecialchars($directorDob);
			$directorDob = mysql_real_escape_string($directorDob);
			$directorDob = date('Y-m-d', strtotime(str_replace('-', '/', $directorDob)));

			$directorDod = $_POST['directorDod'];
			$directorDod = htmlspecialchars($directorDod);
			$directorDod = mysql_real_escape_string($directorDod);
			if($directorDod != "")
				$directorDod = date('Y-m-d', strtotime(str_replace('-', '/', $directorDod)));
			else
				$directorDod = "NULL";

			$id_query = "SELECT id 
						 FROM MaxPersonID";
			$result = mysql_query($id_query);

			$id = mysql_result($result, 0) + 1;
			
			$query = "INSERT INTO Director ( id, last, first, dob, dod )
					  VALUES ( '$id', '$directorLast', '$directorFirst', '$directorDob'," . ($directorDod == "NULL" ? $directorDod : "'$directorDod'") . ")";

			$add_result = mysql_query($query);
			if( !$add_result )
				die('Invalid query: ' .mysql_error());
			else
			{
				$update_id_query = "UPDATE MaxPersonID
									SET id = id + 1";
				$update_result = mysql_query($update_id_query);
				if( !$update_result )
					die('Invalid query: ' .mysql_error());
				else
					echo "Successfully added " . $directorFirst . " " . $directorLast . " to the Director Table!";
			}



			break;
		case 'movie':

			$movieTitle = $_POST['movieTitle'];
			$movieTitle = htmlspecialchars($movieTitle);
			$movieTitle = mysql_real_escape_string($movieTitle);

			$company = $_POST['company'];
			$company = htmlspecialchars($company);
			$company = mysql_real_escape_string($company);

			$year = $_POST['year'];
			$year = htmlspecialchars($year);
			$year = mysql_real_escape_string($year);

			$rating = $_POST['rating'];

			$genre = $_POST['genre'];

			$id_query = "SELECT id 
						 FROM MaxMovieID";
			$result = mysql_query($id_query);

			$id = mysql_result($result, 0) + 1;

			$query = "INSERT INTO Movie ( id, title, year, rating, company )
					  VALUES ( '$id', '$movieTitle', '$year', '$rating', '$company' )";
			
			$add_result = mysql_query($query);
			if( !$add_result )
				die('Invalid query:' .mysql_error());
			else
			{
				foreach ( $genre as $selected )
				{
					$genre_query = "INSERT INTO MovieGenre ( mid, genre )
									VALUES ( '$id', '$selected' )";
					$genre_result = mysql_query($genre_query);
					if (!$genre_result)
						die('Invalid query: ' .mysql_error());
				}

				$update_id_query = "UPDATE MaxMovieID
									SET id = id + 1";
				$update_result = mysql_query($update_id_query);
				if( !$update_result )
					die('Invalid query: ' .mysql_error());
				else
					echo "Successfully added " . $movieTitle . " to the Movie Table!";
			}

			break;
		case 'relation':
			
			if ($_POST['relation'] == 'movie_actor')
			{
				$movie_id = $_POST['movie_actor_movie'];
				$actor_id = $_POST['movie_actor_actor'];
				$role = $_POST['role'];
				$role = htmlspecialchars($role);
				$role = mysql_real_escape_string($role);

				if ($movie_id == "" || $actor_id == "" || $role == "")
				{
					echo "Please fill in all blanks";
					break;
				}
				else
				{
					$movie_actor_query = "INSERT INTO MovieActor ( mid, aid, role )
										  VALUES ( '$movie_id', '$actor_id', '$role' )";
					$result = mysql_query($movie_actor_query);
					if( !$result )
						die('Invalid query:' .mysql_error());
					else
					{
						echo "Successfully added to the MovieActor Table!";
					}
				}
			}
			else
			{
				$movie_id = $_POST['movie_director_movie'];
				$director_id = $_POST['movie_director_director'];
				if ($movie_id == "" || $director_id == "")
				{
					echo "Please fill in all blanks";
					break;
				}
				else
				{
					$movie_director_query = "INSERT INTO MovieDirector ( mid, did )
											 VALUES ( '$movie_id', '$director_id' )";
					$result = mysql_query($movie_director_query);
					if( !$result )
						die('Invalid query:' .mysql_error());
					else
					{
						echo "Successfully added to the MovieDirector Table!";
					}
				}
			}

			break;
	}

	// Close connection
    mysql_close($db_connection);
?>