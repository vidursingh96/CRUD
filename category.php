<?php


include('dashboard.php');


if (isset($_POST['submit'])){

$category = $_POST['category'];


$sql1 = "INSERT INTO `category`(`category`) VALUES ( '".$category."')";

$query = mysqli_query($con , $sql1);

}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Cat</title>
</head>
<body>

<h1>ADD CATEGORY</h1>	
<form action="" method="POST">
	<label>Category:</label>
<input type="text" name="category"><br><br>
<input type="submit" name="submit" value="Save">

</form>	
</body>
</html>