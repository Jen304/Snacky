<?php
    include ('../includes/header.php');
	include('../includes/db_connection.php');
?>
 
<title>Add to Cart | Snacky</title>
<link rel="stylesheet" href="../css/add_to_cart.css">
</head>

<body>
	<?php
		/*if (!isset($_SESSION['userid']) || $_SESSION['userid'] == "" || $_SESSION['admin'] == 0) {	
			header('location:index.php');
		}
		*/
		$prod_id = $_POST['pid'];
		
		//query
		$prodq="SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
				FROM product p, image i
				WHERE p.image_id = i.image_id AND p.product_id = $prod_id;";

		$prodq_result = mysqli_query ($dbc, $prodq);
		
		//initialization of variables
		while ($product = mysqli_fetch_array ($prodq_result, MYSQLI_ASSOC)) {
			$name=$product["product_name"];
			$description=$product["product_desc"];
			$image_file_name = trim($product["image_name"]);
			$price=$product["unit_price"];
		}
		//getting input from the form
			
		$userid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['userid']))));
		$productid = mysqli_real_escape_string($dbc, trim(strip_tags(strtoupper($_POST['proid']))));
		$quanty = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['quantity'])));
		
		//adding product to the cart
		$query = "INSERT INTO cart_item (customer_id, product_id, quantity)
					VALUES ('$userid', '$productid', '$quanty');";
		
		
		//display product information
		echo 
		"<div class='card mb-3' style='max-width: 540px;'>
			<div class='row no-gutters'>
				<div class='col-md-4'>
					<img src='../images/products/{$image_file_name}' class='card-img-top' alt='...' width='70' height='150'>
				</div>
				<div class='col-md-8'>
					<div class='card-body'>
						<h5 class='card-title'>{$name}</h5>
						<p class='card-text'>{$description}</p>
						<p class='card-text'>\${$price}</p>
						<form action='index.php' method='POST'>
							<label class='my-1 mr-2' for='inlineFormCustomSelectPref'>Quantity:</label>
							<input type='number' name='quantity' value='1' min='1' max='100' step='1'/></br><br>
							<input type='hidden' name='proid' value={$prod_id}>
							<input type='hidden' name='userid' value=//{$_SESSION['userid']}//>
							<button type='submit' class='btn btn-primary'>Add to Cart</button>
						</form>
					</div>
				</div>
			</div>
		</div>";

		mysqli_close($dbc);
		include ('../includes/footer.php');
	?>