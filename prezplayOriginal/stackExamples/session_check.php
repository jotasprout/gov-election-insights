<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include("../php/database_connection.php");
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['admin_username'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysqli_query($con,"select admin_user from admin_login where admin_user='$user_check'");
$row = mysqli_fetch_array($ses_sql);
$login_session =$row['admin_user'];
if(!isset($login_session)){
mysql_close($con); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>