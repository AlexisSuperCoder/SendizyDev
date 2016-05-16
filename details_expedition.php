<?php
require_once 'account_inc/functions.php';
require_once 'core/db.php';
require_once 'core/init.php';
logged_only();
?>

<?php

if(isset($_GET['edit']) && !empty($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];		
		$sql3 = "SELECT * FROM expedition WHERE expedition_id = '$edit_id'"; 
		$edit_result = $db->query($sql3);
		$eresult = mysqli_fetch_assoc($edit_result);
		$edate = $eresult['expedition_date'];
		$day= date("d/m/Y", strtotime($edate));
		
		$amb_id = $eresult['user_id'];
		$sql4 = "SELECT * FROM users WHERE id='$amb_id'";
		$amb_result = $db->query($sql4);
		$aresult = mysqli_fetch_assoc($amb_result);
		$postdate = $eresult['posted'];
		$day_post= date("d/m/Y", strtotime($postdate));
		
		$dep = $eresult['departure'];
		$depquery = $db->query("SELECT * FROM cities WHERE city='$dep'");
		$dep_country = mysqli_fetch_assoc($depquery);
		
		
		$des = $eresult['destination'];
		$desquery = $db->query("SELECT * FROM cities WHERE city='$des'");
		$des_country = mysqli_fetch_assoc($desquery);
}


?>

<?php include 'account_inc/header.php';?>
<?php include 'account_inc/exp_research.php';?>
		
	<div class="container">
	
			<div class="exp_title">
				Expedition <?=$eresult['colis_type'];?> de <?=$eresult['departure'];?>, <?=$dep_country['country'];?> vers <?=$eresult['destination'];?>, <?=$des_country['country'];?> le <?=$day;?>
				<h5>Publie le <?=$day_post;?>, par <?=$aresult['secund_username'];?></h5>
			</div>
			
			<div>
				<div class="exp_voyage">
					Details de voyage
				</div>
				<div class="exp_voyage_it">
					Lieu de depart du colis : <?=$eresult['departure'];?>, <?=$dep_country['country'];?>.
				</div>
				<div class="exp_voyage_it">
					Lieu de destination du colis : <?=$eresult['destination'];?>, <?=$des_country['country'];?>.
				</div>
				<div class="exp_voyage_it">
					Date d'expedition souhaitée : <?= date("d/m/Y", strtotime($eresult['expedition_date']));?>.
				</div>		
			</div>
			
			<div>
				<div class="exp_voyage">
					Details du colis
				</div>
				<div class="exp_voyage_it">
					Nature du colis : <?=$eresult['colis_type'];?>.
				</div>
				<div class="exp_voyage_it">
					Poids du colis : <?=$eresult['weight'];?> kg.
				</div>
				<div class="exp_voyage_it">
					Infos complementaires : <?=$eresult['description'];?>.
				</div>
				
			</div>
			
			<div>
				<div class="exp_voyage">
					Details de demandeur
				</div>
				<div class="exp_voyage_it">
					Nom de l'expediteur : <?=$aresult['first_username'];?> .
				</div>
				<div class="exp_voyage_it">
					Prenom de l'expediteur : <?=$aresult['secund_username'];?> .
				</div>
				<div class="exp_voyage_it">
					Email de l'expediteur : <?=$aresult['email'];?> .
				</div>
				<div class="exp_voyage_it">
					Telephone : <?=$aresult['phone'];?> .
				</div>
				
				<div class="exp_voyage_it">
					Lieu de residence : <?=$aresult['city'];?>, <?=$aresult['country'];?> .
				</div>
				<div class="exp_voyage_it">
					Grade : <?=$aresult['grade'];?> .
				</div>
			</div>
			
			<div>
				<div class="exp_voyage">
					Compensation
				</div>
				<div class="exp_voyage_it">
					Pourboire : <?=$eresult['price'];?>€.
				</div>
				<div class="exp_voyage_it">
					Recompense: <?=$eresult['gift'];?> .
				</div>
						
			</div>
			
			<div class="mcontacter text-center">
			Vous comptez voyager bientot à destination de <?=$eresult['destination'];?>, <?=$des_country['country'];?>:<br>
					<a href="publier_voyage.php"><button type="button" class="btn btn-success btn-lg">Publier votre voyage</button></a>
					<a href="mcontacter.php?edit=<?=$aresult['id'];?>"><button type="button" class="btn btn-success btn-lg">Lui envoyer un email</button></a>
			</div>
	
	</div>		

<?php include 'account_inc/footer.php';?>