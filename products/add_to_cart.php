<?php
    include ('../includes/header.php');
	include('../includes/db_connection.php');
 ?>
 
<title>Add to Cart | Snacky</title>
<!-- create seperate css file and include it, we can resuse it if applicable -->
<link rel="stylesheet" href="../css/add_to_cart.css">
</head>

<body>
<!--test id-->
<?php
$test_id=$_POST["pid"];
echo "Product id is: $test_id";
?>


<div class="card mb-3" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4">
		<img src="" class="card-img-top" alt="..." width="70" height="150">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        <p class="card-text">Last updated 3 mins ago</p>
		<form>
			<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Quantity:</label>
			<input type="number" value="0" min="0" max="100" step="1"/></br><br>
			<button type="submit" class="btn btn-primary">Add to Cart</button>
		</form>
      </div>
    </div>
  </div>
</div>



<?php
mysqli_close($dbc);
include ('../includes/footer.php');
?>