<?php
include('includes/header.php');
include('includes/nav_bar.php');
?>
<title>Admin Main Page | Snacky</title>
<link rel="stylesheet" href="css/admin_login.css">
</head>

<body>
<?php

if (!isset($_SESSION['admin_name'])) {
	echo '<form action="admin_login.php" method="post">
			<h1>You are not logged in!</h1>
			<p>Please login again</p>
			<input type="hidden" name="logout" value="true" />
			<button type="submit" class="btn btn-danger">Login</button>
	      </form>';
}else {
	$admin_name = $_SESSION['admin_name'];
	echo '<form action="logout.php" method="post">
			<h1>You are now logged in!</h1>
			<input type="hidden" name="logout" value="true" />
			<a href="add_product_db.php" class="btn btn-primary">Add Product</a>
			<button type="submit" class="btn btn-danger">Logout</button>
	      </form>';
}
?>


<?php
include ('includes/footer.php');
?>