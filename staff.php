<?php
ob_start();
 
	session_start();
	include('dbconnect.php');
	
	
	
	$errormsg="";
	$successmsg="";
	
	$string1="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$string2="0123456789";
	$string1=str_shuffle($string1);
	$string2=str_shuffle($string2);
	$staff_pass= substr($string2,0,6).substr($string1,0,2);
	
	
	
	if(isset($_POST['submit'])){
    $staff_name= mysqli_real_escape_string($con,$_POST['staff_name']);
    $portfolio= mysqli_real_escape_string($con,$_POST['portfolio']);
    $gender = $_POST['gender'];
   
    $dob=$_POST['yy']."/".$_POST['mm']."/".$_POST['dd'];
    $lga= mysqli_real_escape_string($con,$_POST['lga']);
    $state= mysqli_real_escape_string($con,$_POST['state']);
	
	$username= mysqli_real_escape_string($con,$_POST['username']);
	
	$address= mysqli_real_escape_string($con,$_POST['address']);
	
	
	//prevent adding empty entries
	if(!empty($staff_name) && !empty($portfolio) && !empty($gender ) && !empty( $dob) && !empty($lga) && !empty($state) && !empty($username) && !empty($address) && !empty($staff_pass)){
		
	
		
	//checking if username already exist in users table
	
		
	$sss= "SELECT * FROM staff WHERE username='$username'";
	$result1=  $con->query($sss);
	$check1= mysqli_num_rows($result1);
	if($check1 !==0){
		$errormsg= "<div id ='errormsg'>username already exist</div>";
	}else{
		
	
		
	
	//checking if staff username aready exist
	
	$ss= "SELECT * FROM users WHERE username='$username'";
	$res=  $con->query($ss);
	$check= mysqli_num_rows($res);
	if($check !==0){
		$errormsg= "<div id ='errormsg'>username already exist</div>";
	}else{
		
	
	
	
	
	$query1= "INSERT INTO staff (staff_name,portfolio,dob,gender,lga,state,address,username,password,UserType)
	VALUES('$staff_name','$portfolio',' $dob','$gender','$lga','$state','$address','$username','$staff_pass','teacher')";
	
	$query2= mysqli_query($con,"INSERT INTO users (staff_name,username,password,UserType) VALUES('$staff_name','$username','$staff_pass','teacher')");
	
	$result= mysqli_query($con,$query1);
	if($result){
		$successmsg= "<div id='successmsg'>Staff was addedd successfully<br/>
		Username : <span class='logindetails'>$username</span><br/>
		password : <span class='logindetails'>$staff_pass</span></div>";
	}else{
		echo "failed";
	}
	}
	
	}
	}else{
		$errormsg= "<div id ='errormsg'>All fields are required</div>";
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

	  <div class="navi"><p>Create Staff Profile</p></div>
	  	  <div class="sub-section">
		  
		  
		  <div class="pagination">
    <ul>

    <li  class="active"><a href="staff_list.php"><font color="white">View All Staff</font></a></li>
	 <li  class="active"><a href="staff.php"><font color="white">Add New Staff</font></a></li>
    
   
 
  
    </ul>
	

    </div>
		  

		
		<form action="" method="POST" id="form-register" enctype="multipart/form-data">
                <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                   <div> <label for="staffname">Staff Name:</label>
                    <input type="text" name="staff_name" id="staffname" ></div>

                   <div> <label for="Portfolio">Portfolio</label>
                    <input type="text" name="portfolio" id="Portfolio" ></div>

                    

                  
				   
				   <div><label>Choose Gender</label>
                    <select name="gender" id="studclass">
						<option>Male</option>
						<option>Female</option>
                        
                </select></div>
				
				
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
					
					
					<div><label for="username">Staff username: </label>
                    <input type="text" name="username" id="username" ></div>
					
				
					
					<div><label>Address</label>
					<textarea name="address"  placeholder="enter address..."></textarea>
					
					</div>
					
					
					

                    <div><input type="submit" name="submit" value="Save"></div>

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   <?php include('footer.php');?>
   
   
   </body>
</html>