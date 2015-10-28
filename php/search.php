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
            <li class="active"><a href="#">Browse</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1 class=" scene_element scene_element--fadein">Search Results</h1>
        
        <!-- PHP SCRIPT HERE -->
        <?php
              include('dbconnection.php');

              if ($_GET['search'])
              {
                  $search = $_GET['search'];
                  $search = htmlspecialchars($search);
                  $search = mysql_real_escape_string($search);

                  $search_terms = explode(' ', $search);

                  // search in Actor
                  $actor_query = "SELECT *
                                  FROM Actor
                                  WHERE last LIKE '%$search_terms[1]%'
                                  AND first LIKE '%$search_terms[0]%';";

                  $actor_result = mysql_query($actor_query, $db_connection);
                  if (mysql_num_rows($actor_result) > 0)
                  {
        ?>
                      <table class="table table-condensed table-hover scene_element scene_element--fadein">
                        <thead class="table-header">
                          <tr>
                            <th>&nbsp;&nbsp;Name</th>
                            <th>Date of Birth</th>
                            <th>Date of Death</th>
                          </tr>
                        </thead>
                        <tbody>
        <?php
                      $i = 1; // new line
                      while ($results = mysql_fetch_assoc($actor_result)) 
                      {
        ?>
                          <tr>
                            <td>&nbsp;&nbsp;<?php echo $results['first']."&nbsp;".$results['last'] ?></td>
                            <td><?php echo $results['dob'] ?></td>
                            <td><?php echo $results['dod'] ?></td>
                          </tr>
        <?php
                      }
        ?>
                        </tbody>
                      </table>
        <?php
                  }
                  else
                  {
                      echo "Failed!";
                  }

              }
              else
              {
                  echo "<p>There's nothing here...</p>";
              }


              // Close connection
              mysql_close($db_connection);
        ?>
      </div><!-- /starter-template -->
       
      <form class="input-group center-search-bar scene_element scene_element--fadeinup" role="search" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input name="search" type="text" class="form-control" placeholder="Search again...">
        <span class="input-group-btn">
          <button class="btn" type="submit"><span class="fui-search"></span></button>
        </span>
      </form>

      <div class="scroll-top-wrapper">
        <span class="scroll-top-inner">
          <span class="glyphicon glyphicon-chevron-up scroll" aria-hidden="true"></span>
        </span>
      </div>


    </div><!-- /.container -->


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