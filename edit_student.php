<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";
	
	
	
	
	
	
	


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

	  <div class="navi"><p>Enter Student Individual Profile</p></div>
	  	  <div class="sub-section">
		  
		  
		  <div class="pagination">
    <ul>

    <li  class="active"><a href="student_list.php"><font color="white">View All Student</font></a></li>
	 <li  class="active"><a href="student.php"><font color="white">Add New Student</font></a></li>
    
   
 
  
    </ul>
	

    </div>
		  
		  
		  <?php
	
	$id= $_GET['student_id'];
	
	
	
	$res= mysqli_query($con, "SELECT * FROM student WHERE Student_id = '$id'");
	$rows= mysqli_fetch_array($res);
	$student_name= $rows['student_name'];
?>

<?php
if(isset($_POST['submit'])){
		
		$id= $_GET['student_id'];
    $student_name= mysqli_real_escape_string($con,$_POST['student_name']);
    $admission_no= mysqli_real_escape_string($con,$_POST['admission_no']);
    $gender = $_POST['gender'];
    $class= mysqli_real_escape_string($con,$_POST['class_name']);
    $dob=mysqli_real_escape_string($con,$_POST['dob']);
    $lga= mysqli_real_escape_string($con,$_POST['lga']);
    $state= mysqli_real_escape_string($con,$_POST['state']);
	
	$house= mysqli_real_escape_string($con,$_POST['house']);
	
	$file_name = time();
	require('upload_file.php');
	upload_file('passport', $file_name);
	
	
	if(isset($_POST['submit']) && ($class!=="..student class..") && ($class!=="..student house..") &&($dob!=="..Y..") &&($dob!=="..M..") &&($dob!=="..D..")){
	
	$update= "UPDATE student SET student_name= '$student_name', admission_no= '$admission_no',gender='$gender', class_name='$class',dob='$dob',lga='$lga',state='$state',house='$house',photo= '$file_name' WHERE student_id='$id'";
	
	$run_update= mysqli_query($con, $update);
	
	if($run_update){
		header("Location:student_list.php");
	}
	}
    

	}
	
	?>

		
		<form action="" method="POST" id="form-register" enctype="multipart/form-data">
                <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                   <div> <label for="studentname">Student Name:</label>
                    <input type="text" name="student_name" id="studentname" value="<?php echo $student_name;?>"></div>

                   <div> <label for="admission_no">Admission Number: </label>
                    <input type="text" name="admission_no" id="admission_no" value="<?php echo $rows['admission_no'];?>"></div>

                    
				<div> <label for="gender">Gender: </label>
                    <input type="text" name="gender" id="gender" value="<?php echo $rows['gender'];?>"></div>
                  
				   
				  
				
				   

                   <div><label>Student Class</label>
                    <select name="class_name" id="studclass">
                        <option>..student class..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM class");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
                </select></div>
				
				<div><label>House Allocated: </label>
                    <select name="house" id="studclass">
                        <option>..student house..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM house");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['housename'];?></option>
                                <?php }?>
                </select></div>
				</br>
				
				
				
               <div><label>Date of Birth:</label> 
                    
                    <input type="text" name="dob" id="dob" value="<?php echo $rows['dob'];?>"></div>

                    
					<div><label for="lga">LGEA: </label>
                    <input type="text" name="lga" id="lga" value="<?php echo $rows['lga'];?>"></div>

                   <div><label for="state">State Origin: </label>
                    <input type="text" name="state" id="state" value="<?php echo $rows['state'];?>"></div>
                    
					
					<div><label>Image: </label>
					<input type="file" name="file" class="image" value="<?php echo $rows['photo'];?>"> </div>

                    <div><input type="submit" name="submit" value="Save"></div>

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   <?php include('footer.php');?>
   
   </body>
</html>