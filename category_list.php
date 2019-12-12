<?php


//include 'connection.php';
include('dashboard.php');

$show = mysqli_query($con, "SELECT * FROM category where p_id != 0 order by id");


?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<h2>HTML Table</h2>

<table>
  <tr>
    <th>S.no</th>
    <th>Category</th>
    <th>Sub Category</th>
    
  </tr>
   <?php
    
    $i = 1;

    while ($row = mysqli_fetch_array($show)) 
{

 $getcat = getcatname($row['p_id'] ,$con);

?>
  <tr>
    <td><?php echo $i;?></td>
    <td><?php echo $getcat; ?></td>
    <td><?php echo $row['category'];?></td>

  </tr>
  <?php $i++; } ?>
</table>

</body>
</html>