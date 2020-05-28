<?php
include('../header.php');

?>
<title>Add product | Snacky</title>
<link rel="stylesheet" href="../css/add_product.css">
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
                    if(upload_image($file_name)){
                        //-------Inserting data to image table------------
                        $insert_image = "INSERT INTO image (image_name)
                        VALUES(' $file_name ');";
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
                                $category_list = $_POST['category'];
                               
                                    if(!empty($category_list)){                                   
                                        echo "Has some";
                                        $Num = count($category_list);
                                        for($i = 0; $i < $Num; $i++){
                                            echo "product_id ". $product_id;
                                             $insert_category = "INSERT INTO product_category VALUES ($product_id, $category_list[$i]);";
                                             mysqli_query($dbc, $insert_category);
                                            
                                           
    
                                        }
                                        
                                    }else{
                                        echo "nothing";
                                    }
                               
                                
                                mysqli_close($dbc);	
                                
                                echo "<script> alert('Product was inserted.'); </script>"; 
                                unset($dbc);   
                            }
                        }
                    }
                    else{
                        echo "<script> alert('An error occured'); </script>";
                    }
                }
            }         
        }
        else{
            //echo 'All fields must be filled';
            echo "<script> alert('All fields must be filled'); </script>";
        }
    }  

    function upload_image($file_name){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            $destination = '../images/products/' . $file_name;
            
            if(move_uploaded_file($_FILES['file']['tmp_name'], $destination)){
                echo "<script> alert('Image has been uploaded'); </script>";
                return True;
            }
            else{
                echo "<script> alert('An error ocuured'); </script>";
                return False;
            }
        }
        else{
            echo "<script> alert('Image has not been uploaded'); </script>";
            return False;
        }
    }
?>
    <!------------------------------------- PHP end ------------------------------------>


    <!--#########################-->
    <!--       HTML CODE         -->
    <!--#########################-->
    <div class="container-fluid h-100">
        <div class="row h-100  ">
            <form class="col-12" action="index.php" method="POST" enctype="multipart/form-data">
                <!---------------- Header --------------->
                <h2 class="pb-4">Add Product</h2>
                <!---------------- Product Name --------------->
                <div class="form-group row mb-5">
                    <label for="product_name"
                        class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Name</label>
                    <div class=" col-lg-6 col-md-7 col-sm-7 col-12">
                        <input type="text" name="product_name" id="product_name" class="form-control" maxlength="20"
                            required>
                    </div>
                </div>
                <!---------------- Product Description --------------->
                <div class="form-group row mb-5">
                    <label for="description"
                        class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Description</label>
                    <div class="col-lg-6 col-md-7 col-sm-7 col-1,,2">
                        <textarea type="text" name="description" id="description" class="form-control" maxlength="150"
                            required></textarea>
                    </div>
                </div>
                <!---------------- Unit Price --------------->
                <div class="form-group row mb-5">
                    <label for="price"
                        class="col-lg-3 col-md-3 col-sm-4 col-12 col-form-label label-size label-center">Price</label>
                    <div class="col-lg-3 col-md-4 col-sm-5 col-6 test">
                        <input type="number" step="0.01" name="price" id="price" class="form-control" min="0.00"
                            max="999.99" required>
                    </div>
                </div>
                <!---------------- Category --------------->
                <?php
                    include('db_connection.php');
                    $categories_query = "SELECT * FROM category
                                    ORDER BY category_id";

                    $categories = mysqli_query($dbc, $categories_query);
                    ?>
                <div class="form-group row mb-5">
                    <div class="col-lg-3 col-md-3 col-sm-4 col-12 label-size label-center">Category</div>

                    <?php
                    while($category = mysqli_fetch_array($categories, MYSQLI_ASSOC)){
                        echo " <div class=\"col-lg-3 col-md-2 col-sm-4 col-12\">";
                        echo "<div class=\"form-check\">";
                        
                        echo "<input class=\"form-check-input\" type=\"checkbox\" name=\"category[]\" value=\"{$category["category_id"]}\"/>";
                        echo "<lable class=\"form-check-label\" for=\"category\">{$category["category_name"]}</lable>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
        </div>


        <!---------------- Image Upload --------------->
        <div class="form-group row mb-5">
            <label class="col-lg-3 col-md-3 col-sm-4 col-12 label-size label-center" for="image">Image</label>
            <div class="col-lg-2 col-md-4 col-sm-4 col-12 test">
                <label class="btn btn-secondary" style="display: inline-block" id="image">
                    Upload Image <input class="form-control-file" type="file" id="file" name="file" hidden required>
                </label>
            </div>
            <div class="col-lg-5">
                <span id="file-selected-text">No image is chosen</span>
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




    <!--#########################-->
    <!--     JavaScript CODE     -->
    <!--#########################-->
    <script>
    const fileInput = document.getElementById("file");
    const fileInputLabel = document.getElementById("file-selected-text");

    fileInput.addEventListener("change", function() {
        if (fileInput.value) {
            fileInputLabel.innerHTML = fileInput.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        } else {
            fileInputLabel.innerHTML = "No image is chosen";
        }
    });
    </script>
    <!------------------------------------- JavaScript end ------------------------------------>

    <?php
include ('../footer.php');
?>