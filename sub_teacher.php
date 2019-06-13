<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";
	
	
	
	
	
	if(isset($_POST['submit'])){
    $TeacherName= mysqli_real_escape_string($con,$_POST['staff_name']);
    $subject= mysqli_real_escape_string($con,$_POST['subname']);
    
	$class_name= mysqli_real_escape_string($con,$_POST['class_name']);
	
	
	

    if(!empty($TeacherName) && !empty($subject) && !empty($class_name)){
       
        //prevent assigning one subject to more than one teacher per class
        $sql= mysqli_query($con, "SELECT * FROM subject_teacher where subname= '$subject' AND class_name='$class_name'");

        $check= mysqli_num_rows($sql);
            if($check !=0){
                 $errormsg= "<div id='errormsg'>Sorry ! The subject $subject has already been assigned to $TeacherName in $class_name</div>";
            
        }else{


		if(isset($_POST['submit']) && ($class_name!=="..select subject..") && ($class_name!=="..select class..") && ($TeacherName!=="..select teachername..")){
        $res= "INSERT INTO subject_teacher (sub_id, staff_name, subname, class_name,date) VALUES('','$TeacherName','$subject','$class_name',NOW())";
		
		$result= mysqli_query($con,$res);

        if($result){
				$successmsg= "<div id='successmsg'>Record added successfully</div>";
        }else{
            $errormsg= "<div id='errormsg'><center>There was an error trying to add record, please try again</div>";
        }
		}
}

		
    }else{
       $errormsg= "<div id='errormsg'>All fields are required</div>";
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

	  <div class="navi"><p>Enter Student Individual Profile</p></div>
	  	  <div class="sub-section">
		  
		  
		  <div class="pagination">
    <ul>

    <li  class="active"><a href="student_list.php"><font color="white">View All Student</font></a></li>
	 <li  class="active"><a href="student.php"><font color="white">Add New Student</font></a></li>
    
   
 
  
    </ul>
	

    </div>
		  

		
		<form action="" method="POST" id="form-register" enctype="multipart/form-data">
                <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                   
                   
					
					<div><label>Allocate Subject: </label>
						<select name="subname" id="studclass">
                        <option>..select subject..</option>
                        <?php $query=mysqli_query($con,
						"SELECT DISTINCT subname FROM sub_junior 
							UNION 
							SELECT DISTINCT subname FROM sub_senior ORDER BY subname ASC
						");
                            while($rows=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $rows['subname'];?></option>
                                <?php }?>
                </select></div>
						
						
						
						
						<div><label>Teacher Name: </label>
						<select name="staff_name" id="studclass">
                        <option>..select teachername..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM staff");
                            while($rows=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $rows['staff_name'];?></option>
                                <?php }?>
                </select></div>
				
						<div><label> Allocate Class: </label>
                    <select name="class_name" id="studclass">
                        <option>..select class..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM class ORDER BY class_name ASC");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
                </select></div>
                    

                  
				   
				   
					
					
					
					
                    <div><input type="submit" name="submit" value="Save"></div>

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>