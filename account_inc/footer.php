		<div class="subfooter">
			<div class="wrap">
				<ul>
					<li><a href="conditions.php">Conditions génerales</a><span>::</span></li>
					<li><a href="diffusion.php">Regles de diffusion</a><span>::</span></li>
					<li><a href="mentions.php">Mentions legales</a><span>::</span></li>
					<li><a href="modeemploi.php">Aide</a><span>::</span></li>
					<li><a href="contact.php">Nous Contacter</a></li>
					<div class="clear"> </div>
				</ul>
				<p class="copy-right">&copy; 2016 Sendizy.fr| Tous droits reserves</p>
				<a class="to-top" href="#header"><span> </span> </a>
			</div>
			
			<div class="container to_footer">
				<h3>Rejoignez nous</h3>
				<ul>
					<li>
						 <a href="https://www.facebook.com/sendizy.fr/"><img src="images/fb.png"/></a>
					</li>
					<li>
						<a href="#"><img src="images/tw.png"/></a>
					</li>
					<li>
						<a href="#"><img src="images/googleplus.png"/></a>
					</li>
					<li>
						<a href="#"><img src="images/pinterest.png"/></a>
					</li>
					
				</ul>
				
			</div>
		</div>
		<!---//End-subfooter---->
		<!----//End-wrap---->


<script>
function get_child_options(){
	var departureID = jQuery('#departure').val();
	jQuery.ajax({
		url:'/takeiteasy/destination.php',
		type: 'POST',
		data: {departureID : departureID},
		success: function(data){
			jQuery('#destination').html(data);
		},
		error: function(){alert("someting went wrong.")},
	});
}
jQuery('select[name="departure"]').change(get_child_options);



</script>








		</body>
</html>





