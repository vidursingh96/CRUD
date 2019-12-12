<?php

include('dashboard.php');

$show = mysqli_query($con, "SELECT * FROM products");

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<h2>Product List</h2>

<table>
  <tr>
  	<th>S.No</th>
    <th>Categoy</th>
    <th>Sub Category</th>
    <th>Sub Sub Category</th>
    <th>Product Name</th>
    <th>Product Description</th>
    <th>Product Price</th>
    <th>Product Image</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>
     <?php
    
    $i = 1;

    while ($row = mysqli_fetch_array($show)) 
{


?>
  <tr class="record" id="row_data_<?php echo $row['id']; ?>">
  	<td><?php echo $i; ?></td>
    <td><?php echo $row['cat_id']; ?></td>
    <td><?php echo $row['sub_cat_id']; ?></td>
    <td><?php echo $row['sub_sub_cat_id']; ?></td>
    <td><?php echo $row['prod_name']; ?></td>
    <td><?php echo $row['prod_desc']; ?></td>
    <td><?php echo $row['pro_price']; ?></td>
    <td><img src="images/<?php echo $row['image']; ?>" style="width: 50px; height: 50px;" ></td>
    <td><a href="editprod.php">Edit</a></td>
    <td><a data-id="<?php echo $row['id'] ?>" class="delete" href="#">Delete</a></td>
  </tr>
  <?php $i++; } ?>
</table>
<script type="text/javascript">
  
$(document).on('click','.delete',function(){
var element = $(this);
var del_id = element.attr("data-id");
//alert(del_id);

var info = 'id=' + del_id;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "delprod.php",
   data: info,
   success: function(){

 }
});
  $(this).parents("tr").animate({ backgroundColor: "#00ffe8" }, "slow")
  .animate({ opacity: "hide" }, "slow");
 }
return false;
});

</script>
</body>
</html>