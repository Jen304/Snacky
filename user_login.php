<?php
include('includes/header.php');
?>
<title>Login | Snacky</title>
<link rel="stylesheet" href="css/user_login.css">
</head>

<body>
    <!--#########################-->
    <!--          PHP            -->
    <!--#########################-->

    <?php
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include('includes/db_connection.php');
        //Get User Inputs
        $user_email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['user_name'])));
        $password = sha1(mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password']))));
        $select_query = "SELECT * FROM customer WHERE email = '$user_email' and customer_password = '$password'";
        try{
            //Check if both field are filled
            if(($user_email === '') || ($password === '')){
                throw new Exception('All fields must be filled');
            }

            $result = mysqli_query($dbc, $select_query);
            
            //Check if query is successful
            if(!result){
                throw new Exception('Query failed');
            }
            //Check if there is a result that matches entered user name and password
            if(mysqli_num_rows($result) != 1){
                throw new Exception('Email and Password do not match');
            }
            // get user id from query
            while ($user = mysqli_fetch_array ($result, MYSQLI_ASSOC)) {
                $userid=$user["customer_id"];
                
            }
            //We can change to get user first name
            $_SESSION['user_email'] = $user_email;
            $_SESSION['userid'] = $userid;
            // initialize cart list
            $_SESSION['cart'] =array();
            echo '<script> alert("Login successful");
                          location="index.php";</script>';
            //echo $_SESSION['userid'];
            //header('location: index.php');
        }catch(Exception $ex){
            echo "<script> alert('{$ex->getMessage()}');</script>";
        }
    }

?>
    <!-- include nav bar -->
    <?php
        include('includes/nav_bar.php');
?>

    <!--#########################-->
    <!--          HTML           -->
    <!--#########################-->

    <div class="container-fluid">
        <div class="row login-form">
            <!-- Login form header -->
            <h2 class="col-12 "> Login </h2>
            <!-- Login form -->
            <form class="col-12" action="user_login.php" method="POST">
                <!-- User Name ( Email Adress ) -->
                <div class="form-group col-8 offset-2">
                    <input class="form-control" name="user_name" type="email" placeholder="Enter Email Adress...."
                        required>
                </div>
                <!-- User Password -->
                <div class="form-group col-8 offset-2">
                    <input class="form-control" name="password" type="password" placeholder="Enter Password...."
                        required>
                </div>
                <!-- Login Button -->
                <div class="form-group col-8 offset-2">
                    <button class="form-control btn btn-primary" type="submit">LOGIN</button>
                </div>
            </form>
            <p>New User? <a href="register/index.php" id="register">Register</a></p>
        </div>
    </div>


    <?php
include ('includes/footer.php');
?>