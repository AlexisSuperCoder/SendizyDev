<?php
require_once 'account_inc/functions.php';
logged_only();
?>
<?php
require_once 'core/db.php';
require_once 'core/init.php';
?>

<?php
	if(!empty($_POST)){
		
		if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
			$_SESSION['flash']['danger'] = "Les mots de pass ne correspondent pas";
		}else{
			$user_id = $_SESSION['auth']->id;
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$pdo->prepare('UPDATE users SET password = ?')->execute([$password]);
			$_SESSION['flash']['danger'] =  "Votre mot de passe a bien ete mis à jour";
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
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>
	<h3>Changer mon mot de passe</h3><hr>
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
		<form action="modif_motdepass.php" method="POST">
			<div class="form-group col-md-3">
				<label for="password">Nouveau mot de passe*:</label>
				<input type="password" class="form-control" name="password" id="password" value="" placeholder="Entrer le nouveau mot de pass">
			</div>
			
			<div class="form-group col-md-3">
				<label for="password_confirm">Confirmation mot de passe*:</label>
				<input type="password" class="form-control" name="password_confirm" id="password_confirm" value="" placeholder="Confirmation nouveau mot de pass">
			</div><br><br><br>
			
			<div class="form-group pull-right">
				<a href="personal.php" class="btn btn-default">Cancel</a>
				<input type="submit" value="changer mot de passe" name="valider" class="btn btn-success pull-right">
			</div><div class="clearfix"></div>
		
		</form>
	</div>

</div>




<?php include 'account_inc/footer.php';?>



