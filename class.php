<?php
ob_start();
session_start();



$successmsg="";
$errormsg="";

                include("dbconnect.php");
                if(isset($_POST['submit'])){

                    
                    $class_name=$_POST['class_name'];

                    if(!empty($class_name)){

                        //trying to check if class already exist
                        $query= mysqli_query($con, "SELECT * from class where class_name= '$class_name'");
                        $check= mysqli_num_rows($query);
                        if($check != 0){
                            $errormsg= "<div id='errormsg'>Sorry ! class already added</div>";
                        }else{


                        $res= "INSERT into class(class_name) VALUES('$class_name')";
						
						$result= mysqli_query($con,$res);
                        if($result){
                            $successmsg= "<div id='successmsg'>Class successfully Added</div>";
                        }else{
                            $errormsg= "<div id='errormsg'>There was an error trying to class, please try again</div>";
                        }
                        }
                    }else{
                        $errormsg= "<div id='errormsg'>fill out the field</div>";
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

	  <div class="navi"><p>Add classes here</p></div>
	  	  <div class="sub-section">
		
		<form action="" method="POST" id="form-register">
                <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                   <div> <label for="class">Class Name</label>
                    <input type="text" name="class_name" id="class_name" placeholder="format JSS 1A OR SSS 1A"></div>

                    <input type="submit" name="submit" value="Save">

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>