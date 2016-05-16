<?php
require_once 'account_inc/functions.php';
logged_only();
?>
<?php
$userid = $_SESSION['auth']->id;
require_once 'core/db.php';
require_once 'core/init.php';
$results = $db->query("SELECT * FROM travel WHERE user_id='$userid' AND deleted =0 AND featured = 1");

//Delete announce
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE travel SET deleted = 1 WHERE travel_id = '$id'");
  header('Location: account.php');
}

//Delete announce
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE expedition SET deleted = 1 WHERE expedition_id = '$id'");
  header('Location: account.php');
}
?>


<?php include 'account_inc/header.php';?>
<div class="container">
<div class="o_cont">
<h2><strong>Mon compte</strong></h3>
	<div class="wrap">
		<div class="header_btm">
				<div class="menu m_title">
					<ul>
						<li class="active"><a href="account.php"><strong>Mes annonces</strong></a></li>
						<li><a href="publier_expedition.php">Publier une expedition</a></li>
						<li><a href="publier_voyage.php">Publier un voyage</a></li>
						<li><a href="personal.php">Donnees personnelles</a></li>
						
						<div class="clear"></div>
					</ul>
				</div>
			<div class="clear"></div>
		</div>
	</div><hr>	
	
	<h2 class="text-center">Mes voyages annonces</h2>
	
	<table class="table table-bordered table-condensed table-striped">
		<thead><th></th><th>Depart</th><th>Destination</th><th>Date de voyage</th><th>Date limite</th><th>Nb kg</th><th>Pourboire</th></thead>
		<tbody>
			<?php while($donnes = mysqli_fetch_assoc($results)): ?>
			<tr>
				<td>
					
					<a href="account.php?delete=<?=$donnes['travel_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				<td><?=$donnes['departure'];?></td>
				<td><?=$donnes['destination'];?></td>
				<td><?= date("d/m/Y", strtotime($donnes['travel_date']));?></td> 
				<td> <?= date("d/m/Y", strtotime($donnes['limit_day']));?></td>  
				<td><?=$donnes['weight'];?></td>
				<td><?=$donnes['price'];?>€</td>				
			</tr>
			<?php endwhile;?>
		</tbody>
	</table>
	
	
	<h2 class="text-center">Mes annonces d'expedition de colis</h2>
	<?php
		$presults = $db->query("SELECT * FROM expedition WHERE user_id='$userid' AND deleted =0 AND featured = 1");
	?>
	<table class="table table-bordered table-condensed table-striped">
		<thead><th></th><th>Depart</th><th>Destination</th><th>Date d'expedition souhaitee</th><th>Nb kg</th><th>Pourboire</th></thead>
		<tbody>
			<?php while($donnes = mysqli_fetch_assoc($presults)): ?>
			<tr>
				<td>
					
					<a href="account.php?delete=<?=$donnes['expedition_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
				</td>
				<td><?=$donnes['departure'];?></td>
				<td><?=$donnes['destination'];?></td>
				<td><?= date("d/m/Y", strtotime($donnes['expedition_date']));?></td>
				
				<td><?=$donnes['weight'];?></td>
				<td><?=$donnes['price'];?>€</td>   				
			</tr>
			<?php endwhile;?>
		</tbody>
	</table>

</div>
	
</div>




<?php include 'account_inc/footer.php';?>



