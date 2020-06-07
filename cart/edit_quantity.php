<?php
    include('../includes/header.php');
    include('../includes/db_connection.php');

?>

<?php
    try{
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $productid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['product_id']))));
            $updated_quantity = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quantity'])));
            echo $productid;
            echo $updated_quantity;
            // save to the datbase if user login
            if (!empty($_SESSION['userid'])){
                $userid = $_SESSION['userid'];
                $update_query = "UPDATE cart_item SET quantity = $updated_quantity WHERE customer_id = $userid AND product_id = $productid";
			    mysqli_query($dbc, $update_query);
            }

            // edit session
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
    }catch(Exception $ex){
		echo "<script> alert('{$ex->getMessage()}');</script>";
    }		
 	mysqli_close($dbc);
	//mysqli_query($dbc, $insert_category);
	header('location: index.php');
?>