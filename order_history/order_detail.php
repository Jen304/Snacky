<?php
    include('../includes/header.php');
    include('../includes/db_connection.php');
?>

<title>Order history | Snacky</title>
</head>
<body>
<?php
 include('../includes/nav_bar.php');
 $order_id = $_POST['order_id'];
 $created_at = $_POST['created_at'];
 //echo $order_id;
 ?>
  <div class="container">
        <p class="display-4">Your order detail</p>
        <p class="lead"><b>Order id:</b> 
        <?php echo $order_id?></p>
        <p class="lead"><b>Created at:</b> 
        <?php echo $created_at ?></p>
</p>

<?php
try{
    $query = "select *, sum(unit_price * quantity) as total from order_item where order_id = $order_id;";
    $query_result = mysqli_query ($dbc, $query);
    if(mysqli_num_rows($query_result) > 0){
        echo ' <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">Quanity</th>
            <th scope="col">Unit Price</th>
          </tr>
        </thead>
        <tbody>';
        while ($order = mysqli_fetch_array ($query_result, MYSQLI_ASSOC)) {
            $product_id = $order['product_id'];
            $unit_price = $order['unit_price'];
            $quantity = $order['quantity'];
            $total = $order['total'];
            $query = "SELECT product_name  FROM product WHERE product_id = $product_id";
                    $product_result = mysqli_query ($dbc, $query);
                    while($product = mysqli_fetch_array($product_result, MYSQLI_ASSOC)){
                        $product_name = $product['product_name'];                      
                    }
            
          
            echo '<tr>
            <th scope="row">'.$product_id.'</th>
            <td>'.$product_name.'</td>
            <td>'.$quantity.'</td>
            <td>'.$unit_price.'</td>
        </form>
            
          </tr>';
        }  
        echo ' </tbody>
        </table>';
    }else{
        echo 'The order is empty.';
    }

}catch(Exception $ex){
    echo "<script> alert('{$ex->getMessage()}');</script>";
}
?>
    </div>
<?php
include('includes/footer.php');
?>