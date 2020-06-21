<?php
     include('./includes/header.php');
    ?>
    <title>Confirmation | Snacky</title>
    <link rel="stylesheet" href="./css/charge.css">
</head>
<body>
<?php
    //Include nav bar here so that nav bar won't display any cart item quantity mark
    include('./includes/nav_bar.php');
    $order_id = $_SESSION['order_id'] ;
?>
<div class="containor-fluid box">
    <div class="row">
        <h2 class="col-12 center header"> Thank you for shopping at Snacky !</h2>
    </div>
    <div class="row">
        <p class="col-5 offset-1 center"> Your order number is : </p>
        <p class="col-2 offset-3 order_no"> <?php echo "#$order_id"; ?></p>
    </div>
</div>
<?php
include('includes/footer.php');
?>