<?php

	session_start();

	$username = "jotaNaked";
	$password = "We2CanFly!";

	# Does this automatically redirect logged in users to success? I don't think I like that.
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		header("Location: presidents.php");
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password) {
			$_SESSION['loggedin'] = true;
			header("Location: presidents.php");
		}
		else {
			header("Location: failed.htm");
		}
	}

?>
