<?php
    include('../includes/header.php');
    include('../includes/db_connection.php');
?>

<title>Order history | Snacky</title>
</head>
<body>
<?php
 include('../includes/nav_bar.php');
 ?>
   <div class="container">
        <p class="display-4">Your order</p>
    
 <?php
try{
    $customer_id = $_SESSION['userid'];
    $query = "SELECT * FROM customer_order WHERE customer_id = $customer_id;";
    $query_result = mysqli_query ($dbc, $query);
    if(mysqli_num_rows($query_result) > 0){
        echo ' <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Created at</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>';
        while ($order = mysqli_fetch_array ($query_result, MYSQLI_ASSOC)) {
            $order_id = $order['order_id'];
            $created_at = $order['created_at'];
            $total_query = "select sum(unit_price * quantity) as total from order_item where order_id = $order_id;";
            $query_result = mysqli_query ($dbc, $total_query);
            while($query_row = mysqli_fetch_array ($query_result, MYSQLI_ASSOC)){
                    $total = $query_row['total'];
            }
            echo '<tr>
            <th scope="row">'.$order_id.'</th>
            <td>'.$created_at.'</td>
            <td>'.$total.'</td>
            <td>
            <form action="./order_detail.php" method="POST">
            <input hidden name="order_id" value="'.$order_id.'">
            <input hidden name="created_at" value="'.$created_at.'">
            <button type="submit" class="btn btn-warning">Detail</button></td>
        </form>
            
          </tr>';
        }  
        echo ' </tbody>
        </table>';
    }else{
        echo 'You do not have any order yet.';
    }

}catch(Exception $ex){
    echo "<script> alert('{$ex->getMessage()}');</script>";
}
?>
    </div>
<?php
include('includes/footer.php');
?>