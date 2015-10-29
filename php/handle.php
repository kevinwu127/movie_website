<?php 

	switch($_POST['type']) {
		case 'actor':
			echo 'This is the actor field';
			break;
		case 'director':
			echo 'This is the director field';
			break;
		case 'movie':
			echo 'This is the movie field';
			break;
		case 'relation':
			echo "This is the relation field\n";
			$relationType = $_POST['relation'];
			echo 'With the relation ' .$relationType;
			break;
	}
?>