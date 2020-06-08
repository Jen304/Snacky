<?php
    include('../includes/header.php');
    include('../includes/db_connection.php');
    $user_id = mysqli_real_escape_string($dbc, trim(strip_tags($_SESSION['userid'])));
    $product_id = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['product_id'])));
    $delete_all = mysqli_real_escape_string($dbc, trim(strip_tags($_POST['all'])));

    if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
        //If a user is logged in
        if(isset($_SESSION['userid'])){
            //If delete all is clicked
            if($delete_all === 'yes'){
                //Delete all items from cart
                $delete_query = "DELETE FROM cart_item WHERE customer_id = $user_id;";
                try{
                    if(!mysqli_query($dbc, $delete_query)){
                        throw new Exception('Query failed');
                    }
                }catch(Exception $ex){
                    echo "<script> alert('{$e->getMessage()}'); </script>";
                }
                //Remove all items from session
                $_SESSION['cart'] = array();
                echo '<script>location="index.php";</script>';
            }
            //If delete each item is clicked
            else{
                //Delete each item from cart 
                $delete_query = "DELETE FROM cart_item WHERE customer_id = $user_id AND product_id = $product_id;";
                try{
                    if(!mysqli_query($dbc, $delete_query)){
                        throw new Exception('Query failed');
                    }
                }catch(Exception $ex){
                    echo "<script> alert('{$e->getMessage()}'); </script>";
                }
                //Remove an item from session
                $i = 0;
                $removed = False;
                $size = sizeof($_SESSION['cart']);
                //Loop through session array to remove an item
                while(!$removed && ($i < $size)){
                    if(($_SESSION['cart'][$i]['customer_id'] === $user_id) && ($_SESSION['cart'][$i]['product_id'] === $product_id)){
                        unset($_SESSION['cart'][$i]);
                        $removed = True;
                    }
                    $i++;
                }
                //Re index the session array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo '<script>location="index.php";</script>';
            }   
        }
        // If a user is not logged in
        else{
            //if delete all is clicked
            if($delete_all === 'yes'){
                $_SESSION['cart'] = array();
                echo '<script>location="index.php";</script>';
            }
            // If delete each item is clicked
            else{
                //Remove an item from session
                $i = 0;
                $removed = False;
                $size = sizeof($_SESSION['cart']);
                //Loop through session array to remove an item
                while(!$removed && ($i < $size)){
                    if($_SESSION['cart'][$i]['product_id'] === $product_id){
                        unset($_SESSION['cart'][$i]);
                        $removed = True;
                    }
                    $i++;
                }
                //Re index the session array
                $_SESSION['cart'] = array_values($_SESSION['cart']);
                echo '<script>location="index.php";</script>';
            }
        }
    }
?>