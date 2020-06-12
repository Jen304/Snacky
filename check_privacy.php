<?php 
include('./includes/db_connection.php');
if(!empty($_SESSION['userid'])){
                $userid = $_SESSION['userid'];
                $query = "SELECT privacy_selection FROM customer WHERE customer_id=$userid";
                $query_result = mysqli_query($dbc, $query);
                while($selection = mysqli_fetch_array($query_result, MYSQLI_ASSOC)){
                    $privacy_selection = $selection['privacy_selection'];                   
                }
                if($privacy_selection==0){
                    header('Location: /logout.php');
                }
            }

?>