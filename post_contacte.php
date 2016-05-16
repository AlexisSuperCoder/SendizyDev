<?php
require_once 'account_inc/functions.php';
logged_only();
?>
<?php
$errors = array();

if(!array_key_exists('firstname',$_POST) || $_POST['firstname'] ==''){
	$errors['firstname'] = "Vous n'avez pas renseignes votre nom";
}

if(!array_key_exists('secundname',$_POST) || $_POST['secundname'] ==''){
	$errors['secundname'] = "Vous n'avez pas renseignes votre prenom";
}

if(!array_key_exists('email',$_POST) || $_POST['email'] ==''  || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
	$errors['email'] = "Vous n'avez pas renseignes un email valide";
}

if(!array_key_exists('telephone',$_POST) || $_POST['telephone'] ==''){
	$errors['telephone'] = "Vous n'avez pas renseignes votre telephone";
}

if(!array_key_exists('message',$_POST) || $_POST['message'] ==''){
	$errors['message'] = "Vous n'avez pas renseignes votre message";
}


if(!empty($errors)){
	$_SESSION['errors'] = $errors;
	$_SESSION['inputs'] = $_POST;
	header('Location: contact.php');
	
}else{
	$_SESSION['success'] = 1;
	$headers = 'FROM: ' . $_POST['email'];
	mail('sawedmond@yahoo.fr','Formulaire de contact' . $_POST['firstname'], $_POST['message'], $headers);
	header('Location: contact.php');
}



?>
