<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";
	
	
	
		

	$student_id= $_GET['student_id'];
	$query= mysqli_query($con, "SELECT * FROM student WHERE student_id ='$student_id'");
	
	while($row= mysqli_fetch_array($query)){
		$admission_no= $row['admission_no'];
		  $class_name=$row['class_name'];
		  $dob=$row['dob'];
		  $lga=$row['lga'];
		  $state=$row['state'];
		  $gender=$row['gender'];
		  $student_name=$row['student_name'];
	}
	
	
	if(isset($_POST['edit'])){
		$student_id= $_GET['student_id'];
		$admission_no= $_POST['admission_no'];
		$class_name=$_POST['class_name'];
		$dob= $_POST['dob'];
		$lga= $_POST['lga'];
		$state= $_POST['state'];
		$gender= $_POST['gender'];
		$student_name= $_POST['student_name'];
		
		
		$update= mysqli_query($con,"UPDATE student SET admission_no='$admission_no', student_name='$student_name',class_name='$class_name',gender='$gender',lga='$lga', state='$state' WHERE student_id='$student_id'");
		
		
		
		if($update){
			$successmsg="<div id='successmsg'>update was successfully made. Thanks!</div>";
		}else{
			$errormsg= "<div id='errormsg'>Error trying to add records</div>";
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

	  <div class="navi"><p>You are in Student Update Entry</p></div>
	  	  <div class="sub-section">
		
		<form action="" method="POST" id="form-register">
                <?php echo $errormsg;?>
                <?php echo $successmsg;?>
				
				
					Student Name</br>
                   <div> <label for="studentname"></label>
                    <input type="text" name="student_name" id="studentname" value="<?php echo $student_name;?>"></div>
					
					Admission Number</br>
                   <div> <label for="admission_no"></label>
                    <input type="text" name="admission_no" id="admission_no" value="<?php echo $admission_no;?>"></div>

                    Class</br>
					<div> <label for="class_name"></label>
                    <input type="text" name="class_name" id="class_name" value="<?php echo $class_name;?>"></div>
					
					Date of Birth</br>
					<div> <label for="dob"></label>
                    <input type="text" name="dob" id="dob" value="<?php echo $dob;?>"></div>

                  Gender</br>
				<div> <label for="gender"></label>
                    <input type="text" name="gender" id="gender" value="<?php echo $gender;?>"></div>
                   
                

                    
					Local Government Area</br>
                    <div><label for="lga"></label>
                    <input type="text" name="lga" id="lga" value="<?php echo $lga;?>"></div>

                   State of Origin</br>
				   <div><label for="state"></label>
                    <input type="text" name="state" id="state" value="<?php echo $state;?>"></div>

                    <input type="submit" name="edit" value="Update student">

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>