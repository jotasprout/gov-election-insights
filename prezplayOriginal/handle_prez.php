<?php
// PHP code in a more secure location
  include("../../php/boneyard.php");

// Connection test and feedback
  if (!$connekt)
  {
    die('Rats! Could not connect: ' . mysql_error());
  }

//Uses PHP code to connect to database
  mysql_select_db("jscript_presidents", $connekt);

// Assigns form field content to columns in database
  $firstName = $_POST['firstName'];
  $lastName = $_POST['lastName'];
  $party = $_POST['party'];
  $firstYear = $_POST['firstYear'];
  $lastYear = $_POST['lastYear'];

// Instructions for inserting form content into database
  $pushPrez = "
  INSERT INTO presidents (
  	firstName,
	lastName,
	party,
	firstYear,
	lastYear
	)
  VALUES (
  	'$firstName',
	'$lastName',
	'$party',
	'$firstYear',
	'$lastYear'
	);";

// Uses the above instructions for inserting
//  mysql_query($pushPrez);
  
// Feedback of whether INSERT worked or not
  $retval = mysql_query($pushPrez, $connekt);
  
  if(!$retval){
	  die('Crap. Could not push your prez: ' . mysql_error());
  }
	
	// after save, go to view page
	header("Location: presidents.php"); 
	
// When attempt is complete, connection closes
  mysql_close($connekt);

?>