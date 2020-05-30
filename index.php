<?php
include('includes/header.php');
?>
<title>Snacky</title>
<!-- embed css file from local repo -->
<link rel="stylesheet" href="css/index.css">
</head>

<body>
    <nav class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow">

        <img src="./images/logo.png" class="mr-md-auto " id-"logo" alt="logo">

        <div class="nav nav-bar justify-content-end align-items-center">
            <div class="nav-item ">
                <a class="nav-link text-dark" href="#">Home</a>
            </div>
            <div class="nav-item">
                <a class="nav-link text-dark" href="#">Store</a>
            </div>
            <div class="nav-item">
                <a class="nav-link text-dark" href="#">Login</a>
            </div>
        </div>

        <span class="material-icons">
            shopping_basket
        </span>

    </nav>

    <div id="banner" class="container-fluid d-flex align-items-center">
        <div id="greeting-quote" class="container">
            <h1 class="display-1">time for snack</h1>
            <p class="text-white lead">Let enjoying wonderful snacks straight to your door.</p>
            <button type="button" class="btn btn-warning mb-3">Let start!</button>
        </div>
    </div>
    <div class="container" id="step-quote">
        <p class="h1">Enjoy snacks with only 3 steps</p>
        <img src="./images/stepbystep.png" class="rounded mx-auto d-block" alt="stepbystep">
    </div>

    <?php
include('includes/footer.php');
?>