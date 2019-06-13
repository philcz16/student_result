<?php
ob_start();
session_start();
include("dbconnect.php");

	if(isset($_POST['search'])){
		
		$admission_no= $_POST['admission_no'];
		$class_name= $_POST['class_name'];
		
		
		
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

	  <div class="navi"><p>Enter Student Admission Number and class for subject registration</p></div>
	  	  <div class="sub-section">
		<div class="search-class">
		
		 <form action="register_subject.php" method="POST" id="form-register">
		 
		 <?php
         if (isset($_SESSION['errormsg'])) {
           echo  $_SESSION['errormsg']; 
           unset($_SESSION['errormsg']);
          } 

              ?>
		
                
				<div> <label for="admissionno">Admission Number:</label>
                 <input type="text" name="admission_no" id="admission_no" id="admissionno" required></div>
		
		
		
		<div>
		<div><label>Student Class</label>
		<select name="class_name" id="studclass">
		<option>..Select Class..</option>
		<?php $query=mysqli_query($con, "SELECT * FROM class WHERE class_name LIKE 'SSS%' ORDER BY class_name");
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