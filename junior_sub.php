<?php
ob_start();
session_start();
include("dbconnect.php");


$errormsg="";
$successmsg="";

if(isset($_POST['submit'])){
	
  $subname= $_POST['subname'];
  
 $class= array();
  
  foreach($_POST['class'] as $val){
    $class[]= $val;
  }

    $class= implode(',', $class);
   
  

if(!empty($subname) && !empty($class)){

      $res= mysqli_query($con, "SELECT * from sub_junior where subname= '$subname'");
      $check= mysqli_num_rows($res);
      if($check !=0){
        $errormsg= "<div id='errormsg'>The subject $subname is already added</div>";
      }else{

      $sql= "INSERT into sub_junior(subname,subject_for) VALUES('$subname','$class')";
	  
	  $result= mysqli_query($con, $sql);

      if($result){
        $successmsg = "<div id='successmsg'>The Subject $subname is successfully Added</div>";
      }else{
        $errormsg= "<div id='errormsg'><center>There was an error trying to add record, please try again</center></div>";
      }
}
}else{
  $errormsg= "<div id='errormsg'>Please Select subject and check all the boxes</div>";
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
    <div class="navi"><p>Add Junior Secondary Subjects</p></div>
      <div class="sub-section">
	  <form action="" method="POST" id="form-register">
              
                   <div>
                    <input type="text" name="subname" id="subname" placeholder="Please Enter subject for JSS class"></div>
					
					
					<p class="notice">Check the box to select All classes</p>
				
				
				<div> Check All <input type="checkbox"  name="selectAll" id="checkAll" />
                <script>
                $("#checkAll").click(function () {
                  $('input:checkbox').not(this).prop('checked', this.checked);
                });
                </script>
                  </div>
					
					
					<?php
				$sss= mysqli_query($con, "SELECT * FROM class WHERE class_name LIKE 'JSS%' ORDER BY class_name");
				while($result=mysqli_fetch_array($sss)){
					$sub1= $result['class_name'];
					
					
					echo '<input type="checkbox" name="class[]" value = "'. $sub1 .'" >';
					echo "$sub1</br></br>";
				}
				
				?>
					<div><input type="submit" name="submit" value="Save"></div>
					
					
					
					
					
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