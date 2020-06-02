<?php
include('includes/header.php');
session_destroy();
//Unset admin session 
if(isset($_SESSION['admin_name'])){
    unset($_SESSION['admin_name']);
}
//Unset user session
if(isset($_SESSION['user_email'])){
    unset($_SESSION['user_email']);
}
//Redirect to the homepage
echo '<script>alert("You have successfully logged out");
location="index.php";</script>';

include ('includes/footer.php');
?>

