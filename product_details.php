<?php
    include ('includes/header.php');
	include('includes/db_connection.php');
	include('includes/nav_bar.php');
?>

<title>Add to Cart | Snacky</title>
<link rel="stylesheet" href="css/product_details.css">
</head>

<body>
    <?php
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
		
		echo 
		"<div id='add' class='card mb-3' style='max-width: 540px;'>
			<div class='row no-gutters'>
				<div class='col-md-4'>
					<img src='images/products/{$image_file_name}' class='card-img-top' alt='...' width='70' height='150'>
				</div>
				<div class='col-md-8'>
					<div class='card-body'>
						<h5 class='card-title'>{$name}</h5>
						<p class='card-text'>{$description}</p>
						<p class='card-text'>\${$price}</p>
						<form action='products_functions/add_to_cart.php' method='POST'>
							<label class='my-1 mr-2' for='inlineFormCustomSelectPref'>Quantity:</label>
							<input type='number' name='quantity' value='1' min='1' max='100' step='1'/></br><br>
							<input type='hidden' name='proid' value={$prod_id}>
							<button type='submit' class='btn btn-primary'>Add to Cart</button>
						</form>
					</div>
				</div>
			</div>
		</div>";

		mysqli_close($dbc);
		include ('includes/footer.php');
	?>