<?php
require_once 'account_inc/functions.php';
logged_only();
include 'account_inc/header.php';
?>

<?php
$userid = $_SESSION['auth']->id;
require_once 'core/db.php';
require_once 'core/init.php';
?>

<?php
$cityquery = $db->query("SELECT * FROM cities");
$cityquery2 = $db->query("SELECT * FROM cities");
$formatcolisquery = $db->query("SELECT * FROM formatcolis");
?>

<?php
if(isset($_POST['valider'])){
	$errors = array();
	$dbpath = '';
	if(empty($_POST['departure']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['departure'])){
			$errors['departure'] = "La ville de depart saisie n'est pas valide";}
	
	if(empty($_POST['destination']) || !preg_match('/^[a-zA-Z0-9_-]+$/', $_POST['destination'])){
			$errors['destination'] = "La ville de destination saisie n'est pas valide";}
	
	if(empty($_POST['colis'])){
			$errors['colis'] = "Le type de colis saisi n'est pas valide";}
			
	
	if(empty($_POST['expedition_date']) || !preg_match('`(\d{1,2})/(\d{1,2})/(\d{4})`', $_POST['expedition_date'])){
			$errors['expedition_date'] = "La date de voyage saisie n'est pas valide";}
	
			
		
	if(empty($_POST['weight'])){
			$errors['weight'] = "Le poids saisi n'est pas valide";}
	
	if(!is_numeric($_POST['price'])){
			$errors['price'] = "Le prix saisi n'est pas valide";}

	if(empty($_POST['formatcolis'])){
			$errors['formatcolis'] = "Veuillez sélectionner un format de colis";}

	if(empty($_POST['photocolis'])){
			$errors['photocolis'] = "Selectionner une photo valide format jpg,png,gif ou jpeg";}
	

	if(!empty($_FILES)){
		$photo = $_FILES['photocolis'];
		$name = $photo['name'];
		$nameArray = explode('.',$name);
		$fileName = $nameArray[0];
		$fileExt =  $nameArray[1];
		$mime = explode('/',$photo['type']);
		$mimeType = $mime[0];
		$mimeExt = $mime[1];
		$tmpLoc = $photo['tmp_name'];
		$fileSize = $photo['size'];		
		$uploadName = md5(microtime()).'.'.$fileExt;
		$uploadPath = BASEURL.'img_user/'.$uploadName;
		$dbpath = '/takeiteasy/img_user/'.$uploadName;
		$allowed = array('png','jpg','jpeg','gif','jpe');
		// validation
		if($mimeType != 'image'){
			$errors[] = 'Vous devez charger une image';
		}
		if(!in_array($fileExt, $allowed)){
			$errors[] = "L'extension de la photo doit etre png, jpg, jpeg ou gif";
		}
		if($fileSize > 100000){
			$errors[] = "La photo devra etre moins de 10 MO";
		}
		if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt !='jpg' && $fileExt !='png' && $fileExt !='gif')){
			$errors[] = "L'extension de fichier ne marche pas";
		}
	}

			
	if(empty($errors)){
		move_uploaded_file($tmpLoc,$uploadPath);
		$depart = $_POST['departure'];
		
		$depquery1 =  $db->query("SELECT * FROM cities WHERE city_id = '$depart'");
		$dresult1 = mysqli_fetch_assoc($depquery1);
		$d1 = $dresult1['city'];
		
		
		$destin = $_POST['destination'];
		
		$depquery2 =  $db->query("SELECT * FROM cities WHERE city_id = '$destin'");
		$dresult2 = mysqli_fetch_assoc($depquery2);
		$d2 = $dresult2['city'];
		
		$gift = $_POST['gift'];
		$description = $_POST['description'];
		
		$col = $_POST['colis'];
		$wei = $_POST['weight'];
		$pri = $_POST['price'];
		$trav1 = $_POST['expedition_date'];
		
		$formatcolis1 = $_POST['formatcolis'];
		$photocolis1 = $_POST['photocolis'];
		
		$timestamp = $trav1;
		$timestamp = date_create_from_format('d/m/Y', $timestamp);
		$trav =  date_format($timestamp, 'Y-m-d');
		// update database
		
		$insertSql = "INSERT INTO expedition (user_id,departure,destination,price,weight,colis_type,expedition_date,gift,description,formatcolis,photocolis)
		VALUES ('$userid','$d1','$d2','$pri','$wei','$col','$trav','$gift','$description',$formatcolis1,$photocolis1)";
		$db->query($insertSql);
		$_SESSION['flash']['success']= "Votre annonce a bien été publié sur le site!";
		header('Location: account.php');
	}
}
?>


<div class="container">
<div class="o_cont">
<h2><strong>Mon compte</strong></h2>
	<div class="wrap">
		<div class="header_btm">
				<div class="menu">
					<ul>
						<li><a href="account.php">Mes annonces</a></li>
						<li><a href="publier_expedition.php"><strong>Publier une expedition</strong></a></li>
						<li><a href="publier_voyage.php">Publier un voyage</a></li>
						<li><a href="personal.php">Donnees personnelles</a></li>
						<div class="clear"></div>
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>
	
	
	<div class="p_sal">
		<h2>Publier une annonce pour expedier un colis</h2><br>
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
								<input class="form-control" type="text" name="departure" value="" placeholder="Depart" id="depart" required/>
						</div><br>
						
						<div class="form-group">
							<label for="destination">Ville de destination*</label>
							<p>Saisir la ville de destination en vous servant des suggestions</p>
								<input class="form-control" type="text" name="destination" value="" placeholder="Destination" id="destination" required/>
							
						</div><br>

					  <div class="form-group">
						<label for="expedition_date">Date d'expedition souhaite(15/12/2016)*</label>
						<p>Sasir la date d'expédition souhaitée de votre colis. Respecter le format</p>
						<input  type="date" class="form-control" name="expedition_date" placeholder="15/12/2016" id="expedition_date" value="<?=((isset($_POST['expedition_date']))?sanitize($_POST['expedition_date']):'');?>" required/>
					  </div><hr>
					  
				<h4><span class="glyphicon glyphicon-envelope"> <strong>Informations concernant le colis</strong></h4><br>	  
					  <div class="form-group">
						<label for="colis">Intitulé du colis à expédier*</label>
						<p>Saisir l'intitulé du colis. Soyez le plus clair possible</p>
						<input  type="text" class="form-control" name="colis" placeholder="Courrier,Ordinateur,Télévision,vélo..." id="colis" value="<?=((isset($_POST['colis']))?sanitize($_POST['colis']):'');?>" required/>
					  </div><br>
					  
					<div class="form-group">
							<label for="formatcolis">Format du colis*</label>
							<p>Selectionner le format du colis parmi les suggestions</p>
								<select class="form-control" id="formatcolis" name="formatcolis" >
									<option value="0"></option>
									<option value="1">Taille XS-tient dans une pochette(passport,Extrait de naissance, attestation...)</option>
									<option value="1">Taille S-tient dans un carton(iphone,maquillage...)</option>
									<option value="2">Taille M-tient dans une valise de cabine(tablette,Ordinateur,vêtements...)</option>
									<option value="3">Taille XM-tient dans un coffre(télévision,imprimante...)</option>
								</select>
								
						</div><br>
					  
					  <div class="form-group">
						<label for="weight">Poids colis à expédier(kg)*</label>
						<p>Sasir le poids du colis. Respecter le format</p>
						<input  type="text" class="form-control" name="weight" placeholder="2.50" id="weight" value="<?=((isset($_POST['weight']))?sanitize($_POST['weight']):'');?>" required/>
					  </div><br>
					  
					  <div class="form-group">
						<label for="photocolis">Photo du colis*</label>
						
						<p>Votre annonce sera 7 flois plus consultée qu'une annonce sans photo. Respecter le format(png,jpg,jpeg)</p>
						<input type="file" class="form-control" name="photocolis" id="photocolis" required>
					  </div><br>
					  
					  <div class="form-group">
						<label for="price">Pourboire(€)*</label>
						<p>Sasir le pourboire que vous proposez. Respecter le format</p>
						<input  type="text" class="form-control" name="price" id="price" placeholder="25" value="<?=((isset($_POST['price']))?sanitize($_POST['price']):'');?>"/>
					  </div><br>
					  
					  <div class="form-group">
						<label for="gift">Recompense</label>
						<p>Vous pouvez proposer une récompense pour le voyageur</p>
						<input  type="text" class="form-control" name="gift" id="gift" placeholder="café, chèque cadeau, restaurant" value="<?=((isset($_POST['gift']))?sanitize($_POST['gift']):'');?>"/>
					  </div><br>
					  
					  <div class="form-group">
						<label for="description">Description supplémentaire</label>	
						<p>Rajouter une description de votre colis</p>
						<textarea type="text" class="form-control" name="description" id="description" placeholder="Salut.Je souhaite expédier vers Nairobi un sac Dior..." value="<?=((isset($_POST['description']))?sanitize($_POST['description']):'');?>"></textarea>
					  </div><br>
					  
					  

					  <button type="submit" class="btn btn-primary" name="valider">Valider</button><br><br>
		</form>
	</div>
	<div class="col-md-6">
		
	</div>
</div>
</div>
<?php include 'account_inc/footer.php';?>



