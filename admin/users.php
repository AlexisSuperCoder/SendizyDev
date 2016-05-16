<?php
require_once '../core/init.php';
if(!is_logged_in()){
		login_error_redirect();
	}
if(!has_permission()){
		permission_error_redirect('index.php');
	}
	

?>
<?php
	include 'includes/head.php';
	include 'includes/navigation.php';
?>


<h2 class="text-center">Toutes les utilisateurs en cours de validite</h2>

<?php
$userqls = $db->query("SELECT * FROM users WHERE deleted =0 AND featured =1");

	//Delete announce
if(isset($_GET['delete'])){
  $id = sanitize($_GET['delete']);
  $db->query("UPDATE users SET deleted = 1 WHERE id = '$id'");
  $db->query("UPDATE travel SET deleted = 1 WHERE user_id = '$id'");
  $db->query("UPDATE expedition SET deleted = 1 WHERE user_id = '$id'");
  header('Location: users.php');
}

?>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th></th><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th><th>city</th></thead>
	<tbody>
	<?php while($userql = mysqli_fetch_assoc($userqls)):?>
		<tr>
		
			<td>
				<a href="users.php?featured=<?=$userql['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
				<a href="users.php?delete=<?=$userql['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a>
			</td>
			<td><?= $userql['first_username'];?></td>
			<td><?= $userql['secund_username'];?></td>
			<td><?= $userql['email'];?></td>						
			<td><?= $userql['phone'];?></td>
			<td><?= $userql['city'];?></td>
					
		</tr>
	<?php endwhile;?>
	</tbody>
</table>


<h2 class="text-center">Toutes les utilisateurs supprimes</h2>

<?php
$userqls = $db->query("SELECT * FROM users WHERE deleted =1");
?>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th><th>city</th></thead>
	<tbody>
	<?php while($userql = mysqli_fetch_assoc($userqls)):?>
		<tr>
		
			
			<td><?= $userql['first_username'];?></td>
			<td><?= $userql['secund_username'];?></td>
			<td><?= $userql['email'];?></td>						
			<td><?= $userql['phone'];?></td>
			<td><?= $userql['city'];?></td>
					
		</tr>
	<?php endwhile;?>
	</tbody>
</table>


<h2 class="text-center">Toutes les utilisateurs archives</h2>

<?php
$userqls = $db->query("SELECT * FROM users WHERE featured =0");
?>
<div class="clearfix"></div>
<table class="table table-bordered table-condensed table-striped">
	<thead><th>Nom</th><th>Prenom</th><th>Email</th><th>Telephone</th><th>city</th></thead>
	<tbody>
	<?php while($userql = mysqli_fetch_assoc($userqls)):?>
		<tr>
		
			
			<td><?= $userql['first_username'];?></td>
			<td><?= $userql['secund_username'];?></td>
			<td><?= $userql['email'];?></td>						
			<td><?= $userql['phone'];?></td>
			<td><?= $userql['city'];?></td>
					
		</tr>
	<?php endwhile;?>
	</tbody>
</table>


<?php
include 'includes/footer.php';
?>
