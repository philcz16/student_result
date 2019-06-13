<?php
ob_start();
session_start();
include("dbconnect.php");





	
	$errormsg="";
		
	$successmsg="";
	
	$adm_no="";
	$std_class="";
	$term="";
	$session_yr="";
	$subject="";
	
	$first_ca="";
	$second_ca="";
	$third_ca="";
	$exam="";
	
	

	if(isset($_POST['search'])){
		$adm_no = $_POST['admission_no'];
		$subject= $_POST['subname'];
		$std_class = $_POST['class_name'];
		$term= $_POST['term'];
		
		$session_yr=$_POST['session_yr'];
		
		
		$query1 = mysqli_query($con, "SELECT * FROM scores WHERE admission_no='$adm_no' AND subname='$subject' AND class_name='$std_class' AND term='$term' AND session_yr='$session_yr'");
		if(mysqli_num_rows($query1) == 0 || !isset($adm_no)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist for this student</div>"; 
		header("Location: junior_cat.php");
  }
			
	}
?>





<?php
		$adm_no = $_POST['admission_no'];
		$subject= $_POST['subname'];
		$std_class = $_POST['class_name'];
		$term= $_POST['term'];
		
		$session_yr=$_POST['session_yr'];
	$que= mysqli_query($con, "SELECT * FROM scores WHERE admission_no='$adm_no' AND subname='$subject' AND class_name='$std_class' AND term='$term' AND session_yr='$session_yr'");
	while($rowss=mysqli_fetch_array($que)){
		$adm_no= $rowss['admission_no'];
		$subject= $rowss['subname'];
		$std_class= $rowss['class_name'];
		$term= $rowss['term'];
		$session_yr= $rowss['session_yr'];
	}


?>






<?php
		
	
		
	if(isset($_POST['submit'])){
	$first_ca= $_POST['first_ca'];
	$second_ca= $_POST['second_ca'];
	$third_ca= $_POST['third_ca'];
	$exam= $_POST['exam'];
	
	
		

  $update= "UPDATE scores SET first_ca='$first_ca', second_ca='$second_ca', third_ca='$third_ca', exam='$exam' WHERE admission_no='$adm_no' AND class_name='$std_class' AND subname='$subject' AND session_yr='$session_yr' AND term='$term'";
	
	$run_update= mysqli_query($con, $update);
		
	

  if($run_update){
    $successmsg= "<div id='successmsg'>Your update was successfully made. thanks!";
	
  }else{
    $errormsg= "<div id='errormsg'>Update failed, please retry</div>";
  }
			
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
		
		<div class="sub-section">
		
		
		
		<form action="" method="POST" class="compute-scores">
		
		<div><label>Subject</label></br>
		
		<input type="text" name="subname" value="<?php echo $subject;?>"></div>
		
		<div><label>Term</label></br>
		
		<input type="text" name="term" value="<?php echo $term;?>"></div>
		
		<div><label>Session Year</label></br>
		
		<input type="text" name="session_yr" value="<?php echo $session_yr;?>"></div></br>
		
		
		
		<table border="1" width="95%">
		<tr>
		<th>S/N</th>
		<th>Admission No</th>
		<th>Student Name</th>
		<th>Class Name</th>
		<th>First Ca</th>
		<th>Second Ca</th>
		<th>Third Ca</th>
		<th>Exams</th>
		
		</tr>
		
		
		<?php
		$count = 0;
		
		$sql = mysqli_query($con,"SELECT * FROM scores WHERE admission_no='$adm_no' AND subname='$subject' AND class_name='$std_class' AND term='$term' AND session_yr='$session_yr'");
		while($row = mysqli_fetch_array($sql)){
			$student_name= $row['student_name'];
			$admission_no= $row['admission_no'];
			$class_name= $row['class_name'];
			
			
			
			$count++;
		
		
		
		
		?>
		
		
		
		
		<tr>
		<td><?php echo $count;?></td>
		<td ><input type="text" name="admission_no" value="<?php echo $admission_no;?>" readonly></td>
		<td width="50%"><input type="text" name="student_name" value="<?php echo $student_name;?>" readonly></td>
		<td  width="15%"><input type="text" name="class_name" value="<?php echo $class_name;?>" readonly></td>
		<td  width="10%"><input type="text" name="first_ca"   value="<?php echo $row['first_ca'];?>" ></td>
		<td  width="10%"><input type="text" name="second_ca"  value="<?php echo $row['second_ca'];?>"></td>
		<td  width="10%"><input type="text" name="third_ca"  value="<?php echo $row['third_ca'];?>"></td>
		<td  width="10%"><input type="text" name="exam"  value="<?php echo $row['exam'];?>"></td>
		</tr>
		
		<?php };?>
		</table>
		<input type="submit" name="submit" value="Save Scores">
		
		<?php echo $errormsg;?>
		<?php echo $successmsg;?>
		</form>
		
		
		
		</div>
   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   <?php include('footer.php');?>
   
   
   
   </body>
</html>