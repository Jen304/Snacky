 <?php
    include ('../includes/header.php');
	include('../includes/db_connection.php');

?>

 <?php
	
	try {
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// get the value from the form
			$productid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['proid']))));
			$quantity = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quantity'])));

			// if user login, save\ it to database
			if (!empty($_SESSION['userid'])){
				$userid = $_SESSION['userid'];
				//Select query is used to check if there is a pair of customer id and product id exists
				$select = "SELECT * FROM cart_item WHERE customer_id = $userid AND product_id = $productid;";
				$select_result = mysqli_query($dbc, $select);
				//If there is already an item in the cart
				if(mysqli_num_rows($select_result) != 0){
					//Obtain a quantity that is stored in the cart item table
					while($row = mysqli_fetch_array($select_result)){
						$saved_quantity = $row['quantity'];
					}
					$updated_quantity = $saved_quantity + $quantity;
					//Update the quantity column of cart item table if duplicated item is added
					$update_query = "UPDATE cart_item SET quantity = $updated_quantity WHERE customer_id = $userid AND product_id = $productid";
					mysqli_query($dbc, $update_query);
					$i = 0;
					$updated = False;
					//Update Session 
					while(($i < sizeof($_SESSION['cart'])) && !$updated){
						if( ($_SESSION['cart'][$i]['customer_id'] === $userid) && ($_SESSION['cart'][$i]['product_id'] === $productid)){
							$_SESSION['cart'][$i]['quantity'] = $updated_quantity;
							$updated = True;
						}
						$i++;
					}
				}
				//If there is no duplicated item in the cart
				else{
					$query = "INSERT INTO cart_item (customer_id, product_id, quantity)
						VALUES ('$userid', '$productid', '$quantity');";
					// run query, if it causes error, the catch will catch that error
					mysqli_query($dbc, $query);
					// check if there is a session started
					if(!isset($_SESSION['cart'])) {
						$_SESSION['cart'] = array();
        			}
					$new_product = array("customer_id"=>"$userid","product_id"=>"$productid","quantity"=>"$quantity");
					array_push($_SESSION['cart'],$new_product);
				}
				
			}
			//Below is used for a non - registered customer
			else{
				if(!isset($_SESSION['cart'])) {
					$_SESSION['cart'] = array();
				}
				
				$i = 0;
				$updated = False;
				//Loop through cart to check if a duplicated item exists or no
				while(($i < sizeof($_SESSION['cart'])) && !$updated){
					//If exists, update session
					if($_SESSION['cart'][$i]['product_id'] === $productid){
						$_SESSION['cart'][$i]['quantity'] = $_SESSION['cart'][$i]['quantity'] + $quantity;
						$updated = True;
					}
					$i++;
				}
				//If there is no duplicated item
				if(!$updated){
					$new_product = array("product_id"=>"$productid","quantity"=>"$quantity");
					array_push($_SESSION['cart'],$new_product);
				}	
			}	
		}
	}catch(Exception $ex){
		echo "<script> alert('{$ex->getMessage()}');</script>";
		
    }		
 	mysqli_close($dbc);
	//mysqli_query($dbc, $insert_category);
	echo '<script> alert("Product added to your cart");
                           location="../products.php";</script>';
	
	
?>