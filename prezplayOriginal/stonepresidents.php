<!DOCTYPE html>
<html>
<head>
    <title>Presidents of the United States of America</title>

    <script src="../../js/jquery-214.js"></script>
    <script src="../../js/jquery_play.js"></script>

    <link rel="stylesheet" type="text/css" href="../../js/bootstrap/css/bootstrap.min.css">
    <script src="../../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../js/bootstrap/css/justified-nav.css">

    <LINK href="../favicon.ico" rel="icon" type="image/x-icon">
    <LINK href="../favicon.ico" rel="shortcut icon" type="image/x-icon">
    <LINK href="../favicon.ico" rel="icon" type="image/ico">

</head>
<body>
	<div class="container">

            <DIV class="masthead">
                <a href="http://www.jotascript.com"><img src="../../croppedmore-js-headerUnicorn.png" width="680" height="198" alt="Curiosity created a unicorn"/></a>

            </div> <!-- /masthead -->

            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="http://www.jotascript.com">Home</a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="http://www.jotascript.com/tutes/tutes.htm">Tutorials</a></li>
                            <li><a href="http://www.jotascript.com/education.htm">Education<span class="sr-only"> (current)</span></a></li>
                            <li><a href="http://www.jotascript.com/experience.htm">Experience</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="https://jotascript.wordpress.com">Blog</a></li>
                        </ul>
                    </div> <!-- /collapse -->
                </div> <!-- /container-fluid -->

            </nav> <!-- /navbar -->
            <!-- main -->

	<div class="panel panel-default">
		<div class="panel-heading"><h4>Ye Olde Presidents of the United States of America</h4></div>
			<div class="panel-body">
				<!-- Panel Content -->
                <!-- old
        <a href="../index.php" class="btn btn-primary">Log In to Play</a>
        -->
        <!-- new -->
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Log In to Play</button>
<?php

// PHP code in a more secure location

    include("../../php/boneyard.php");

//Uses PHP code to connect to database

	mysql_select_db("jscript_presidents", $connekt);

// Connection test and feedback

  if (!$connekt)

  {

    die('Rats! Could not connect: ' . mysql_error());

  }

// Create variable for query

    $query = "SELECT * FROM presidents ORDER BY presidents.firstYear ASC";

// Use variable with MySQL command to grab info from database

	$result = mysql_query($query);

// Start creating an HTML table and create header row

    echo "<table class='table table-striped table-hover'>";

    echo "<thead><tr><th>First Name</th><th>Last Name</th><th>Party</th><th>First Year</th><th>Last Year</th></tr></thead><tbody>";



 // Create a row in HTML table for each row from database

    while ($row = mysql_fetch_array($result)) {

      echo "<tr>";
      echo "<td>" . $row["firstName"] . "</td>";
      echo "<td>" . $row["lastName"] . "</td>";
      echo "<td>" . $row["party"] . "</td>";
      echo "<td>" . $row["firstYear"] . "</td>";
  		echo "<td>" . $row["lastYear"] . "</td>";
      echo "</tr>";

    }

// Finish creating HTML table

    echo "</tbody></table>";

// When attempt is complete, connection closes

    mysql_close($connekt);

?>
			</div>
		</div>
	</div> <!-- /container -->
<!-- Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Who Goes There?</h4>
      </div>
      <div class="modal-body">
        <p>Dost thou haveth a username and password?</p>
      </div>
      <form class="form-horizontal" action="login2.php" method="post">
          <fieldset>
              <legend>Your Credentials Please</legend>
              <div class="form-group"> <!-- Row 1 -->
                  <!-- Column 1 -->
                  <label class="col-lg-2 control-label" for="username">username</label>
                  <!-- Column 2 -->
                  <div class="col-lg-4">
                      <input class="form-control" type="text" id="username" name="username" placeholder="username" />
                  </div>
              </div><!-- /Row 1 -->

              <div class="form-group"> <!-- Row 2 -->
                  <!-- Column 1 -->
                  <label class="col-lg-2 control-label" for="password">password</label>
                  <!-- Column 2 -->
                  <div class="col-lg-4">
                      <input class="form-control" type="password" id="password" name="password" placeholder="password" />
                  </div>
              </div><!-- /Row 2 -->
          </fieldset>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Nope</button>
        <button class="btn btn-primary" name="submit" type="submit">Login</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


</body>

</html>
