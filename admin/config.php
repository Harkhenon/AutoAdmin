<?php
$servbdd = "";
$namebdd = "";
$logbdd = "";
$passbdd = "";
$prefix  = "aa_";

try
{
	$bdd = new PDO('mysql:host='.$servbdd.';dbname='.$namebdd.'', $logbdd, $passbdd);
}
catch (Exception $e)
{
        die('Erreur BDD->PDO : ' . $e->getMessage() . '');
}


?>