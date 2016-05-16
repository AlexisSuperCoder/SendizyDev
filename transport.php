<?php
require_once 'account_inc/functions.php';
require_once 'core/db.php';
require_once 'core/init.php';

?>
<?php include 'account_inc/header.php';?>
<?php include 'account_inc/tra_research.php';
	compter_visite();
	$sql = "SELECT * FROM travel WHERE deleted = 0 AND featured = 1";
	$result = $db->query($sql);
?>
		
<div class="container">
	<div class="t_announce">
		<h2 class="text-center">Dernieres annonces de voyageurs</h2>
	</div>
	<div class="destination-places">
				<div class="wrap">
					<div class="destination-places-head"><br><br><br><br>
						
					</div>
					<div class="results">
						<?php while($presult = mysqli_fetch_assoc($result)): 
							$c_posted = $presult['posted'];
							$posted = date('d/m/Y h:i:s', strtotime ($c_posted));
							$c_limit = $presult['limit_day'];
							$limit = date('d-m-Y', strtotime ($c_limit));
							
							$user_id = $presult['user_id'];
							$sql_user = "SELECT * FROM users WHERE id='$user_id'";
							$userQuery = $db->query($sql_user);
							$user = mysqli_fetch_assoc($userQuery);
							$c_age = $user['birthday'];
							$now = date('Y',time());
							$age = ($now -  $c_age);
							
							$c_leave = $presult['travel_date'];
							$leave = date('d-m-Y', strtotime ($c_leave));
						?>
						
							<li class="searchs_results">
								<a class="oneresults" href="details_transport.php?edit=<?=$presult['travel_id'];?>">
									<article class="rows">
										<div class="users">
												<img class="photo" width="120" height="120" src="<?=$user['photo'];?>"><br>
												<div class="user">
													<div class="users-name text-center"><?=$user['secund_username'];?></div>
													<div class="users-age text-center"><?=$age;?> ans</div>
												</div>
										</div>
										<div class="details">
											<h3><?=$leave;?> <span class="glyphicon glyphicon-plane"></span> <?=$presult['departure'];?> <span class="glyphicon glyphicon-arrow-right"></span> <?=$presult['destination'];?></h3>
											<h4>Date limite reception : <?=$limit;?></h4>
											<h4>Type de colis accepté : <?=$presult['colis_type'];?></h4><hr>
											<span></span>*<span> Posté le : <?=$posted;?></span>
										</div>
										<div class="offres">
											
											<h3>Pourboire : <?=$presult['price'];?> €</h3>
											<h3>Dispo : <?=$presult['weight'];?> kg</h3>
											<button type="button" class="btn btn-success">En Savoir</button>
										</div>
									</article>
								</a>
							</li>
						
						<?php endwhile;?>
						<div class="clear"> </div>
					</div>
					
				</div>
			</div>

</div>
<?php include 'account_inc/footer.php';?>


