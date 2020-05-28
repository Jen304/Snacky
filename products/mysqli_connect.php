<?php
DEFINE ('DB_USER', 'admin_snacky');
DEFINE ('DB_PASSWORD', 'snacky12345');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'snacky_db');

$con = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) 
		or die ('Could not connect to MySQL: ' . mysqli_connect_error());
		
mysqli_set_charset(@con, 'utf8');
?>