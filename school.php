<?php
ob_start();
session_start();

include("dbconnect.php");

$successmsg="";
$errormsg="";

     if(isset($_POST['submit'])){
    
    $schoolname= $_POST['schoolname'];
    $lga= $_POST['lga'];

	
    if(!empty($schoolname) && !empty($lga)){

        //preventing schoolname from adding doubl

        $sch= mysqli_query($con, "SELECT * FROM school WHERE schoolname='$schoolname' AND lga= '$lga'");
        $check_sch= mysqli_num_rows($sch);
        if($check_sch !=0){
            $errormsg= "<div id='errormsg'>School Name already added</div>";
        }else{



        $query= mysqli_query($con, "INSERT INTO school(schoolname,lga) VALUES('$schoolname','$lga')");

        if($query){
            $successmsg = "<div id='successmsg'>Records successfully Added</div>";
        }else{
            $errormsg= "<div id='errormsg'>There was an error trying to add record, please try again</div>";
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

	  <div class="navi"><p>Add name of school and Local government Area</p></div>
	  	  <div class="sub-section">
		
		
		 <form action="" method="POST" id="form-register">
		 
		 <?php echo $errormsg;?>
                <?php echo $successmsg;?>
                   <div> <label for="nameofschool">Name of School: </label>
                    <input type="text" name="schoolname" id="nameofschool" ></div>

                   

                    

                   
                

                 
                   <div><label for="lga">LGEA of school:</label>
                    <input type="text" name="lga" id="lga" ></div>

                    <input type="submit" name="submit" value="Submit">

		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>