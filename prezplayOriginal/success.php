<?php

	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
		header("Location: failed.htm"); # user goes to fail page if they aren't logged in
	}

	# if they are logged in, they see the content on this page below
?>

<h2>Yay! Welcome back!</h2>
<p><a href="logout.php">Logout</a></p>
