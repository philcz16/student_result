<?php
ob_start();
session_start();
include("dbconnect.php");


if(isset($_POST['search'])){
		
		$admission_no= $_POST['admission_no'];
		$class_name= $_POST['class_name'];
		
		
		$squery= mysql_query("SELECT * FROM student WHERE admission_no= '$admission_no' AND class_name='$class_name'");
		
		
		if (mysql_num_rows($squery) == 0 || !isset($admission_no) && ($class_name)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist for this Student</div>"; 
		header("Location:search_student.php");
  }	
	}
	
	
	
	
	



if(isset($_POST['submit'])){
	$admission_no= $_POST['admission_no'];
	$student_name= $_POST['student_name'];
	$class_name= $_POST['class_name'];
	$session_yr= $_POST['session_yr'];
  
	$subname= array();
  
  foreach($_POST['subname'] as $val){
    $subname[]= $val;
  }
	  

    $subname= implode(',', $subname);
   
  


	
	if(empty($subname)){
		 $errormsg= "<div id='errormsg'>please select subjects offered</div>";
	}else{
		
	

      $res= mysql_query("SELECT * from junior_registered where admission_no= '$admission_no' AND class_name='$class_name'");
      $check= mysql_num_rows($res);
      if($check !=0){
        $errormsg= "<div id='errormsg'>Subjects Already Registered for this Student</div>";
      }else{
		
		if(isset($_POST['submit']) && ($subname!=="..Please Select Class..") && ($session_yr!=="..Please Select Session..")){
      $sql= mysql_query("INSERT into junior_registered (admission_no,student_name,class_name,subname,session_yr) VALUES('$admission_no','$student_name','$class_name','$subname','$session_yr')");

      if($sql){
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
    $search1 = mysql_query("SELECT * from student where class_name='$class_name'");
    while($row= mysql_fetch_array($search1)){
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
	  <div class="navi"><p>Register subjects for Junior Secondary Level</p></div>
      <div class="sub-section">
	  
				<?php echo $errormsg;?>
                <?php echo $successmsg;?>
	  
				<form action="" method="POST" id="form-register">
                
				<div> Admission Number</br>
                    <input type="text" name="admission_no" id="admission_no" placeholder="Enter student Admission Number" value="<?php echo $admission_no;?>" required></div>
					
                   <div> Student's Name</br>
                    <input type="text" name="student_name" id="studentname" placeholder="Enter student name" value="<?php echo $student;?>" required></div>
					
					<div> Class Name</br>
                    <input type="text" name="class_name" id="studentname" placeholder="Enter student name" value="<?php echo $class_name;?>" required></div>

                  
				
				<select name="session_yr" id="studclass">
				<option>..Please Select Session..</option>
		<?php $query1 = mysql_query("select * from session");
                            while($row1=mysql_fetch_array($query1)){
                            ?>
                            <option ><?php echo $row1['session_yr'];?></option>
                                <?php }?>
								
		</select>
				
				
				
				
				<p class="notice">Select Subjects  Offers</p>
				
				
				<div> Check All <input type="checkbox"  name="selectAll" id="checkAll" />
                <script>
                $("#checkAll").click(function () {
                  $('input:checkbox').not(this).prop('checked', this.checked);
                });
                </script>
                  </div>
				
				<?php
				$sss= mysql_query("SELECT * FROM sub_junior");
				while($result=mysql_fetch_array($sss)){
					$sub1= $result['subname'];
					
					
					echo '<input type="checkbox" name="subname[]" value = "'. $sub1 .'" >';
					echo "$sub1</br>";
				}
				
				?>
				
				
				
	  <input type="submit" name="submit" value="submit">
	  
	  </form>
				
	  </div>
   </section>
    <?php include("menu.php");?>
	
   </div>
   
   
   
   
   
   </body>
</html>