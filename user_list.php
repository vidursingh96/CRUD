<?php

include('dashboard.php');

$show = mysqli_query($con, "SELECT * FROM add_user  order by id");

if(isset($_GET['del'])) {
$del_id=$_GET['del'];


$query1  = "DELETE from add_user WHERE id=".$del_id."";
   mysqli_query($con, $query1);
   header('Location: user_list.php');
   die; 
}

if(isset($_POST['delete'])){
    if(!empty($_POST['check'])) {

        $checkbox = implode(',',$_POST['check']);
      mysqli_query($con," DELETE FROM add_user WHERE id in (".$checkbox.")");
       header('Location: user_list.php');
        die; 
   }
}

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
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

</head>
<body>

<h2>USER LIST</h2>

<form method="post" action="" onsubmit="return deleteConfirm();">

<table>
  <tr>
    <th><input type="checkbox" id="select_all" /> Select all</th>
    <th>Name</th>
    <th>Username</th>
    <th>Password</th>
    <th>Gender</th>
    <th>Hobbies</th>
    <th>Address</th>
    <th>Edit</th>
    <th>Delete</th>

  </tr>
  <tr>
    <?php
    
    while ($row = mysqli_fetch_array($show)) 
{

?>
     <td><input type="checkbox" id="checkItem" name="check[]" class="checkbox" value="<?php echo $row['id']; ?>"></td>
    <td><?php echo $row['name'];?></td>
    <td><?php echo $row['username'];?></td>
    <td><?php echo $row['password'];?></td>
    <td><?php echo $row['gender'];?></td>
    <td><?php echo $row['hobbies'];?></td>
    <td><?php echo $row['address'];?></td>
    <?php echo "<td><a href='add_user.php?edit_id=".$row['id']."'>Edit</a></td>";?>
    <?php echo "<td><a href='user_list.php?del=".$row['id']."'>Delete</a></td>";?>
  </tr>
<?php  } ?>
</table><br>
<input type="submit" name="delete" value="Delete">
<h4><a href="add_user.php">ADD USERS</a></h4>
<h4><a href="dashboard.php">Back Dashboard</a></h4>
</form>
<script type="text/javascript">

function deleteConfirm(){
    var result = confirm("Do you really want to delete records?");
    if(result){
        return true;
    }else{
        return false;
    }
}
$(document).ready(function(){
    $('#check_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#check_all').prop('checked',true);
        }else{
            $('#check_all').prop('checked',false);
        }
    });
});

$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});

</script>
</body>
</html>

