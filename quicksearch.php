
   <table cellpadding="0" cellspacing="0" border="0" width="100%" class="display">

    
	
<?php
include('dbconnect.php');
$count= 0;
$key =  $_POST['key'];
$key = addslashes($key);
$sql = mysqli_query($con, "select * from student WHERE student_name LIKE '%$key%' OR admission_no LIKE '%$key%' OR class_name LIKE '%$key%'") or die(mysql_error());

    While($row = mysqli_fetch_array($sql)) {
	$count++;
	
	$photo= $row['photo'];
	$id= $row['student_id'];

	if($count<= 10){
?>

	
	
		
		
		
					<tr>
					<th>Student's Name</th>
					<th>Admission Number</th>
					<th>Class</th>
					<th>Gender</th>
					<th>Date of Birth</th>
					<th>Local Govt</th>
					<th>State Origin</th>
					<th>House Allocated</th>
					<th>Photo</th>
					<th>Actions</th>
					</tr>
					
	 
	
    <tr>
					<tr class="del<?php echo $bookid ?>">
					<td><?php echo $row['student_name'];?></td>
					<td><?php echo $row['admission_no'];?></td>
					<td><?php echo $row['class_name'];?></td>
					<td><?php echo $row['gender'];?></td>
					<td><?php echo $row['dob'];?></td>
					<td><?php echo $row['lga'];?></td>
					<td><?php echo $row['state'];?></td>
					<td><?php echo $row['house'];?></td>
					<td align="center"><?php echo '<img class="pic" width="50" height="40"  src="passport/'.$photo.'.jpg"."  >'?> </td>
					<td><a href="edit_student.php<?php echo '?student_id='.$id; ?>"><img src="images/edit.png" class="actions" title="Edit student"></a>
					<a  class="btn btn-danger1" id="<?php echo $id; ?>"><img src="images/del.png" class="actions" title="Delete Student"></a>
					</td>
					
					
					</tr>


	
	
		</div>
<?php }}
if($count==""){
echo "No Record Found";
}else{
 ?>
 
 
 
 <?php } ?>
 
 		
    </table>

 <script type="text/javascript">
	$(document).ready( function() {
	
	var myDate = new Date();
var pc_date = (myDate.getMonth()+1) + '/' + (myDate.getDate()) + '/' + myDate.getFullYear();
var pc_time = myDate.getHours()+':'+myDate.getMinutes()+':'+myDate.getSeconds();
jQuery(".pc_date").val(pc_date);
jQuery(".pc_time").val(pc_time);
	
	
	$('.btn-danger1').click( function() {
		
		var id = $(this).attr("id");
		var pc_date = $('.pc_date').val();
		var pc_time = $('.pc_time').val();
		var data_name = $('.data_name'+id).val();
		var user_name = $('.user_name').val();
		
		if(confirm("Are you sure you want to delete this Student?")){
			
		
			$.ajax({
			type: "POST",
			url: "delete_student.php",
			data: ({id: id,pc_time:pc_time,pc_date:pc_date,data_name:data_name,user_name:user_name}),
			cache: false,
			success: function(html){
			$(".del"+id).fadeOut('slow'); 
			} 
			}); 
			}else{
			return false;}
		});				
	});

</script>
   	