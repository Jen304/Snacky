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
            if(empty($_SESSION['user_email'])){
                echo '
                <div class="nav-item">
                <a class="nav-link text-dark" href="/user_login.php">Login</a>
            </div>
                ';
            }else{
                echo '
                <div class="nav-item">
                <a class="nav-link text-dark" href="#">'.$_SESSION['user_email'].'</a>
            </div>';
            }
        ?>

    </div>
    <div class="nav-item">
        <a class="nav-link text-dark" href="/cart/">
            <span class="material-icons">
                shopping_basket
            </span></a>
    </div>



</nav>