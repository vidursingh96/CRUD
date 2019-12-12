<?php

include('dashboard.php');

$result = mysqli_query($con,"SELECT * FROM category where p_id = 0");


if (isset($_POST['submit'])){

//$category = $_POST['category'];

 $sub_category = $_POST['sub_category'];
 $sel_cat= $_POST['sel_cat'];

$sql2 = "INSERT INTO `category`(`category` , `p_id`) VALUES ('".$sub_category."' , '".$sel_cat."')";


$query = mysqli_query($con , $sql2);

}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Cat</title>
</head>
<body>

<h1>Select Category</h1>	
<form action="" method="POST">

  <select name="sel_cat">
	<option value="">Select  Category</option>
<?php
while($row = mysqli_fetch_array($result)) {
?>
	<option value="<?php echo $row["id"];?>"><?php echo $row["category"];?></option>
<?php
}
?>
</select>
<input type="text" name="sub_category"><br><br>
<input type="submit" name="submit" value="Save">

	</form>	

<h4><a href="category_list.php">Show List</a></h4>

<h4><a href="dashboard.php">Back to dashboard</a></h4>


</body>
</html>