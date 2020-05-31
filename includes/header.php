<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <link rel="shortcut icon" href="/images/favicon.png" type="image/jpg">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- embed icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- embed bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- embed google font for banner -->
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&display=swap" rel="stylesheet">

    <!-- embed jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    </head>
    <body>
        <nav class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow">

        <img src="../images/logo.png" class="mr-md-auto " id-"logo" alt="logo">

        <div class="nav nav-bar justify-content-end align-items-center">
        <div class="nav-item ">
            <a class="nav-link text-dark" href="#">Home</a>
        </div>
        <div class="nav-item">
            <a class="nav-link text-dark" href="#">Store</a>
        </div>
        <div class="nav-item">
            <?php
                if(isset($_SESSION['user_email'])){
                    echo '<a class="nav-link text-dark" href="../user_logout.php">Logout</a>';
                }
                else{
                    echo '<a class="nav-link text-dark" href="../user_login.php">Login</a>';
                }
            ?>
            
        </div>
        </div>

        <span class="material-icons">
        shopping_basket
        </span>

        </nav>
    </body>