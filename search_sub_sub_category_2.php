<?php
//include_once('dashboard.php');
include 'connection.php';
 
    if(isset($_POST['category_id']) && $_POST['category_id'] != '') {
		
		$category_id = $_POST['category_id'];
		$SelVal= "select * from category where p_id='$category_id'";
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