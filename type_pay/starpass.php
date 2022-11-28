<?php
		$script_pay = $bdd->query("SELECT * FROM ".$prefix."paiement WHERE type='starpass'");
		$result = $script_pay->fetch();

		
		echo '<div class="center">' .$result['script_insert']. '</div>';
	
		$script_pay->closeCursor();