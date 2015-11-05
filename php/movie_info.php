<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>OZAI</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/flat-ui.min.css" rel="stylesheet">

    <!-- Google font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300" type="text/css">

    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="new-body m-scene" id="main">

    <!-- NAV BAR -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../index.html">&nbsp;&nbsp;
            <span class="glyphicon glyphicon-fire scene_element scene_element--fadein" aria-hidden="true"></span>
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="../index.html">Home</a></li>
            <li><a href="../new.html">Add New</a></li>
            <li class="active"><a href="#browse">Browse</a></li>
          </ul>
          <form class="navbar-form navbar-right" action="search.php" role="search" method="get">
            <div class="form-group">
              <div class="input-group">
                <input class="form-control" name="search" type="search" placeholder="Search">
                <span class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </span>
              </div>
            </div>
          </form>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container-fluid scene_element scene_element--fadeinup">
    	<div class="starter-template">
    		<div class="profile">



				<?php 

					include('dbconnection.php');

					$id = $_GET['id'];
					$result = mysql_fetch_assoc(mysql_query("SELECT * FROM Movie WHERE id='$id'"));
					if ($result)
					{
						echo "<h1>" . $result['title'] . "</h1><br />";
							echo "<div class='col-md-6'>";

								echo "<ul style='list-style-type:none;'>";	

								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>Production Year: </p>";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										echo "<p>" . $result['year'] . "</p>";
									echo "</div>";
								echo "</div>";

								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>Producer: </p>";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										echo "<p>" . $result['company'] . "</p>";
									echo "</div>";
								echo "</div>";

								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>MPAA Rating: </p>";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										echo "<p>" . $result['rating'] . "</p>";
									echo "</div>";
								echo "</div>";

								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>Director(s): </p>";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										$directors_result = mysql_query("SELECT * FROM MovieDirector WHERE mid='$id'");
										while ($directors = mysql_fetch_assoc($directors_result))
										{
											$did = $directors['did'];
											$director = mysql_fetch_assoc(mysql_query("SELECT first, last, dob FROM Director WHERE id='$did'"));
											echo "<p>" . $director['first'] . " " . $director['last'] . " (" . $director['dob'] . ") </p>";
										}
									echo "</div>";
								echo "</div>";

								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>Genre: </p><br />";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										$genres = "";
										$genres_result = mysql_query("SELECT genre FROM MovieGenre WHERE mid='$id'");
										while ($genre = mysql_fetch_assoc($genres_result))
										{
											$genres = $genres . $genre['genre'] . ', ';
										}
										$genres = substr($genres, 0, -2);
										echo "<p>" . $genres . "</p>";
									echo "</div>";
								echo "</div>";



								echo "<div class='row' style='padding-bottom:0;'>";
									echo "<li class='col-sm-4' style='text-align:right'>";
										echo "<p>Actors: </p><br /><br />";
									echo "</li>";
									echo "<div class='col-sm-8' style='text-align:left'>";
										$actors_result = mysql_query("SELECT * FROM MovieActor WHERE mid='$id'");
										while ($actors = mysql_fetch_assoc($actors_result))
										{
											$aid = $actors['aid'];
											$actor = mysql_fetch_assoc(mysql_query("SELECT id, first, last, dob FROM Actor WHERE id='$aid'"));
											echo "<div class='actor_links'>";
												echo "<p class='actor_page_link'><b>" . $actor['first'] . " " . $actor['last'] . " (" . $actor['dob'] . ") </p></b>";
												echo "<p class='actor_id' style='display:none;'>" . $actor['id'] . "</p>";
											echo "</div>";
										}
									echo "</div>";
								echo "</div>";


								echo "</ul>";
							echo "</div>";

							echo "<div class='col-md-6'>";
								
								echo "<p>Comments</p>";

							echo "</div>";
						
						}

					// Close connection
              		mysql_close($db_connection);
				?>

			</div><!-- /profile -->
		</div><!-- /starte-template -->
	</div><!-- /container -->

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.smoothState.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/flat-ui.min.js"></script>
    <script src="../js/radiocheck.js"></script>
    <script src="../js/application.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

  </body>
</html>