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

	  <div class="navi"><p>Select category to update result</p></div>
	  	  <div class="sub-section">
		  
		<div class="result_update">
		
		 <div class="pagination">
    <ul>

    <li  class="active"><a href="junior_cat.php"><font color="white">Junior Category</font></a></li>
	 <li  class="active"><a href="senior_cat.php"><font color="white">Senior Category</font></a></li>
    
   
 
  
    </ul>
	

    </div>
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   <?php include('footer.php');?>
   
   
   
   </body>
</html>