<?php
require_once 'account_inc/functions.php';
logged_only();

?>

<?php
$userid = $_SESSION['auth']->id;
require_once 'core/db.php';
require_once 'core/init.php';
?>

<?php
$cityquery = $db->query("SELECT * FROM cities");
$cityquery2 = $db->query("SELECT * FROM cities");

?>

<?php
// selection du mail du voyageur
	$user_emailquery = $db->query("SELECT * FROM users WHERE id=$userid");
	$user_emailq = mysqli_fetch_assoc($user_emailquery);
	$user_email = $user_emailq['email'];
?>

<?php
if(isset($_POST['valider'])){
	$errors = array();
	
	if(empty($_POST['departure']) || !preg_match("/^[a-zA-Z'_-]+$/", $_POST['departure'])){
			$errors['departure'] = "La ville de depart saisie n'est pas valide";}
	
	if(empty($_POST['destination']) || !preg_match("/^[a-zA-Z'_-]+$/", $_POST['destination'])){
			$errors['destination'] = "La ville de destination saisie n'est pas valide";}
	
	if(empty($_POST['colis'])){
			$errors['colis'] = "Le type de colis saisi n'est pas valide";}
			
	if(empty($_POST['formatcolis'])){
			$errors['formatcolis'] = "Veuillez sélectionner un format de colis";}
			
	if(empty($_POST['travel_date']) || !preg_match('`(\d{1,2})/(\d{1,2})/(\d{4})`', $_POST['travel_date'])){
			$errors['travel_date'] = "La date de voyage saisie n'est pas valide";}
	
	if(empty($_POST['limit_day']) || !preg_match('`(\d{1,2})/(\d{1,2})/(\d{4})`', $_POST['limit_day'])){
			$errors['limit_day'] = "La date limite saisie n'est pas valide";}
			
			
	if(!is_numeric($_POST['weight'])){
			$errors['weight'] = "Le poids saisi n'est pas valide";}
	
	if(!is_numeric($_POST['price'])){
			$errors['price'] = "Le prix saisi n'est pas valide";}

	if($_POST['travel_date'] < $_POST['limit_day']){
			$errors['travel_date'] = "La date de voyage devra etre superieure à la date limite de reservation";}
			
	if(empty($errors)){
		$formatcolis = $_POST['formatcolis'];
		$depart = addslashes($_POST['departure']);
		
		$depquery1 =  $db->query("SELECT * FROM cities WHERE city_id = '$depart'");
		$dresult1 = mysqli_fetch_assoc($depquery1);
		$d1 = $dresult1['city'];
		
		
		$destin = addslashes($_POST['destination']);
		
		$depquery2 =  $db->query("SELECT * FROM cities WHERE city_id = '$destin'");
		$dresult2 = mysqli_fetch_assoc($depquery2);
		$d2 = $dresult2['city'];
		
		$gift = $_POST['gift'];
		$description = $_POST['description'];
		
		$col = $_POST['colis'];
		$wei = $_POST['weight'];
		$pri = $_POST['price'];
		$trav1 = $_POST['travel_date'];
		
		$timestamp = $trav1;
		$timestamp = date_create_from_format('d/m/Y', $timestamp);
		$trav =  date_format($timestamp, 'Y-m-d');
		$lim1 = $_POST['limit_day'];
		$timestamp = $lim1;
		$timestamp = date_create_from_format('d/m/Y', $timestamp);
		$lim =  date_format($timestamp, 'Y-m-d');
		
		// update database
		$insertSql = "INSERT INTO travel (user_id,departure,destination,price,limit_day,weight,colis_type,travel_date,gift,formatcolis,description)
		VALUES ('$userid','$depart','$destin','$pri','$lim','$wei','$col','$trav','$gift','$formatcolis','$description')";
		$db->query($insertSql);
		
					

			$mail = $user_email; // Déclaration de l'adresse de destination.

			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.

			{

				$passage_ligne = "\r\n";

			}

			else

			{

				$passage_ligne = "\n";

			}

			//=====Déclaration des messages au format texte et au format HTML.

			$message_txt = "Bonjour. Votre annonce de voyage a bien été publiée sur le site Sendizy.fr!. Elle pourra dès à présent être consultée par toute la communauté et les internautes. Sendizy.fr ainsi que toute son équipe vous remercie pour votre confiance";

			$message_html = "<html><head></head><body><b>Bonjour</b>, Votre annonce de voyage a bien été publiée sur le site Sendizy.fr.Elle pourra dès à présent être consultée par toute la communauté et les internautes.Sendizy.fr ainsi que toute son équipe vous remercie pour votre confiance</body></html>";

			//==========

			 

			

			//==========

			 

			//=====Création de la boundary.

			$boundary = "-----=".md5(rand());

			$boundary_alt = "-----=".md5(rand());

			//==========

			 

			//=====Définition du sujet.

			$sujet = "Confirmation diffusion voyage !";

			//=========

			 

			//=====Création du header de l'e-mail.

			$header = "From: \"Sendizy\"<contact@sendizy.fr>".$passage_ligne;

			$header.= "Reply-to: \"Sendizy\" <contact@sendizy.fr>".$passage_ligne;

			$header.= "MIME-Version: 1.0".$passage_ligne;

			$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

			//==========

			 

			//=====Création du message.

			$message = $passage_ligne."--".$boundary.$passage_ligne;

			$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;

			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

			//=====Ajout du message au format texte.

			$message.= "Content-Type: text/plain; charset=utf-8".$passage_ligne;

			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

			$message.= $passage_ligne.$message_txt.$passage_ligne;

			//==========

			 

			$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

			 

			//=====Ajout du message au format HTML.

			$message.= "Content-Type: text/html; charset=utf-8".$passage_ligne;

			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

			$message.= $passage_ligne.$message_html.$passage_ligne;

			//==========

			 

			//=====On ferme la boundary alternative.

			$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

			//==========

			 

			 

			 

			$message.= $passage_ligne."--".$boundary.$passage_ligne;

			 

			//=====Ajout de la pièce jointe.

			$message.= "Content-Type: image/jpeg; name=\"image.jpg\"".$passage_ligne;

			$message.= "Content-Transfer-Encoding: base64".$passage_ligne;

			$message.= "Content-Disposition: attachment; filename=\"image.jpg\"".$passage_ligne;

			$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;

			$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 

			//========== 

			//=====Envoi de l'e-mail.

			mail($mail,$sujet,$message,$header);

			 

			//==========

		$_SESSION['flash']['success']= "Votre annonce a bien été publié sur le site!";
		header('Location: account.php');
		exit();
		
	}

}
?>


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







<div class="container">
<div class="o_cont">
<h2><strong>Mon compte</strong></h2>
	<div class="wrap">
		<div class="header_btm">
				<div class="menu">
					<ul>
						<li><a href="account.php">Mes annonces</a></li>
						<li><a href="publier_expedition.php">Publier une expedition</a></li>
						<li><a href="publier_voyage.php"><strong>Publier un voyage</strong></a></li>
						<li><a href="personal.php">Donnees personnelles</a></li>
						<div class="clear"></div>
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>
	
	
	<div class="">
		<h2>Publier une annonce pour annoncer votre prochain voyage</h2><br>
		<p>La diffusion de votre annonce est totalement gratuit. La durée de publication de votre annonce est de 1 mois</p>
	</div>	
	<div class="col-md-6">
	
	<?php if(!empty($errors)): ?>
			<div class="alert alert-danger">
				<p>Vous n'avez pas rempli le formulaire correctement</p>
				<ul>
					<?php foreach($errors as $error): ?>
						<li><?=$error;?></li>
					<?php endforeach; ?>
				</ul>
			</div>
	<?php endif;?>

		<form action="" method="POST">
				<h4><span class="glyphicon glyphicon-send"> <strong>Informations concernant le voyage</strong></h4><br>
				
				<script src="//code.jquery.com/jquery-1.10.2.js"></script>
							<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>					
							<script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
							<script src="js/datepicker-fr.js"></script>
						  <script>
								$(document).ready(function() {
								$('#depart').autocomplete({
									serviceUrl: 'fichier.php',
									dataType: 'json'
								});
							});
							</script>
							<script>
								$(document).ready(function() {
								$('#destination').autocomplete({
									serviceUrl: 'fichier.php',
									dataType: 'json'
								});
							});
							</script>		
						<!---strat-date-piker---->
						  <script>
						  $(function() {
							$( "#datepicker" ).datepicker();
						  });
						  </script>
						<!---/End-date-piker---->
					
					  <div class="form-group">
							<label for="departure">Ville de depart*</label>
							<p>Saisir la ville de départ en vous servant des suggestions</p>
								<input class="form-control" type="text" name="departure" value="" placeholder="Ville de départ" id="depart" required/>
						</div><br>
						
						<div class="form-group">
							<label for="destination">Ville de destination*</label>
							<p>Saisir la ville de destination en vous servant des suggestions</p>
								<input class="form-control" type="text" name="destination" value="" placeholder="Ville de destination" id="destination" required/>
							
						</div><br>

					  <div class="form-group">
						<label for="travel_date">Date du voyage (15/12/2016)*</label>
						<p>Saisir la date prévue de votre voyage. Respecter le format</p>
						<input  type="date" class="form-control" name="travel_date" placeholder="15/12/2016" id="travel_date" value="<?=((isset($_POST['travel_date']))?sanitize($_POST['travel_date']):'');?>" required/>
					  </div><hr>
					  
					  
				<h4><span class="glyphicon glyphicon-envelope"> <strong>Informations concernant le colis</strong></h4><br>
				
					  <div class="form-group">
						<label for="limit_day">Date limite de reception de colis (15/12/2016)*</label>
						<p>Saisir la date limite de réception du colis. Cette date devra être ultérieure à la date du voyage. Respecter le format</p>
						<input  type="date" class="form-control" name="limit_day" id="limit_day" placeholder="15/12/2016" value="<?=((isset($_POST['limit_day']))?sanitize($_POST['limit_day']):'');?>" required/>
					  </div><br>
					  
					  <div class="form-group">
						<label for="colis">Intitulé du colis recevable*</label>
						<p>Saisir l'intitulé du colis</p>
						<input  type="text" class="form-control" name="colis" placeholder="Courrier,Ordinateur,Télévision,..." id="colis" value="<?=((isset($_POST['colis']))?sanitize($_POST['colis']):'');?>" required/>
					  </div><br>
					  
					  <div class="form-group">
							<label for="formatcolis">Format du colis*</label>
							<p>Selectionner le format du colis parmi les suggestions</p>
								<select class="form-control" id="formatcolis" name="formatcolis" >
								
									<option value="" selected="selected"></option>
									<option value="Taille XS-tient dans une pochette(passport,Extrait de naissance, attestation...)" selected="selected">Taille XS-tient dans une pochette(passport,Extrait de naissance, attestation...)</option>
									<option value="Taille S-tient dans un carton(iphone,maquillage...)" selected="selected">Taille S-tient dans un carton(iphone,maquillage...)</option>
									<option value="Taille M-tient dans une valise de cabine(tablette,Ordinateur,vêtements...)" selected="selected">Taille M-tient dans une valise de cabine(tablette,Ordinateur,vêtements...)</option>
									<option value="Taille XM-tient dans un coffre(télévision,imprimante...)" selected="selected">Taille XM-tient dans un coffre(télévision,imprimante...)</option>
									
								</select>
								
						</div><br>
						
					  
					  <div class="form-group">
						<label for="weight">Poids colis recevable(kg)*</label>
						<p>Sasir le poids du colis recevable. Respecter le format</p>
						<input  type="text" class="form-control" name="weight" placeholder="2.50" id="weight" value="<?=((isset($_POST['weight']))?sanitize($_POST['weight']):'');?>" required/>
					  </div><br>
					  
					 <div class="form-group">
						<label for="price">Pourboire(€)*</label>
						<p>Sasir le pourboire que vous demandez. Respecter le format</p>
						<input  type="text" class="form-control" name="price" id="price" placeholder="25" value="<?=((isset($_POST['price']))?sanitize($_POST['price']):'');?>"/>
					  </div><br>
					  
					  <div class="form-group">
						<label for="gift">Recompense</label>
						<p>Vous pouvez demander une récompense à l'expéditeur</p>
						<input  type="text" class="form-control" name="gift" id="gift" placeholder="café, chèque cadeau, restaurant" value="<?=((isset($_POST['gift']))?sanitize($_POST['gift']):'');?>"/>
					  </div><br>
					  
					  					  
					  <div class="form-group">
						<label for="description">Description supplémentaire</label>	
						<p>Rajouter une description de votre colis</p>
						<textarea type="text" class="form-control" name="description" id="description" placeholder="Salut.Je voyage vers Bruxelle; j'ai 2 kg dispo..." value="<?=((isset($_POST['description']))?sanitize($_POST['description']):'');?>"></textarea>
					  </div>
					  				  
					  <br>

					  <button type="submit" class="btn btn-primary" name="valider">Valider</button><br><br>
		</form>
	</div>
	<div class="col-md-6"></div>
</div>
</div>


<?php include 'account_inc/footer.php';?>



