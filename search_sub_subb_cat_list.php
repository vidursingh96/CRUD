<?php

include 'connection.php';

include 'functions.php';


    if(isset($_POST['sub_sub_category_id'])) {
		
		$sub_sub_category_id = $_POST['sub_sub_category_id'];
		if($sub_sub_category_id == 0) {
			$where = 'WHERE p_id != 0';
		}else{
			$where = "WHERE p_id  = {$sub_sub_category_id}";
		}
		
		$SelVal= " 	
					SELECT
						*  
					FROM 
						`category` 
					WHERE 
						p_id  in (SELECT id  FROM `category` $where)	
						
				";
		$query = mysqli_query($con ,$SelVal);
		$count =  mysqli_num_rows($query);
		
			?>
<table>
  <tr>
    <th>ID</th>
    <th>Category</th>
	<th>Sub Category</th>
	<th>Sub Sub Category</th>
	<th>Edit</th>
  </tr>  
  
  <?php
	  if(mysqli_num_rows($query) > 0){
		$i = 1;	
		while($data = mysqli_fetch_array($query)){
	
			$getCatname = getCatnamedata($data['p_id'] , $con);
			$getSubCatname = getSubCatname($data['p_id'] , $con);
  ?>
  <tr>
    <td><?php echo $i;?></td>
	<td><?php /* To print the value of category*/echo $getCatname;?></td>
	<td><?php /* To print the value of Sub category*/echo $getSubCatname;?></td>
	<td><?php /* To print the value of Sub Sub category*/echo $data['category'];?></td>
	<td> <a   href="sub_sub_cat.php?getid=<?php echo $data['id']; ?>">Edit</td>
	 </tr>
 <?php
		$i++;
		}
	}else{ ?>
	 <tr>
		<td colspan='5'> No Records Found</td>
	 </tr>	
	<?php }?>
 
</table>
	  <?php  } ?>	
			