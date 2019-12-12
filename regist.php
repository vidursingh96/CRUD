<?php 


include 'connection.php';

if (isset($_POST['submit']))
{

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$status = $_POST['status'];

$sql = "INSERT INTO regist_form (name, username, password , status) VALUES ('$name', '$email', '$pass' , '$status')";

if(mysqli_query($con, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
}

 ?>
<!DOCTYPE html>
<html>
<head>

	<title>Registration</title>
</head>
<body>
<h1>Registration Form</h1>
	<form action="regist.php" method="POST">
		<label>Name:</label>
        <input type="text" name="name"><br><br>
        <label>Username:</label>
        <input type="text" name="email" value="email"><br><br>
        <label>Password:</label>
        <input type="password" name="password" value="password"><br><br>
        <label>Status:</label><br><br>
        <select name="status"><br><br>
        <option value="">select</option>
        <option value="Active">Active</option><br><br>
        <option value="In-Active">In-Active</option><br><br>
        </select><br><br>
        <input type="submit" name="submit" value="submit"><h4><a href="login.php">Click to Login</a>
	</form>
</body>
</html>