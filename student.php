<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";
	
	
	
	
	
	if(isset($_POST['submit'])){
    $student_name= mysqli_real_escape_string($con,$_POST['student_name']);
    $admission_no= mysqli_real_escape_string($con,$_POST['admission_no']);
    $gender = $_POST['gender'];
    $class= mysqli_real_escape_string($con,$_POST['class_name']);
    $dob=$_POST['yy']."/".$_POST['mm']."/".$_POST['dd'];
    $lga= mysqli_real_escape_string($con,$_POST['lga']);
    $state= mysqli_real_escape_string($con,$_POST['state']);
	
	$house= mysqli_real_escape_string($con,$_POST['house']);
	
	$file_name = time();
	require('upload_file.php');
	upload_file('passport', $file_name);
	

    if(!empty($student_name) && !empty($admission_no) && !empty($gender) && !empty($class) && !empty($dob) 
		&& !empty($lga) && !empty($state) && !empty($house)){
        //trying to make sure student admission number is not more or less than 5 numbers
        if(strlen($admission_no ) != 5){
            $errormsg= "<div id='errormsg'>Student admission number must contain only five digits</div>";
        }else{




        //checking if student registration number exist
        $sql= mysqli_query($con, "SELECT * FROM student where admission_no= '$admission_no'");

        $check= mysqli_num_rows($sql);
            if($check !=0){
                 $errormsg= "<div id='errormsg'>Sorry ! The admission number '$admission_no' already in use</div>";
            
        }else{


		if(isset($_POST['submit']) && ($class!=="..student class..") && ($class!=="..student house..") &&($dob!=="..Y..")
			&&($dob!=="..M..") &&($dob!=="..D..")){
        $res= "INSERT INTO student(student_name,admission_no,gender,class_name,dob,lga,state,photo) 
		VALUES('$student_name','$admission_no','$gender','$class','$dob','$lga','$state', '$file_name')";
		
		$result= mysqli_query($con,$res);

        if($result){
            $successmsg= "<div id='succssmsg'>student details is successfully added</div>";
        }else{
            $errormsg= "<div id='errormsg'><center>There was an error trying to record, please try again</div>";
        }
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
                   <div> <label for="studentname">Student Name:</label>
                    <input type="text" name="student_name" id="studentname" ></div>

                   <div> <label for="admission_no">Admission Number</label>
                    <input type="text" name="admission_no" id="admission_no" ></div>

                    

                  
				   
				   <div><label>Choose Gender</label>
                    <select name="gender" id="studclass">
						<option>Male</option>
						<option>Female</option>
                        
                </select></div>
				
				   

                   <div><label>Student Class: </label>
                    <select name="class_name" id="studclass">
                        <option>..student class..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM class");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['class_name'];?></option>
                                <?php }?>
                </select></div>
				
				<div><label>House : </label>
                    <select name="house" id="studclass">
                        <option>..student house..</option>
                        <?php $query=mysqli_query($con,"SELECT * FROM house");
                            while($row=mysqli_fetch_array($query)){
                            ?>
                            <option ><?php echo $row['housename'];?></option>
                                <?php }?>
                </select></div>
				</br>
               <label>Date of Birth</label> 
                    <select name="yy" class="dob">
                        <option>..Y..</option>
                        
                        <?php
                            $sel="";
                            for($i=1985;$i<=2017;$i++){ 
                                if($i==$y){
                                    $sel="selected='selected'";}
                                else
                                $sel="";
                            echo"<option value='$i' $sel>$i </option>";
                            }
                            
                        ?>
                       
                    </select>
                    
                    <select name="mm" class="dob">
                        <option>..M..</option>
                        <?php
                            $sel="";
                            $mm=array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","NOv","Dec");
                            $i=0;
                            foreach($mm as $mon){
                                $i++;
                                    if($i==$m){
                                        $sel=$sel="selected='selected'";}
                                    else
                                        $sel="";
                                echo"<option value='$i' $sel> $mon</option>";       
                            }
                        ?>
                    </select>
                    
                    <select name="dd" class="dob">
                        <option>..D..</option>
                        <?php
                        $sel="";
                        for($i=1;$i<=31;$i++){
                            if($i==$d){
                                $sel=$sel="selected='selected'";}
                            else
                                $sel="";
                        ?>
                        <option value="<?php echo $i ;?>"<?php echo $sel?> >
                        <?php
                        if($i<10)
                            echo"0"."$i" ;
                        else
                            echo"$i";   
                              
                        ?>
                        </option>   
                        <?php 
                        }?>
                    </select>
                

                    

                    <div><label for="lga">LGEA: </label>
                    <input type="text" name="lga" id="lga" ></div>

                   <div><label for="state">State Origin: </label>
                    <input type="text" name="state" id="state" ></div>
					
					
					
					<div><label>Image: </label>
					<input type="file" name="file" class="image"> </div>

                    <div><input type="submit" name="submit" value="Save"></div>

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>