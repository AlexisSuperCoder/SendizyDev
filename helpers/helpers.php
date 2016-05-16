<?php 
function display_errors($errors){
	$display = '<ul class="bg-danger">';
	foreach($errors as $error){
		$display .= '<li class="text-danger">'.$error.'</li>';
	}
	$display .= '</ul>';
	return $display;
}

function sanitize($dirty){
	return htmlentities($dirty,ENT_QUOTES,"UTF-8");
}

// convertir une date en format francais
function age($dob){
	if(!empty($dob)){
		$birthdate = new DateTime($dob);
		$today   = new DateTime('today');
		$age = $birthdate->diff($today)->y;
		return $age;
	}else{
		return 0;
	}
}

function login($user_id){
	$_SESSION['SBUser'] = $user_id;
	global $db;
	$date = date("Y-m-d H:i:s");
	$db->query("UPDATE admin SET last_login = '$date' WHERE id ='$user_id'");
	$_SESSION['success_flash'] = 'Vous etes connectes maintenant';
	header('Location: index.php');
}


function is_logged_in(){
	if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0) {
		return true;
	}
		return false;
	
	}
	
function login_error_redirect($url = 'adm_login.php'){
	$_SESSION['error_flash'] = 'Vous devez etre connecter pour acceder a cette page';
	header('Location: '.$url);
}

function permission_error_redirect($url = 'adm_login.php'){
	$_SESSION['error_flash'] = "Vous n'avez les droits d'acces a cette page";
	header('Location: '.$url);
}


function has_permission($permission = 'admin'){
	global $user_data;
	$permissions = explode(',', $user_data['permissions']); 
	if(in_array($permission,$permissions,true)){
		return true;
	}
		return false;
	
}






