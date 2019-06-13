<?php
ob_start();
session_start();
include("dbconnect.php");

$errormsg="";
$successmsg="";


if(isset($_POST['submit'])){
	
  $subname= $_POST['subname'];
  
 
  
  
  

if(!empty($subname)){

      $res= mysqli_query($con, "SELECT * from sub_senior where subname= '$subname'");
      $check= mysqli_num_rows($res);
      if($check !=0){
        $errormsg= "<div id='errormsg'>The subject $subname is already added</div>";
      }else{

      $sql= "INSERT into sub_senior(subname) VALUES('$subname')";
	  $result= mysqli_query($con,$sql);

      if($result){
        $successmsg = "<div id='successmsg'>The Subject $subname is successfully Added</div>";
      }else{
        $errormsg= "<div id='errormsg'><center>There was an error trying to add record, please try again</center></div>";
      }
}
}else{
  $errormsg= "<div id='errormsg'>Please fill out the field</div>";
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
    <div class="navi"><p>Add Subjects at the Senior Secondary Level</p></div>
      <div class="sub-section">
	  <form action="" method="POST" id="form-register">
              <?php echo $errormsg;?>
              <?php echo $successmsg;?>
                   <div><label for="subname">Subject Name:</label>
                    <input type="text" name="subname" id="subname" id="subname"></div>
					<div><input type="submit" name="submit" value="Save"></div>
					
					
					
					
					</form>
				
	  </div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>