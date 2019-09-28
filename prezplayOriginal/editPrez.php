<?php
/* 
 Used for editing presidential information
*/

 // creates the edit record form
 // since this form is used multiple times in this file, and DRY, form follows (or, is in a) function

session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
    header("Location: failedprez.htm"); # user goes to locked version if they aren't logged in
}

# if they are logged in, the following works like normal?

function renderForm($id, $firstName, $lastName, $party, $firstYear, $lastYear, $error)
	{
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Play with a Prez</title>
    
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
		<div class="masthead">
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
 
 
 
<?php 
 	// if there are any errors, display them
 	if ($error != '')
		{
		echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
		}
?> 
 
		<p>*Required</p>
 		<p><strong>ID:</strong> <?php echo $id; ?></p>
        <form class="form-horizontal" action="" method="post">
        	<input type="hidden" name="id" value="<?php echo $id; ?>"/>
            
            <fieldset>
            	<legend>Play with a Prez</legend>
                
                <div class="form-group"> <!-- Row 1 -->
                    <!-- Column 1 -->
                    <label class="col-lg-2 control-label" for="firstName">First Name</label>
                    <!-- Column 2 -->
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="firstName" value="<?php echo $firstName; ?>"/>
                    </div>
                </div><!-- /Row 1 -->            		

                <div class="form-group"> <!-- Row 2 -->
                    <!-- Column 1 -->
                    <label class="col-lg-2 control-label" for="lastName">Last Name</label>
                    <!-- Column 2 -->
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="lastName" value="<?php echo $lastName; ?>" />
                    </div>
                </div><!-- /Row 2 -->

                <div class="form-group"> <!-- Row 3 -->
                    <label class="col-lg-2 control-label" for="party">Party</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="party">
                        	<option value="<?php echo $party; ?>"><?php echo $party; ?></option>
                            <option value="Democratic">Democratic</option>
                            <option value="Republican">Republican</option>
                            <option value="Democratic-Republican">Democratic-Republican</option>
                            <option value="Independent">Independent</option>
                            <option value="Federalist">Federalist</option>
                            <option value="Whig">Whig</option>
                        </select>                            
                    </div>
                </div><!-- /Row 3 --> 

                <div class="form-group"> <!-- Row 4 -->
                    <!-- Column 1 -->
                    <label class="col-lg-2 control-label" for="firstYear">First Year</label>
                    <!-- Column 2 -->
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="firstYear" value="<?php echo $firstYear; ?>" />
                    </div>
                </div><!-- /Row 4 -->
    
                <div class="form-group"> <!-- Row 5 -->
                    <!-- Column 1 -->
                    <label class="col-lg-2 control-label" for="lastYear">Last Year</label>
                    <!-- Column 2 -->
                    <div class="col-lg-4">
                        <input class="form-control" type="text" name="lastYear" value="<?php echo $lastYear; ?>" />
                    </div>
                </div><!-- /Row 5 -->
 
                <div class="form-group"> <!-- Last Row -->           
                    <div class="col-lg-4 col-lg-offset-2">
                        <button class="btn btn-primary" type="submit" name="submit">Update Prez</button>
                    </div>
                </div><!-- /Last Row -->            
            
            </fieldset>
        </form> 
 
 	</div> <!-- /container -->
    
 </body>
 </html> 
 
 
 
<?php

	} // end of the renderForm function


// credentials in a more secure location
include("../../php/boneyard.php");

//Uses PHP code to connect to database
mysql_select_db("jscript_presidents", $connekt);
 
// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit']))
	{ 
	
	// confirm that the 'id' value is a valid integer before getting the form data
	if (is_numeric($_POST['id']))
		{
			
		// get form data, making sure it is valid
		$id = $_POST['id'];
		$firstName = mysql_real_escape_string(htmlspecialchars($_POST['firstName']));
		$lastName = mysql_real_escape_string(htmlspecialchars($_POST['lastName']));
		$party = mysql_real_escape_string(htmlspecialchars($_POST['party']));
		$firstYear = mysql_real_escape_string(htmlspecialchars($_POST['firstYear']));
		$lastYear = mysql_real_escape_string(htmlspecialchars($_POST['lastYear']));		

		// check that firstName and lastName fields are both filled in
		if ($firstName == '' || $lastName == '')
			{
			// generate error message
			$error = 'ERROR: Boy, you sure are stupid! Fill in all required fields like you were told!';
 
			//error, display form
			renderForm($id, $firstName, $lastName, $party, $firstYear, $lastYear, $error);
			}

		else
			{

			// save data to database
			mysql_query("UPDATE presidents SET firstName='$firstName', lastName='$lastName', party='$party',firstYear='$firstYear', lastYear='$lastYear' WHERE id='$id'")
			or die(mysql_error()); 
 
			// after save, go to view page
			header("Location: presidents.php"); 
			}
		}

	else
		{

		// if the 'id' isn't valid, display an error
		echo 'Error!';
		}
	}

else // if the form hasn't been submitted, get the data from the db and display the form
	{

	// get 'id' value from URL (if it exists), confirming it is valid and is numeric/larger than 0)
	if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
		{

		// query db
		$id = $_GET['id'];
		$result = mysql_query("SELECT * FROM presidents WHERE id=$id")
		or die(mysql_error()); 
		$row = mysql_fetch_array($result);
 
		// check that the 'id' matches up with a row in the databse
		if($row)
			{
 
			// get data from db
			$firstName = $row['firstName'];
			$lastName = $row['lastName'];
			$party = $row['party'];
			$firstYear = $row['firstYear'];
			$lastYear = $row['lastYear'];			
 
			// show form
			renderForm($id, $firstName, $lastName, $party, $firstYear, $lastYear, '');
			}

		else // if no match, display result
			{
			
			echo "No results!";
			}
		}

	else // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
		{
		echo 'Error!';
		}
	}
?>