<?php
session_start ();
session_destroy ();
session_start ();
$_SESSION['success'] = "You have been logged out";
header('Location: login.php');die;
?>
