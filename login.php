<?php
session_start();
include_once('db.php');

if (isset($_POST['email'])) {
    // collect value of input field
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    if (empty($email)) {
        $_SESSION["error"] = "Email is empty";
                header("location: login.php");die;

        
    } else if (empty($password)) {
        $_SESSION["error"] = "Password is empty";
                header("location: login.php");die;

        
    }
    //Sending values to database
    else {
        //Checks for duplicate email
       
            $LoginQuery = "select * from users where email = '$email' and password = '$password'";
            $result = mysqli_query($a, $LoginQuery);
            $rows = mysqli_num_rows($result);
            //echo $rows;
            
            if($rows > 0)
            {
                if($row1 = $result->fetch_assoc()){
                    $_SESSION["name"]=$row1['fullname'];
                    $_SESSION["email"]=$email;
                    $_SESSION["id"]=$row1['id'];
                    header("location:index.php");
                }
                
            }else{
                $_SESSION["error"]= "Invalid login details. Please! try again.";
                header("location:login.php");
            }
        

    }
 } else{
     if(!empty($_POST)){
        $_SESSION["error"] = "invalid data";
        header("location: login.php");die;
     }
}
?>
<?php
// Common code for all the pages
require 'header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Login</h1>
    </div>


    <form method="POST">

    <div class="form-group">
        <label >Email address</label>
        <input type="email" class="form-control" name="email" placeholder="Email"  required>
    </div>
    <div class="form-group">
        <label >Password</label>
        <input type="password" class="form-control" name="password" placeholder="Password"  required>
    </div>
    <a class="pull-left" href="signup.php"> Sign up</a>
    <button type="submit" class="btn btn-primary pull-right">Join</button>
    </form>
</div>
<?php
require 'footer.php';
?>