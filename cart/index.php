<?php
    include('../includes/header.php');
?>
<title>Your cart | Snacky</title>
<!-- embed css file from local repo -->
<link rel="stylesheet" href="../css/cart.css">
</head>

<body>
    <?php
        include('../includes/nav_bar.php');
    ?>

    <div class="container">
        <p class="display-4">Your cart</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <!-- id -->
                    <th scope="row">1</th>
                    <!-- name -->
                    <td>Chocolate chips</td>
                    <!-- Unit Price -->
                    <td>5.59</td>
                    <!-- Quantity -->
                    <td>
                        <form action="edit_quantity.php" method="post">
                            <input hidden name="user_id" value="user_id">
                            <input hidden name="product_id" value="product_id">
                            <input type="number" min="1" class="quantity" name="quantity">
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

                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>@mdo</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th scope="col" colspan="4" class="text-right">Subtotal


                    </th>

                </tr>
                <tr>
                    <td colspan="5">
                        <button type="button" class="btn btn-warning float-right" id="checkoutButton">Checkout</button>
                    </td>
                </tr>

            </tfoot>
        </table>
        <div id="checkout" class="d-flex justify-content-end">

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