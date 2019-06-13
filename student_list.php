<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";	

?>

<?php
   if(!isset($_SESSION['username'])){
	header("Location:index.php");
}

   ?>


<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Results management system</title>
     
      
         <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> 
      <link rel="stylesheet" href="css/style.css">
	  <link href="css/font-awesome.css" rel="stylesheet" type="text/css" media="screen">
	  
	  
	  <link rel="shortcut icon" href="images/favico.png">
      <script src="js/jquery-1.8.3.min.js"></script> 
	  <script type="text/javascript" src="js/student.js" ></script>
   </head>
   
   
   <body>

      
        <?php include("header.php");?>
		
		
		
		
		
      
  
   <div id="wrapper">
      <section>

	  <div class="navi"><p>Enter Student Individual Profile</p></div>
	  	  <div class="sub-section">
		  
		  
		  <div class="pagination">
    <ul>

    <li  class="active"><a href="student_list.php"><font color="white">View All Student</font></a></li>
	 <li  class="active"><a href="student.php"><font color="white">Add New Student</font></a></li>
    
   
 
  
    </ul>
	

    </div>
		  
		<div class="form-search">
		<form action="" method="POST">
		
		
		
    
	<input placeholder="Search Student" class="input-large search-query" type="text" id="key" >
  	<div class="result"><div class="loading"></div></div>
    </form>
   
		
		</div>
					<table cellpadding="0" cellspacing="0" border="1" width="100%" class="display">
					<tr>
					<th>Student's Name</th>
					<th>Admission Number</th>
					<th>Class</th>
					<th>Gender</th>
					<th>Date of Birth</th>
					<th>Local Govt</th>
					<th>State Origin</th>
					<th>House Allocated</th>
					<th>Actions</th>
					</tr>
					
					
					
					<?php
					
					$get_student= mysqli_query($con, "SELECT * FROM student ORDER by class_name LIMIT 0,9 ");
					while($row= mysqli_fetch_array($get_student)){

						$id= $row['student_id'];
					?>
			
					<tr>
					<tr class="del<?php echo $id ?>">
					<td><?php echo $row['student_name'];?></td>
					<td><?php echo $row['admission_no'];?></td>
					<td><?php echo $row['class_name'];?></td>
					<td><?php echo $row['gender'];?></td>
					<td><?php echo $row['dob'];?></td>
					<td><?php echo $row['lga'];?></td>
					<td><?php echo $row['state'];?></td>
					<td><?php ?></td>
					<td><a href="edit_student.php<?php echo '?student_id='.$id; ?>"><img src="images/edit.png" class="actions" title="Edit student"></a>
					<a  class="btn btn-danger1" id="<?php echo $id; ?>"><img src="images/del.png" class="actions" title="Delete Student"></a>
					</td>
					
					
					</tr>
					
					<?php }?>
					</table>

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <script type="text/javascript">
	$(document).ready( function() {
	
	var myDate = new Date();
var pc_date = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
var pc_time = myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds();
jQuery(".pc_date").val(pc_date);
jQuery(".pc_time").val(pc_time);
	
	
	$('.btn-danger1').click( function() {
		
		var id = $(this).attr("id");
		var pc_date = $('.pc_date').val();
		var pc_time = $('.pc_time').val();
		var data_name = $('.data_name'+id).val();
		var user_name = $('.user_name').val();
		
		if(confirm("Are you sure you want to delete this Student?")){
			
		
			$.ajax({
			type: "POST",
			url: "delete_student.php",
			data: ({id: id,pc_time:pc_time,pc_date:pc_date,data_name:data_name,user_name:user_name}),
			cache: false,
			success: function(html){
			$(".del"+id).fadeOut('slow'); 
			} 
			}); 
			}else{
			return false;}
		});				
	});

</script>
   
   <?php include('footer.php');?>
   
   
   
   </body>
</html>