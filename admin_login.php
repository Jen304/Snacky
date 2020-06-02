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
	</form>
<!---------------------END HTML------------------->

	
<?php
include ('includes/footer.php');
?>