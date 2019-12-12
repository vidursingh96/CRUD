<?php
include('dashboard.php');


#######To fetch Sub category value only in table list not sub sub category value....
		
		$countData = "
				SELECT *  FROM `category` WHERE p_id  in (SELECT id  FROM `category` WHERE p_id != 0 )
				";
		$fetchData = mysqli_query($con,$countData);	
		
### For Search category to their sub part with their sub part....

	$selData = "
					SELECT
						id,category
					from
						category
					where 
						p_id = '0'
				";
	$cateData = mysqli_query($con,$selData);	
?>

<html>
<head>
	<title>
		Category List
	</title>
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

<h2>Category List Table</h2>

<body>
	    <a href="sub_category.php">Add Sub Category</a>&nbsp;&nbsp;&nbsp;
		
  <br/>
  <br/>
  <form method='POST' action='#'>
          <?php  
    		  $getCategoryList =  getCategoryList($con); ?>
  
		  &nbsp;&nbsp;<select name="sub_sub_category_id" id="sub_sub_category_id" onChange="

		  change_sub_sub_category();">					
		  <option value='0'>---------Select---------</option>
			<?php
			    if(mysqli_num_rows($cateData)){
					$i = 1;	
					while($row = mysqli_fetch_array($cateData)){
					?>
						<option value="<?php echo $row['id'];?>">
							<?php echo $row['category'];?>
						</option>
					<?php
					}
				}
			?>
			</select>&nbsp;&nbsp;
			
</form>			
<table id="show_data">
  <tr>
    <th>ID</th>
    <th>Category</th>
	<th>Sub Category</th>
	<th>Sub Sub Category</th>
	<th>Edit</th>
  </tr>
  
  
  <?php
	  if(mysqli_num_rows($fetchData) > 0){
		$i = 1;	
		while($data = mysqli_fetch_array($fetchData)){
		
		//if($data['p_id'] == 0) {
			
			$getCatname = getCatnamedata($data['p_id'] , $con);
			$getSubCatname = getSubCatname($data['p_id'] , $con);
  ?>
  <tr>
    <td><?php echo $i;?></td>
	<td><?php /* To print the value of category*/echo $getCatname;?></td>
	<td><?php /* To print the value of Sub category*/echo $getSubCatname;?></td>
	<td><?php /* To print the value of Sub Sub category*/echo $data['category'];?></td>
	<td> <a  /*To send directly on this*/ href="sub_sub_cat.php?getid=<?php echo $data['id']; ?>">Edit</td>
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
</body>
</html>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		 
		<script>
		<!-- Use of Ajax To Search Category, Sub category ,Sub Sub Category -->
			function change_sub_sub_category(){
				 var sub_sub_category_id = $("#sub_sub_category_id").val();
				  
				  if(sub_sub_category_id == '0') {
					  sub_sub_category_id = 0;
				  }else{
					  sub_sub_category_id = sub_sub_category_id;
				  }
				 
					$.ajax({
					 type: "POST",
					 url  : "search_sub_subb_cat_list.php",
					 data : "sub_sub_category_id="+ sub_sub_category_id,
					 cache: false,
					 success: function(response)
					 {
						 $('#show_data').html(response);
					   //alert(response);
					 //return false; != ''
					  
					 }
					 });
					 
			}
		</script>