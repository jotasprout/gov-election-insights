<?php

    session_start();

    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        header("Location: stone/presidents.php"); # user goes to locked version if they aren't logged in
    }

    # if they are logged in, they see the content on this page below
?>

<!DOCTYPE html>

<html>
<head>
    <title>Presidents of the United States of America</title>

    <script src="../js/jquery-214.js"></script>
    <script src="../js/jquery_play.js"></script>

    <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/bootstrap.min.css">
    <script src="../js/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../js/bootstrap/css/justified-nav.css">

    <LINK href="favicon.ico" rel="icon" type="image/x-icon">
    <LINK href="favicon.ico" rel="shortcut icon" type="image/x-icon">
    <LINK href="favicon.ico" rel="icon" type="image/ico">

</head>
<body>

	<div class="container">

            <DIV class="masthead">
                <a href="http://www.jotascript.com"><img src="../croppedmore-js-headerUnicorn.png" width="680" height="198" alt="Curiosity created a unicorn"/></a>

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
                <a href="insertPrez.htm" class="btn btn-primary">Push Prez</a>
                <a href="logoutprez.php" class="btn">Logout</a>

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

    echo "<thead><tr><th>ID</th><th>Play</th><th>First Name</th><th>Last Name</th><th>Party</th><th>First Year</th><th>Last Year</th></tr></thead><tbody>";



 // Create a row in HTML table for each row from database

    while ($row = mysql_fetch_array($result)) {

        echo "<tr>";
		echo "<td>" . $row["id"] . "</td>";
		echo "<td><a href='editPrez.php?id=" . $row["id"] . "'>Edit</a></td>";
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

</body>

</html>
