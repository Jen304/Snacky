<?php
    include('includes/header.php');
    include('check_privacy.php');
?>
<title>Snacky</title>
<!-- embed css file from local repo -->
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/products.css">
</head>

<body>
    <?php
        include('includes/nav_bar.php');
    ?>
    <div id="banner" class="container-fluid d-flex align-items-center">
        <div id="greeting-quote" class="container">
            <h1 class="display-1">time for snack</h1>
            <p class="text-white lead">Let enjoying wonderful snacks straight to your door.</p>
            <button type="button" class="btn btn-warning mb-3"><a href="products.php" class="text-dark">Let
                    start!</a></button>
        </div>
    </div>
    <div class="container pt-5 mt-5" id="step-quote">
        <p class="h1">Enjoy snacks with only 3 steps</p>
        <img src="./images/stepbystep.png" class="rounded mx-auto d-block" alt="stepbystep">
    </div>
    <?php
        include('includes/db_connection.php');
        try{
            $categories_query = "SELECT * FROM category
            ORDER BY category_id";

            $categories = mysqli_query($dbc, $categories_query);
        }catch(Exception $e){
            echo "<script> alert('{$e->getMessage()}'); </script>";

        }
    ?>
<div id="products">
    <div class="container-fluid d-flex justify-content-between">
        <?php
        include('includes/db_connection.php');
        $category_id = (int)$_GET["category"];
        try{
            if($category_id > 0){
                $category_query = "SELECT * FROM category
                WHERE category_id = $category_id";

                $result = mysqli_query($dbc, $category_query);
                while($category = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $category_name = $category['category_name'];                        
                }
            
        }else{
            $category_name = 'All';
            
        }
    }catch(Excepton $e){
        echo "<script> alert('{$e->getMessage()}'); </script>";

    }
    echo '<p class="display-4">'.$category_name.'</p>';
    ?>
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
    <div class="dropdown-divider"></div>
    <div>
        <?php
    
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
        echo "<div class='card text-center mb-3'>
					<img src='images/products/{$image_file_name}' class='card-img-top' alt='...' width='70' height='135'>
					<div class='card-body'>
						<h5 class='card-title'>{$product["product_name"]}</h5>
						<p class='card-text'>\${$product["unit_price"]}</p>
					</div>
					<form action='product_details.php' method='POST'>
						<input type='hidden' name='pid' value={$product["product_id"]}>
						<div class='container'>
							<button type='submit' class='btn btn-primary'>Buy</button>
						</div>
					</form>
				</div>";
			
		}	

    mysqli_close($dbc);
    ?>
    </div>
    </div>

    <?php
include('includes/footer.php');

?>