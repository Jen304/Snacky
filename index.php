<?php
    include('includes/header.php');
?>
<title>Snacky</title>
<!-- embed css file from local repo -->
<link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php
        include('includes/nav_bar.php');
    ?>
    <div id="banner" class="container-fluid d-flex align-items-center">
        <div id="greeting-quote" class="container">
            <h1 class="display-1">time for snack</h1>
            <p class="text-white lead">Let enjoying wonderful snacks straight to your door.</p>
            <button type="button" class="btn btn-warning mb-3"><a href="/products/" class="text-dark">Let
                    start!</a></button>
        </div>
    </div>
    <div class="container" id="step-quote">
        <p class="h1">Enjoy snacks with only 3 steps</p>
        <img src="./images/stepbystep.png" class="rounded mx-auto d-block" alt="stepbystep">
    </div>

    <?php
include('includes/footer.php');
?>