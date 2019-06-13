<?php
	session_start();
	include("dbconnect.php");
	$admission_no= $_REQUEST['admission_no'];
	$class_name = $_REQUEST['class_name'];
	$term = $_REQUEST['term'];
	$get_result = mysqli_query($con, "SELECT * FROM `scores` WHERE `class_name` ='$class_name' AND term='$term'");
	
	if (mysqli_num_rows($get_result) == 0) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist or wrong admission number/class combination/term</div>"; 
		header("Location: print_all.php");
	}
	
	//$test= mysqli_query($con, "SELECT * FROM `scores` WHERE `admission_no` ='$class_name' AND term='$term'");
	
	
	$get_std = mysqli_query($con, "SELECT * FROM  `student` WHERE `class_name` = '$class_name'");
    
     
       $session=  mysqli_query($con, "SELECT session_yr, term FROM `scores` WHERE  class_name='$class_name' AND term='$term'");
	  $row= mysqli_fetch_array($session);
	  if($row){
		  $session_yr= $row['session_yr'];
		  $term= $row['term'];
		  
	  }
	  
	  
	  
	  
	  $school=  mysqli_query($con,"SELECT * FROM school");
	  $result= mysqli_fetch_array($school);
	  if($result){
		  $sname= $result['schoolname'];
		  $lga= $result['lga'];
		  
		  
	  }
	 
    

        





function highest_in_class($class_name, $subject,$term,$con) {
		$sql = mysqli_query($con,"SELECT MAX(`total`) as `total` FROM `scores` WHERE `class_name` = '$class_name' AND `subname` = '$subject' AND term='$term'");
		while ($row = mysqli_fetch_array($sql)) {
			return (INT) $row['total'];
		}
}

function lowest_in_class($class_name, $subject,$term,$con) {
		$sql = mysqli_query($con,"SELECT MIN(`total`) as `total` FROM `scores` WHERE `class_name` = '$class_name' AND `subname` = '$subject' AND term='$term'");
		while ($row = mysqli_fetch_array($sql)) {
			echo $row['total'];
		}
}

function total_stds($class_name,$term,$con) {
		$sql = mysqli_query($con, "SELECT DISTINCT `student_name` FROM `scores` WHERE class_name= '$class_name' AND term='$term'");
		$total_student = mysqli_num_rows($sql);
		return $total_student;
}
function subject_avg($class_name, $subject,$term,$con) {
	$sql = mysqli_query($con,"SELECT SUM(`total`) as `avg` FROM `scores` WHERE `class_name` = '$class_name' AND `subname` = '$subject' AND term='$term'");
	while ($row = mysqli_fetch_assoc($sql)) {
		return (INT) $row['avg'];
	}
}




	
		
	function subject_rank($class_name,$subname,$admission_no,$term,$con){
		
	
	$sql= mysqli_query($con,"SELECT admission_no,student_name,subname,class_name,total,term,
        (SELECT count(*)+1 FROM scores a 
            WHERE a.total>b.total AND class_name=b.class_name AND subname=b.subname AND term=b.term) 
        AS rank FROM scores b 
        WHERE class_name='$class_name' AND subname='$subname' AND admission_no='$admission_no' AND term='$term' ORDER BY class_name");
	   while($row=mysqli_fetch_array($sql)){
		echo $row['rank'];
	}
	}


function get_position($class_name,$admission_no,$term,$con){
    $sql=mysqli_query($con,"SELECT admission_no,student_name,class_name,term,SUM(total) as total,(SELECT COUNT(*)+1 from scores a where a.total>b.total AND class_name=b.class_name AND subname=b.subname AND term=b.term) AS rank FROM scores b WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='$term' GROUP BY admission_no ORDER BY class_name,term;");
    while ($row=mysqli_fetch_array($sql)){

        echo $row['rank'];
        
    }
}

		
    
?>



<?php


		
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

	  
	  
	  
	  	  <div class="sub-section">
		<div id="res_content">
                    <img src="images/res_logo.png" alt="result_logo" id="res_logo">
                    <p>benue state of nigeria</p>
                    <p>ministry of education, makurdi</p>
                    <p>termly continouns assemement dossier for secondary schools</p>

                </div>  
		
		
		<table width="100%">


                    <?php

                            

                            
							
                            while($row2=mysqli_fetch_array($get_std)){
							
							
                                
                                

                        ?>


                    <tr>
                    <td width="50%">Name of Student: <?php echo $row2['student_name'];?></td>

                    <td>Admission Number:  <?php echo $row2['admission_no'];?></td>
                    
                    </tr>
                
                    <tr>
                    <td>Class:  <?php echo $row2['class_name'];?></td>
                    <td>Sex:  <?php echo $row2['gender'];?></td>
                    </tr>
					
					
					
					
                    <?php } ?>
					
					
					<tr>
                    <td>Session Year:  <?php echo $session_yr;?></td>
                    <td>Term:  <?php echo $term;?></td>
                    </tr>
					
					<tr>
                    <td>School of Name:  <?php echo $sname;?></td>
                    <td>L.G.A of School:  <?php echo $lga;?></td>
                    </tr>


                    </table>


                   

                    

               

          <table width="100%">
  <tr>
    <th >SN</th>
    <th width="15%" align="center">SUBJECT</th>
    <th >1st CA (10%)</th>
    <th >2nd CA (10%)</th>
    <th >3rd CA (10%)</th>
    <th >EXAM (70%)</th>
    <th>TOTAL (100%)</th>
    <th >HIGHEST IN CLASS</th>
    <th >LOWEST IN CLASS</th>
    <th >CLASS AVERAGE</th>
	<th >POSITION IN CLASS</th>
    <th >GRADE</th>
    
  </tr>




<?php



			$count=0;
            while($row= mysqli_fetch_array($get_result)){
             $count ++; 
?>






  <tr>
    <td scope="row"><?php echo $count;?></td>
    <td ><?php echo $row['subname'];?></td>
    <td align="center"><?php echo $row['first_ca'];?></td>
    <td align="center"><?php echo $row['second_ca'];?></td>
    <td align="center"><?php echo $row['third_ca'];?></td>
    <td align="center"><?php echo $row['exam'];?></td>

    <td align="center"><?php 
    $sum= $row['first_ca']+$row['second_ca']+$row['third_ca']+$row['exam'];
    echo "<span class='sum'>$sum</span>";



    


        
        ?>
    </td>
    <td align="center">
	<!-- comment-->
	<?php  	
		echo highest_in_class($class_name, $row['subname'],$term,$con);
	?>

    </td>
    <td align="center">
	<?php  	
		lowest_in_class($class_name, $row['subname'],$term,$con);
	?>

	</td>
    <td align="center">
		<?php 
		$subject_average = subject_avg($class_name, $row['subname'],$term,$con) /total_stds($class_name,$term,$con);
		echo round($subject_average,1);
		?>
	</td>
	
	<td align="center">
	<?php 
		subject_rank($class_name,$row['subname'],$admission_no,$term,$con);
	?>
	</td>

    <td align="center">
        <?php 
        $sum= $row['first_ca']+$row['second_ca']+$row['third_ca']+$row['exam'];

       
            

if($sum>=75){
    echo "A";
}elseif($sum<75 && $sum>=64){
    echo "B";
}elseif ($sum<64 && $sum>=55) {
    echo "C";
}elseif ($sum<55 && $sum>=40) {
    echo "D";
}elseif ($sum<40) {
    echo "<span class='fail'>E</span>";
}
        ?>

    </td>
    


  </tr>
 <?php };?>
</table>

                        
                    <table width="100%" id="table_comments">


                    <?php
                          
                        $exam= 0;
                        $count=0;
                       

                        $res1= mysqli_query($con,"SELECT SUM(first_ca), SUM(second_ca), SUM(third_ca), SUM(exam), COUNT(subname) FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='$term'");
                        while($row5=mysqli_fetch_array($res1)){
                            
                            $sum= $row5['SUM(first_ca)']+$row5['SUM(second_ca)']+$row5['SUM(third_ca)']+$row5['SUM(exam)'];
                            $total= $exam+$sum;
                            




                            
                            $total_sub= $count+$row5['COUNT(subname)'];

                            $count++;

                            $aveg= $total/$total_sub;

                            $total_ob= $total_sub*100;
                            
                            
                             //$total_stud=$row5['COUNT(class_name)'];
                            
                            
                            


                            
                            
                            

                        ?>


                    <tr>
                    <td>Number of Subject: <?php echo $total_sub;?></td>


                    <td>Total Obtainable Marks: <?php echo $total_ob;?></td>
                    <td>Marks Obtainable: <?php echo $total;?></td>
                    
                    
                    
                    </tr>
                
                    <tr>
                    <td>Average: <?php echo round($aveg,2);?></td>
                    <td>Position in Class : 
                        <?php

                            get_position($class_name,$admission_no,$term,$con);

                        ?>

                    </td>
                    <td>Out Of : 


                            <?php



					
					$class_no= mysqli_query($con,"SELECT COUNT(class_name) FROM student WHERE class_name='$class_name'");
					while($row6=mysqli_fetch_array($class_no)){
   
					echo $row6['COUNT(class_name)'];
}

?>

                    </td>
					</tr>
					
					<tr>
					<td colspan="3">Form Master/ Mistress Remarks : </td>
					</tr>
					
					<tr>
					<td>Name : </td>
					<td>Signature : </td>
					<td>Date : </td>
                    </tr>
					
					<tr>
					<td colspan="3">Principal's Remarks : </td>
					</tr>
					
					<tr>
					<td >Name of Principal : </td>
					<td colspan="2">Signature/Date/Stamp : </td>
					
                    </tr>
					
					
                    <?php } ?>
</table></br>

		<input type="submit" name="print" value="Click to Print Result" onclick="print()">
		
		
		
		
		
		
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>