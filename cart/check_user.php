<?php
session_start();

if(empty($_SESSION['user_email'])){
    echo '<script> alert("Please login or register before checkout");
                          location="../user_login.php";</script>';

}else{
    header("Location: /checkout/");
}
?>