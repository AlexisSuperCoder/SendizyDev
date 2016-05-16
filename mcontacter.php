<?php
require_once 'account_inc/functions.php';
require_once 'helpers/helpers.php';
require_once 'core/init.php';
logged_only();

	if(isset($_GET['edit'])){
		$id = sanitize($_GET['edit']);
		$sql_id = $db->query("SELECT * FROM users WHERE id ='$id'");
		$result_id = mysqli_fetch_assoc($sql_id);
	}
?>
<?php include 'account_inc/header.php';?>
<h2 class="text-center">Envoyer un email de contact à <?=$result_id['secund_username'];?></h2>
	<div class="container">
		<div class="starter-template">
		
		<?php if(array_key_exists('errors', $_SESSION)):?>
			
			<div class="alert alert-danger">
				<?= implode('<br>', $_SESSION['errors']);?>
			</div>		
		
		<?php endif;?>

		<?php if(array_key_exists('success', $_SESSION)):?>
			
			<div class="alert alert-success">
				Votre email a bien ete envoyé!
			</div>		
		
		<?php endif;?>	
		
			<form action="post_contacte_users.php?cat=<?=$id;?>" method="POST">
				<div class="row">
					<div class="col-xs-6">
						<div class="form-group">
							<label for="firstname">Votre nom*</label>
							<input type="text" name="firstname" class="form-control" id="firstname" value="<?= isset($_SESSION['inputs']['firstname']) ? $_SESSION['inputs']['firstname'] : '';?>" required>
						</div>
					</div>
					
					<div class="col-xs-6">
						<div class="form-group">
							<label for="secundname">Votre prenom*</label>
							<input type="text" name="secundname" class="form-control" id="secundname" value="<?= isset($_SESSION['inputs']['secundname']) ? $_SESSION['inputs']['secundname'] : '';?>" required>
						</div>
					</div>
					
					<div class="col-xs-6">
						<div class="form-group">
							<label for="email">Votre Email*</label>
							<input type="email" name="email" class="form-control" id="email" value="<?= isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : '';?>" required>
						</div>
					</div>
					
					<div class="col-xs-6">
						<div class="form-group">
							<label for="telephone">Votre telephone*</label>
							<input type="text" name="telephone" class="form-control" id="telephone" value="<?= isset($_SESSION['inputs']['telephone']) ? $_SESSION['inputs']['telephone'] : '';?>" >
						</div>
					</div>
					
					<div class="col-xs-12">
						<div class="form-group">
							<label for="message">Votre message*</label>
							<textarea id="message" name="message" class="form-control" required><?= isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : '';?></textarea>
						</div>
					</div>
					
					<button type="submit" class="btn btn-primary pull-right">Envoyer</button><br><br><br><br>
					
				</div>

			</form>
		</div>

	</div>
<?php include 'account_inc/footer.php';?>
<?php
unset($_SESSION['inputs']);
unset($_SESSION['success']);
unset($_SESSION['errors']);
?>




