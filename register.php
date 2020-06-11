<?php
include('includes/header.php');

?>
<title>Register | Snacky</title>
<link rel="stylesheet" href="css/register.css">

</head>

<body>
    <!--#########################-->
    <!--          PHP            -->
    <!--#########################-->

    <?php
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include('includes/db_connection.php');
        //Get User Inputs
        $name = preg_replace('/[^A-Za-z ]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['name']))));
        $password = sha1(mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password']))));
        $street = preg_replace('/[^A-Za-z0-9- ]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['street']))));
        $city = preg_replace('/[^A-Za-z ]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['city']))));
        $province = preg_replace('/[^A-Za-z]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['province']))));
        $country = preg_replace('/[^A-Za-z ]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['country']))));
        $post_code = preg_replace('/[\s\W]+/','',mysqli_real_escape_string($dbc, trim(strip_tags($_POST['post_code']))));
        $email = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['email'])));
        $phone = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['phone'])));

        //Used to check email duplication
        $email_upper = strtoupper($email);
        $select_query = "SELECT * FROM customer WHERE UPPER(email) = '$email_upper';";
        //Check which fields are filled
        //If province and phone are blanlk
        if(empty($province) && empty($phone)){
            $insert_query = "INSERT INTO customer (customer_name, customer_password, street, city, country, postal_code, email)
                                               VALUES('$name', '$password', '$street', '$city', '$country', '$post_code', '$email')";
            //echo $insert_query;
        }
        //If province is empty
        elseif(empty($province)){
            $insert_query = "INSERT INTO customer (customer_name, customer_password, street, city, country, postal_code, email, phone)
                                               VALUES('$name', '$password', '$street', '$city', '$country', '$post_code', '$email', '$phone')";
            //echo $insert_query;
        }
        //If phone is empty
        elseif(empty($phone)){
            $insert_query = "INSERT INTO customer (customer_name, customer_password, street, city, province, country, postal_code, email)
                                               VALUES('$name', '$password', '$street', '$city', '$province', '$country', '$post_code', '$email')";
            //echo $insert_query;
        }
        //If all fields are filled
        else{
            $insert_query = "INSERT INTO customer (customer_name, customer_password, street, city, province, country, postal_code, email, phone)
                                               VALUES('$name', '$password', '$street', '$city', '$province', '$country', '$post_code', '$email', '$phone')";
            //echo $insert_query;
        }
        
        
        try{ 
            //Check if there is an empty field
            if(($name === '') || ($password === '') || ($street === '') || ($city === '') || ($country === '') || ($post_code === '')){
                throw new Exception('All required fields must be filled');
            }

            $select_result = mysqli_query($dbc, $select_query);
            
            //Check if select query is successful
            if(!$select_result){
                throw new Exception('Query failed');
            }
            //Check if there is a duplicated email
            if(mysqli_num_rows($select_result) != 0){
                throw new Exception('Email Address has already been used');
            }

            $insert_result = mysqli_query($dbc, $insert_query);
            
            //Check if insert query is successful
            if(!$insert_result){
                throw new Exception('Query failed');
            }

            //Get user id
            $user_id = mysqli_insert_id($dbc);
            //Store user id and email so that user is immedeately logged in after registration is successful
            $_SESSION['user_email'] = $email;
            $_SESSION['userid'] = $user_id;
            //If We want to have user logged inn after succesful registration 
            // $_SESSION['user_email'] = $user_email;
            echo '<script> alert("Registration successful\nRedirecting...");
                           location="./privacy_act/privacy_act.php";</script>';
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
            <!-- Register form header -->
            <h2 class="col-12 "> Register </h2>
            <!-- Register form -->
            <form class="col-12" action="register.php" method="POST" onsubmit="return validation()">
                <!-- Customer full name -->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Name</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="name" id="name" type="text" placeholder="Full Name"
                            maxlength="50" required>
                    </div>
                </div>

                <!-- Customer Password -->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Password</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="password" id="password" type="password" placeholder="Password"
                            maxlength="20" required>
                    </div>
                </div>

                <!-- Comfirm Password -->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Comfirm Password</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" type="password" id="comf_password" placeholder="Comfirm Password"
                            maxlength="20" required>
                    </div>
                </div>

                <!-- Street -->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Street</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="street" type="text" placeholder="Street" maxlength="30"
                            required>
                    </div>
                </div>

                <!-- City -->
                <div class="row">
                    <label for="name" class="col-2 offset-2">City</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="city" type="text" placeholder="City" maxlength="20" required>
                    </div>
                </div>

                <!-- Province (Optional field)-->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Province</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="province" type="text" placeholder="Province(Optional)"
                            maxlength="10">
                    </div>
                </div>

                <!-- Country-->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Country</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="country" type="text" placeholder="Country" maxlength="15"
                            required>
                    </div>
                </div>

                <!-- Postal code-->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Postal Code</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="post_code" type="text" placeholder="Postal Code"
                            maxlength="10" required>
                    </div>
                </div>

                <!-- Email-->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Email</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="email" type="email" placeholder="Email" maxlength="40"
                            required>
                    </div>
                </div>

                <!-- Phone-->
                <div class="row">
                    <label for="name" class="col-2 offset-2">Phone</label>
                    <div class="form-group col-6 ">
                        <input class="form-control" name="phone" type="text" placeholder="Phone Number(Optional)"
                            onkeypress="return isNumber(event)" id="phone" maxlength="15">
                    </div>
                </div>


                <!-- Register Button -->
                <div class="form-group col-6 offset-3">
                    <button class="form-control btn btn-primary" id="submit" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    //Check if a number is being entered in the phone number field
    function isNumber(event) {
        let input = event.keyCode;
        if (input > 48 && input < 57) {
            return true;
        }
        return false;
    }

    //Check to see if
    //1, input fields contain invalid characters
    //2, Password and comfirm password match
    function validation(){
        try{
            invalid_character();
            validate_password();
        }catch(e){
            alert(e.message);
            return false;
        }
    }

    //Check to see if input fields contain invalid characters
    function invalid_character(){
        const regix = new RegExp('[^A-Za-z0-9- ]');
        let inputs = document.querySelectorAll('input[type="text"]');
        for(let i = 0; i < inputs.length; i++){
            if(inputs[i].value.match(regix) !== null){
                throw new Error("Invalid character is included");       
            }
        }
    }

    //Check if password and comfirm password fields match befor submitting a form 
    function validate_password() {
        let password = document.getElementById("password").value;
        let comf_password = document.getElementById("comf_password").value;
        if (password !== comf_password) {
            throw new Error("Password fields must match");
        }
    }
    </script>
    <?php
        include ('includes/footer.php');
    ?>