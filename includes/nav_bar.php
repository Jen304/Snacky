<nav class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow">

    <img src="/images/logo.png" class="mr-md-auto " id-"logo" alt="logo">

    <div class="nav nav-bar justify-content-end align-items-center">
        <div class="nav-item ">
            <a class="nav-link text-dark" href="/">Home</a>
        </div>
        <div class="nav-item">
            <a class="nav-link text-dark" href="/products/">Store</a>
        </div>
        <?php
            // display login if user does not login 
            if(empty($_SESSION['user_email'])){
                echo '
                <div class="nav-item">
                <a class="nav-link text-dark" href="/user_login.php">Login</a>
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
                        <a class="dropdown-item" href="/cart/">Your cart</a>
                        <a class="dropdown-item" href="/">Order history</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout.php">Logout</a>
                    </div>                
                </div>';
            }
        ?>

    </div>
    <div class="nav-item">
        <a class="nav-link text-dark" href="/cart/" id="cart">
            <span class="material-icons">
                shopping_basket
            </span>
            <div id="itemNum" class="rounded-circle bg-danger text-white align-middle">1</div>
        </a>

    </div>



</nav>