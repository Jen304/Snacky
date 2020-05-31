<?php
include('../includes/header.php');
?>
<title>Admin Logout</title>
</head>
<body>
<?php
session_start();
session_destroy();
unset($_SESSION['admin_name']);

echo '<script>alert("You have successfully logged out");
location="admin_login.php";</script>';


include ('../includes/footer.php');
?>

