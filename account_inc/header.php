<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Envoi de colis entre particuliers | Home :: SendPack</title>
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link href="css/account.css" rel='stylesheet' type='text/css' />
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		</script>
		<script src="js/jquery.min.js"></script>
		<!---script---->
		<link rel="stylesheet" href="css/jquery.bxslider.css" type="text/css" />
		<script src="js/jquery.bxslider.js"></script>
			<script type="text/javascript">
				$(document).ready(function(){
					$('.bxslider').bxSlider({
						 auto: true,
 						 autoControls: true,
						 minSlides: 4,
						 maxSlides: 4,
						 slideWidth:450,
						 slideMargin: 10
					});
				});
			</script>
		<!---//smoth-scrlling---->
		<!---smoth-scrlling---->
			<script type="text/javascript">
				$(document).ready(function(){
									$('a[href^="#"]').on('click',function (e) {
									    e.preventDefault();
									    var target = this.hash,
									    $target = $(target);
									    $('html, body').stop().animate({
									        'scrollTop': $target.offset().top
									    }, 1000, 'swing', function () {
									        window.location.hash = target;
									    });
									});
								});
				</script>
		<!---//smoth-scrlling---->
		<!---webfonts---->
		<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<!---webfonts---->
		<!---calender-style---->
		<link rel="stylesheet" href="css/jquery-ui.css" />
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.11.2/themes/start/jquery-ui.css">
		<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
		<script src="js/jquery.ui.autocomplete.html.js"></script>
		
		<script src="js/responsiveslides.min.js"></script>
		<script>
    // You can also use "$(window).load(function() {"
    $(function () {
      // Slideshow 1
      $("#slider1").responsiveSlides({
         auto: true,
		 nav: true,
		 speed: 500,
		 namespace: "callbacks",
      });
    });
  </script>
		<!---//calender-style---->
	</head>
		<body>				
					<!----start-wrap---->
				<!----start-top-header----->
				<div class="top-header" id="header">
					<div class="wrap">
					<div class="top-header-left">
						
					</div>
					<div class="top-header-right">
						<ul>
							
							
							
							<div class="clear"> </div>
						</ul>
					</div>
					<div class="clear"> </div>
					</div>
				</div>
				<!----//End-top-header----->
				<!---start-header---->
				<div class="header">
								<div class="wrap">
								<!--- start-logo---->
								<div class="logo">
									<a href="index.php"><img src="images/logo.png" title="voyage" /></a>
								</div>
								<!--- //End-logo---->
								<!--- start-top-nav---->
								<div class="top-nav">
					<div class="navigation">
						<span class="menu"></span> 
							<ul class="navig cl-effect-16">
								<li><a href="index.php">Acceuil</a></li>
	
								<?php if(isset($_SESSION['auth'])):?>
									<li><a href="logout.php">Se deconnecter</a></li>
									<li><a href="account.php">Mon compte</a></li>
									<li><strong><a href="#">Bonjour <?= $_SESSION['auth']->first_username;?>.</a></strong></li>
									
								<?php else: ?>							
									<li><a href="register.php"> S'Inscrire</a></li>
									<li><a href="login.php"> Se Connecter</a></li>						
									
								<?php endif;?>								
								<li><a href="modeemploi.php">Mode d'emploi</a></li>
								
								
							</ul>
					</div>
										
										<!----search-scripts---->
										<script src="js/modernizr.custom.js"></script>
										<script src="js/classie.js"></script>
										<script src="js/uisearch.js"></script>
										<script>
											new UISearch( document.getElementById( 'sb-search' ) );
										</script>
										<!----//search-scripts---->
								</div>
								<!--- //End-top-nav---->
								<div class="clear"> </div>
							</div>
							<!---//End-header---->
				</div>
			<!--script-for-menu-->
			<script>
				$("span.menu").click(function(){
					$(" ul.navig").slideToggle("slow" , function(){
					});
				});
			</script>
		<!--script-for-menu-->
			<!---start-destinatiuons---->
			
			<div class="destinations">
	
		<?php if(isset($_SESSION['flash'])): ?>
			<?php foreach($_SESSION['flash'] as $type =>$message): ?>
				<div class="alert alert-<?=$type;?>">
					<?=$message;?>
				</div>
			<?php endforeach;?>
			<?php unset($_SESSION['flash']); ?>
		<?php endif;?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	