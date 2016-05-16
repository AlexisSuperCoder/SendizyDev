<?php

function debug($variable){
	echo '<pre>' . print_r($variable, true) .'<pre>';
}

function str_random($length){
	$alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
	return substr(str_shuffle(str_repeat($alphabet, $length)),0,$length);
}

function logged_only(){
	if(session_status() == PHP_SESSION_NONE){
	session_start();
	}
	if(!isset($_SESSION['auth'])){
	$_SESSION['flash']['danger']="Vous devez vous connecter pour acceder à cette page";
	header('Location: login.php');
	exit();
}
}




function reconnect_from_cookie(){
	if(session_status() == PHP_SESSION_NONE){
	session_start();
	}

if(isset($_COOKIE['remember']) && !isset($_SESSION['auth'])){
	require_once 'core/db.php';
	if(!isset($pdo)){
		global $pdo;
	}
	$remember_token = $_COOKIE['remember'];
	$parts = explode('==', $remember_token);
	$user_id = $parts[0];
	$req = $pdo->prepare('SELECT * FROM users WHERE id = ?');
	$req->execute([$user_id]);
	$user = $req->fetch();
	if($user){
		$expected = $user_id .'=='. $user->remember_token . sha1($user_id . 'ratonlaveurs');
		if($expected == $remember_token){
			
		session_start();
		$_SESSION['auth']= $user;
		setcookie('remember', $remember_token, time()+ 60 * 60 * 24 *7);
		
			
		}else{
			setcookie('remember', null, -1);
		}	
	}else{
			setcookie('remember', null, -1);
	}
}
	
}


function get_ip() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}




// Fonction qui permet de mettre à jour le compteur de visites
function compter_visite(){
    // On va utiliser l'objet $pdo pour se connecter, il est créé en dehors de la fonction
    // donc on doit indiquer global $pdo; au début de la fonction
    global $pdo;
     
    // On prépare les données à insérer
    $ip   = $_SERVER['REMOTE_ADDR']; // L'adresse IP du visiteur
    $date = date('Y-m-d');           // La date d'aujourd'hui, sous la forme AAAA-MM-JJ
     
    // Mise à jour de la base de données
    // 1. On initialise la requête préparée
    $query = $pdo->prepare("
        INSERT INTO stats_visites (ip , date_visite , pages_vues) VALUES (:ip , :date , 1)
        ON DUPLICATE KEY UPDATE pages_vues = pages_vues + 1
    ");
    // 2. On execute la requête préparée avec nos paramètres
    $query->execute(array(
        ':ip'   => $ip,
        ':date' => $date
    ));
}



// convertir date en francais
function convert($date){	
	$convert = date('d/m/Y', strtotime ($date));
	return $convert;
}

