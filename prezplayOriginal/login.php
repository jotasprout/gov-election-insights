<?php

	session_start();

	$username = "jotaNaked";
	$password = "We2CanFly!";

	# Does this automatically redirect logged in users to success? I don't think I like that.
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
		header("Location: success.php");
	}

	if (isset($_POST['username']) && isset($_POST['password'])) {
		if ($_POST['username'] == $username && $_POST['password'] == $password) {
			$_SESSION['loggedin'] = true;
			header("Location: success.php");
		}
		else {
			header("Location: failed.htm");
		}
	}

?>

<!doctype html>
<html>
<head></head>

<body>

	<form method="post" action="login.php">
		username:<br />
		<input type="text" name="username"><br />
		password:<br />
		<input type="password" name="password"><br />
		<input type="submit" name="submit" value="Login">
	</form>

</body>
</html>
