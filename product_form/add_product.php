<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Snacky - Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
        body,
        html {
            height: 100%;
        }

        form {
            margin: auto;
        }

        .container-fluid{
            padding:5%;
        }

        .label-size{
            font-size: 1.4rem;
        }

        @media (max-width: 575px){
            .label-center{
                text-align: center;
            }
            .test{
                margin:auto;
            }
        }
    </style>
</head>

<body>

    <!--#########################-->
    <!--       PHP CODE          -->
    <!--#########################-->
<?php
    include('db_connection.php');
    error_reporting(E_ALL & ~E_NOTICE); 
    //Getting Product Name
    $product_name = $_POST['product_name'];
    //Getting Product Description
    $product_description = $_POST['description'];
    //Getting Product Price
    $product_price = $_POST['price'];
    //Getting file name
    $file_name = $_FILES['file']['name'];

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //Check if all input fields are filled
        if(!(trim($product_name) === "") && !(trim($product_description) === "")){
            $duplicate = False;
            //Select product Name to check duplication
            $select_product_name = "SELECT product_name FROM product;";
            $select_result = mysqli_query($dbc, $select_product_name);
            if(!$select_result){
                echo "<script> alert('An error occured'); </script>";
            }
            else{
                //check if there is a duplication
                while(($row = mysqli_fetch_array($select_result)) && !$duplicate){
                    if(strtoupper($row['product_name']) === strtoupper($product_name)){
                        $duplicate = True;
                    }
                }
                if($duplicate){
                    echo "<script> alert('Duplicated Product not allowed'); </script>";
                }
                else{
                    //-------Inserting data to image table------------
                    $insert_image = "INSERT INTO image (image_path, image_name)
                    VALUES('test/user/ics199/', ' $file_name ');";
                    //if Image was not inserted
                    if(!mysqli_query($dbc, $insert_image)){
                        //echo 'Image could not be inserted';
                        echo '<script> alert("An error occured(Image Insertion)."); </script>';
                    }
                    else{
                        //echo 'Image was inserted. <br>';
                        //Getting image id of inserted image
                        $image_id = mysqli_insert_id($dbc);
                        //-------Inserting product data to Product table-----------
                        $insert_product = "INSERT INTO product (product_name, product_desc, image_id, unit_price)
                                                        VALUES('$product_name', '$product_description', $image_id , $product_price);";
                        
                        //if product is not inserted
                        if(!mysqli_query($dbc, $insert_product)){
                            echo '<script> alert("An error occured(Product Insertion)."); </script>';
                        }
                        else{
                            //echo 'Product was inserted. <br>';
                            //Getting product id of inserted product
                            $product_id = mysqli_insert_id($dbc);
                            //-------Insert data into Product Category table-------
                            //If chocolate is checked
                            if(isset($_POST['chocolate'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 1);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //If salty is checked
                            if(isset($_POST['salty'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 2);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //If sweet is checked
                            if(isset($_POST['sweet'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 3);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //If healthy is checked
                            if(isset($_POST['healthy'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 4);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //If homemade is checked
                            if(isset($_POST['homemade'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 5);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //If gluten-free is checked
                            if(isset($_POST['gluten-free'])){
                                $insert_category = "INSERT INTO product_category VALUES ($product_id, 6);";
                                mysqli_query($dbc, $insert_category);
                            }
                            //echo 'Product Category has been added.<br>';
                            mysqli_close($dbc);	
                            echo "<script> alert('Product was inserted.'); </script>";    
                        }
                    }
                }
            }         
        }
        else{
            //echo 'All fields must be filled';
            echo "<script> alert('All fields must be filled'); </script>";
        }
    }  
?>
<!------------------------------------- PHP end ------------------------------------>


    <!--#########################-->
    <!--       HTML CODE         -->
    <!--#########################-->
    <div class="container-fluid h-100">
        <div class="row h-100  ">
            <form class="col-12" action="add_product.php" method="POST"  enctype="multipart/form-data">
                <!---------------- Header --------------->
                <h2 class="pb-4">Add Product</h2>
                <!---------------- Product Name --------------->
                <div class="form-group row mb-5">
                    <label for="product_name" class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Name</label>
                    <div class=" col-lg-6 col-md-7 col-sm-7 col-12">
                        <input type="text" name="product_name" id="product_name" class="form-control" maxlength="20" required>
                    </div>
                </div>
                <!---------------- Product Description --------------->
                <div class="form-group row mb-5">
                    <label for="description" class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Description</label>
                    <div class="col-lg-6 col-md-7 col-sm-7 col-12">
                        <textarea type="text" name="description" id="description" class="form-control" maxlength="50"required></textarea>
                    </div>
                </div>
                <!---------------- Unit Price --------------->
                <div class="form-group row mb-5">
                    <label for="price" class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Price</label>
                    <div class="col-lg-3 col-md-4 col-sm-5 col-6 test">
                        <input type="number" step="0.01" name="price" id="price" class="form-control" min="0.00" max="999.99" required>
                    </div>
                </div>
                <!---------------- Category --------------->
                <div class="form-group row mb-5">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12 label-size label-center">Category</div>
                    <!---------------- Chocolate --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="chocolate" name="chocolate" value="chocolate">
                            <lable class="form-check-label" for="chocolate">Chocolate</lable>
                        </div>
                    </div>
                    <!---------------- Salty --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="salty" name="salty" value="salty">
                            <lable class="form-check-label" for="salty">Salty</lable>
                        </div>
                    </div>
                    <!---------------- Sweet --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sweet" name="sweet" value="sweet">
                            <lable class="form-check-label" for="sweet">Sweet</lable>
                        </div>
                    </div>
                    <!---------------- Healthy --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12 offset-sm-4 offset-md-0 offset-lg-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="healthy" name="healthy" value="healthy">
                            <lable class="form-check-label" for="healty">Healthy</lable>
                        </div>
                    </div>
                    <!---------------- Homemade --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12 offset-sm-4 offset-md-0 offset-lg-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="homemade" name="homemade" value="homemade">
                            <lable class="form-check-label" for="homemade">Homemade</lable>
                        </div>
                    </div>
                    <!---------------- Gluten Free --------------->
                    <div class="col-lg-3 col-md-2 col-sm-4 col-12 offset-sm-4 offset-md-0 offset-lg-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="gluten-free" name="gluten-free" value="gluten-free">
                            <lable class="form-check-label" for="gluten-free">Gluten-Free</lable>
                        </div>
                    </div>        
                </div>
                <!---------------- Image Upload --------------->
                <div class="form-group row mb-5">
                    <label class="col-lg-3 col-md-3 col-sm-4 col-12 label-size label-center" for="image">Image</label> 
                    <div class="col-lg-2 col-md-4 col-sm-4 col-12 test">
                        <label class="btn btn-secondary" style="display: inline-block"id="image">
                            Upload Image <input class="form-control-file" type="file" id="file" name="file" hidden required>
                        </label>
                    </div>
                    <div class="col-lg-5">
                        <span  id="file-selected-text">No image is chosen</span>
                    </div>
                </div>
                <!---------------- Buttons --------------->
                <div class="form-group row justify-content-center">
                    <!---------------- Clear Button --------------->
                    <div class="col-2">
                        <button type="reset" class="btn btn-primary">Clear</button>
                    </div>
                    <!---------------- Submit Button --------------->
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>                   
                </div>
            </form>
        </div>
    </div>
<!------------------------------------- HTML end ------------------------------------>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <!--#########################-->
    <!--     JavaScript CODE     -->
    <!--#########################-->
    <script>
        const fileInput = document.getElementById("file");
        const fileInputLabel = document.getElementById("file-selected-text");

        fileInput.addEventListener("change", function(){
            if(fileInput.value){
                fileInputLabel.innerHTML = fileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            }
            else{
                fileInputLabel.innerHTML = "No image is chosen";
            }
        });
    </script>
    <!------------------------------------- JavaScript end ------------------------------------>

</body>

</html>
