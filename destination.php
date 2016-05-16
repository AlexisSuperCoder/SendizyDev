<?php
require_once 'core/db.php';
require_once 'core/init.php';
?>
<?php
$departureID = (int)$_POST['departureID'];

$destQuery = $db->query("SELECT * FROM cities WHERE city_id != '$departureID'");

ob_start(); ?>
  <option value=""></option>
  <?php while($dest = mysqli_fetch_assoc($destQuery)): ?>
    <option value="<?=$dest['city_id'];?>"><?=$dest['city'];?></option>
  <?php endwhile; ?>
<?php echo ob_get_clean();?>