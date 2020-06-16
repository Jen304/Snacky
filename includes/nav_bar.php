<nav class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow">

    <div class="mr-md-auto">
        <a href="../index.php"><img src="../images/logo.png" id-"logo" alt="logo"></a>
    </div>

    <div class="nav nav-bar justify-content-end align-items-center">
        <div class="nav-item ">
            <a class="nav-link text-dark" href="../index.php">Home</a>
        </div>
        <div class="nav-item">
            <a class="nav-link text-dark" href="../products.php">Store</a>
        </div>
        <?php
            // display login if user does not login 
            if(empty($_SESSION['user_email'])){
                echo '
                <div class="nav-item">
                <a class="nav-link text-dark" href="../user_login.php">Login</a>
            </div>
                ';
                // display user email if user login
            }else{
                echo '
                <div class="nav-item">
                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" 
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                '.$_SESSION['user_email'].'</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../cart.php">Your cart</a>
                        <a class="dropdown-item" href="/order_history">Order history</a>
                        <a class="dropdown-item" href="./privacy_act/privacy_policy.php">Privacy Policy</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>                
                </div>';
            }
            
        ?>

    </div>
    <div class="nav-item">
        <a class="nav-link text-dark" href="../cart.php" id="cart">
            <span class="material-icons">
                shopping_basket
            </span>

            <?php
                if(!empty($_SESSION['cart'])){
                    $max=sizeof($_SESSION['cart']);
                    $count = 0;
                    for($i=0; $i<$max; $i++) {                 
                        // get product quantity
                        $quantity =  $_SESSION['cart'][$i]['quantity'];
                        $count = $count + $quantity;
                    }

                    echo '<div id="cartCount" class="rounded-circle bg-danger text-white align-middle">'.$count.'
                    </div>'; 
                }
                ?>
        </a>
    </div>
</nav>