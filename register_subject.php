<?php
ob_start();
session_start();
include("dbconnect.php");
 
 $errormsg="";
 $successmsg="";
 
 $admission_no="";
$class_name="";
$student="";
$subname="";
$run="";
 
 
 if(isset($_POST['search'])){
		
		$admission_no= $_POST['admission_no'];
		$class_name= $_POST['class_name'];
		
		
		$squery= mysqli_query($con, "SELECT * FROM student WHERE admission_no= '$admission_no' AND class_name='$class_name'");
		
		
		if (mysqli_num_rows($squery) == 0 || !isset($admission_no)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist for this Student or wrong class selection</div>"; 
		header("Location:search_student.php");
  }	
	}
 
 


if(isset($_POST['submit'])){
	$admission_no= $_POST['admission_no'];
	$student_name= $_POST['student_name'];
	$class_name= $_POST['class_name'];
	$session_yr= $_POST['session_yr'];
	$subname= $_POST['subname'];
  
	$subname= array();
  
  foreach($_POST['subname'] as $val){
    $subname[]= $val;
  }
	  

    $subname= implode(',', $subname);
   
  


	
	if(empty($subname)){
		 $errormsg= "<div id='errormsg'>please select student prefered subject</div>";
	}else{
		
	

      $res= mysqli_query($con,"SELECT * from subject_registered where admission_no= '$admission_no' AND class_name='$class_name'");
      $check= mysqli_num_rows($res);
      if($check !=0){
        $errormsg= "<div id='errormsg'>Subjects Already Registered for this Student</div>";
      }else{
		
		if(isset($_POST['submit']) && ($subname!=="..Please Select Class..") && ($session_yr!=="..Select Session..")){
      $sql= "INSERT into subject_registered (admission_no,student_name,class_name,subname,session_yr) VALUES('$admission_no','$student_name','$class_name','$subname','$session_yr')";

	  $run= mysqli_query($con,$sql);
      if($run){
        $successmsg = "<div id='successmsg'>The Subject $subname is successfully Added</div>";
      }else{
        $errormsg= "<div id='errormsg'>There was an error trying to add record, please try again</div>";
      }
		}
}
	}
}





?>

<?php

	$count= 0;
    $search1 = mysqli_query($con, "SELECT * FROM student WHERE admission_no= '$admission_no' AND class_name='$class_name'");
    while($row= mysqli_fetch_array($search1)){
		$student= $row['student_name'];
		
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

      <?php
   if(!isset($_SESSION['username'])){
	header("Location:index.php");
}

   ?>
        <?php include("header.php");?>
      
  
   <div id="wrapper">
      <section>
	  <div class="navi"><p>Register subjects</p></div>
      <div class="sub-section">
	  
				
	  
	  <form action="" method="POST" id="form-register">
	  
	  <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                
				<div><label for="admissionno"> Admission Number: </label>
                    <input type="text" name="admission_no" id="admission_no" value="<?php echo $admission_no;?>" readonly></div>
					
                   <div> <label for="studentname"> Student's Name :</label>
                    <input type="text" name="student_name" id="studentname" placeholder="Enter student name"  value="<?php echo $student;?>" readonly></div>

                   <div><label for="class_name"> Class Name: </label>
                    <input type="text" name="class_name" id="studentname" placeholder="Enter student name"  value="<?php echo $class_name;?>" readonly></div>
					
				
				<div><label for="session">Session: </label>
				<select name="session_yr" id="studclass">
				<option>..Select Session..</option>
		<?php $query1 = mysqli_query($con, "select * from session");
                            while($row1=mysqli_fetch_array($query1)){
                            ?>
                            <option ><?php echo $row1['session_yr'];?></option>
                                <?php }?>
								
		</select></div>
				
				
				
				
				<p class="notice">Select Subjects  Offers</p>
				
				<?php
				$sss= mysqli_query($con, "SELECT * FROM sub_senior");
				while($result=mysqli_fetch_array($sss)){
					$sub1= $result['subname'];
					
					
					echo '<input type="checkbox" name="subname[]" value = "'. $sub1 .'" >';
					echo "<span class='subject'>$sub1</span></br>";
				}
				
				?>
				
				
				
	  <div><input type="submit" name="submit" value="submit"></div>
	  
	  </form>
			
	
			
	  </div>
   </section>
    <?php include("menu.php");?>
	
   </div>
   
   
   
   
   
   </body>
</html>