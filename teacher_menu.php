<div class="sub-cate">
            <div class=" top-nav rsidebar span_1_of_left">

               
       <ul class="menu">
        
		
		
		<li>
         <ul class="kid-menu">
            <li ><a href="dashboard.php">Dashboard</a></li>
         </ul>
      </li>
		
		
      
      
	  
	  <li class="item4"><a href="#">Subject Master<img class="arrow-img img-left-arrow" src="../images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="search_junior.php">Input Scores</a></li>
			<li class="subitem2"><a href="search_class.php">Input Scores for All CA's</a></li>
			<li class="subitem2"><a href="update_result.php">Make subject comments</a></li>
			<li class="subitem2"><a href="update_result.php">Update scores</a></li>
         </ul>
      </li>
	  
	  
	  <li class="item5"><a href="#">Form Master<img class="arrow-img img-left-arrow" src="../images/arrow1.png" alt=""/></a>
         <ul class="cute">
			<li class="subitem1"><a href="single_result.php">Make roll call</a></li>
			<li class="subitem1"><a href="single_result.php">Manage student house</a></li>
			<li class="subitem1"><a href="single_result.php">Make comments</a></li>
			<li class="subitem1"><a href="single_result.php">Make comments (All students)</a></li>
			<li class="subitem1"><a href="single_result.php">Access Student skills</a></li>
			<li class="subitem1"><a href="single_result.php">Manage days absent</a></li>
			<li class="subitem1"><a href="single_result.php">Make comments (commulative)</a></li>
			<li class="subitem1"><a href="single_result.php">Traits comments</a></li>
            <li class="subitem1"><a href="single_result.php">Student term result</a></li>
			<li class="subitem2"><a href="annual_result.php">student commulative result</a></li>
			
         </ul>
      </li>
	  
	  
	  
	  <li class="item5"><a href="#">Users<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="">Account</a></li>
			<li class="subitem2"><a href="print_all.php">Noticification</a></li>
			
         </ul>
      </li>
	  
	  
	   <li class="item6"><a href="#">Staff<img class="arrow-img img-left-arrow" src="images/arrow1.png" alt=""/></a>
         <ul class="cute">
            <li class="subitem1"><a href="single_result.php">Manage profile</a></li>
			<li class="subitem1"><a href="single_result.php">View Monthly Salary</a></li>
			
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