 <?php
    include ('../includes/header.php');
	include('../includes/db_connection.php');
?>

<?php
    
	try {
		
		// check if there is a session started
		if(!isset($_SESSION['cart'])) {
			$_SESSION['cart'] = array();
        }
        
		//adding product to the cart
		$new_product = array("product_id"=>"$productid","quantity"=>"$quantity");
		array_push($_SESSION['cart'],$new_product);
        
		//number of item in the cart
        $max=sizeof($_SESSION['cart']);
		
        for($i=0; $i<$max; $i++) { 

			while (list ($key, $val) = each ($_SESSION['cart'][$i])) { 
				echo "$key -> $val ,"; 
			} // inner array while loop
			echo "<br>";
        } // outer array for loop
		
	}
	catch(Exception $ex){
		echo "<script> alert('{$ex->getMessage()}');</script>";
    }

	if (!isset($_SESSION['userid']) || $_SESSION['userid'] == "") {	
		header('location: index.php');
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// getting values from form
		$userid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['userid']))));
		$productid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['proid']))));
		$quantity = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quantity'])));
			
		$query = "INSERT INTO cart_item (customer_id, product_id, quantity)
					VALUES ('$userid', '$productid', '$quanty');";
			
		//checking query
		if(!mysqli_query($dbc, $query)){
			?> <script> alert("Unable to add product to the cart"); </script><?php
		}
		else{
			?> <script> alert("Product sucessfully added to the cart"); </script><?php
		}
		
		mysqli_query($dbc, $insert_category);
		header('location: products.php');
	}
?>