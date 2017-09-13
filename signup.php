<?php
session_start();
include_once('db.php');

if (isset($_POST['name'])) {
    // collect value of input field
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    if (empty($name)) {
        $_SESSION["error"] = "Name is empty";
                header("location: signup.php");die;

        
    } else if (empty($password)) {
        $_SESSION["error"] = "Password is empty";
                header("location: signup.php");die;

        
    }
    else if (empty($email)) {
        $_SESSION["error"] = "Password is empty";
                header("location: signup.php");die;

        
    }
    //Sending values to the database
    else {
        //check for duplicate email check....
        $LoginQuery = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($a, $LoginQuery);
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            $_SESSION["error"] = "This email is already registered.";
            header("location: signup.php");die;
        }else{
            $submitQuery = "INSERT INTO users (fullname, email, password)
            VALUES ('$name', '$email', '$password')";

            if (mysqli_query($a, $submitQuery)) {
                $_SESSION["success"] = "Account created! Please login.";
                header("location: login.php");die;
            }else{
                $_SESSION["error"] = "Error: " . mysqli_error($a);
                header("location: signup.php");die;
            }
        }

    }
 } else{
     if(!empty($_POST)){
        $_SESSION["error"] = "no data";
        header("location: signup.php");die;
     }
}
?>
<?php
// Common code for all pages
require 'header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Sign up</h1>
    </div>


    <form method="POST">

    <div class="form-group">
        <label >Name</label>
        <input type="text" class="form-control" name="name" placeholder="Name" required>
    </div>
    <div class="form-group">
        <label >Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email"  required>
    </div>
    <div class="form-group">
        <label >Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password"  required>
    </div>
    <a class="pull-left" href="login.php"> Login</a>
    <button type="submit" class="btn btn-primary pull-right">Join</button>
    </form>
</div>
<?php
require 'footer.php';
?>