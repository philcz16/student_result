<?php
ob_start();
session_start();
include("dbconnect.php");


$errormsg="";
$successmsg="";

if(isset($_POST['submit'])){
	
	$session_yr= mysqli_real_escape_string($con,$_POST['session_yr']);
	
	
	$sst= mysqli_query($con, "SELECT * FROM session WHERE session_yr= '$session_yr'");
	$ccc= mysqli_num_rows($sst);
	if($ccc !==0){
		$errormsg= "<div id='errormsg'>This session is already added</div>";
	}else{
		
	
	$ss= "INSERT INTO session(session_id,session_yr) VALUES('', '$session_yr')";
	$run= mysqli_query($con,$ss);
	
	if($run){
		$successmsg="<div id='successmsg'>Session has been added successfully</div>";
	}else{
		$errormsg= "<div id='errormsg'>Error trying to added session, please try again</div>";
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
	  
	  <div class="navi"><p>Add Session year Here</p></div>
	  <div class="sub-section">
	  
     <form action="" method="POST" id="form-register">
	 <?php echo $errormsg;?>
	 <?php echo $successmsg;?>
	 <label for="Session">Add Session:</label>
	 <div><input type="text" name="session_yr" required><div>
	 
	 
	 <div><input type="submit" name="submit" value="Save"></div>
	 
	 
	 </form>
	 
</div>
   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>