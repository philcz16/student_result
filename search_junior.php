<?php
ob_start();
session_start();
include("dbconnect.php");


$username=$_SESSION['username'];

$id= $_SESSION['id'];
$TeacherName= $_SESSION['TeacherName'];







$student_name="";
	if(isset($_POST['search'])){
		$class_name =  mysqli_real_escape_string($con,$_POST['class_name']);
		
		
		
		
		
  }
	  
	  
		
		
		
		
	


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
	  <link rel="shortcut icon" href="images/favico.png">
      <script src="js/jquery-1.8.3.min.js"></script> 
   </head>
   
   
   <body>

      
        <?php include("header.php");?>
      
  
   <div id="wrapper">
      <section>

	  <div class="navi"><p>Select your class thought</p></div>
	  	  <div class="sub-section">
		  
		  <div class="sub-aside">
		  
		  <?php
		  $test= mysqli_query($con, "select * from teacher WHERE TeacherName='$TeacherName' ORDER BY class_name AND subject DESC");
		  while($row=mysqli_fetch_array($test)){
			  $sub= $row['subject'];
			  $class= $row['class_name'];  
		  
		  
		  ?>
		  
		  
		  <div class="subclass">
		  <ul>

		  <li><a href=""><img src="images/icon.png" id="icon"><?php echo "$sub &nbsp $class";?></a></li>
		  </ul>
		  
		  </div>
		  <?php };?>
		  
		  
			
		  </div>
		<div class="search-class">
		
		<form action="scores_entry1.php" method="POST" id="form-register">
		<?php
         if (isset($_SESSION['errormsg'])) {
           echo  $_SESSION['errormsg']; 
           unset($_SESSION['errormsg']);
          } 

              ?>
			  <div><label>Class thought: </label>
		<select name="class_name" id="studclass">
		<option>..Select Class..</option>
		<?php $query=mysqli_query($con, "SELECT * FROM class WHERE class_name='$class' LIKE 'JSS%' ORDER BY class_name ASC");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
								
		</select></div>
		
		

		
		
		<div><input type="submit" name="search" value="search"></div>
		</form>
		
		
		
		
		</div>
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>


