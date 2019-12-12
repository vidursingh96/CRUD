<?php
include('dashboard.php');
?>

<?php   
    
    $msg='';
    $selData = "
                    SELECT
                        id,category
                    from
                        category
                    where 
                        p_id = '0'
                ";
    $cateData = mysqli_query($con,$selData);
    
            
    if(isset($_POST) && !empty($_POST['save']) == 'save'){
            
        
        if(!empty($_POST['sub_cat'])){
            
               $InsData = "
                        Insert
                            into
                        category    
                            (p_id,category,level
                        )
                        values(
                            '".mysqli_real_escape_string($con,$_POST['sub_cat'])."',
                            '".mysqli_real_escape_string($con,$_POST['sub_sub_cat'])."',
                            '3'
                        )
                    "; 
                    
            $loggedUser = mysqli_query($con,$InsData);
                                
            if(!empty($loggedUser)){
                header('location: sub_subb_cat_list.php');
            }
            
        }else{
                 $msg = "Please Fill This Field";
             }
    }
?>

<html>
<head>
    <title>
        Sub Category
    </title>
    <h3> Sub Category</h3>
</head>
<body>

          <a href="sub_sub_category.php">Add Sub Sub Category</a>&nbsp;&nbsp;&nbsp;
          <a href="sub_subb_cat_list.php">List Sub Sub Category</a>&nbsp;&nbsp;&nbsp;
          <br/>
          <br/>
          
  
    <form action="" method='POST'>
          Category&nbsp;&nbsp;<select name="category_id" id="category_id"  onchange="change_category();">                       
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
            </select>&nbsp;&nbsp;</br></br>
    
            Sub Category&nbsp;<select name="sub_cat" id="sub_cat" class="dropdown">
            <option value="">Select sub category</option>
 
            </select>
            &nbsp;&nbsp;</br></br>
            Sub Sub Cat&nbsp;&nbsp; <input type="text" name="sub_sub_cat" value="">&nbsp;&nbsp;</br></br>
            
            &nbsp;&nbsp;<input type="submit" name="save" value="Save">

            
            
    </form>
         
        <script>
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
              }
             }
             });
             
        }
        </script>

</body>
</html>