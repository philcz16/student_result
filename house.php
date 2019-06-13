<?php
ob_start();
session_start();
include("dbconnect.php");


$errormsg="";
$successmsg="";

if(isset($_POST['submit'])){
	
	$housename= mysqli_real_escape_string($con,$_POST['housename']);
	
	
	$sst= mysqli_query($con, "SELECT * FROM house WHERE housename= '$housename'");
	$ccc= mysqli_num_rows($sst);
	if($ccc !==0){
		$errormsg= "<div id='errormsg'>$housename house is already added</div>";
	}else{
		
	
	$ss= "INSERT INTO house(id, housename) VALUES('', '$housename')";
	$run= mysqli_query($con,$ss);
	
	if($run){
		$successmsg="<div id='successmsg'>House has been added successfully</div>";
	}else{
		$errormsg= "<div id='errormsg'>Error trying to added house, please try again</div>";
	}
	}
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
	  
	  <div class="navi"><p>Add House</p></div>
	  <div class="sub-section">
	  
     <form action="" method="POST" id="form-register">
	 <?php echo $errormsg;?>
	 <?php echo $successmsg;?>
	 <label for="Session">Add house:</label>
	 <div><input type="text" name="housename" required><div>
	 
	 
	 <div><input type="submit" name="submit" value="Save"></div>
	 
	 
	 </form>
	 
</div>
   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>