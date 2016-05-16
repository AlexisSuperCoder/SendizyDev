<?php


if(!empty($_POST) && !empty($_POST['email'])){
	require_once 'core/db.php';
	require_once 'account_inc/functions.php';
	
	$req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND confirmed_at IS NOT NULL');
	$req->execute([$_POST['email']]);
	$user = $req->fetch();

	if($user){
		session_start();
		$reset_token = str_random(60);
		$pdo->prepare('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id=?')->execute([$reset_token, $user->id]);
		$_SESSION['flash']['success']= 'Les instructions du rappel de mot de passe vous ont ete envoye par email';
		mail($_POST['email'], 'Reinitialisation de votre mot de passe', "Afin de reinitialiser votre mot de passe, merci de cliquer sur ce lien \n\n http://localhost:82/takeiteasy/reset.php?id={$user->id}&token=$reset_token");
		header('Location: login.php');
		exit();
		
	}else{
		
		$_SESSION['flash']['danger'] = 'Auncun compte ne correspond a cette adresse';
	}
	
}

?>

<?php include 'account_inc/header.php';?>

			<!----LOGIN---->
			
			<div class="content">
				<div class="container">
					<div class="login-page">
						<div class="account-grid">
							<div class="col-md-6 login-right" data-wow-delay="0.4s">
								<h3>Mot de passe oublié ?</h3>
								<form action="" method="POST">
									<div>
										<span>Votre email<label> *</label></span>
										<input type="email" name="email" placeholder="Entrer votre email" class="form-control">
									</div>
									<button class="btn btn-primary" type="submit">Se connecter</button><br><br>
								</form>
								
							</div>
							<div class="clearfix"></div>							
						</div>
					</div>
				</div>
			</div>
			

<?php include 'account_inc/footer.php';?>