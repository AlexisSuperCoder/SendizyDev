<?php
require_once 'account_inc/functions.php';
require_once 'core/db.php';
require_once 'core/init.php';

?>


<?php include 'account_inc/header.php';?>
<?php include 'account_inc/navigation.php';?>
<?php 
	compter_visite();

?>
<?php
	$travel_sql = $db->query("SELECT * FROM travel ORDER BY travel_id DESC LIMIT 5");
	$exp_sql = $db->query("SELECT * FROM expedition ORDER BY expedition_id DESC LIMIT 5");
?>
		<!----//End-find-place---->
		<!----start-offers---->
		<div class="offers">
			<div class="offers-head">
				<h3>EXPEDIER OU TRANSPORTER DES COLIS ENTRE PARTICULIERS</h3>
				<p>AFRIQUE - AMERIQUE - EUROPE - ASIE</p>
			</div>
			<!-- start content_slider -->
			
			<section>
			
				<div class="container">
					
						<div class="col-md-6">
							<div class="m_cad">
								<div class="m_cad2">
									<div class="m_cad3">
										<h3>Vous desirez transporter un colis</h3>
										<div class="text-center">
											<a href="account.php" class="button">PUBLIER VOTRE VOYAGE</a>
										</div>
										<h3>Prochains voyages</h3>
										<ul class="sous_menu text-left">
											<?php while($pop_travel = mysqli_fetch_assoc($travel_sql)):?>
												<li class="categorie"> <span class="glyphicon glyphicon-hand-right"></span> <?=$pop_travel['departure'];?>  <span class="glyphicon glyphicon-arrow-right"></span>  <?=$pop_travel['destination'];?> | <?=$pop_travel['colis_type'];?> | <?=convert($pop_travel['travel_date']);?>.</li><br>
											<?php endwhile;?>
										</ul>
										<div class="text-center">
											<a href="transport.php" class="button">Voir tous les voyages</a>
										</div>
										<div class="decaler"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="m_cad">
								<div class="m_cad2">
									<div class="m_cad3">
										<h3>Vous souhaitez expédier un colis</h3>
										<div class="text-center">
											<a href="account.php" class="button">PUBLIER UNE ANNONCE</a>
										</div>
										<h3>Expeditions en cours</h3>
										<ul class="sous_menu text-left">
											<?php while($pop_demande = mysqli_fetch_assoc($exp_sql)):?>
												<li class="categorie"> <span class="glyphicon glyphicon-hand-right"></span> <?=$pop_demande['departure'];?>  <span class="glyphicon glyphicon-arrow-right"></span>  <?=$pop_demande['destination'];?> | <?=$pop_demande['colis_type'];?> | <?=convert($pop_demande['expedition_date']);?>.</li><br>
											<?php endwhile;?>
										</ul>	
										<div class="text-center">
											<a href="expedition.php" class="button">Voir toutes les expeditions</a>
										</div>
										<div class="decaler"></div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="clear"> </div>	
				</div>
				
				<div class="clear"> </div>
			</section>
			<div class="decaler2"></div>

		<div class="clients">
			<div class="client-head">
				<h3>Colis populaires</h3>
				<span>LES TYPES DE COLIS LES PLUS ENVOYES SUR <strong>SENDIZY!</strong></span>
			</div>
			<div class="client-grids text-center">
				<div class="container">	
					<div class="about"> 
						<div class="container">
							<div class="about-top grid-1">
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic1.png" alt=""/>
										<figcaption>
											<h4>Sacs</h4>
											<p>Portefeuilles, sac à main, etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic2.png" alt=""/>
										<figcaption>
											<h4>Telephones</h4>
											<p>Iphone, Samsung, Nokia etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic3.png" alt=""/>
										<figcaption>
											<h4>Vetements</h4>
											<p>Robes, Chemises, Pantalons,Coustumes etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic4.png" alt=""/>
										<figcaption>
											<h4>Electronique</h4>
											<p>Ordinateurs, Ecrans, tablettes etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic5.png" alt=""/>
										<figcaption>
											<h4>Jeux video</h4>
											<p>PS4,Nitendo etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic6.png" alt=""/>
										<figcaption>
											<h4>Meches</h4>
											<p>bresiliennes, perruques etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic7.png" alt=""/>
										<figcaption>
											<h4>Documents</h4>
											<p>Livres,Passport,Courriers,etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic8.png" alt=""/>
										<figcaption>
											<h4>Produits de beauté</h4>
											<p>Maquillage, cremes etc...</p>	
										</figcaption>			
									</figure>
								</div>
								
								<div class="col-md-4 about-left">
									<figure class="effect-bubba">
										<img class="img-responsive" src="images/pic9.png" alt=""/>
										<figcaption>
											<h4>Boissons</h4>
											<p>Vins, champagnes etc...</p>	
										</figcaption>			
									</figure>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			
			
			<div class="client-head">
				<h3>Destinations populaires</h3>
				<span>LES MEILLEURES DESTINATIONS POPULAIRES SUR <strong>SENDIZY</strong></span>
			</div>
			<!-- FlexSlider -->
			 <!-- jQuery -->
			  <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
			  <!-- FlexSlider -->
			  <script defer src="js/jquery.flexslider.js"></script>
			  <script type="text/javascript">
			    $(function(){
			      SyntaxHighlighter.all();
			    });
			    $(window).load(function(){
			      $('.flexslider').flexslider({
			        animation: "slide",
			        animationLoop: true,
			        itemWidth:250,
			        itemMargin: 5,
			        start: function(slider){
			          $('body').removeClass('loading');
			        }
			      });
			    });
			  </script>
			<!-- Place somewhere in the <body> of your page -->
				 <section class="slider">
		        <div class="flexslider carousel">
		          <ul class="slides">
		            <li onclick="location.href='#';">
		  	    	    <img src="images/johanesburg.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=Johanesburg">Johanesburg</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    	</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/ouaga.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=Ouagadougou">Ouagadougou</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/bruxelles.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=bruxelles">Bruxelles</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/nairobi.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=nairobi">Nairobi</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		            <li onclick="location.href='#';">
		  	    	    <img src="images/newyork.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=new_york">New York</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/paris.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=paris">Paris</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/brazaville.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=brazzaville">Brazzaville</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/abidjan.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=abidjan">Abidjan</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		             <li onclick="location.href='#';">
		  	    	    <img src="images/casablanca.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=casablanca">Casablanca</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    	 <li onclick="location.href='#';">
		  	    	    <img src="images/montreal.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=montreal">Montreal</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/berlin.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=berlin">Berlin</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		  	    		 <li onclick="location.href='#';">
		  	    	    <img src="images/pekin.png"/>
		  	    	    <!----place-caption-info---->
		  	    	    <div class="caption-info">
		  	    	    	 <div class="caption-info-head">
		  	    	    	 	<div class="caption-info-head-left">
			  	    	    	 	<h4><a href="expedition_results.php?edit=pekin">Pekin</a></h4>
			  	    	    	 	<span>Envoyer un colis!</span>
		  	    	    	 	</div>
		  	    	    	 	<div class="caption-info-head-right">
		  	    	    	 		<span> </span>
		  	    	    	 	</div>
		  	    	    	 	<div class="clear"> </div>
		  	    	    	 </div>
		  	    	    </div>
		  	    	     <!----//place-caption-info---->
		  	    		</li>
		          </ul>
		        </div>
		      </section>
              <!-- //End content_slider -->
		
		
		
			<!--content-->
				<div class="content">
					<div class="client-head">
						<h3>NOTRE COMMUNAUTE</h3>
					</div>
					<div class="services">
					
						<div class="container">
							
							
							<div class="service-in">
								<div class="col-md-4 in-ser">
								<h4 class="text-center">Envoyer vos colis à l'international</h4>
									
									<img src="images/rihanna1.png" alt="image" class="img-responsive zoom-img img-circle">
									
										<div class="number-top">
										
										<div class="number-in">
											
											<p>Mes colis sont arrivés à Ouaga en toute serenité. Juste à temps pour le mariage de ma soeur.<br></p>
											<span class="com_name">Nolann.S - Paris</span>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
								<div class="col-md-4 in-ser">
									<h4 class="text-center">Rentabiliser votre voyage</h4>
										<div class="view effect">
											
											<img src="images/rihanna3.png" alt="image" class="img-responsive zoom-img img-circle">
														
										</div>
										<div class="number-top">
											
											<div class="number-in">
												
												<p>Avant c'était une galere pour faire envoyer des cadeaux à mes parents. Maintenant avec Sendizy, mes envois sont faciles.<br> </p>
												<span class="com_name">Syvlie.N - Ouagadougou</span>
											</div>
											<div class="clearfix"> </div>
										</div>
								</div>
								<div class="col-md-4 in-ser">
									<h4 class="text-center">Livraison par les voyageurs</h4>
									<div class="view effect">
										
											<img src="images/Rihanna2.jpe" alt="image" class="img-responsive zoom-img img-circle">
														
									</div>
									<div class="number-top">
										
										<div class="number-in">
											
											<p>Le voyage s'est bien passé. J'ai gagné de l'argent en emportant un PC. Quelle vacance génial! <br></p>
											<span class="com_name">Boris.T - Abidjan</span>
										</div>
										<div class="clearfix"> </div>
									</div>
								</div>
									<div class="clearfix"> </div>
							</div>	
						</div>
					</div>
				</div>
		

		
		
		</div>
		<!----//End-offers---->
		

		

				<?php include 'account_inc/footer.php';?>


