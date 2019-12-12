<?php
//include_once('dashboard.php');
include 'connection.php';
 
    if(isset($_POST['sub_cat_id']) && $_POST['sub_cat_id'] != '') {
		
		$sub_cat_id = $_POST['sub_cat_id'];
		$SelVal= "select * from category where p_id='$sub_cat_id'";
		//$query = $conn->query($sql);
		$query = mysqli_query($con ,$SelVal);
		
		$count =  mysqli_num_rows($query);
		
			$str =  '<option value="">Select sub category</option>';
			if($count > 0) {
			while($res = mysqli_fetch_array($query)){
				$str .=  '<option value="'.$res['id'].'">'.$res['category'].'</option>';
			}
		}
		echo  $str;
    }
	
?>