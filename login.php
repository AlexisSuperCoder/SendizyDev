<?php
require_once 'account_inc/functions.php';
reconnect_from_cookie();

if(isset($_SESSION['auth'])){
	header('Location: account.php');
	exit();
}

if(!empty($_POST) && !empty($_POST['first_username']) && !empty($_POST['password'])){
	require_once 'core/db.php';
	$req = $pdo->prepare('SELECT * FROM users WHERE (first_username = :first_username OR email = :first_username) AND confirmed_at IS NOT NULL');
	$req->execute(['first_username' => $_POST['first_username']]);
	$user = $req->fetch();
	
	if(!empty($user)){
		
		if(!empty($_POST) && !empty($_POST['first_username']) && !empty($_POST['password'])){
			require_once 'core/db.php';
			$req = $pdo->prepare('SELECT * FROM users WHERE (first_username = :first_username OR email = :first_username) AND confirmed_at IS NOT NULL');
			$req->execute(['first_username' => $_POST['first_username']]);
			$user = $req->fetch();
	
			if(password_verify($_POST['password'], $user->password)){
				$_SESSION['auth']= $user;
				$_SESSION['flash']['success']= 'Vous etes maintenant connecte au site';
				header('Location: account.php');
				exit();
			}else{
				$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
			}
	
		}
	
	}else{
		$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
	}
	
}

?>


<?php include 'account_inc/header.php';?>

			<!----LOGIN---->
			
			<div class="content">
				<div class="container">
					<div class="login-page">
						<div class="account-grid">
							<div class="col-md-6 login-left" data-wow-delay="0.4s">
								<h3>CREER UN NOUVEAU COMPTE</h3>
								<p>En creant un compte, vous devenez ambassadeur; ainsi vous pourrez diffuser gratuitement vos annonces de voyage afin de collecter des colis pour faire le complement de vos bagages en soute et gagner de l'argent!</p>
								<a class="account-btn" href="register.php"><button type="button" class="btn btn-success">Creer un compte</button></a>
								
							</div>
							
							
							<div class="col-md-6 login-right" data-wow-delay="0.4s">
								<h3>SE CONNECTER A VOTRE COMPTE</h3>
								<p>Si vous avez deja un compte, connectez vous ici</p>
								
								<form action="" method="POST">
									<div>
										<span>Nom ou Votre email<label> *</label></span>
										<input type="text" name="first_username" placeholder="Entrer votre nom" class="form-control" required>
									</div>
									<div>
										<span>Mot de passe<label> *</label></span>
										<input type="password" name="password" placeholder="Entrer votre mot de passe" class="form-control" required>
									</div>
									<div class="form-group">
										<label>
											<input type="checkbox" name="remember" value="1"/> Se souvenir de moi
										</label>
									</div>
									<a class="forgot" href="forget.php">Mot de passe oublie?</a>
									<button class="btn btn-primary" type="submit">Se connecter</button><br><br>
								</form>
								
							</div>
							<div class="clearfix"></div>							
						</div>
					</div>
				</div>
			</div>
			

<?php include 'account_inc/footer.php';?>