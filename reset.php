<?php

if(isset($_GET['id']) && isset($_GET['token'])){
	require_once 'core/db.php';	
	require_once 'account_inc/functions.php';	
	
	$req = $pdo->prepare('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(),INTERVAL 30 MINUTE)');
	$req->execute([$_GET['id'], $_GET['token']]);
	$user = $req->fetch();
	if($user){
		
		if(!empty($_POST)){
			if(!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$pdo->prepare('UPDATE users SET password = ?, reset_at = NULL, reset_token = NULL')->execute([$password]);
				session_start();
				$_SESSION['flash']['success'] = "Votre mot de pass a bient ete modifié";
				$_SESSION['auth'] = $user;
				header('Location: account.php');
				exit();
			}
		}
		
	}else{
		session_start();
		$_SESSION['flash']['danger'] = "ce token n'est pas valide";
		header('Location: login.php');
		exit();
	}

}else{
	header('Location: login.php');
	exit();
}

?>


<?php include 'account_inc/header.php';?>

			<!----LOGIN---->
			
			<div class="content">
				<div class="container">
					<div class="login-page">
						<div class="account-grid">

							
							<div class="col-md-6 login-right" data-wow-delay="0.4s">
								<h3>REINITIALISER MON MOT DE PASSE</h3>
								
								
								<form action="" method="POST">

									<div>
										<span>Mot de passe<label> *</label></span>
										<input type="password" name="password" placeholder="Entrer votre mot de passe" class="form-control">
									</div>
									
									<div>
										<span>Conrimation mot de passe<label> *</label></span>
										<input type="password" name="password_confirm" placeholder="Entrer de nouveau votre mot de passe" class="form-control">
									</div>
									
									<button class="btn btn-primary" type="submit">Reinitialiser</button><br><br>
								</form>
								
							</div>
							<div class="clearfix"></div>							
						</div>
					</div>
				</div>
			</div>
			

<?php include 'account_inc/footer.php';?>