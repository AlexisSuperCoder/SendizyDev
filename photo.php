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
	
	
	<div>

		<h3>Changer ma photo de profil</h3><hr>
		
		<div class="form-group col-md-6">
			
				<div class="saved-image"><img src ="img_user/img.jpg" alt="saved image"/><br>
					
				</div>
			
		</div>
			
			<a href="#">Modifier</a><br><br>
	</div>	

	
</div>




<?php include 'account_inc/footer.php';?>




