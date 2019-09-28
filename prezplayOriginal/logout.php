<?php

	session_start();

	session_destroy();

	header("location: logged_out.htm")

?>
