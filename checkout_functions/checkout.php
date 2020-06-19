<?php
    include('../includes/header.php');
    include('../includes/nav_bar.php');
    include('../includes/db_connection.php');
    require_once('../stripe/config.php');
?>
    <title> Checkout | Snacky</title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>

<body>
    <div class="container-fluid" id="box">
        <div class="row header">
            <h1 class="col-12">Order Confirmation</h1>
        </div>
        <!-- Product Details -->
        <div class="row product">
            <h2 class="col-12">Order Detail</h2>
            <p class="col-8 column">Products</p>
            <p class="col-2 column">Quantity</p>
            <p class="col-2 column">Subtotal</p>
            <?php
                $array_size = sizeof($_SESSION['cart']);
                //Keep track of total 
                $total = 0;
                //Display product name, quantity and subtotal of each item in the cart
                for($i = 0; $i < $array_size; $i++){
                    $product_id = $_SESSION['cart'][$i]['product_id'];
                    $select_query = "SELECT * FROM product WHERE product_id = $product_id";
                    $select_result = mysqli_query($dbc, $select_query);
                    try{
                        if(!$select_result){
                            throw new Exception('Query Failed');
                        }
                        $row = mysqli_fetch_array($select_result);
                        $product_name = $row['product_name'];
                        $quantity = $_SESSION['cart'][$i]['quantity'];
                        $unit_price = $row['unit_price'];
                        $subtotal = $unit_price * $quantity;
                        $total = $total + $subtotal;
                        //Display product name
                        echo '<p class="col-8 product_name">'.$product_name.'</p>';
                        //Display Quantity
                        echo '<p class="col-2">　×'.$quantity.'</p>';
                        //Display subtotal
                        echo '<p class="col-2"> $'.$subtotal.'</p>';    
                    }
                    catch(Exception $ex){
                        echo "<script> alert('{$e->getMessage()}'); </script>";
                    }
                }
                $total = number_format($total,2);
                echo '<p class="col-2 offset-8 total">Total</p>';
                echo '<p class="col-2  total"> $'.$total.'</p>';
            ?>
            <a class="btn btn-primary offset-9" href="../products.php">Continue Shopping</a>
        </div>
        <!-- Customer Information -->
        <div class="row customer_info">
            <h2 class="col-12">Customer Information</h2>
            <?php
                $customer_id = $_SESSION['userid'];
                $select_query = "SELECT * FROM customer WHERE customer_id = $customer_id";
                $select_result = mysqli_query($dbc, $select_query);
                try{
                    if(!$select_result){
                        throw new Exception('Query failed');
                    }
                    $row = mysqli_fetch_array($select_result);
                    //Get all customer information
                    $customer_name = $row['customer_name'];
                    $street = $row['street'];
                    $city = $row['city'];
                    $province = $row['province'];
                    $country = $row['country'];
                    $post = $row['postal_code'];
                    $email = $row['email'];
                    if(!isset($province)){
                        $address = $street . ', '. $city . ', '. $country . ', '. $post;
                    }
                    else{
                        $address = $street . ', '. $city . ', '. $province . ', '. $country . ', '. $post;
                    }
                    //Print out customer name
                    echo '<p class="col-2">Name: </p>'; 
                    echo '<p class="col-3 offset-7">'. $customer_name . '</p>';
                    //Print out customer address
                    echo '<p class="col-2">Address: </p>'; 
                    echo '<p class="col-5 offset-5 address">'. $address . '</p>';
                    //Print out email
                    echo '<p class="col-2">Email: </p>'; 
                    echo '<p class="col-3 offset-7">'. $email . '</p>';
                }
                catch(Exception $ex){
                    echo "<script> alert('{$e->getMessage()}'); </script>";
                }
            ?>
        </div>

        <!-- Buttons -->
        <div class="row buttons">
            <!-- Back button -->
            <a class="btn btn-primary col-1 offset-4" href="../cart.php">Back</a>
            <!-- Payment Button -->
            <div class=" col-2 offset-1">
                <form action="charge.php" method="post">  
                    <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                    data-key="<?php echo $stripe['publishable_key']; ?>"
                    data-label="Payment"
                    data-description="Checkout"
                    data-amount="<?php echo $total * 100; ?>"
                    data-locale="auto"></script>
                    <input hidden name="total" value="<?php echo $total *100; ?>">
                </form>
            </div>
        </div>  
    </div>
</body>