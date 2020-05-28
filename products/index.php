<?php
    include ('../header.php');
 ?>
<title>Products | Snacky</title>
<?php
            
include ('../db_connection.php');

echo "<style>
";
echo "table, th, td {";
echo "border: 1px solid black;";
echo "}";
echo "
</style>";
echo "<br>";

$prod = "SELECT p.product_id, p.product_name, p.product_desc, i.image_name, p.unit_price
FROM product p, image i
WHERE p.image_id = i.image_id
ORDER BY p.product_id;;";

echo '<form name="searchproduct" action="" method="get">
    <select name="category">
        <option value="0">All</option>
        <option value="1">Sweet</option>
        <option value="2">Salty</option>
        <option value="3">Chocolate</option>
        <option value="4">Gluten-Free</option>
        <option value="5">Healthy</option>
        <option value="6">Homemade</option>
    </select>
    <input type="submit" value="Search">
</form>';
echo "<br>";

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
    $prod_result = mysqli_query ($con, $prod);
    while ($product = mysqli_fetch_array ($prod_result, MYSQLI_ASSOC)) {
    echo "<tr>
        <td>{$product["product_id"]}</td>
        <td>{$product["product_name"]}</td>
        <td>{$product["product_desc"]}</td>
        <td><img src='images/{$product["image_name"]}' width='100' height='100' /></td>
        <td>{$product["unit_price"]}</td>
        <td><input type='submit' value='Add'></td>";
        echo "
    </tr>";

    }
    echo "
</table>";

mysqli_close($con);
include ('../footer.php');
?>