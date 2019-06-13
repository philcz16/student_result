<?php
ob_start();
session_start();
include("dbconnect.php");
 
 $errormsg="";
 $successmsg="";
 
 $admission_no="";
$class_name="";
$student="";
$subname="";
$student_name="";
$run="";




 
 
 if(isset($_POST['search'])){
		
		$admission_no= $_POST['admission_no'];
		
		
		
		$squery= mysqli_query($con, "SELECT * FROM subject_registered WHERE admission_no= '$admission_no'");
		
		
		if (mysqli_num_rows($squery) == 0 || !isset($admission_no)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist for this Student or wrong Admission Number</div>"; 
		header("Location:view_register_sub.php");
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
	  
	  
				
				
				
				<?php
				$query= mysqli_query($con,"SELECT * FROM subject_registered WHERE admission_no='$admission_no'");
				$row= mysqli_fetch_array($query);
				if($row){
					$admission_no= $row['admission_no'];
					$student_name= $row['student_name'];
					$class_name= $row['class_name'];
					$subname= htmlentities($row['subname']);
					
				}
				?>
				
				<form action="" method="POST" id="form-register">
				<p class="pnotice">Notice !. Seperate every subject with Comma</p>
				<?php echo $errormsg;?>
                <?php echo $successmsg;?>
				<table  width="100%">
				<tr>
				<th>Admission Number</th>
				<th>Student Name</th>
				<th>Class Name</th>
				
				
				</tr>
				
				<tr>
				<td><input type="text" name="admission_no" value="<?php echo $admission_no;?>" readonly></td>
				<td><input type="text" name="student_name" value="<?php echo $student_name;?>" readonly></td>
				<td><input type="text" name="class_name" value="<?php echo $class_name;?>"></td>
				</tr>
				
				
				
				
				</table></br>
				
				<h1>Subject Registered</h1>
				
				
				<input type="search" name="subname" class="subname" value="<?php echo $subname;?>">
				
				
				<div><input type="submit" name="update" value="Update"></div>
	  </form>
			
	
			
	  </div>
   </section>
    <?php include("menu.php");?>
	
   </div>
   
   <?php include('footer.php');?>
   
   
   
   </body>
</html>