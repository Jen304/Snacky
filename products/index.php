<?php
    include ('../header.php');
 ?>
<title>Products | Snacky</title>
<link rel="stylesheet" href="../css/products.css">
</head>

<body>


    <?php
        include('../db_connection.php');
        $categories_query = "SELECT * FROM category
                            ORDER BY category_id";

        $categories = mysqli_query($dbc, $categories_query);
    ?>
    <form name="searchproduct" action="index.php" method="get">
        <select name="category">
            <option value="0">All</option>
            <?php
                    while($category = mysqli_fetch_array($categories, MYSQLI_ASSOC)){
                        echo "<option value=\"{$category["category_id"]}\"/>{$category["category_name"]}</option>";                        
                    }
            ?>
            <input type="submit" value="Search">
        </select>
    </form>

    <?php
    include('../db_connection.php');
    
    echo 'Hello ' . $_GET["category"] . '!';
    $category_id = (int)$_GET["category"];
    if($category_id > 0){
        $prod = "SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
        FROM product p, image i
        WHERE p.image_id = i.image_id and
        p.product_id in (select product_id from product_category where category_id = 1)
        ORDER BY p.product_id;";
    }else{
        $prod = "SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
        FROM product p, image i
        WHERE p.image_id = i.image_id
        ORDER BY p.product_id;";
    }
    // display products  

    echo '<table name="display">
        <tr>
            <td>
                <span class="text">Product ID</span>
            </td>

            <td>
                <span class="text">Product Name</span>
            </td>
            <td>
                <span class="text">Description</span>
            </td>
            <td>
                <span class="text">Image</span>
            </td>
            <td>
                <span class="text">Price</span>
            </td>

            <td>
                <span class="text">Add to Cart</span>
            </td>

        </tr>';
        $prod_result = mysqli_query ($dbc, $prod);
        while ($product = mysqli_fetch_array ($prod_result, MYSQLI_ASSOC)) {
        $image_file_name = trim($product["image_name"]);
        echo "<tr>
            <td>{$product["product_id"]}</td>
            <td>{$product["product_name"]}</td>
            <td>{$product["product_desc"]}</td>
            <td><img src='../images/products/{$image_file_name}' width='100' height='100' /></td>
            <td>\${$product["unit_price"]}</td>
            <td><input type='submit' value='Add'></td>";
            echo "
        </tr>";

        }
        echo "
    </table>";

    mysqli_close($con);
    include ('../footer.php');
    ?>