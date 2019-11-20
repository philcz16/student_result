<?php
ob_start();
session_start();
include("dbconnect.php");





	$admission_no="";
	$errormsg="";
		
	$successmsg="";
	$class_name="";
	$total="";
	
	

	if(isset($_POST['search'])){
		$class_name =  mysqli_real_escape_string($con,$_POST['class_name']);
		
		
		$query1 = mysqli_query($con, "SELECT * FROM student WHERE class_name='$class_name'");
		if(mysqli_num_rows($query1) == 0 || !isset($class_name)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist for this class</div>"; 
		header("Location: search_junior.php");
  }
			
	}
?>











<?php
		
	
	
			
	if(isset($_POST['submit'])){
		
	
    foreach ($_POST['admission_no'] as $row=>$admission_no){
      $admission_no= mysqli_real_escape_string($con,$admission_no);
      $student_name= mysqli_real_escape_string($con,$_POST['student_name'][$row]);
      $class_name= mysqli_real_escape_string($con,$_POST['class_name'][$row]);
      $subname= mysqli_real_escape_string($con,$_POST['subname']);
        $first_ca= mysqli_real_escape_string($con,$_POST['first_ca'][$row]);
        $second_ca= mysqli_real_escape_string($con,$_POST['second_ca'][$row]);
        $third_ca= mysqli_real_escape_string($con,$_POST['third_ca'][$row]);
        $exam= mysqli_real_escape_string($con,$_POST['exam'][$row]);
		$session_yr= mysqli_real_escape_string($con,$_POST['session_yr']);
		$term= mysqli_real_escape_string($con,$_POST['term']);
		
        
        
        
			
          //trying to make sure students records is not double entered

          $query= mysqli_query($con,"SELECT * FROM scores WHERE admission_no= '$admission_no' AND subname= '$subname' AND term='$term' AND session_yr='$session_yr'");
		  

          $check= mysqli_num_rows($query);

          if($check != 0){
              $errormsg= "<div id='errormsg'>Scores entry for $subname has already been recorded</div>";
          }else{

          	//trying to make sure scores for test does not exeed 10 and exam not more than 70

          	if(($first_ca)>10 || ($second_ca)>10 || ($third_ca)>10)){
				$errormsg= "<div id='errormsg'>Continues assessment scores cannot exceed 10</div>";
		}elseif (($first_ca)<0 || ($second_ca)<0 || ($third_ca)<0))
			$errormsg= "<div id='errormsg'>Continues assessment scores cannot be less than 0</div>";
		{
		}else{
			
				if(($exam)>70){
					$errormsg= "<div id='errormsg'>Exam scores cannot exceed 70</div>";
				}else{




				

				if(isset($_POST['submit']) && ($subname!=="..Select Subject..") && ($session_yr!=="..Select Session..") &&($term!=="..Select Term..")){

        $res= "INSERT INTO scores(admission_no,student_name,class_name,subname,first_ca,second_ca,third_ca,exam,session_yr,term) 
          VALUES 
          ('$admission_no','$student_name','$class_name','$subname','$first_ca','$second_ca','$third_ca','$exam','$session_yr','$term')";
		 
		 $result= mysqli_query($con,$res);

        if($result){
          $successmsg= "<div id='successmsg'>The subject $subname is computed successfully</div>";
          
          
        }else{
          $errormsg= "<div id='errormsg'>There was an error trying to record, please try again</div>";
        }
}
}
    
}
        }

        
    }
	
	

	}

    ?>   
	
	<?php 
			

	$update= mysqli_query($con,"UPDATE scores SET total=(first_ca+second_ca+third_ca+exam)");
		
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
		
		<select name="subname">
		<option>..Select Subject..</option>
		<?php $query1=mysqli_query($con, "select * from sub_junior");
                            while($row1=mysqli_fetch_array($query1)){
                            ?>
                            <option ><?php echo $row1['subname'];?></option>
                                <?php };?>
								
		</select>
		<select name="session_yr">
		<option>..Select Session..</option>
		<?php $query1 = mysqli_query($con,"select * from session");
                            while($row1=mysqli_fetch_array($query1)){
                            ?>
                            <option ><?php echo $row1['session_yr'];?></option>
                                <?php };?>
								
		</select>
		
		<select name="term">
				<option>..Select Term..</option>
				<option>First</option>
				<option>Second</option>
					<option>Third</option>					
		</select>
		
		<?php echo $errormsg;?>
		<?php echo $successmsg;?>
		<table border="1" width="90%">
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
		
		$sql = mysqli_query($con,"SELECT * FROM student WHERE class_name='$class_name' ORDER BY student_name ASC");
		while($row = mysqli_fetch_array($sql)){
			$student_name= $row['student_name'];
			$admission_no= $row['admission_no'];
			$class_name= $row['class_name'];
			
			
			
			$count++;
		
		
		
		
		?>
		
		
		
		
		<tr>
		<td><?php echo $count;?></td>
		<td ><input type="text" name="admission_no[]" value="<?php echo $admission_no;?>" readonly></td>
		<td width="50%"><input type="text" name="student_name[]" value="<?php echo $student_name;?>" readonly></td>
		<td  width="15%"><input type="text" name="class_name[]" value="<?php echo $class_name;?>" readonly></td>
		<td  width="10%"><input type="text" name="first_ca[]"   required></td>
		<td  width="10%"><input type="text" name="second_ca[]"  required></td>
		<td  width="10%"><input type="text" name="third_ca[]"  required></td>
		<td  width="10%"><input type="text" name="exam[]"  required></td>
		</tr>
		
		<?php };?>
		</table>
		<input type="submit" name="submit" value="Save Scores">
		</form>
		
		
		
		</div>
   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>
