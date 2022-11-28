<?php
include('../core/templates/header_admin.php');
?>
<?php
if($_GET['page'] == "valider")
{
//Initialisation & recuperation des variables

$reqDD = $bdd->query("SELECT * FROM ".$prefix."demande WHERE id='" .$_GET['id']. "'");
$resDD = $reqDD->fetch();
$reqDD->closeCursor();

	$nom = $resDD['serveur'];
	$name = $resDD['pseudo'];
	$steamid = $resDD['steamid'];
	$email = $resDD['email'];
	
$reqDS = $bdd->query("SELECT * FROM ".$prefix."donnee_serveur WHERE id='" .$nom. "'");
$resDS = $reqDS->fetch();
$reqDS->closeCursor();
				
				
	$url_serveur = $resDS['chemin'];
	$plugin_serveur = $resDS['plugin_serveur'];
	$nom_serveur = $resDS['nom_serveur'];
	$port_serveur = $resDS['port_serveur'];
	$ip_serveur = $resDS['ip_serveur'];
	$rcon = $resDS['rcon'];
	$id_ftp = $resDS['id_ftp'];
	$mdp_ftp = $resDS['mdp_ftp'];
	
$reqDA = $bdd->query("SELECT * FROM ".$prefix."flags WHERE plugin='".$plugin_serveur."'");
$resDA = $reqDA->fetch();
$reqDA->closeCursor();

$flags_admin = $resDA['admin'];
$flags_immunity = $resDA['immunity'];
$groupe = $resDA['groupe'];

$IP = $ip_serveur;
$Pass = $rcon;
$Port = $port_serveur;

//On commence la verif et on envoie sur la page appropriée pour l'ajout

if(!$plugin_serveur or empty($plugin_serveur))
{
echo 'Aucun plugin spécifié';
} 
else
{
include('trait/'.$plugin_serveur.'.php');
$valid = $bdd->prepare("UPDATE ".$prefix."demande SET validation='oui' WHERE id= :id");
$valid->execute(array("id" => $_GET['id']));
$valid->closeCursor();

$req = $bdd->query("SELECT * FROM ".$prefix."mail WHERE type_mail='2'");
$res = $req->fetch();
$req->closeCursor();
mail($email, $res['titre'], $res['corps'], $headers);
}
}
elseif($_GET['page'] == "suppr")
{
$del_droit = $bdd->prepare("DELETE FROM ". $prefix ."demande WHERE id= :id");
$del_droit->execute(array("id" => $_GET['id']));
$del_droit->closeCursor();
header('Location: ok.php');
}
else
{ 
	header('Location: admin_choose.php');
}
?>
</table>
<?php
$templates->footerAffiche();
?>