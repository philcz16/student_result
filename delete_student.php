<?php
include('dbconnect.php');

$id=$_POST['id'];
$pc_date = $_POST['pc_date'];
$pc_time = $_POST['pc_time'];
$data_name = $_POST['data_name'];


mysqli_query($con, "delete from student where student_id='$id'");


//mysqli_query($con, "INSERT INTO history (`data`,`action`,`date`,user)VALUES('$data_name', 'Deleted student', '$pc_date $pc_time','Admin')");	


?>