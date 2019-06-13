<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	if (isset($_POST['search'])) {
		$std_class = strtoupper($_REQUEST['class_name']);
		$term= strtoupper($_REQUEST['term']);

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

	  <div class="navi"><p>Print All result in one class</p></div>
	  	  <div class="sub-section">
		<div class="search-class">
		
		 <form action="process_printall.php" method="POST" id="form-register">
                
				
		<select name="class_name">
		<option>..Select Student Class..</option>
		<?php $query=mysqli_query($con,"SELECT * FROM class");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
								
		</select>
		
		
		<select name="term">
				<option>..Please Select Term..</option>
				<option>First</option>
				<option>Second</option>
					<option>Third</option>					
		</select>
		
		<div><input type="submit" name="search" value="search"></div>
		</form>
		
		
		<?php
         if (isset($_SESSION['errormsg'])) {
           echo  $_SESSION['errormsg']; 
           unset($_SESSION['errormsg']);
          } 

              ?>
		
		</div>
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>