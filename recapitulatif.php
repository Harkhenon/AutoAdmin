<?php
include('core/templates/header.php');
verif_login();
include('core/class/serveur.class.php');
include('core/class/config.class.php');
			$templates = new Templates();
	$templates->headerAffiche();
$serveur = new Serveur();
$pay = new Paiement();
echo '<form method="POST" action="paiement.php?paiement=achat-regular">';
echo '<p>Bonjour ' .$info['pseudo']. ', bienvenue sur ta page de récapitulatif.</p>';
echo '<p>Voici ta commande:</p>';
$checkserv = $serveur->recServ($_POST['serveur']);
echo '<p>Serveur: <input type="hidden" name="serveur" value="' .$_POST['serveur']. '"/><font color="red">' .$checkserv['nom_serveur']. '</font></p>';
echo '<p>Pour une période de <font color="red">' .$_POST['temps']. '&nbsp;' .$_POST['periode']. '(s)</font></p>';
$total = $pay->calculPrix($_POST['temps'], $_POST['periode']);
$total_ut = $info['token'] - $total;
if($total_ut < 0)
	{
		echo '<p>Tu n\'a pas assez de tokens pour payer tes droits, rachete en d\'autres ici</p>';
	}
else
	{
		echo '<p>Tu dois payer ' .$total. ' tokens et il te resteras '. $total_ut. ' tokens</p>';
$timestamp = $pay->timestamp($_POST['periode']);
echo '<input type="hidden" name="tps" value="' .$_POST['temps']. '"/>';
echo '<input type="hidden" name="per" value="' .$_POST['periode']. '"/>';
echo '<input type="hidden" name="tsrama" value="' .$timestamp. '"/>';
echo '<p class="center"><input type="submit" name=submit" value="Confirmer ma commande"/></p>';
}
echo '</form>';
$templates->footerAffiche();

?>