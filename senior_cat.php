<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	if (isset($_POST['search'])) {
		$adm_no = strtoupper($_REQUEST['admission_no']);
		$subject= strtoupper($_REQUEST['subname']);
		$std_class = strtoupper($_REQUEST['class_name']);
		$term= strtoupper($_REQUEST['term']);
		
		$session_yr=$_REQUEST['session_yr'];

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

	  <div class="navi"><p>Update section for Senior category</p></div>
	  	  <div class="sub-section">
		<div class="search-class">
		
		 <form action="process_updateres.php" method="POST" id="form-register">
		 
		 
		 <?php
         if (isset($_SESSION['errormsg'])) {
           echo  $_SESSION['errormsg']; 
           unset($_SESSION['errormsg']);
          } 

              ?>
		
                
				<div><label for="admissionno">Admission Number: </label> 
                 <input type="text" name="admission_no" id="admission_no"  required></div>
		
		<div><label>Student subject:</label>
		<select name="subname" id="studclass">
		<option>..Select  subject..</option>
		<?php $query=mysqli_query($con,"SELECT * FROM sub_senior ORDER BY subname ASC");
                            while($rows=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $rows['subname'];?></option>
                                <?php }?>
								
		</select></div>
		
		
		
		<div><label>Student Class:</label>
		<select name="class_name" id="studclass">
		<option>..Select  Class..</option>
		<?php $query=mysqli_query($con,"SELECT * FROM class WHERE class_name LIKE '%SSS%' ORDER BY class_name ASC");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
								
		</select></div>
		
		
		<div><label>Term:</label>
		<select name="term" id="studclass">
				<option>..Select Term..</option>
				<option>First</option>
				<option>Second</option>
					<option>Third</option>					
		</select></div>
		
		
		<div><label>Session:</label>
		<select name="session_yr" id="studclass">
		<option>..Select Session..</option>
		<?php $query=mysqli_query($con,"SELECT * FROM session");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['session_yr'];?></option>
                                <?php }?>
								
		</select></div>
		
		<div><input type="submit" name="search" value="search"></div>
		</form>
		
		
		
		</div>
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>