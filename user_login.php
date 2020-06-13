<?php
include('includes/header.php');
?>
<title>Login | Snacky</title>
<link rel="stylesheet" href="css/user_login.css">
</head>

<body>
    <!--#########################-->
    <!--          PHP            -->
    <!--#########################-->

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include('includes/db_connection.php');
        //Get User Inputs
        $user_email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['user_name'])));
        $password = sha1(mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password']))));
        $select_query = "SELECT * FROM customer WHERE email = '$user_email' and customer_password = '$password'";
		
        try{
            //Check if both field are filled
            if(($user_email === '') || ($password === '')){
                throw new Exception('All fields must be filled');
            }
            $result = mysqli_query($dbc, $select_query);
			//Check if query is successful
            if(!result){
                throw new Exception('Query failed');
            }
			
            //Check if there is a result that matches entered user name and password
            if(mysqli_num_rows($result) != 1){
                throw new Exception('Email and Password do not match');
            }
			
            // get user id from query
            while ($user = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
                $userid=$user["customer_id"];
            }
			
            //We can change to get user first name
            $_SESSION['user_email'] = $user_email;
            $_SESSION['userid'] = $userid;
			
            $sql_query = "UPDATE customer SET last_login=current_timestamp() where customer_id=$userid";
            mysqli_query($dbc, $sql_query);
            

            // initialize cart list
            if(!empty($_SESSION['cart'])){
                $max=sizeof($_SESSION['cart']);
                for($i=0; $i<$max; $i++) { 
                    // get product_id
                    $productid = $_SESSION['cart'][$i]['product_id'];
                    // get product quantity
                    $quantity =  $_SESSION['cart'][$i]['quantity'];
                    // get product name and unit price from database                
                    $query = "INSERT INTO cart_item (customer_id, product_id, quantity)
					            VALUES ('$userid', '$productid', '$quantity');";
				        // run query, if it causes error, the catch will catch that error
				    mysqli_query($dbc, $query);
				    $item_id = mysqli_insert_id($dbc);
				    echo $item_id;                        
                }
            }
            $_SESSION['cart'] =array();
            // get the cart list from the database
            $cart_query = "SELECT * FROM cart_item WHERE customer_id = '$userid';";
            $cart_list = mysqli_query($dbc, $cart_query);
            // if the cart list is not empty, input them to the session
            if(mysqli_num_rows($cart_list) > 0){
                while ($cart_item = mysqli_fetch_array ($cart_list, MYSQLI_ASSOC)) {
                    $customer_id = $cart_item["customer_id"];
                    $productid = $cart_item['product_id'];
                    $quantity = $cart_item['quantity'];
                    $new_item = array("customer_id"=> "$customer_id","product_id"=>"$productid","quantity"=>"$quantity");
			        array_push($_SESSION['cart'],$new_item);  
                }                
            }
            echo '<script> alert("Login successful");
                          location="./privacy_act/privacy_act.php";</script>';
				   
        }catch(Exception $ex){
            echo "<script> alert('{$ex->getMessage()}');</script>";
        }
    }

?>
    <!-- include nav bar -->
    <?php
        include('includes/nav_bar.php');
?>

    <!--#########################-->
    <!--          HTML           -->
    <!--#########################-->

    <div class="container-fluid">
        <div class="row login-form">
            <!-- Login form header -->
            <h2 class="col-12 "> Login </h2>
            <!-- Login form -->
            <form class="col-12" action="user_login.php" method="POST">
                <!-- User Name ( Email Adress ) -->
                <div class="form-group col-8 offset-2">
                    <input class="form-control" name="user_name" type="email" placeholder="Enter Email Adress...."
                        required>
                </div>
                <!-- User Password -->
                <div class="form-group col-8 offset-2">
                    <input class="form-control" name="password" type="password" placeholder="Enter Password...."
                        required>
                </div>
                <!-- Login Button -->
                <div id="loginbutton" class="form-group col-8 offset-2">
                    <button class="form-control btn btn-primary" type="submit">LOGIN</button>
				</div>
				
            </form>
            <p>New User? <a href="register.php" id="register">Register</a></p>
			<a href="admin_login.php">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 16" width="14" height="16" style="margin-left: 280px;"><path fill-rule="evenodd" d="M14 8.77v-1.6l-1.94-.64-.45-1.09.88-1.84-1.13-1.13-1.81.91-1.09-.45-.69-1.92h-1.6l-.63 1.94-1.11.45-1.84-.88-1.13 1.13.91 1.81-.45 1.09L0 7.23v1.59l1.94.64.45 1.09-.88 1.84 1.13 1.13 1.81-.91 1.09.45.69 1.92h1.59l.63-1.94 1.11-.45 1.84.88 1.13-1.13-.92-1.81.47-1.09L14 8.75v.02zM7 11c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3z"></path></svg>
			</a>
		</div>
    </div>

    <?php
include ('includes/footer.php');
?>

<script>
	$(document).ready(function(){
		$("#privacy-policy").modal('show');
	});
</script>

