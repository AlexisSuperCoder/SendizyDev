<?php
require_once 'account_inc/functions.php';
require_once 'core/db.php';
require_once 'core/init.php';
?>
<?php
	$today = date('Y-m-d');
	if(isset($_POST['transport'])){
		$depart = trim(sanitize($_POST['depart']));		
		$destination = trim(sanitize($_POST['destination']));
		$trav_date = sanitize($_POST['travel_date']);
		
		$errors = array();
		if(!empty($_POST['travel_date'])){
			$timestamp = $trav_date;
			$timestamp = date_create_from_format('d/m/Y', $timestamp);
			$travel_date =  date_format($timestamp, 'Y-m-d');
		}
		// depart ok destination vide date vide
		if(!empty($_POST['depart']) && empty($_POST['destination']) && empty($_POST['travel_date'])){
			$sql_count = "SELECT * FROM travel WHERE departure='$depart' AND travel_date >= '$today' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);
			$sql = "SELECT * FROM travel WHERE departure='$depart' AND travel_date >= '$today' AND deleted =0 AND featured = 1";		
		}
		// depart ok destination vide date ok
		if(!empty($_POST['depart']) && empty($_POST['destination']) && !empty($_POST['travel_date'])){
			$sql_count = "SELECT * FROM travel WHERE departure='$depart' AND travel_date >= '$travel_date' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);		
			$sql = "SELECT * FROM travel WHERE departure='$depart' AND travel_date >= '$travel_date' AND deleted =0 AND featured = 1";				
		}
		// depart ok destination ok date vide
		if(!empty($_POST['depart']) && !empty($_POST['destination']) && empty($_POST['travel_date'])){
			$sql_count = "SELECT * FROM travel WHERE departure='$depart' AND destination = '$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);
			$sql = "SELECT * FROM travel WHERE departure='$depart' AND destination = '$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";		
		}
		// depart ok destination ok date ok
		if(!empty($_POST['depart']) && !empty($_POST['destination']) && !empty($_POST['travel_date'])){
			$sql_count = "SELECT * FROM travel WHERE departure='$depart' AND destination = '$destination' AND travel_date >= '$travel_date' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);		
			$sql = "SELECT * FROM travel WHERE departure='$depart' AND destination = '$destination' AND travel_date >= '$travel_date' AND deleted =0 AND featured = 1";
		}
		if(empty($_POST['depart']) && empty($_POST['destination']) && !empty($_POST['travel_date'])){
			$errors = "il manque la destination et le depart";
		}
		if(empty($_POST['depart']) && empty($_POST['destination']) && empty($_POST['travel_date'])){
			$errors = "Aucune valeur entrée";			
		}
		if(empty($errors)){			
			$result = $db->query($sql);
		}
	}elseif(isset($_POST['chercher'])){				
		$destination = trim(sanitize($_POST['searchons']));	
		$errors = array();
		if(!empty($_POST['searchons'])){
			$sql_count = "SELECT * FROM travel WHERE destination='$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);
			$sql = "SELECT * FROM travel WHERE destination='$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";

		}
		
		if(empty($errors)){			
			$result = $db->query($sql);
		}
		
	}elseif(isset($_GET['edit'])){				
		$destination = trim(sanitize($_GET['edit']));
			
		$errors = array();
		if(!empty($_GET['edit'])){
			$sql_count = "SELECT * FROM travel WHERE destination='$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";
			$result_count = $db->query($sql_count);
			$count = mysqli_num_rows($result_count);
			$sql = "SELECT * FROM travel WHERE destination='$destination' AND travel_date >= '$today' AND deleted =0 AND featured = 1";
		}
		
		if(empty($errors)){			
			$result = $db->query($sql);
		}
		
	}

?>

<?php include 'account_inc/header.php';?>
<?php include 'account_inc/tra_research.php';?>
<?php include 'account_inc/research_transport_results.php';?>
<?php include 'account_inc/footer.php';?>