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
$email = ((isset($_POST['email']) && $_POST['email'] != '')?sanitize($_POST['email']):$personne['email']);

if(isset($_POST['valider'])){
	
	$errors = array();
	
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Votre email n'est pas valide";
	}else{
			
			$req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
			$req->execute([$_POST['email']]);
			$user = $req->fetch();
			if($user){
					$errors['email'] = 'Cet email est deja pris';
			}	
		}

	if(empty($errors)){	
		$insertSql = "UPDATE users SET email = '$email' WHERE id= '$userid'";
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
		<form action="modif_email.php" method="POST">
			<div class="form-group col-md-3">
				<label for="email">Nouveau Email*:</label>
				<input type="text" class="form-control" name="email" id="email" value="<?=$email;?>">
			</div><br><br>
			
			<div class="form-group pull-right">
				<a href="personal.php" class="btn btn-default">Annuler</a>
				<input type="submit" value="Valider" name="valider" class="btn btn-success pull-right">
			</div><div class="clearfix"></div>
		
		</form>
	</div>

</div>




<?php include 'account_inc/footer.php';?>



