<?php
    include('../includes/header.php');
?>
<title>Your cart | Snacky</title>
<!-- embed css file -->
<link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <?php
        include('../includes/nav_bar.php');
        include('../includes/db_connection.php');
    ?>

    <div class="container">
        <p class="display-4">Your cart</p>
        <?php
        
        if(!empty($_SESSION['cart'])){
        echo '<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Item ID</th>
                <th scope="col">Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Subtotal</th>

            </tr>
        </thead>
        <tbody>';
            $sumSubTotal = 0;
        $max=sizeof($_SESSION['cart']);
        for($i=0; $i<$max; $i++) { 
                // get product_id
                $product_id = $_SESSION['cart'][$i]['product_id'];
                
                // get product quantity
                $quantity =  $_SESSION['cart'][$i]['quantity'];

                // get product name and unit price from database                
                try {
                    $query = "SELECT product_name,  unit_price FROM product WHERE product_id = $product_id";
                    $query_result = mysqli_query ($dbc, $query);
                    while($product = mysqli_fetch_array($query_result, MYSQLI_ASSOC)){
                        $product_name = $product['product_name'];  
                        $unit_price = $product['unit_price'];                      
                    }
                    
                    
                }catch(Excepton $e){
                    echo "<script> alert('{$e->getMessage()}'); </script>";
                }
                // calculate subtotal 
                $subTotal = $unit_price * $quantity;
                $sumSubTotal = $sumSubTotal + $subTotal;
                                
                echo '<tr>
            <!-- id -->
            <th scope="row">'. $product_id .'</th>
            <!-- name -->
            <td >'. $product_name .'</td>
            <!-- Unit Price -->
            <td>$'. $unit_price .'</td>
            <!-- Quantity -->
            <td>
                <form action="edit_quantity.php" method="post">
                    <input hidden name="product_id" value="'. $product_id .'">
                    <input type="number" min="1" class="quantity" name="quantity" value="'.$quantity.'">
                    <div class="edit">
                        <button type="submit" class="btn btn-dark">Save</button>
                        <button type="button" class="btn btn-outline-dark cancel">Cancel</button>
                    </div>
                </form>
                <!-- Subtotal -->
            <td> $'. number_format($subTotal, 2,",",".") .'</td>
            <!-- Delete button -->
            <td><span class="material-icons">
                    delete
                </span></td>

        </tr>';
       
       
        } // outer array for loop

        echo '</tbody>
        <tfoot>
            <tr>
                <th scope="col" colspan="4" class="text-right">Subtotal
                </th>
                <th>$'. number_format($sumSubTotal, 2,",",".") .'</th>
            </tr>
            <tr>
                <td colspan="5">
                    <form action="check_user.php">
                        <input type="submit" class="btn btn-warning float-right" id="checkoutButton"
                            value="Checkout"></form>
                </td>
            </tr>

        </tfoot>
    </table>';
}else{
    echo '<p class="lead">Your cart is empty...</p>';
}
        ?>
        <div id=" checkout" class="d-flex justify-content-end">

        </div>
        <script>
        let originQuantity = 0;
        // display save and cancel buttons
        $('.quantity').focus(function(e) {
            console.log(e.target.value);
            originQuantity = e.target.value;
            $(e.target).next().css("display", "block");

        });

        // add cancel function
        $('.cancel').click(function(e) {
            // set the value in input back to origin
            const quantityInput = $(e.target).parent().prev();
            quantityInput.val(originQuantity);
            // hide edit save and cancel button
            const container = $(e.target).parent()
            container.css("display", "none");
        })
        </script>

        <?php
        include('../includes/footer.php');
    ?>