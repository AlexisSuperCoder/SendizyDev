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
if(isset($_POST['valider'])){
	$errors = array();	

	if(!empty($_FILES)){
		$photo = $_FILES['photo'];
		$name = $photo['name'];
		$nameArray = explode('.',$name);
		$fileName = $nameArray[0];
		$fileExt =  $nameArray[1];
		$mime = explode('/',$photo['type']);
		$mimeType = $mime[0];
		$mimeExt = $mime[1];
		$tmpLoc = $photo['tmp_name'];
		$fileSize = $photo['size'];		
		$uploadName = md5(microtime()).'.'.$fileExt;
		$uploadPath = BASEURL.'img_user/'.$uploadName;
		$dbpath = '/takeiteasy/img_user/'.$uploadName;
		$allowed = array('png','jpg','jpeg','gif','jpe');
		// validation
		if($mimeType != 'image'){
			$errors[] = 'Vous devez charger une image';
		}
		if(!in_array($fileExt, $allowed)){
			$errors[] = "L'extension de la photo doit etre png, jpg, jpeg ou gif";
		}
		if($fileSize > 100000){
			$errors[] = "La photo devra etre moins de 10 MO";
		}
		if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt !='jpg' && $fileExt !='png' && $fileExt !='gif')){
			$errors[] = "L'extension de fichier ne marche pas";
		}
	}
	
	if(empty($errors)){
		move_uploaded_file($tmpLoc,$uploadPath);
		$insertSql = "UPDATE users SET photo = '$dbpath' WHERE id= '$userid'";
		$db->query($insertSql);
		header('Location: personal.php');
	}
	
}
?>

<?php include 'account_inc/header.php';?>
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
<div class="cadre_photo">	
<h3>Changer ma photo</h3>
<div class="row">
		<form action="" method="POST" enctype="multipart/form-data">
			<div class="form-group col-md-4">
				<label for="photo">Ma photo*:</label>
				<input type="file" class="" name="photo" id="photo" required>
			</div><br><br>
			
			<div class="form-group pull-right">
				<a href="personal.php" class="btn btn-default">Annuler</a>
				<input type="submit" value="Valider" name="valider" class="btn btn-success pull-right">
			</div><div class="clearfix"></div>
		
		</form>
	</div>
</div>	

<?php include 'account_inc/footer.php';?>



