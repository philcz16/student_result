<?php
ob_start();
session_start();
include("dbconnect.php");




$username=$_SESSION['username'];
$id= $_SESSION['id'];






?>



<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Results management system</title>
      <link rel="stylesheet" type="text/css" href="css/css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
		
		<noscript><link rel="stylesheet" type="text/css" href="css/css/noJS.css" /></noscript>
      
         <link href="css/menu.css" rel="stylesheet" type="text/css" media="all" /> 
      <link rel="stylesheet" href="css/style.css">
	  <link rel="shortcut icon" href="images/favico.png">
      <script src="js/jquery-1.8.3.min.js"></script> 
	  
	  <script src="js/jquery-2.1.3.min.js"></script>
   </head>
   
   
   <body>
   
   
   <?php
   if(!isset($_SESSION['id'])){
	header("Location:index.php");
}

   ?>

      
        <?php include("header.php");?>
      
  
   <div id="wrapper">
      <section>
	  <div class="navi"><p>Welcome To ARMS</p>
	  
				<div class="wrapper-demo">
					<div id="dd" class="wrapper-dropdown-5" tabindex="1"><?php echo "Welcome $username";?>
						<ul class="dropdown">
							<li><a href="#"><i class="icon-user"></i>Profile</a></li>
							<li><a href="#"><i class="icon-cog"></i>Settings</a></li>
							<li><a href="logout.php"><i class="icon-remove"></i>Log out</a></li>
						</ul>
					</div>
				​</div>
			
			
				
				
				<!-- jQuery if needed -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script type="text/javascript">

			function DropDown(el) {
				this.dd = el;
				this.initEvents();
			}
			DropDown.prototype = {
				initEvents : function() {
					var obj = this;

					obj.dd.on('click', function(event){
						$(this).toggleClass('active');
						event.stopPropagation();
					});	
				}
			}

			$(function() {

				var dd = new DropDown( $('#dd') );

				$(document).click(function() {
					// all dropdowns
					$('.wrapper-dropdown-5').removeClass('active');
				});

			});

		</script>
	  
	  </div>
	  <div class="sub-section">


<div id="content">
<img src="images/edu.jpg" class="photo-pic">	  

<div id="core-content">
<div class="content1">
<a href="student_list.php"><img src="images/user.png" id="symbol">
<p>View Student profile</p></a>
</div>

<div class="content2">
<a href="single_result.php"><img src="images/user.png" id="symbol">
<p>Term Results</p></a>
</div>

<div class="content3">
<a href="annual_result.php"><img src="images/user.png" id="symbol">
<p>Cumulative Results</p></a>
</div>



</div>
</div>

	
	</div>
   </section>
    <?php include("menu.php");?>

   
   
   </div>
   <?php include('footer.php');?>
   
   
   
   
   </body>
</html>