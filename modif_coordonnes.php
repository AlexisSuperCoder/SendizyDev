<?php
require_once 'account_inc/functions.php';
logged_only();
?>

<?php
$userid = $_SESSION['auth']->id;
require_once 'core/db.php';
require_once 'core/init.php';
$pers = $db->query("SELECT * FROM users WHERE id='$userid'");
$personne = mysqli_fetch_assoc($pers);
?>

<?php
$first_username = ((isset($_POST['first_username']) && $_POST['first_username'] != '')?sanitize($_POST['first_username']):$personne['first_username']);
$secund_username = ((isset($_POST['secund_username']) && $_POST['secund_username'] != '')?sanitize($_POST['secund_username']):$personne['secund_username']);
$address = ((isset($_POST['address']) && $_POST['address'] != '')?sanitize($_POST['address']):$personne['address']);
$city = ((isset($_POST['city']) && $_POST['city'] != '')?sanitize($_POST['city']):$personne['city']);
$country = ((isset($_POST['country']) && $_POST['country'] != '')?sanitize($_POST['country']):$personne['country']);
$phone = ((isset($_POST['phone']) && $_POST['phone'] != '')?sanitize($_POST['phone']):$personne['phone']);
$birthday = ((isset($_POST['birthday']) && $_POST['birthday'] != '')?sanitize($_POST['birthday']):$personne['birthday']);

if(isset($_POST['valider'])){
	
	$errors = array();
	
	
	if(empty($_POST['first_username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['first_username'])){
			$errors['first_username'] = "Le nom saisi n'est pas valide";
	}else{
			$req = $pdo->prepare('SELECT id FROM users WHERE first_username = ?');
			$req->execute([$_POST['first_username']]);
			$user = $req->fetch();
			if($user){
					$errors['first_username'] = 'Ce nom est deja pris';
			}
			
		}
			
	

	if(empty($_POST['secund_username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['secund_username'])){
			$errors['secund_username'] = "Le prenom saisi n'est pas valide";
	}else{
			$req = $pdo->prepare('SELECT id FROM users WHERE secund_username = ?');
			$req->execute([$_POST['secund_username']]);
			$user = $req->fetch();
			if($user){
					$errors['secund_username'] = 'Ce prenom est deja pris';
			}
			
		}
			

	
	// verification adresse
	
	if(empty($_POST['address'])){
			$errors['address'] = "L'adresse saisi n'est pas valide";
	}
	
	
	// verification ville
	
	if(empty($_POST['city']) || !preg_match('/^[a-zA-Z]/', $_POST['city'])){
			$errors['city'] = "La ville saisie n'est pas valide";
	}
		
	// verification pays
	
	if(empty($_POST['country']) || !preg_match('/^[a-zA-Z]/', $_POST['country'])){
			$errors['country'] = "Le pays saisi n'est pas valide";
	}
	
	
	// verification date de naissance
	
	if(empty($_POST['birthday']) || !preg_match('#^[1-2][0-9][0-9][0-9]$#', $_POST['birthday'])){
			$errors['birthday'] = "La date de naissance saisie n'est pas valide";
	}
	
	
	// verification telephone
	
	if(empty($_POST['phone']) || !preg_match('#^0[1-68]([-. ]?[0-9]{2}){4}$#', $_POST['phone'])){
			$errors['phone'] = "Le numero saisi n'est pas valide";
	}		
		
		
	if(empty($errors)){	
		$insertSql = "UPDATE users SET first_username = '$first_username', secund_username = '$secund_username', address = '$address',
			city = '$city', country = '$country', birthday = '$birthday', phone = '$phone' WHERE id= '$userid'";
		$db->query($insertSql);
		header('Location: personal.php');
		}
}
?>

<?php include 'account_inc/header.php';?>
<div class="container">
<h3><strong>Mon compte</strong></h3>
	<div class="wrap">
		<div class="header_btm">
				<div class="menu">
					<ul>
						<li><a href="account.php">Mes annonces publiées</a></li>
						<li><a href="publier.php">Publier une annonce</a></li>
						<li class="active"><a href="personal.php">Donnees personnelles</a></li>
						<li><a href="photo.php">Profil</a></li>
						<div class="clear"></div>
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>
	<h3>Modifier mes données personnelles</h3><hr>
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
	<div class="row">
		<form action="modif_coordonnes.php" method="POST">
			<div class="form-group col-md-3">
				<label for="first_username">Nom*:</label>
				<input type="text" class="form-control" name="first_username" id="first_username" value="<?=$first_username;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="secund_username">Prenom*:</label>
				<input type="text" class="form-control" name="secund_username" id="secund_username" value="<?=$secund_username;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="address">Adresse de résidence*:</label>
				<input type="text" class="form-control" name="address" id="address" value="<?=$address;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="city">Ville de résidence*:</label>
				<input type="text" class="form-control" name="city" id="city" value="<?=$city;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="country">Pays de résidence*:</label>
				<input type="text" class="form-control" name="country" id="country" value="<?=$country;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="phone">Telephone*:</label>
				<input type="text" class="form-control" name="phone" id="phone" value="<?=$phone;?>">
			</div>
			
			<div class="form-group col-md-3">
				<label for="birthday">Annee de naissance*:</label>
				<input type="text" class="form-control" name="birthday" id="birthday" value="<?=$birthday;?>">
			</div><br><br><br><br><div class="clearfix"></div>
			
			<div class="form-group pull-right">
				<a href="personal.php" class="btn btn-default">Cancel</a>
				<input type="submit" value="Valider" name="valider" class="btn btn-success pull-right">
			</div><div class="clearfix"></div>
		
		</form>
	</div>

</div>




<?php include 'account_inc/footer.php';?>



