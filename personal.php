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
$saved_image = $personne['photo'];
$dbpath = $saved_image;
$edit_id = $personne['id'];
?>

<?php include 'account_inc/header.php';?>
<div class="container">
<div class="o_cont">
<h2><strong>Mon compte</strong></h2>
	<div class="wrap">
		<div class="header_btm">
				<div class="menu">
					<ul>
						<li><a href="account.php">Mes annonces</a></li>
						<li><a href="publier_expedition.php">Publier une expedition</a></li>
						<li><a href="publier_voyage.php">Publier un voyage</a></li>
						<li class="active"><a href="personal.php">Donnees personnelles</a></li>
						
						<div class="clear"></div>
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>
	
	
	<div>

		<h2>Mes données personnelles</h2><hr>
		<h4><strong>Mes coordonnées</strong></h4>
			<div class="part1">Nom:</div>
			<div class="part2"><?=$personne['first_username'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Prenom :</div>
			<div class="part2"><?=$personne['secund_username'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Adresse de résidence :</div>
			<div class="part2"><?=$personne['address'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Ville de résidence</div>
			<div class="part2"><?=$personne['city'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Pays de résidence :</div>
			<div class="part2"><?=$personne['country'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Telephone :</div>
			<div class="part2"><?=$personne['phone'];?></div>
			<div class="clearfix"></div>
			
			<div class="part1">Annee de naissance :</div>
			<div class="part2"><?=$personne['birthday'];?></div>
			<div class="clearfix"></div>
	
			
			<a href="modif_coordonnes.php">Modifier</a><br><br>
			
		<h4><strong>Mon email</strong></h4>
			<div class="part1">Email :</div>
			<div class="part2"><?=$personne['email'];?></div>
			<div class="clearfix"></div>
			
			<a href="modif_email.php">Modifier</a><br><br>
			
		<h4><strong>Mon mot de passe</strong></h4>
			
			<div class="part1">Mot de passe :</div>
			<div class="part2">************</div>
			<div class="clearfix"></div>
			
			<a href="modif_motdepass.php">Modifier</a><br><br>
			
			
		<div class="form-group col-md-3">
		<?php if($saved_image !=''):?>
			<h4><strong>Ma photo</strong></h4>
			<div class="saved-image"><img src ="<?=$saved_image;?>" alt="saved image" class="img-thumbnail"/><br>
			<a href="myphoto.php" class="text-danger">Changer Image</a>
		</div>
		<?php else:?>
		<label for="photo">Photo :</label>
		<input type="file" name="photo" id="photo" class="form-control">
		<?php endif;?>

		</div>		
			
			
	</div>	

	
</div>

</div>


<?php include 'account_inc/footer.php';?>



