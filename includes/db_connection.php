<?php
    error_reporting(0);
    $server = 'localhost';
    $user_name = 'ics199';
    $password = 'ics199';
    $db = 'ics199_db';
    define('SERVER', 'localhost');
   
    //Change it to the user name of your schema
    define('USER_NAME', 'ics199');
  
    //Change it to the password of your schema
    define('PASSWORD', 'ics199');
  
    //Change it to the name of your database
    define('DB', 'ics199_db');
 

    //Makeing a database connection
    $dbc = mysqli_connect(SERVER, USER_NAME, PASSWORD,DB) OR
            die ('Could not connect to database' . mysqli_connect_error());

    mysqli_set_charset($dbc, 'utf8');
?>