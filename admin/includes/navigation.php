	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
		<a href="/takeiteasy/admin/index.php" class="navbar-brand">SendPack Admin</a>
			<ul class="nav navbar-nav">
			<?php if(has_permission('admin')): ?>
				<li><a href="city.php">Villes</a></li>
				<li><a href="news.php">Les annonces</a></li>
				<li><a href="archived.php">Les annonces archivees</a></li>
				<li><a href="suppressed.php">Les annonces supprimees</a></li>
				<li><a href="users.php">Users</a></li>
				<li><a href="logout.php">Log Out</a></li>
				<li><a href="change_password.php">Change password</a></li>
				
			<?php endif;?>
			</ul>
		</div>
	</nav><br><br><br><br>			