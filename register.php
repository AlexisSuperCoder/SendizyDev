<?php
require_once 'account_inc/functions.php';
session_start();

if(!empty($_POST)){
	$first_username = stripslashes(trim($_POST['first_username']));    
	$secund_username = stripslashes(trim($_POST['secund_username']));
	$address = stripslashes(trim($_POST['address']));
	$city = stripslashes(trim($_POST['city']));
	$country = stripslashes(trim($_POST['country']));
	
	$phone = stripslashes(trim($_POST['phone']));
	$email = stripslashes(trim($_POST['email']));
	$birthday = stripslashes(trim($_POST['birthday']));
	$password = stripslashes(trim($_POST['password']));
	$password_confirm = stripslashes(trim($_POST['password_confirm']));
	
	$errors = array();
	require_once 'core/db.php';
	
	// verification nom
	
	if(empty($_POST['first_username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['first_username'])){
			$errors['first_username'] = "Le nom saisi n'est pas valide";
	}else{
			$req = $pdo->prepare('SELECT id FROM users WHERE first_username = ?');
			$req->execute([$_POST['first_username']]);
			$user = $req->fetch();
			if($user){
					$errors['first_username'] = 'Ce nom est deja pris';
			}
			
		}
	
	// verification prenom
	
	if(empty($_POST['secund_username']) || !preg_match('/^[a-zA-Z0-9_]+$/', $_POST['secund_username'])){
			$errors['secund_username'] = "Le prenom saisi n'est pas valide";
	}else{
			$req = $pdo->prepare('SELECT id FROM users WHERE secund_username = ?');
			$req->execute([$_POST['secund_username']]);
			$user = $req->fetch();
			if($user){
					$errors['secund_username'] = 'Ce prenom est deja pris';
			}
			
		}
		
	// verification adresse
	
	if(empty($_POST['address'])){
			$errors['address'] = "L'adresse saisi n'est pas valide";
	}
		
		
	// verification ville
	
	if(empty($_POST['city']) || !preg_match('/^[a-zA-Z]/', $_POST['city'])){
			$errors['city'] = "La ville saisie n'est pas valide";
	}
		
	// verification pays
	
	if(empty($_POST['country']) || !preg_match('/^[a-zA-Z]/', $_POST['country'])){
			$errors['country'] = "Le pays saisi n'est pas valide";
	}
	

	// verification numero
	
	if(empty($_POST['phone']) || !preg_match('/^[0-9_]+$/', $_POST['phone'])){
			$errors['phone'] = "Le numero saisi n'est pas valide";
	}else{
			$req = $pdo->prepare('SELECT id FROM users WHERE phone = ?');
			$req->execute([$_POST['phone']]);
			$user = $req->fetch();
		}
		
	// verification date de naissance
	
	if(empty($_POST['birthday']) || !preg_match('#^[1-2][0-9][0-9][0-9]$#', $_POST['birthday'])){
			$errors['birthday'] = "La date de naissance saisie n'est pas valide";
	}
		
	
	// verification telephone
	if(strlen($_POST['phone']) > 18){
		  $errors[] = "Le numero de telephone n'est pas valide.";
		}	
		
	// verification email
	
	if(empty($_POST['email']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
			$errors['email'] = "Votre email n'est pas valide";
	}else{
			
			$req = $pdo->prepare('SELECT id FROM users WHERE email = ?');
			$req->execute([$_POST['email']]);
			$user = $req->fetch();
			if($user){
					$errors['email'] = 'Cet email est deja pris';
			}	
		}

		
	// verification mot de pass
	if(empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']){
			$errors['password'] = "Vous devez entrer un mot de passe valide";
	}
	
	// verification mot de pass
	if(strlen($_POST['password']) < 8){
			$errors['password'] = "Votre mot de passe devra etre superieur à 8 caracteres";
	}
		
	
	if(empty($errors)){
		
			
			$req = $pdo->prepare("INSERT INTO users SET first_username = ?, secund_username = ?, password = ?, email = ?, city = ?, country = ?, birthday = ?, phone = ?, address = ?, photo = ?, grade = ?, confirmation_token = ?");
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$token = str_random(60);
			$grade ="Debutant";
			$photodefault = "/takeiteasy/img_user/image.png";
			$req->execute([$_POST['first_username'], $_POST['secund_username'], $password, $_POST['email'], $_POST['city'], $_POST['country'], $_POST['birthday'], $_POST['phone'], $_POST['address'], $photodefault, $grade, $token]);
			$user_id = $pdo->lastInsertId();
			mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte, merci de cliquer sur ce lien\n\n http://localhost:82/takeiteasy/confirm.php?id=$user_id&token=$token");
			$_SESSION['flash']['success']= 'Un email de confirmation  vous a ete envoyé pour confirmer votre compte';
			header('Location: login.php');
			exit();
		}
}
?>
<?php include 'account_inc/header.php';?>

					<div class="registration-form">
						<div class="container">
							<h2>Créér un nouveau compte</h2>
							
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
									
							<div class="registration-grids">
								<div class="reg-form">
									<div class="reg">
										<p>Bienvenue sur Send.It.Easy; Bien vouloir renseigner les champs obligatoires ci-dessous pour s'inscrire.</p>
										<p>* Si vous avez deja un compte, <a href="login.php">Cliquer ici</a></p><hr>
										<form action="" method="post">
											<ul>
												<li class="text-info" for="">Nom*: </li>
												<li><input type="text" name="first_username" placeholder="Entrer votre nom" class="form_control"></li>
											</ul>
											<ul>
												<li class="text-info" for="">Prenom*: </li>
												<li><input type="text" name="secund_username" placeholder="Entrer votre prenom" class="form_control"></li>
											</ul>
																	
											<ul>
												<li class="text-info" for="">Année de naissance*: </li>
												<li><input type="text" name="birthday" placeholder="Entrer votre annee de naissance" class="form_control"></li>
											</ul>
											
											<ul>
												<li class="text-info" for="">Adresse*: </li>
												<li><input type="text" name="address" placeholder="Entrer votre adresse" class="form_control"></li>
											</ul>
											
											<ul>
												<li class="text-info" for="">Ville de residence*: </li>
												<li><input type="text" name="city" placeholder="Entrer votre ville" class="form_control"></li>
											</ul>
											
											<ul>
												<li class="text-info" for="">Pays de residence*: </li>
												<li><input type="text" name="country" placeholder="Entrer votre pays" class="form_control"></li>
											</ul>
											
											<ul>
												<li class="text-info" for="">Telephone*: </li>
												<li><input type="text" name="phone" placeholder="Entrer votre telephone" class="form_control"></li>
											</ul><hr>
											
										
											<ul>
												<li class="text-info" for="">Email*: </li>
												<li><input type="text" name="email" placeholder="Entrer votre email" class="form_control"></li>
											</ul>
						
											<ul>
												<li class="text-info" for="">Mot de passe*: </li>
												<li><input type="password" name="password" placeholder="Entrer votre mot de passe" class="form_control"></li>
											</ul>
											<ul>
												<li class="text-info" for="">Confirmation*: </li>
												<li><input type="password" name="password_confirm" placeholder="Entrer de nouveau votre mot de passe" class="form_control"></li>
											</ul>
											<button class="btn btn-primary" type="submit">M'inscrire</button><br><br>
											
											<p class="click">En cliquant, vous est d'accord avec les <a href="conditions.php">Termes et conditions d'utilisation</a></p>
										</form>
									</div>
								</div>
								<div class="reg-right">
									<h3>Profiter largement de votre nouveau compte</h3>
									<div class="strip"></div>
									<p>Grace à votre compte, vous pouvez gagner de l'argent en emportant le colis d'un particulier. En faisant beneficier des kilos disponible dans vos baggages.
									A chaque voyage, diffuser grauitement votre annonce sur le compte en vous connectant.
									Emporter des petits colis vers votre destination.</p>
									
								</div>
									<div class="clearfix"></div>
							</div>
						</div>
					</div>
		</div>
		<?php include 'account_inc/footer.php';?>



