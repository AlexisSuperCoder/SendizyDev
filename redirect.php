<?php

require_once 'core/db.php';
session_start();


if(isset($_SESSION['auth'])){

	header('Location: publier.php');
	
}else{
	$_SESSION['flash']['danger']="Vous devez vous connecter avant de faire la publication";
	header('Location: login.php');
}


?>

