<?php 

function getcatname($id , $con) {

	//echo 'sds';
	$show = mysqli_query($con, "SELECT * FROM category where id = $id ");

     $row = mysqli_fetch_array($show);
     return $row['category'];
}

	function getSubCatname($pid ,  $con) {
	    $countData = "
				SELECT
				   id, category
				from 
					category
					
				where   id = ".$pid."";
				//echo $countData; die;
		$fetchData = mysqli_query($con,$countData);
		$data = mysqli_fetch_array($fetchData);
		//print_r($fetchData);
		return $data['category'];
    }

   	function getCatnamedata($pid ,  $con){
		
		$countData = "
				SELECT
				   id, category , p_id
				from 
					category
					
				where   id = ".$pid."";
		$fetchData = mysqli_query($con,$countData);
		$data = mysqli_fetch_array($fetchData);
		
##### This Query is fetch the data of sub sub category...
		$countData1 = "
				SELECT
				   id, category , p_id
				from 
					category
					
				where   id = ".$data['p_id']."";
		
		$fetchData1 = mysqli_query($con,$countData1);
		$data1 = mysqli_fetch_array($fetchData1);
		return  $data1['category'];
	}	
   
   	function getCategoryList($con){
		 
		 $catdata =array();
		   $selData = "
					SELECT
						id,category
					from
						category
					where 
						p_id = '0'
				";
				
		$cateData = mysqli_query($con,$selData);
		if(mysqli_num_rows($cateData)){
						$i = 1;	
			while($row = mysqli_fetch_array($cateData)){
				
				$catdata[] = $row;
							
			}
		  }
		  return $catdata;
	}
	
?>