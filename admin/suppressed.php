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
$travels1 = $db->query("SELECT * FROM travel WHERE deleted = 1");
?>
<?php
	include 'includes/head.php';
	include 'includes/navigation.php';	
?>
<h2 class="text-center">Toutes les voyages supprimees</h2>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Depart</th><th>Destination</th><th>Date de voyage</th><th>Date limite</th><th>Poids</th><th>Prix</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($travel1 = mysqli_fetch_assoc($travels1)):?>
		<tr>
		
			
			<td><?= $travel1['departure'];?></td>
			<td><?= $travel1['destination'];?></td>
			<td><?= $travel1['travel_date'];?></td>
			<td><?= $travel1['limit_day'];?></td>			
			<td><?= $travel1['weight'];?></td>
			<td><?= $travel1['price'];?></td>
			<td><?= $travel1['colis_type'];?></td>
			<td><?= $travel1['posted'];?></td>		
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

<h2 class="text-center">Toutes les expeditions supprimees</h2>
<?php
	$expeditionsups = $db->query("SELECT * FROM expedition WHERE deleted = 1");
?>

<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Depart</th><th>Destination</th><th>Date d'expedition</th><th>Poids</th><th>Prix</th><th>Type de Colis</th><th>Date diffusion</th></thead>
	<tbody>
	<?php while($expeditionsup = mysqli_fetch_assoc($expeditionsups)):?>
		<tr>
		
			
			<td><?= $expeditionsup['departure'];?></td>
			<td><?= $expeditionsup['destination'];?></td>
			<td><?= $expeditionsup['expedition_date'];?></td>
					
			<td><?= $expeditionsup['weight'];?></td>
			<td><?= $expeditionsup['price'];?></td>
			<td><?= $expeditionsup['colis_type'];?></td>
			<td><?= $expeditionsup['posted'];?></td>		
		</tr>
	<?php endwhile;?>
	</tbody>
</table>

<?php
include 'includes/footer.php';
?>

