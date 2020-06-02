<?php
    include ('../includes/header.php');
 ?>
<title>Products | Snacky</title>
<!-- create seperate css file and include it, we can resuse it if applicable -->
<link rel="stylesheet" href="../css/products.css">
</head>

<body>
    <?php
        include('../includes/nav_bar.php');
        include('../includes/db_connection.php');
        try{
            $categories_query = "SELECT * FROM category
            ORDER BY category_id";

            $categories = mysqli_query($dbc, $categories_query);
        }catch(Exception $e){
            echo "<script> alert('{$e->getMessage()}'); </script>";

        }
    ?>

    <div>

        <form class="form-inline" name="searchproduct" action="index.php" method="get">
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Filter by</label>
            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="category">
                <option selected>Choose...</option>
                <option value="0">All</option>
                <?php
                    while($category = mysqli_fetch_array($categories, MYSQLI_ASSOC)){
                        echo "<option value=\"{$category["category_id"]}\"/>{$category["category_name"]}</option>";                        
                    }
            ?>

            </select>
            <button type="submit" class="btn btn-primary my-1">Search</button>
        </form>
    </div>
    <br>

    <?php
    include('../includes/db_connection.php');
    $category_id = (int)$_GET["category"];
    try{
        if($category_id > 0){
            $prod = "SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
            FROM product p, image i
            WHERE p.image_id = i.image_id and
            p.product_id in (select product_id from product_category where category_id = $category_id)
            ORDER BY p.product_id;";
        }else{
            $prod = "SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
            FROM product p, image i
            WHERE p.image_id = i.image_id
            ORDER BY p.product_id;";
        }
    }catch(Excepton $e){
        echo "<script> alert('{$e->getMessage()}'); </script>";
    }
    // display products  
        $prod_result = mysqli_query ($dbc, $prod);
        while ($product = mysqli_fetch_array ($prod_result, MYSQLI_ASSOC)) {
        $image_file_name = trim($product["image_name"]);
        echo "<form action='add_to_cart.php' method='POST'>
				<div class='card text-center mb-3'>
					<img src='../images/products/{$image_file_name}' class='card-img-top' alt='...' width='70' height='135'>
					<div class='card-body'>
						<input type='//hidden//' name='pid' value={$product["product_id"]}>
						<h5 class='card-title'>{$product["product_name"]}</h5>
						<p class='card-text'>\${$product["unit_price"]}</p>
					</div>
					<div class='container'>
						<button type='submit' class='btn btn-primary'>Buy</button>
					</div>
				</div>
			</form";
		}	

    mysqli_close($dbc);
    include ('../includes/footer.php');
    ?>