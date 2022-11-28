<?php
include('core/class/serveur.class.php');
include('core/class/config.class.php');
$serveur = new Serveur();
$pay = new Paiement();
?>

		<form method="post" action="recapitulatif.php" class="center">
		<p class="center">Choisir le serveur<p>
				<select name="serveur">
					<?php
						$infoS = $serveur->recServAll();
							foreach($infoS as $resS)
								{
									echo '<option value="' .$resS['id']. '">' .$resS['ip_serveur']. ':' .$resS['port_serveur']. '&nbsp;|&nbsp;' .$resS['nom_serveur']. '</option>';
								}
					?>
				</select>
				<p>Pour</p>
				<br />
				<select name="temps">
					<?php
						$temps = $pay->recTemps();
							foreach($temps as $resT)
								{ 
									echo '<option value="' .$resT['temps']. '">' .$resT['temps']. '</option>';
								}
					?>
				</select>
								<select name="periode">
					<?php
						$periode = $pay->recPeriode();
							foreach($periode as $resP)
								{ 
									echo '<option value="' .$resP['type_tps']. '">' .$resP['type_tps']. '</option>';
								}
					?>
				</select>
			<br /><br />
			<p><input type="submit" value="Envoyer la demande"/></p>
		</form>
		<br />
		<hr />
			<p class="center"><a href="verification.php">Vérifier la validation</a></p>
		<hr />	