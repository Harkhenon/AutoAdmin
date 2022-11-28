<?php
session_start();
include('core/templates/header.php');
include('core/class/serveur.class.php');
include('core/class/config.class.php');
include('core/class/parser.class.php');
$parse = new Parser();
$serveur = new Serveur();
$pay = new Paiement();

if($_GET['paiement'] == "achat-token")
{
		$templates = new Templates();
	$templates->headerAffiche();
			include('type_pay/'.$_POST['type']. '.php');
			exit;
}
elseif($_GET['paiement'] == "achat-regular")
{
		$templates = new Templates();
	$templates->headerAffiche();
	$total = $pay->calculPrix($_POST['tps'], $_POST['per']);
	$total_ut = $info['token'] - $total;
	$pay->validPay($info['pseudo'], $info['email'], $info['steamid'], $_POST['serveur'], 'Ok', 'non', $_POST['tsrama']);
	$pay->piqueToken($total_ut, $info['pseudo']);
	echo 'Commande validée, <p><a href="membre.php">retour a l\'espace membre</a><p>';
	$templates->footerAffiche();
	exit;
}
elseif($_GET['value'] == "done")
{
		if($_GET['type_pay'] == "paypal")
			{
				$token = $info['token'] + 5;
				$pay->crediteToken($token, $info['pseudo']);
				header('Location: membre.php');
			}

}
else
{
		$templates = new Templates();
	$templates->headerAffiche();
	echo '<p class="center">Vous n\'avez rien a faire ici!</p>';
}
$templates->footerAffiche();
?>