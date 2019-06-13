<?php

$hostname= "localhost";
$username= "root";
$password= "";
$db= "secondary";

$con= mysqli_connect($hostname,$username,$password,$db);

if(!$con){
	die("Database connection error");
	exit();
}



?>
