		<!----start-find-place---->
		<div class="find-place">
			<div class="wrap">
				<div class="p-h">
					<span>TROUVER UN</span>
					<label>DEPART</label>
				</div>
				  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
					<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>					
					<script type="text/javascript" src="js/jquery.autocomplete.min.js"></script>
					<script src="js/datepicker-fr.js"></script>
				  <script>
						$(document).ready(function() {
						$('#depart').autocomplete({
							serviceUrl: 'fichier.php',
							dataType: 'json'
						});
					});
					</script>
					<script>
						$(document).ready(function() {
						$('#destination').autocomplete({
							serviceUrl: 'fichier.php',
							dataType: 'json'
						});
					});
					</script>		
				<!---strat-date-piker---->
				  <script>
				  $(function() {
				    $( "#datepicker" ).datepicker();
				  });
				  </script>
				<!---/End-date-piker---->
				<div class="p-ww">
					<form action="expedition_results.php" method="post">
						<span> De</span>
						<input class="dest" type="text" name="depart" value="" placeholder="Depart" id="depart" required>
						<span> Vers</span>
						<input class="dest" type="text" name="destination" value="" placeholder="Destination" id="destination">
						
						<span> Date</span>
						<input class="date" name="travel_date" type="text" value="" placeholder="Entrer une date" id="datepicker">						
						<button type="submit" name ="expedition"class="btn btn-primary">Expedition colis</button>
					</form>
				</div>
				<div class="clear"> </div>
			</div>
		</div>
		
		
		
		
		
		
	