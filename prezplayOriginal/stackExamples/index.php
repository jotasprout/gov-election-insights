<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="../css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
<link href="../css/custom_style.css" rel="stylesheet" media="screen">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body id="login">
<div class="top-logo"><img src="../assets/logo.png"></div>
<div class="container">
<div class="align_form_center">
<form  method="POST">
<div class="signin-heading"> Please sign in as <b>ADMIN</b></div>
<div class="align-center">
<!-- username box -->
<div class="form-group has-success has-feedback">
<div class="input-group col-md-10">
<span class="input-group-addon">Username</span>
<input type="text" name="admin_user" class="form-control" id="inputGroupSuccess5" aria-describedby="inputGroupSuccess3Status" required>
</div>
</br>
<!-- password box -->       
<div class="form-group has-success has-feedback">
<div class="input-group col-md-10">
<span class="input-group-addon">Password</span>
<input type="password" name="admin_pass" class="form-control" id="inputGroupSuccess3" aria-describedby="inputGroupSuccess3Status" required>
</div>
</br>     
<button name="submit" class="btn btn-large btn-primary col-md-10" type="submit">Sign in</button>
<br>
<label class="">
<input type="checkbox" value="remember-me"> Remember me
</label>
</div></div></div>
</form>
</div>  <!--align_form_center end-->
<footer>Site Design and Coded By <a href="www.freelancer.com/u/xbraindesigner.html">Xbraindesigner</a></footer>
</div> <!-- /container -->
<?php
include("../php/database_connection.php");
if(isset($_POST["submit"])){
$user=($_POST['admin_user']);
$pass=($_POST['admin_pass']);
if(isset($_POST['admin_user'])){$user=$_POST['admin_user'];}
if(isset($_POST['admin_pass'])){$pass=$_POST['admin_pass'];}
$user=stripslashes($user);
$pass=stripslashes($pass);
$user=mysqli_real_escape_string($con,$user);
$pass=mysqli_real_escape_string($con,$pass);
$result=mysqli_query($con,"SELECT * FROM admin_login WHERE admin_user='$user' AND admin_pass='$pass'")or die(mysqli_error());
$count=mysqli_num_rows($result);
if($result === FALSE){
echo ("query not working.".mysql_error());// better error handling
}
if($user=="" AND $pass=""){
return true;
}
if(isset($_POST['submit'])){
if($count == 1){
$_SESSION['admin_username'] = $user;
header("Location:profile.php");
exit;
}
else{
echo "Wrong Username or Password";
}
$result->close();
mysqli_close($con);
}}?>
<script src="../js/jquery-1.9.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>