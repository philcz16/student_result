<title>Automated Results Management System</title>
<link rel="shortcut icon" href="images/favico.png">
 <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/css/style.css" />
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css' />
		<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script> 
		<noscript><link rel="stylesheet" type="text/css" href="css/css/noJS.css" /></noscript>

<style>
html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {
	margin: 0;
	padding: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
	box-sizing: border-box;
}
body{
	font:100%;
	font-family:verdan,serif, sans-serif;
}
#logo{
	float:left;
	margin-left:2em;
	width:6%;
}
header{
	background:#08647D;
	overflow:auto;
	border-bottom:2px solid #E7EAED;
}
header h1{
	font-size:2em;
	font-weight:bold;
	color:#fff;
	text-shadow: 0 0 4px #000;
}

</style>



<body>
<header>

<img src="images/logo3.png" alt="logo" title="Automated results system" id="logo">
<h1>Automated Results Management System</h1>



<section class="main">
				<div class="wrapper-demo">
					<div id="dd" class="wrapper-dropdown-5" tabindex="1">John Doe
						<ul class="dropdown">
							<li><a href="#"><i class="icon-user"></i>Profile</a></li>
							<li><a href="#"><i class="icon-cog"></i>Settings</a></li>
							<li><a href="#"><i class="icon-remove"></i>Log out</a></li>
						</ul>
					</div>
				​</div>
			</section>
			
				
				
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
</header>
</body>