 <?php
    include ('../includes/header.php');
	include('../includes/db_connection.php');

?>

 <?php
	//echo "helloword";
	echo $_SESSION['userid'];
	try {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// get the value from the form
			$productid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['proid']))));
			$quantity = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quantity'])));

			// if user login, save\ it to database
			if (!empty($_SESSION['userid'])){
				$userid = $_SESSION['userid'];
				$query = "INSERT INTO cart_item (customer_id, product_id, quantity)
					VALUES ('$userid', '$productid', '$quantity');";
				// run query, if it causes error, the catch will catch that error
				mysqli_query($dbc, $query);
				$cart_id = mysqli_insert_id($dbc);
				echo $cart_id;
				
			}
			// check if there is a session started
			if(!isset($_SESSION['cart'])) {
				$_SESSION['cart'] = array();
        	}
			// save it to session
			$new_product = array("cart_id"=>"$cart_id","product_id"=>"$productid","quantity"=>"$quantity");
			array_push($_SESSION['cart'],$new_product);
			
			}
		}catch(Exception $ex){
			echo "<script> alert('{$ex->getMessage()}');</script>";
    	}		
 		mysqli_close($dbc);
		//mysqli_query($dbc, $insert_category);
		header('location: index.php');
	
?>