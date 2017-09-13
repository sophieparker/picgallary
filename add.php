<?php
session_start();
if(!isset($_SESSION['id'])){
    $_SESSION["error"] = "Please login to add photos";
    header("location: login.php");die;
}
include_once('db.php');

if (isset($_POST['caption'])) {
    // Collects value of input field
    $caption = $_REQUEST['caption'];
    if (empty($caption)) {
        $_SESSION["error"] = "Caption is empty";
                header("location: add.php");die;

        
    } else if (empty($_FILES)) {
        $_SESSION["error"] = "Picture is empty";
                header("location: add.php");die;

        
    }
    //Sending the values to the database
    else {
        //Checks for duplicate email
        $target = "pics/";
        $filename= time(). basename( $_FILES['picture']['name']);
        $target = $target .$filename;
        $userid = $_SESSION['id'];
        
        //Gets all the other information from the form
        
        if(move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
            $submitQuery = "INSERT INTO pictures (caption, path, userid)
            VALUES ('$caption', '$filename', $userid)";

            if (mysqli_query($a, $submitQuery)) {
                $_SESSION["success"] = "Picture added.";
                header("location: index.php");die;
            }else{
                $_SESSION["error"] = "Picture not saved";
                header("location: add.php");die;
            }
        }
        else{
            $_SESSION["error"] = "Picture could not be saved!";
            header("location: add.php");die;
        }    

    }
 } else{
     if(!empty($_POST)){
        $_SESSION["error"] = "no data";
        header("location: add.php");die;
     }
}
?>
<?php
// Common code for all the pages
require 'header.php';
?>
<div class="container">
    <div class="page-header">
        <h1>Add pictures to gallery</h1>
    </div>


    <form method="POST"  enctype="multipart/form-data">

    <div class="form-group">
        <label >Caption</label>
        <input type="text" class="form-control" name="caption" placeholder="Caption of picture" required>
    </div>
    <div class="form-group">
        <label >Picture</label>
        <input type="file" class="form-control" name="picture" placeholder="Picture"  required>
    </div>
    
    <button type="submit" class="btn btn-primary pull-right">Publish</button>
    </form>
</div>
<?php
require 'footer.php';
?>