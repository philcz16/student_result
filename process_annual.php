<?php
	session_start();
	include("dbconnect.php");
	
	$session_yr="";
	$total1="";
	$subname="";
	$term_avg2="";
	$term_avg3="";
	
	$admission_no = $_REQUEST['adm_no'];
	$class_name = $_REQUEST['class_name'];
	$session_yr = $_REQUEST['session_yr'];
	
	
	$get_result = mysqli_query($con, "SELECT * FROM `scores` WHERE `admission_no` = '$admission_no' AND `class_name` ='$class_name' AND session_yr='$session_yr'");
	
	if (mysqli_num_rows($get_result) == 0 || !isset($admission_no) && ($class_name)) {
		$_SESSION['errormsg'] = "<div id='errormsg'>Data doesn't exist or wrong admission number/class combination/term</div>"; 
		header("Location: annual_result.php");
	}
	
	$get_std = mysqli_query($con, "SELECT * FROM `student` WHERE `admission_no` = '$admission_no'");
    
     
       $session=  mysqli_query($con, "SELECT session_yr, term FROM `scores` WHERE `admission_no` = '$admission_no' AND class_name='$class_name' AND session_yr='$session_yr'");
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
	  
	  
	  
	  
	  function total_stds($class_name,$session_yr,$con) {
		$sql = mysqli_query($con, "SELECT DISTINCT `student_name` FROM `scores` WHERE class_name= '$class_name' AND session_yr='$session_yr'");
		$total_student = mysqli_num_rows($sql);
		return $total_student;
}



function get_position($class_name,$admission_no,$term,$session_yr,$con){
    $sql=mysqli_query($con,"SELECT admission_no,student_name,class_name,SUM(total) as total,(SELECT COUNT(*)+1 from scores a where a.total>b.total AND class_name=b.class_name AND subname=b.subname  AND term=b.term AND session_yr=b.session_yr) AS rank FROM scores b WHERE admission_no='$admission_no'AND class_name='$class_name' AND session_yr='$session_yr' GROUP BY admission_no ORDER BY class_name, session_yr");
    while ($row=mysqli_fetch_array($sql)){
		
        echo $row['rank'];
        
    }
}



function subject_rank($class_name,$subname,$admission_no,$term,$session_yr,$con){
		
	
	$sql= mysqli_query($con,"SELECT admission_no,student_name,subname,term,class_name,session_yr,SUM(total) AS total,(SELECT COUNT(*)+1 FROM scores a WHERE a.total>b.total AND class_name=b.class_name AND subname=b.subname AND term=b.term AND session_yr=b.session_yr) AS rank FROM scores b WHERE admission_no='$admission_no' AND class_name='$class_name' AND subname='$subname' AND session_yr='$session_yr' GROUP BY admission_no ORDER BY term");
	   while($row=mysqli_fetch_array($sql)){
		echo $row['rank'];
	}
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

	  
	  
	  
	  	  <div class="sub-section">
		  <div class="border-round">
		<div id="res_content">
		
		
                    <img src="images/res_logo.png" alt="result_logo" id="res_logo">
                    <p>benue state of nigeria</p>
                    <p>ministry of education, makurdi</p>
                    <p>annual continouns assemement dossier for secondary schools</p>

                </div>  
		
		<div class="result_page">
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

                   

                    

               

          <table width="100%" class="table-result">
  <tr>
    <th >SN</th>
    <th width="15%" align="center">SUBJECT</th>
    <th >Term 1 Total</th>
    <th >Term 2 Total</th>
    <th >Term 3 Total</th>
    <th >Yearly Total</th>
    <th >CLASS AVERAGE</th>
	<th >POSITION IN CLASS</th>
    <th >GRADE</th>
    
  </tr>

		<?php


				$result= mysqli_query($con, "SELECT * FROM `scores` WHERE `admission_no` = '$admission_no' AND `class_name` ='$class_name' AND term='$term' AND session_yr='$session_yr'");
			$count=0;
            while($row= mysqli_fetch_array($result)){
             $count ++;
			 $subname=$row['subname'];
			 
			 
			 //tring to get students scores in various subject per term
			 
			 $sub_total= mysqli_query($con, "SELECT total FROM scores WHERE admission_no='$admission_no' AND subname='$subname' AND term='first' AND session_yr='$session_yr'");
			 
			 $count1=0;
			 $row1= mysqli_fetch_array($sub_total);
				 $total= $row1['total']; 
			 
			 		if($total==NULL){
					 $total= "=";
				 }
				 
			 
			 
			 
			 $sub_total1= mysqli_query($con, "SELECT total FROM scores WHERE admission_no='$admission_no' AND subname='$subname' AND term='second' AND session_yr='$session_yr'");
			 
			 
			 $row2= mysqli_fetch_array($sub_total1);
				 $total1= $row2['total']; 
				 
				 	if($total1==NULL){
					 $total1= "=";
				 }
				 
				 
				 $sub_total2= mysqli_query($con, "SELECT total FROM scores WHERE admission_no='$admission_no' AND subname='$subname' AND term='third' AND session_yr='$session_yr'");
			 $row3= mysqli_fetch_array($sub_total2);
				 $total2= $row3['total']; 
				 
				 if($total2==NULL){
					 $total2= "=";
				 }
				 
				 //get yearly total
				 $yearly_total= $total+$total1+$total2;
				 
				 
				 
				 
				 //getting class_average
				 
				 $total_av= mysqli_query($con,"SELECT SUM(total) AS total FROM scores WHERE subname='$subname' AND class_name='$class_name' AND session_yr='$session_yr'");
				 $row1 = mysqli_fetch_array($total_av);
				 $class_a= $row1['total'];
				 
				 
				
				 
				 
				 
				 //SET @rank=0;
				//SELECT @rank:=@rank+1 AS rank,sum(total) from scores ORDER BY admission_no DESC
				 
				 //SELECT SUM(total) FROM scores WHERE term BETWEEN 'first' AND 'third' AND subname='mathematics' AND class_name='jss 1a' AND admission_no='22590'
				 
				 
				 //$update= mysqli_query($con,"UPDATE scores set overall_total='$yearly_total' where subname='$subname'");
				 
				 
				 
			 
			 
?>

		<td><?php echo $count;?></td>
		<td><?php echo $subname;?></td>
		<td><?php echo $total;?></td>
		<td><?php echo $total1;?></td>
		<td><?php echo $total2;?></td>
		
		<td><?php echo $yearly_total;?></td>
		
		<td>
		<?php
		$class_average=  $class_a /total_stds($class_name,$session_yr,$con);
		echo number_format($class_average,1);

		
		
		?>
		
		
		</td>
		<td>
		<?php
		subject_rank($class_name,$subname,$admission_no,$term,$session_yr,$con);
		
		?>
		
		</td>
		
		<td>
		<?php
		
		if($yearly_total>=230){
		echo "A";
	}elseif($yearly_total<230 && $yearly_total>=190){
		echo "B";
	}elseif ($yearly_total<190 && $yearly_total>=150) {
		echo "C";
	}elseif ($yearly_total<150 && $yearly_total>=110) {
		echo "D";
	}elseif ($yearly_total<110) {
		echo "<span class='fail'>E</span>";
}
		
		
		?>
		
		
		</td>
		
		


</tr>

			<?php };?>
			
</table>


                        
                    <table width="100%" id="table_comments">
<?php

					$count=0;
                       

                        $res1= mysqli_query($con,"SELECT COUNT(subname) FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='$term' AND session_yr='$session_yr'");
                        while($row5=mysqli_fetch_array($res1)){
                            
                            
                            




                            
                            $total_sub= $count+$row5['COUNT(subname)'];

                            $count++;

                           

                            $total_ob= $total_sub*300;
							
                            
                            //trying to comput cummulative scores for session
							
                             $ss= mysqli_query($con,"SELECT SUM(total) as total FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND session_yr='$session_yr'");
                        while($row=mysqli_fetch_array($ss)){
                            
						$total= $row['total'];
						
						//counting number of subject per term
						
						$squery= mysqli_query($con, "SELECT COUNT(subname) AS subname FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='first' AND session_yr='$session_yr'");
						$result= mysqli_fetch_array($squery);
						$first_count= $result['subname'];
						
						
						
						$squery= mysqli_query($con, "SELECT COUNT(subname) AS subname FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='second' AND session_yr='$session_yr'");
						$result1= mysqli_fetch_array($squery);
						$first_count1= $result1['subname'];
						
						
						$squery= mysqli_query($con, "SELECT COUNT(subname) AS subname FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='third' AND session_yr='$session_yr'");
						$result2= mysqli_fetch_array($squery);
						$first_count2= $result2['subname'];
						
						
						
						
						
						//computing average per term
                            

						$sum1= mysqli_query($con, "SELECT SUM(total) AS total FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='first' AND session_yr='$session_yr'");
						$rows= mysqli_fetch_array($sum1);
							
							$term1_total= $rows['total']; 
							
							if($term1_total>0){
								$term_avg1= $term1_total/$first_count;
								
							}
							
							
						
						
						$sum2= mysqli_query($con, "SELECT SUM(total) AS total FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='second' AND session_yr='$session_yr'");
						
						$rows= mysqli_fetch_array($sum2);
							
							$term2_total= $rows['total']; 
							
							if($term2_total>0){
								
							
							$term_avg2= $term2_total/$first_count1;

							}
							
							
							
							
							
							$sum3= mysqli_query($con, "SELECT SUM(total) AS total FROM scores WHERE admission_no='$admission_no' AND class_name='$class_name' AND term='third' AND session_yr='$session_yr'");
							$rows= mysqli_fetch_array($sum3);
							
							$term3_total= $rows['total']; 
							if($term3_total>0){
								$term_avg3= $term3_total/$first_count2;
							}
							
							
							//now we shall get the total average and divide by three (3) to get the annual average for the 3 terms
							
							$annual_average= ($term_avg1+$term_avg2+$term_avg3)/3;
							
							
						
						
						
			 
			 		
                            
                           
                        ?>
                    

                    <tr>
                    <td>Number of Subjects: <?php echo $total_sub;?></td>


                    <td>Total Obtainable Marks: <?php echo $total_ob;?></td>
                    <td>Marks Obtainable: <?php echo $total;?></td>
					
					
					<tr>
                    <td>Average: <?php echo number_format($annual_average,1);?></td>
                    <td>Position in Class : 
                        <?php

                            get_position($class_name,$admission_no,$term,$session_yr,$con);

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
					
						<?php } }?>
                   
			</table></br>
			</div>

		
		
		
		
		
		
		</div>
		<input type="submit" name="print" value="Click to Print Result" onclick="print()">
		</div>

   </section>
    <?php include("menu.php");?>

   
   
   </div>
   
   
   
   
   
   </body>
</html>