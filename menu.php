<div class="sub-cate">
            <div class=" top-nav rsidebar span_1_of_left">

               
       <ul class="menu">
        
		
		
		<li>
         <ul class="kid-menu">
            <li ><a href="dashboard.php">Dashboard</a></li>
         </ul>
      </li>
		
		
      <li class="item1"><a href="#">Student Entry<img class="arrow-img" src="images/arrow1.png" alt=""/> </a>
         <ul class="cute">
            <li class="subitem1"><a href="student_list.php">Student Profile</a></li>
			
			<li class="subitem2"><a href="search_student.php">Register Subject</a></li>
            <li class="subitem3"><a href="view_register_sub.php">Update subject</a></li>
			
            
         </ul>
      </li>
      <li class="item2"><a href="#">Class Entry<img class="arrow-img " src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="class.php">Add Class</a></li>
            <li class="subitem2"><a href="product.html">Update Class</a></li>
            
         </ul>
      </li>
      <li class="item3"><a href="#">Staff Entry<img class="arrow-img img-arrow" src="images/arrow1.png" alt=""/> </a>
         <ul class="cute">
            <li class="subitem1"><a href="staff.php">Add Staff</a></li>
			<li class="subitem1"><a href="sub_teacher.php">Subject Teacher</a></li>
			<li class="subitem1"><a href="staff.php">Form Teacher</a></li>
            <li class="subitem2"><a href="product.html">Update Staff</a></li>
         </ul>
      </li>
      <li class="item4"><a href="#">Subject Entry<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="junior_sub.php">Add JSS Subject</a></li>
			 <li class="subitem2"><a href="senior_sub.php">Add SSS Subject</a></li>
            <li class="subitem3"><a href="product.html">Update Subject</a></li>
            
         </ul>
      </li>

      
      <li class="item4"><a href="#">School Entry<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="school.php">Add School</a></li>
			 <li class="subitem2"><a href="session.php">Add session</a></li>
			  <li class="subitem1"><a href="house.php">Add House</a></li>
            <li class="subitem3"><a href="product.html">Update School</a></li>
            
         </ul>
      </li>
	  
	  <li class="item4"><a href="search_class.php">Scores Entry<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="search_junior.php">For Junior Class</a></li>
			<li class="subitem2"><a href="search_class.php">For Senior Class</a></li>
         </ul>
      </li>
	  
	  
	  <li class="item5"><a href="#">Term Result<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="single_result.php">Student result</a></li>
			<li class="subitem2"><a href="print_all.php">Print all result</a></li>
			<li class="subitem2"><a href="update_result.php">Update result</a></li>
         </ul>
      </li>
	  
	  
	  
	  <li class="item5"><a href="#">Cumulative Result<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="annual_result.php">Student result</a></li>
			<li class="subitem2"><a href="print_all.php">Print all result</a></li>
			<li class="subitem2"><a href="">Update result</a></li>
         </ul>
      </li>
	  
	  
	   <li class="item6"><a href="#">Promotion Entry<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="single_result.php">Check Student status</a></li>
			
         </ul>
      </li>

            <li>
         <ul class="kid-menu">
            <li ><a href="product.html">About Developers</a></li>
            
         </ul>
      </li>
      
   </ul>
               </div>
            <!--initiate accordion-->
      <script type="text/javascript">
         $(function() {
             var menu_ul = $('.menu > li > ul'),
                    menu_a  = $('.menu > li > a');
             menu_ul.hide();
             menu_a.click(function(e) {
                 e.preventDefault();
                 if(!$(this).hasClass('active')) {
                     menu_a.removeClass('active');
                     menu_ul.filter(':visible').slideUp('normal');
                     $(this).addClass('active').next().stop(true,true).slideDown('normal');
                 } else {
                     $(this).removeClass('active');
                     $(this).next().stop(true,true).slideUp('normal');
                 }
             });
         
         });
      </script>