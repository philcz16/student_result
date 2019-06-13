<?php ob_start();?>
<?php include('header.php');?>

<?php

require 'dbconnect.php';	
	$errormsg="";
	$username="";
	$password="";
	$subject="";
	$class_name="";
	$TeacherName="";
	
	if(isset($_POST['login'])){
		
		
		$username= mysqli_real_escape_string($con,$_POST['username']);
		$password = mysqli_real_escape_string($con,$_POST['password']);
		
		
		$query= "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
		$result= $con->query($query);
		$row= $result->fetch_assoc();
		if($row >0){
			
			session_start();
			$_SESSION['username']= $username;
			$_SESSION['id']= $row['id'];
			$_SESSION['userType']= $row['userType'];
			
		}else{
			$errormsg = "<div id='loginerrormsg'>Invalid username or password</div>";
		}
		
		
	}
	
	if(isset($_SESSION['id']) && ($_SESSION['userType']=="admin")){
		header("location:dashboard.php");
	}
	
	
	if(isset($_SESSION['id']) && ($_SESSION['userType']=="teacher")){
		header("location:teacher/teacher_dashboard.php");
	}
	
	
	
?>




<title>Automated Results Management System</title>
<link rel="shortcut icon" href="images/favicon.png">
 <link rel="stylesheet" href="css/style.css">
<style>
body{
    background:url("images/index.jpg");
}
#container{
  max-width: 1000px;
  margin: 2% auto;
  margin-right: 3em;
  min-height:468px;
}

.form-login{
	width:30%;
	margin:2% auto;
	background:#1A515A;
	margin-top:1em;
	min-height:350px;
	box-shadow:0 0 2px #ADA4A4;
	float:right;
}
.form-login input[type="text"] {
	width:80%;
	margin:2em;
	padding:7px;
	border:1px solid #ccc;
	background:#fff url(images/user.png) no-repeat center right;
	
}
.form-login input[type="password"]{
	width:80%;
	margin:2em;
	padding:7px;
	border:1px solid #ccc;
	background:#fff url(images/password.png) no-repeat center right;
	
}
.form-login label{
	margin-left:1em;
	font-size:1.3em;
}
.form-login input[type="submit"]{
	margin-left:2em;
	padding:5px;
	margin-top:1em;
	width:30%;
	background:#FB9F64;
	border:#FB9F64;
	color:#fff;
	font-size:1em;
	border-radius:5px 5px 5px 5px;
	cursor:pointer;
}
.form-login input[type="submit"]:hover{
	background:#F08857;
}

.heading h1{
	font-size:1em;
	text-align:center;
	background:#30707B;
	color:#fff;
	padding:10px

}

#loginerrormsg{
	text-align:center;
	margin-top:3em;
	color:#900;
	background:#E38686;
	border:1px solid ##D1A192;
	padding:5px;
}

#rms{
  width: 35%;
  text-transform: uppercase;
  color:#008C87;
}
#rms h1{
  font-size: 2em;

}

</style>
<div id="container">

<div class="form-login">
	<form action="" method="POST">
	
	<div class="heading"><h1>Login with your username and password</h1></div>
		
		<div><input type="hidden" name="id"></div>
		<div><input type="hidden" name="UserType"></div>
		<div><input type="hidden" name="TeacherName"></div>
		<div><input type="text" name="username" placeholder="Enter your username"></div>
		<div><input type="password" name="password" placeholder="Enter your password"></div>
			<div><input type="submit" name="login" value="Login"></div>
			
			<?php echo $errormsg;?>

	</form>
</div>


<div id="rms">
<h1>arms excels</h1>
<p>
  Excellence, Competence, saves time and energy in results computing</p>
</div>



  </div>
<?php include ('footer.php');?>