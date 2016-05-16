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
$travels = $db->query("SELECT * FROM travel WHERE featured = 0");
?>
<?php
	include 'includes/head.php';
	include 'includes/navigation.php';	
?>
<h2 class="text-center">Toutes les voyages archives</h2>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Depart</th><th>Destination</th><th>Date de voyage</th><th>Date limite</th><th>Poids</th><th>Prix</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($travel = mysqli_fetch_assoc($travels)):?>
		<tr>
		
			
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

<h2 class="text-center">Toutes les expeditions archives</h2>
<?php
$exparchives = $db->query("SELECT * FROM expedition WHERE featured = 0");
?>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Depart</th><th>Destination</th><th>Date d'expedition</th><th>Poids</th><th>Prix</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($exparchive = mysqli_fetch_assoc($exparchives)):?>
		<tr>
		
			
			<td><?= $exparchive['departure'];?></td>
			<td><?= $exparchive['destination'];?></td>
			
			<td><?= $exparchive['expedition_date'];?></td>			
			<td><?= $exparchive['weight'];?></td>
			<td><?= $exparchive['price'];?></td>
			<td><?= $exparchive['colis_type'];?></td>
			<td><?= $exparchive['posted'];?></td>		
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

<?php
include 'includes/footer.php';
?>

