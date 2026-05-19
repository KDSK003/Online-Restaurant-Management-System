<!DOCTYPE html>
<html lang="en">
<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password == $confirm_password) {
        // Check if the username is already taken
        $check_query = "SELECT * FROM admin WHERE username='$username'";
        $check_result = mysqli_query($db, $check_query);
        if (mysqli_num_rows($check_result) > 0) {
            $message = "Username already exists!";
        } else {
            // Insert the new admin into the database
            $hashed_password = md5($password);
            $insert_query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($db, $insert_query)) {
                $success = "Admin registered successfully. You can now log in!";
            } else {
                $message = "Error registering the admin. Please try again.";
            }
        }
    } else {
        $message = "Passwords do not match!";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
<div class="container">
  <div class="info">
    <h1>Admin Registration</h1>
  </div>
</div>

<div class="form">
  <div class="thumbnail"><img src="images/manager.png"/></div>
  <span style="color:red;"><?php echo $message; ?></span>
  <span style="color:green;"><?php echo $success; ?></span>
  <form class="login-form" action="registration.php" method="post">
    <input type="text" placeholder="Username" name="username" required />
    <input type="password" placeholder="Password" name="password" required />
    <input type="password" placeholder="Confirm Password" name="confirm_password" required />
    <input type="submit" name="register" value="Register" />
  </form>
  <p><a href="index.php">Already have an account? Login here.</a></p>
</div>

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='js/index.js'></script>
</body>
</html>
