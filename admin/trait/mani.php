<?php
$Rcon = 'ma_client addclient "'. $name .'"';
$Rcon2 = "say Client ". $name ." ajouté avec succes";
$Rcon3 = "ma_client AddSteam \"". $name ."\" ". $steamid ."";
$Rcon4 = "say Client ". $steamid ." ajoute avec succes";
$Rcon5 = "ma_client setaflag \"". $name ."\" \"". $flags_admin ."\"";
$Rcon6 = "say Flags admin pour \"". $name ."\" ajoutes";
$Rcon7 = "ma_client setiflag \"". $name ."\" \"". $flags_immunity ."\"";
$Rcon8 = "say Immunity flags pour \"". $name ."\" ajoutes";

include_once("class/rcon.class.php");
$r = new rcon("$IP",$Port,"$Pass");
$r->Auth();
var_dump($r->rconCommand("$Rcon"));
var_dump($r->rconCommand("$Rcon2"));
var_dump($r->rconCommand("$Rcon3"));
var_dump($r->rconCommand("$Rcon4"));
var_dump($r->rconCommand("$Rcon5"));
var_dump($r->rconCommand("$Rcon6"));
var_dump($r->rconCommand("$Rcon7"));
var_dump($r->rconCommand("$Rcon8"));
$mani = $bdd->prepare("UPDATE ".$prefix."droit SET validation='oui' WHERE id= :id");
$mani->execute(array("id" => $_GET['id']));
$mani->closeCursor();

header('Location: '.$url.'admin/ok.php');
?>