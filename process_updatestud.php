<?php
ob_start();
session_start();
include("dbconnect.php");
 
 $errormsg="";
 $successmsg="";
 
 




 
 
 if(isset($_POST['search'])){
		
		$class_name= $_POST['class_name'];
		
		$squery= mysqli_query($con, "SELECT * FROM student WHERE class_name='$class_name'");
		
		
		if (mysqli_num_rows($squery) == 0 || !isset($class_name)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Sorry ! Data not available for this class</div>"; 
		header("Location:update_student.php");
  }	
	}
 


?>


<?php




	if(isset($_POST['update'])){
					$admission_no = mysqli_real_escape_string($con,$_POST['admission_no']);
					$class_name = mysqli_real_escape_string($con,$_POST['class_name']);
					$subname = mysqli_real_escape_string($con,$_POST['subname']);
					
					$update= "UPDATE subject_registered SET subname='$subname', class_name='$class_name' WHERE admission_no='$admission_no'";
					
					$run= mysqli_query($con,$update);
					if($run){
						$errormsg="<div id='successmsg'>Subject update was successfull. Thanks!</div>";
					}else{
						$successmsg="<div id='successmsg'>error trying to update records</div>";
					}
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
	  <link rel="shortcut icon" href="images/favico.png">
      <script src="js/jquery-1.8.3.min.js"></script> 
   </head>
   
   
   <body>

      <?php
   if(!isset($_SESSION['username'])){
	header("Location:index.php");
}

   ?>
        <?php include("header.php");?>
      
  
   <div id="wrapper">
      <section>
	  <div class="navi"><p>Update Student Subject</p></div>
	  
      <div class="sub-section">
	  
	  
	  
	  <form action="" method="POST" id="form-student">
	  
	  <table border="1" width="90%">
	  <tr>
	  <th>Admission Number</th>
	   <th>Student Name</th>
		 <th>Gender</th>
		  <th>Date of Birth</th>
		   <th>LGEA</th>
		    <th>State</th>
			<th>Student Class</th>
			<th>Edit</th>
	  </tr>
	  
	  <?php
	  $query= mysqli_query($con, "SELECT * FROM student WHERE class_name='$class_name'");
	  
	  while($row= mysqli_fetch_array($query)){
		  $admission_no= $row['admission_no'];
		  $class_name=$row['class_name'];
		  $dob=$row['dob'];
		  $lga=$row['lga'];
		  $state=$row['state'];
		  $gender=$row['gender'];
		  $student_name=$row['student_name'];
		  
		  
		 
	?>
			
		
			
	  
	  <tr>
	  
	  <td><?php echo $admission_no;?></td>
	  <td><?php echo $student_name;?></td>
	  <td><?php echo $gender;?></td>
	  <td><?php echo $dob;?></td>
	  <td><?php echo $lga;?></td>
	  <td><?php echo $state;?></td>
	  <td><?php echo $class_name;?></td>
	  </td>
	  <td><a href='edit_singlestud.php?student_id=<?php echo $row['student_id'];?>'><img src='images/edit.png' id='edit' title='edit'></td>
	  
	  <?php };?>
	  
	  </tr>
	  </table>
	  
	  </form>
	  
	  </div>
   </section>
    <?php include("menu.php");?>
	
   </div>
   
   
   
   
   
   </body>
</html>