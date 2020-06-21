<?php
include('includes/header.php');
include('includes/db_connection.php');
?>
<title>Order Confirmation | Snacky</title>
</head>
<body>
<?php 
	//get variables 
	$customer_id = $_SESSION['userid'];
	$order_id = $_SESSION['order_id'];
	
	//get customer info
	$select_query = "SELECT * FROM customer WHERE customer_id = $customer_id";
	$select_result = mysqli_query($dbc, $select_query);
	$row = mysqli_fetch_array($select_result);
	//Get all customer information
	$customer_name = $row['customer_name'];
	$street = $row['street'];
	$city = $row['city'];
	$province = $row['province'];
	$country = $row['country'];
	$post = $row['postal_code'];
	$email = $row['email'];


		$pri = "<html>";
		$pri .= "<h2>Order Summary</h2>";
		$pri .= "<table class=table table-striped table>";
		$pri .= "<tr>";
		$pri .= "<td>Customer Name:</td>";
		$pri .= "<td>".$customer_name."</td> \n";
		$pri .= "</tr>";
		$pri .= "<tr>";
		$pri .= "<td>Customer Address:</td> ";
		$pri .= "<td>".$street."</td> \n";
		$pri .= "</tr>";
		$pri .= "<tr>";
		$pri .= "<td>Customer email:</td>";
		$pri .= "<td>".$email."</td> \n";
		$pri .= "</tr>";
		$pri .= "<tr>";
		//get order info
	$query = "SELECT order_id, product_id, quantity, unit_price, (unit_price * quantity) AS subtotal FROM order_item WHERE order_id = $order_id;";
	$query_result = mysqli_query ($dbc, $query);
	while ($order = mysqli_fetch_array ($query_result, MYSQLI_ASSOC)) {
		//get data
		$product_id = $order['product_id'];
		$unit_price = $order['unit_price'];
		$quantity   = $order['quantity'];
		$total      = number_format(($order['subtotal']),2,".",".");
		
		
		
		
		//get product name
		$namequery = "SELECT product_name FROM product WHERE product_id = $product_id;";
		$product_result = mysqli_query ($dbc, $namequery);
		while($product = mysqli_fetch_array($product_result, MYSQLI_ASSOC)){
			$product_name = $product['product_name'];                      
		}
		//get order total
		$ordertotal = "SELECT sum(unit_price * quantity) AS total FROM order_item WHERE order_id = $order_id;";
		$ordertotal_result = mysqli_query ($dbc, $ordertotal);
		while($totalorder = mysqli_fetch_array($ordertotal_result, MYSQLI_ASSOC)){
			$total_order = number_format(($totalorder['total']), 2,".",".");                      
		}
		$pri .= "<th>Product ID</th><th>Product Name</th><th>Quantity</th><th>Total</th> \n";
		$pri .= "<tr><td>".$product_id."</td><td>".$product_name."</td><td>".$quantity."</td><td>".$total."</td> \n"; 
		$pri .= "</tr>";
		
		
	}
		

	//path and name file
	$file_name = "./order_receipt/order#$order_id.txt";
	//create the file
	touch($file_name);
	//Confirm that the file is writable
	if (is_writable($file_name)) {
		//write the data
		$handle = fopen($file_name, 'w') or die('Cannot open file:  '.$file_name);
		fwrite($handle, $pri);
	}

include('includes/footer.php');
?>