<?php
session_start();

if(empty($_SESSION['user_email'])){
    echo '<script> alert("Please register before checkout");
                          location="/register/";</script>';

}else{
    header("Location: /checkout/");
}
?>