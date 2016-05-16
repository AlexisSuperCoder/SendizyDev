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
?>

<?php
	//get brand from database	
	$results = $db->query("SELECT * FROM cities ORDER BY city");
	$errors = array();
	
	// Delete city
	if(isset($_GET['delete']) && !empty($_GET['delete'])){
		$delete_id = (int)$_GET['delete'];
		$delete_id = sanitize($delete_id);
		$sql ="DELETE FROM cities WHERE city_id = '$delete_id'";
		$db->query($sql);
		header('Location : city.php');
	}
	
	
	//Edit brand
	if(isset($_GET['edit']) && !empty($_GET['edit'])){
		$edit_id = (int)$_GET['edit'];
		$edit_id = sanitize($edit_id);
		$sql2 = "SELECT * FROM cities WHERE city_id = '$edit_id'";
		$edit_result = $db->query($sql2);
		$ecity = mysqli_fetch_assoc($edit_result);
	}
	
	
	// if add form is submitted
	if(isset($_POST['add_submit'])){
		$city = sanitize($_POST['city']);
		$country = sanitize($_POST['country']);
		// check if brand is blank
		if($_POST['city']==''){
			$errors[] .='You must enter a city';
		}
		if($_POST['country']==''){
			$errors[] .='You must enter a country';
		}
		// check if city exists in database		
		$sql="SELECT * FROM cities WHERE city='$city'";
		if(isset($_GET['edit'])){
			$sql="SELECT * FROM cities WHERE city='$city' AND city_id !='edit_id'";
		}
		
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errors[] .= $city. ' allready exists; Please choose another brand!';
		}
		
		
		// check if country exists in database	
		$sql="SELECT * FROM cities WHERE country='$country'";
		if(isset($_GET['edit'])){
			$sql="SELECT * FROM cities WHERE country='$country' AND city_id !='edit_id'";
		}
		
		$result = $db->query($sql);
		$count = mysqli_num_rows($result);
		if($count > 0){
			$errors[] .= $country. ' allready exists; Please choose another brand!';
		}
		// display errors
		if(!empty($errors)){
			echo display_errors($errors);
		} else{
			// Add brand to database
			$sql = "INSERT INTO cities (city,country) VALUES ('$city','$country')";
				if(isset($_GET['edit'])){
					$sql="UPDATE cities SET city = '$city' WHERE city_id ='$edit_id'";
				}
			$db->query($sql);
			header('Location: city.php');
		}
	}

?>


<?php
	include 'includes/head.php';
	include 'includes/navigation.php';	
?>

<h2 class="text-center">Toutes les villes</h2><hr>

<!--Brand form-->
<div class="text-center">
	<form class="form-inline" action="city.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'')?>" method="post">
		<div class="form-group">
			<?php 
			$city_value = '';
			$country_value = '';
			if(isset($_GET['edit'])){
				$city_value = $ecity['city'];
				$country_value = $ecity['country'];
			}else{
				if(isset($_POST['city'])){
					$city_value = sanitize($_POST['city']);
					$country_value = sanitize($_POST['country']);
				}
				
			}?>
			<label for="city"><?=((isset($_GET['edit']))?'Edit':'Add A')?> CITY:</label>
			<input type="text" name="city" id="city" class="form-control" value="<?=$city_value ;?>">
			<input type="text" name="country" id="country" class="form-control" value="<?=$country_value ;?>">
			<?php if(isset($_GET['edit'])):?>
				<a href="city.php" class="btn btn-default">Supprimer</a>
			<?php endif;?>

			<input type="submit" name="add_submit" value="<?=((isset($_GET['edit']))?'Edit':'Add')?> city" class="btn btn-success form-control">
		</div>
	</form>
</div><hr>

<table class="table table-bordered table-stripped table-auto table-condensed">
	<thead>
		<th></th><th>Villes</th><th></th>
	</thead>
	<tbody>
		<?php while($city = mysqli_fetch_assoc($results)): ?>
		<tr>
			<td><a href="city.php?edit=<?= $city['city_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
			<td><?= $city['city'];?></td>
			<td><?= $city['country'];?></td>
			<td><a href="city.php?delete=<?= $city['city_id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
		<tr>
		<?php endwhile;?>
	<tbody>
</table>






















<?php
include 'includes/footer.php';
?>

