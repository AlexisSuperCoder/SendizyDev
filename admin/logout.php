<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/takeiteasy/core/init.php';
unset($_SESSION['SBUser']);
header('Location: adm_login.php');
?>