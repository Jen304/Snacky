<?php
include('includes/header.php');
?>

<title>Admin Login | Snacky</title>
<link rel="stylesheet" href="css/admin_login.css">
</head>

<body>

<!------------------ PHP CODE ----------------->
<?php 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include('includes/db_connection.php');
	if (isset($_POST['submit'])) {
		//get user inputs
		$admin_name=mysqli_real_escape_string($dbc, trim(strip_tags($_POST['admin_name'])));
		$password=SHA1(mysqli_real_escape_string($dbc, trim(strip_tags($_POST['password']))));
		//create query
		$query = "SELECT * FROM administrator WHERE admin_name='$admin_name' AND admin_password='$password'";
		//run query
		try {
			if(($admin_name === '') || ($password === '')){
                throw new Exception('All fields must be filled');
            }
			
			$result = @mysqli_query($dbc, $query);
			
		//check the result
			if(!result){
                throw new Exception('Query failed');
            }
            
            if(mysqli_num_rows($result) != 1){
                throw new Exception('Name and Password do not match');
            }
		
			$_SESSION['admin_name'] = $admin_name;
			echo '<script> alert("Login successful");
                          location="admin_page/admin_main_page.php";</script>';
			//header('location:admin_main_page.php');
			
		}catch(Exception $ex){
            echo "<script> alert('{$ex->getMessage()}');</script>";
        }
    }
}

?>

<!----------------- HTML CODE ---------------->
	<div id="header" class="container">
		<a href="index.php"><img src="images/logo.png" id="logo" alt="logo"></a>
	</div>
	<form action="admin_login.php" method="POST" onsubmit="return validation();">
		<div class="container">
			<h1>Snacky Admin Login</h1>
		</div>
		  <br>
	
		<div class="form-group">
			<label for="admin_name">Name</label>
			<input type="text" class="form-control" id="adminname" name="admin_name" placeholder="Enter name" required>
		</div>
		
		<div class="form-group">
			<label for="admin_password">Password</label>
			<input type="password" class="form-control" id="adminpassword" name="password" placeholder="Enter password" required>
		</div>
		
		<div class="form-group form-check">
			<input type="checkbox" class="form-check-input" id="remember">
			<label class="form-check-label" for="">Remember me</label>
		</div>
		<button type="submit" class="btn btn-primary" name="submit">Submit</button>
		<a href="index.php">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16" style="margin-left: 400px;"><path fill-rule="evenodd" d="M16 9l-3-3V2h-2v2L8 1 0 9h2l1 5c0 .55.45 1 1 1h8c.55 0 1-.45 1-1l1-5h2zm-4 5H9v-4H7v4H4L2.81 7.69 8 2.5l5.19 5.19L12 14z"></path></svg>
		</a>
	</form>
<!---------------------END HTML------------------->

	
<?php
include ('includes/footer.php');
?>