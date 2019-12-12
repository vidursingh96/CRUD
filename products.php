
<?php 

// print_r($_FILES); die;

include("dashboard.php"); 

if (isset($_POST['submit']))

{

$category_id = $_POST['category_id'];
$sub_cat = $_POST['sub_cat'];
$sub_sub_cat = $_POST['sub_sub_cat'];
$pro_name = $_POST['product_name'];
$pro_desc = $_POST['editor1'];
$pro_price = $_POST['product_price'];
 
   $sql = "INSERT INTO `products`(`cat_id`, `sub_cat_id`, `sub_sub_cat_id`, `prod_name`,`prod_desc`,`pro_price`,`image`) VALUES ('".$category_id."','".$sub_cat."','".$sub_sub_cat."','".$pro_name."','".$pro_desc."','".$pro_price."','".$pro_img."')";
 
     $query = mysqli_query($con , $sql);

    $pid = mysqli_insert_id($con);
    // $pid =11;

 for($i = 0; $i <count($_FILES['product_img']); $i++) {

       $pro_img = str_replace(' ', '_', $_FILES['product_img']['name'][$i]);
       $pro_tmp = $_FILES['product_img']['tmp_name'][$i];
        move_uploaded_file($pro_tmp, "images/$pro_img");

       mysqli_query($con , "INSERT INTO `product_img` ( `product_id`, `image_name`, `createdOn`) VALUES ('".$pid."', '".$pro_img."', '".date('Y-m-d H:i:s')."');");

   }

   header('Location: products_list.php'); 
}

 $selData = "
            SELECT
                id,category
            from
                category
            where 
                p_id = '0'
        ";
    $cateData = mysqli_query($con,$selData);



if(isset($_POST['sub_sub_cat'])) {
		
		$sub_sub_category_id = $_POST['sub_sub_cat'];
		if($sub_sub_category_id == 0) {
			$where = 'WHERE p_id != 0';
		}else{
			$where = "WHERE p_id  = {$sub_sub_cat}";
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
		
			}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Products</title>
	<script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
	<style type="text/css">
		

	</style>
</head>
<body>

<div>
<form action="" method="post" enctype="multipart/form-data">


	Category&nbsp;&nbsp;
<br><br>

	<select name="category_id" id="category_id" onchange="change_category();" >  

<option value="">--Select--</option>
<?php
        if(mysqli_num_rows($cateData)){
        $i = 1; 
        while($row = mysqli_fetch_array($cateData)){
        ?>
            <option value="<?php echo $row['id'];?>"><?php echo $row['category'];?></option>
        <?php
        }
    }
?>
</select>
<br><br>


<label class="control-label">Sub Cat</label><br><br>

<select name="sub_cat" id="sub_cat" class="dropdown"  onChange="getsubsubcat(this.value)";>
   <option value="">Select sub category</option>
   </select>

   <br><br>


     <label class="control-label">Sub Sub Cat</label><br><br>

<select name="sub_sub_cat" id="sub_sub_cat" class="dropdown">
	<option value="">Select sub category</option>
	<?php
    
       while($query = mysqli_fetch_array($count)){
	?>
    <option value="">Select sub sub category</option>
<?php 

}

?>
    </select>

<br><br>

<label class="control-label">Products Name</label><br><br>

    <input type="text" class="m-wrap medium" name="product_name" required/><br><br>

<label class="control-label">Product Description</label><br><br>

<textarea name="editor1" id="editor1" rows="5"></textarea>
              <br>
<label class="control-label">Original Price</label><br><br>

    <input type="text" class="m-wrap medium" name="product_price" required/><br><br>

<label class="control-label">Products Image</label><br><br>

    <input type="file" class="m-wrap medium" name="product_img[]" multiple required/>

<button type="submit" name="submit" class="btn blue"><i class="icon-ok"></i> Save</button>

</form>
</div>
<script type="text/javascript">
	

 function change_category()
        {
         var category_id = $("#category_id").val();
         
            $.ajax({
             type: "POST",
             url  : "search_sub_sub_category_2.php",
             data : "category_id="+category_id,
             cache: false,
             success: function(response)
             {
        //alert(response);
             //return false; != ''
              if(response == '') {
               $("#sub_cat").html('<option value="0">Select sub category</option>');
              }else{
                  $("#sub_cat").html(response);
                  $("#sub_sub_cat").html('<option value="0">Select sub sub category</option>');
              }
             }
             });
             
        }

       function getsubsubcat(value){
        // var sub_cat $('#sub_cat').val();
          //  alert(value);
             $.ajax({
             type: "POST",
             url  : "search_sub_sub_category_3.php",
             data : "sub_cat_id="+value,
             cache: false,
             success: function(response)
             {
                 
                  if(response == '') {
               $("#sub_sub_cat").html('<option value="0">Select sub sub category</option>');
              }else{
                  $("#sub_sub_cat").html(response);
              }
             }
             });

       } 
                        CKEDITOR.replace( 'editor1' );
						CKEDITOR.config.width="60%";
						CKEDITOR.config.height="35%";							


</script>
</body>
</html>