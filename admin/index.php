<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the fields are not empty
    if(!empty($username) && !empty($password)){
        // Perform the login query
        $loginquery = "SELECT * FROM admin WHERE username='$username' AND password='".md5($password)."'";
        $result = mysqli_query($db, $loginquery);
        $row = mysqli_fetch_array($result);

        // Check if the username and password match
        if(is_array($row)){
            $_SESSION["adm_id"] = $row['adm_id'];
            header("refresh:1;url=dashboard.php");
        } else {
            $message = "Invalid Username or Password!";
        }
    } else {
        $message = "Please fill in both fields.";
    }
}
?>

<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>

<div class="container">
  <div class="info">
    <h1>Admin Panel</h1>
  </div>
</div>

<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  <span style="color:red;"><?php echo $message; ?></span>
  <form class="login-form" action="index.php" method="post">
    <input type="text" placeholder="Username" name="username" required/>
    <input type="password" placeholder="Password" name="password" required/>
    <input type="submit" name="submit" value="Login" />
  </form>
  <p><a href="registration.php">Don't have an account? Register here.</a></p>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='js/index.js'></script>
</body>

</html>
