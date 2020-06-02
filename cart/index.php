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
            
        $_SESSION['cart']=array(array("product_id"=>"1","quantity"=>2),
        array("product_id"=>"2","quantity"=>4),
        array("product_id"=>"3","quantity"=>5),
        array("product_id"=>"4","quantity"=>7),
        ); 
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
            
        $max=sizeof($_SESSION['cart']);
        for($i=0; $i<$max; $i++) { 
                // get product_id
                $product_id = $_SESSION['cart'][$i]['product_id'];
                
                // get product quantity
                $quantity =  $_SESSION['cart'][$i]['quantity'];

                // get product name                
                try {
                    $query = "SELECT product_name FROM product WHERE product_id = $product_id";
                    $query_result = mysqli_query ($dbc, $query);
                    while($product = mysqli_fetch_array($query_result, MYSQLI_ASSOC)){
                        $product_name = $product['product_name'];                        
                    }
                    
                    
                }catch(Excepton $e){
                    echo "<script> alert('{$e->getMessage()}'); </script>";
                }

                                
                echo '<tr>
            <!-- id -->
            <th scope="row">'. $product_id .'</th>
            <!-- name -->
            <td scope="row">'. $product_name .'</td>
            <!-- Unit Price -->
            <td>5.59</td>
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
            <td>@mdo</td>
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