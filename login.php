<?php

include 'connection.php';


if (isset($_POST['email']) and isset($_POST['password'])){
	
$username = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `regist_form` WHERE username='$username' and password='$password'";

$result = mysqli_query($con, $query) or die(mysqli_error($con));
$count = mysqli_num_rows($result);

if ($count > 1){

header("Location: dashboard.php");

}
else
{

echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";

}

}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
<form action="login.php" method="post">
<label>Username:</label><br><br>
<input type="text" name="email" ><br><br>
<label>Password:</label><br><br>
<input type="password" name="password" ><br><br>
<input type="submit" name="submit" value="submit">
<h4><a href="regist.php">Register For Login</a></h4>
</form>
</body>
</html>