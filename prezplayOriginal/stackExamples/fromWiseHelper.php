<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../php/database_connection.php");

// I think using a function for this process will clean up your script a bit.
// Also moving it to an include page instead of on the page would also help de-clutter your login page.
function ValidateUser($username = false,$password = false,$con)
    {
        // Do all the sanitizing and such
        $username   =   mysqli_real_escape_string($con,trim(stripslashes($username)));
        $password   =   mysqli_real_escape_string($con,trim(stripslashes($password)));
        // Set a default error
        $success    =   array('success'=>false,'error'=>"invalid");
        // Check if the values after sanitizing are empty
        if(!empty($username) && !empty($password)) {
                // Fetch from the table
                $result     =   mysqli_query($con,"SELECT * FROM admin_login WHERE admin_user='$username' AND admin_pass='$password'") or die(mysqli_error($con));
                if($result) {
                    // If user in system true, if not false
                    $validuser  =   (mysqli_num_rows($result) == 1)? true:false;
                    $success    =   array('success'=>$validuser,'error'=> ((!$validuser)? "Invalid Username / Password": ""));
                    $result->close();
                }
                else
                    $success    =   array("success"=>false,"error"=>mysql_error());
            }
        // By now there will be a clear picture of validation
        return (object) $success;
    }

session_start();
// You may want to do a redirect here if a user is already logged in:
if(!empty($_SESSION['admin_username'])) {
    header("Location:profile.php");
    exit;
}

// Just set a default error
$error  =   false;
// If submitted
if(isset($_POST["submit"])){
    // Check the user
    $validate   =   ValidateUser($_POST['admin_user'],$_POST['admin_pass'],$con);
    // If true
    if($validate->success) {
        // Assign session
        $_SESSION['admin_username'] = htmlspecialchars($_POST['admin_user'],ENT_QUOTES);
        // Redirect
        header("Location:profile.php");
        exit;
    }
    // Set the error again
    $error  =   $validate->error;
}
?><!DOCTYPE html>
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
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--align_form_center end-->
        <footer>Site Design and Coded By <a href="www.freelancer.com/u/xbraindesigner.html">Xbraindesigner</a></footer>
    </div>
    <!-- /container -->
    <?php echo $error; ?>
    <script src="../js/jquery-1.9.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php mysqli_close($con); ?>
