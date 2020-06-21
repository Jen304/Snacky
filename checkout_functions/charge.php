    <?php
     include('../includes/header.php');
    ?>
    <title>Confirmation | Snacky</title>
    <link rel="stylesheet" href="../css/charge.css">
</head>
<body>
<?php
    include('../includes/db_connection.php');
    require_once('../stripe/config.php');

    $token  = $_POST['stripeToken'];
    $email  = $_POST['stripeEmail'];
    $total = $_POST['total'];

   try{
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));
  
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $total,
        'currency' => 'cad'
    ));
       /*
    $charge = \Stripe\Charge::create([
        'amount' => $total,
        'currency' => 'cad',
        'description' => 'Snacky purchage',
        'source' => $token,
      ]);*/
	  
   }catch(Exception $ex){
    echo "<script> alert('{$e->getMessage()}'); </script>";
}


	



    /////////////////////////////////////////////////////////////////////
    //                                                                ///  
    //    Insert cart items to order item and customer order table    ///
    //                                                                ///
    /////////////////////////////////////////////////////////////////////
    
    $customer_id = $_SESSION['userid'];
    //Query to insert item to order item table
    $insert_customer_order_query = "INSERT INTO customer_order (customer_id) VALUES($customer_id);";
    try{
        if(!mysqli_query($dbc, $insert_customer_order_query)){
            throw new Exception('Query failed');
        }
        //Get order id from just inserted data
        $order_id = mysqli_insert_id($dbc);
        $array_size = sizeof($_SESSION['cart']);

        
        //Insert data into order item table
        for($i = 0; $i < $array_size; $i++){
            $product_id = $_SESSION['cart'][$i]['product_id'];
            $quantity = $_SESSION['cart'][$i]['quantity'];
            //Query to insert item to order item table
            // get the price of item
            $query = "SELECT unit_price FROM product WHERE product_id = $product_id";
            $query_result = mysqli_query ($dbc, $query);
            while($product = mysqli_fetch_array($query_result, MYSQLI_ASSOC)){ 
                $unit_price = $product['unit_price'];                      
            }
            $insert_order_item_query = "INSERT INTO order_item (order_id, product_id, quantity, unit_price) VALUES ($order_id,$product_id, $quantity, $unit_price);";
            //echo $insert_order_item_query;
            if(!mysqli_query($dbc, $insert_order_item_query)){
                throw new Exception('Query failed');
            }
        }
    }

    catch(Exception $ex){
        echo "<script> alert('{$e->getMessage()}'); </script>";
    }
  
  
    /////////////////////////////////////////////////////////////////////////
    //                                                                    ///  
    //   Empty cart SESSION and delete cart items from cart item table    ///
    //                                                                    ///
    /////////////////////////////////////////////////////////////////////////

    //Empty cart session
    $_SESSION['cart'] = array();
    //Delete cart items associated with the customer from database
    $delete_query = "DELETE FROM cart_item WHERE customer_id = $customer_id;";
    $result = mysqli_query($dbc, $delete_query);
    try{
        if(!result){
            throw new Exception('Query failed');
        }
    }
    catch(Exception $ex){
        echo "<script> alert('{$e->getMessage()}'); </script>";
    }
    //Include nav bar here so that nav bar won't display any cart item quantity mark
    include('../includes/nav_bar.php');
?>
<div class="containor-fluid box">
    <div class="row">
        <h2 class="col-12 center header"> Thank you for shopping at Snacky !</h2>
    </div>
    <div class="row">
        <p class="col-5 offset-1 center"> Your order number is : </p>
        <p class="col-2 offset-3 order_no"> <?php echo "#$order_id"; ?></p>
    </div>
</div>

<?php
$_SESSION['order_id'] = $order_id;
    require_once('../create_order_file.php');
	include('includes/footer.php');
?>