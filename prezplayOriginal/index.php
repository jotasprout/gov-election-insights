<?php

	session_start();

	$username = "jotaNaked";
	$password = "We2CanFly!";

	# Does this automatically redirect logged in users to success? I don't think I like that.
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		header("Location: presidents.php");
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password) {
			$_SESSION['logged_in'] = true;
			header("Location: presidents.php");
		}
		else {
			header("Location: failedprez.htm");
		}		
	}

?>

<!doctype html>

<html>

<head></head>

<body>

	<form method="post" action="index.php">
		username:<br />
		<input type="text" name="username"><br />
		password:<br />
		<input type="password" name="password"><br />
		<input type="submit" name="submit" value="Login">
	</form>
<p>Or <a href="http://www.jotascript.com/prezplay/stone/presidents.php">Return to Presidents</a></p>
</body>
</html>
