<?php

include('dashboard.php');

if (isset($_POST['submit'])) {

//print_r($_POST);die;

$name=$_POST['name'];
$username=$_POST['email'];
$pass = $_POST['password'];
$gender=$_POST['gender'];
$hobbies= implode(',', $_POST['ankit']);
$address=$_POST['address'];



$query = "INSERT INTO `add_user`(`name`, `username`, `password`, `gender`, `hobbies`, `address`) VALUES ('".$name."','".$username."','".$pass."', '".$gender."', '".$hobbies."' , '".$address."')";

if ($query) {
	echo "<script type='text/javascript'>alert('Data Inserted')</script>";
}

mysqli_query($con, $query);

}

if(isset($_GET['edit_id']))
{
   $id=$_GET['edit_id'];

   $query4=mysqli_query($con , "SELECT * from add_user where id= ". $id ."");

    $query5=mysqli_fetch_array($query4);

    $Hobbies = explode(',', $query5['hobbies']);
    //print_r($Hobbies);
 
}

if(isset($_POST['update'])) {
  $upd_id=$_POST['edit_id'];

$name=$_POST['name'];
$username=$_POST['email'];
$pass=$_POST['password'];
$gender=$_POST['gender'];
$hobbies= implode(',', $_POST['ankit']);
$address=$_POST['address'];

 $query6="UPDATE add_user SET name = '$name' , username = '$username', password = '$pass', gender = '$gender', hobbies = '$hobbies', address = '$address' WHERE id = ".$upd_id."";

mysqli_query($con , $query6);

  
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Add User</title>
</head>
<body>
<form action="add_user.php" method="post" >

<p style="color: red"><span> *   required field </span> </p>
Name: <input type="text" name="name" value="<?php if(!empty($query5)) { echo $query5['name']; } ?>" /><br><br/>
Username: <input type="email" name="email" value="<?php if(!empty($query5)) { echo $query5['username']; } ?>" ><br><br/>
Password: <input type="password" name="password" value="<?php if(!empty($query5)) { echo $query5['password']; } ?>"><br><br/>
Gender:
<input type="radio" name="gender" value="Female"<?php if(!empty($query5) && $query5["gender"]=='Female') { echo "checked"; } ?>/>Female
<input type="radio" name="gender" value="Male"<?php if(!empty($query5) && $query5["gender"]=='Male') { echo "checked"; } ?>/>Male
<input type="radio" name="gender" value="other"<?php if(!empty($query5) && $query5["gender"]=='Other') { echo "checked"; } ?>/>Other<br><br>
Hobbies:<br>
 <input type="checkbox" name="ankit[]" value="cricket"<?php if(!empty($query5) && in_array("cricket", $Hobbies)) { echo "checked"; }  ?>/> Cricket <br />
      <input type="checkbox" name="ankit[]" value="watchtv"<?php if(!empty($query5) && in_array("watchtv", $Hobbies)) { echo "checked"; }  ?> /> Watch Tv <br>
      <input type="checkbox" name="ankit[]" value="playgame" <?php if(!empty($query5) && in_array("playgame", $Hobbies)) { echo "checked"; }  ?>/> Play Game <br />
      <input type="checkbox" name="ankit[]" value="inserf" <?php if(!empty($query5) && in_array("inserf", $Hobbies)) { echo "checked"; }  ?> /> Internet Surfing <br/><br>

      Address: <br>
      <textarea name="address" rows="5" cols="40"><?php if(!empty($query5)) { echo $query5['address']; } ?></textarea><br><br>

       <?php if(!empty($query5) && $query5['id'] != '') {  ?>
                    <input type="submit" name="update" value="Update"/>
                    <input type="hidden" name="edit_id" value="<?php if(!empty($query5) && $query5['id'] != '') { echo $query5['id']; } ?>"/>
              <?php  } else { ?>
                <input type="submit" name="submit" value="submit"/>
            <?php  } ?>
      <h4><a href="user_list.php">SHOW LIST</a></h4>
      <h4><a href="dashboard.php">Back Dashboard</a></h4>

</form>
</body>
</html>