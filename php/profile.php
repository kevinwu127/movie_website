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

    <div class="container scene_element scene_element--fadeinup">
    	<div class="starter-template">
    		<div class="profile">



				<?php 

					include('dbconnection.php');

					$id = $_GET['id'];
					$result = mysql_fetch_assoc(mysql_query("SELECT * FROM Actor WHERE id='$id'"));
					if ($result)
					{
						echo "<h1>" . $result['first'] . " " . $result['last'] . "</h1><br />";
						
								echo "<div class='col-sm-4' style='text-align:right'>";
									echo "<p>Sex: </p></br />";
									echo "<p>Date of Birth: </p><br />";
									echo "<p>Date of Death: </p><br /><br />";
									echo "<p>Starred in: </p>";
								echo "</div>";
								echo "<div class='col-sm-8' style='text-align:left'>";
									echo "<p>" . $result['sex'] . "</p><br />";
									echo "<p>" . $result['dob'] . "</p><br />";
									echo "<p>" . ($result['dod'] == NULL ? 'Alive' : $result['dod']) . "</p><br /><br />";

									// Find the movies and roles
									$roles_result = mysql_query("SELECT * FROM MovieActor WHERE aid='$id'");
									while ($roles = mysql_fetch_assoc($roles_result))
									{
										$mid = $roles['mid'];
										$movie = mysql_fetch_assoc(mysql_query("SELECT id, title FROM Movie WHERE id='$mid'"));
										echo "<ul style='list-style-type:none;'>";	
											echo "<div class='row' style='padding-bottom:0;'>";
												echo "<li class='col-xs-6 movie_starred'>";
													$title = $movie['title'];
													if (strlen($title) > 25)
													{
														$title = substr($title, 0, 25);
														$title = $title . "...";
													}
													echo "<p class='movie_page_link'><b>" . $title . "</b></p>";
													echo "<p class='movie_id' style='display:none;'>" . $movie['id'] . "</p>";
												echo "</li>";
												echo "<div class='col-sm-6'>";
													echo "<p> as " . $roles['role'] . "</p>";
												echo "</div>";
											echo "</div>";
										echo "</ul>";				
									}
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
    <script src="../js/jquery.barrating.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/flat-ui.min.js"></script>
    <script src="../js/radiocheck.js"></script>
    <script src="../js/application.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->

  </body>
</html>