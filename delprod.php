<?php

include 'connection.php';



if(isset($_POST['id'])) {
$del_id=$_POST['id'];


$query1  = "DELETE from products WHERE id=".$del_id."";
   mysqli_query($con, $query1);
   header('Location: products_list.php');
   
}

?>