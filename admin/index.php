<?php
require_once '../core/init.php';
if(!is_logged_in()){
		login_error_redirect();
	}
?>
<?php
$today = date('Y-m-d');
$maj_travel = $db->query("SELECT * FROM travel");
if(mysqli_num_rows($maj_travel) > 0){
	// output data of each row
    while($row = mysqli_fetch_assoc($maj_travel)) {
		$voyage_date = $row["travel_date"];
		$v_id = $row["travel_id"];
		if($voyage_date < $today){
			$db->query("UPDATE travel SET deleted = 1 WHERE travel_id = '$v_id'");
		}
	}
}


$maj_expedition = $db->query("SELECT * FROM expedition");
if(mysqli_num_rows($maj_expedition) > 0){
	// output data of each row
    while($row = mysqli_fetch_assoc($maj_expedition)) {
		$exp_date = $row["expedition_date"];
		$p_id = $row["expedition_id"];
		if($exp_date < $today){
			$db->query("UPDATE expedition SET deleted = 1 WHERE expedition_id = '$p_id'");
		}
	}
}
?>

<?php
$sql11="SELECT * FROM stats_visites";
$result = $db->query($sql11);
$count = mysqli_num_rows($result);
?>
<?php
	include 'includes/head.php';
	include 'includes/navigation.php';
?>
<h1>Administration</h1>
Le nombre de visiteurs sur le site :<?=$count;?>

<?php
include 'includes/footer.php';
?>