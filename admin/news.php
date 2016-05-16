<?php
require_once '../account_inc/functions.php';
require_once '../core/db.php';
require_once '../core/init.php';
if(!is_logged_in()){
		login_error_redirect();
	}
if(!has_permission()){
		permission_error_redirect('index.php');
	}
	

$travels = $db->query("SELECT * FROM travel WHERE deleted =0 AND featured =1");

//Delete announce
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE travel SET deleted = 1 WHERE travel_id = '$id'");
  header('Location: news.php');
}

if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE expedition SET deleted = 1 WHERE expedition_id = '$id'");
  header('Location: news.php');
}

//Archived announce
if(isset($_GET['featured'])){
  $id = sanitize($_GET['featured']);
  $db->query("UPDATE travel SET featured = 0 WHERE travel_id = '$id'");
  header('Location: news.php');
}

if(isset($_GET['featured'])){
  $id = sanitize($_GET['featured']);
  $db->query("UPDATE expedition SET featured = 0 WHERE expedition_id = '$id'");
  header('Location: news.php');
}


?>
<?php
	include 'includes/head.php';
	include 'includes/navigation.php';	
?>
<h2 class="text-center">Toutes les voyages en cours</h2>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th></th><th>Depart</th><th>Destination</th><th>Date de voyage</th><th>Date limite</th><th>Poids</th><th>Prix</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($travel = mysqli_fetch_assoc($travels)):?>
		<tr>
		
			<td>
				<a href="news.php?featured=<?=$travel['travel_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="news.php?delete=<?=$travel['travel_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
			</td>
			<td><?= $travel['departure'];?></td>
			<td><?= $travel['destination'];?></td>
			<td><?= $travel['travel_date'];?></td>
			<td><?= $travel['limit_day'];?></td>			
			<td><?= $travel['weight'];?></td>
			<td><?= $travel['price'];?></td>
			<td><?= $travel['colis_type'];?></td>
			<td><?= $travel['posted'];?></td>		
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

<h2 class="text-center">Toutes les expeditions de colis en cours</h2>

<?php
$expsqls = $db->query("SELECT * FROM expedition WHERE deleted =0 AND featured =1");
?>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th></th><th>Depart</th><th>Destination</th><th>Date d'expedition</th><th>Poids</th><th>Pourboire</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($expsql = mysqli_fetch_assoc($expsqls)):?>
		<tr>
		
			<td>
				<a href="news.php?featured=<?=$expsql['expedition_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="news.php?delete=<?=$expsql['expedition_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
			</td>
			<td><?= $expsql['departure'];?></td>
			<td><?= $expsql['destination'];?></td>
			<td><?= $expsql['expedition_date'];?></td>						
			<td><?= $expsql['weight'];?></td>
			<td><?= $expsql['price'];?></td>
			<td><?= $expsql['colis_type'];?></td>
			<td><?= $expsql['posted'];?></td>		
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

<?php
include 'includes/footer.php';
?>

