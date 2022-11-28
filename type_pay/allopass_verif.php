<?php
session_start();
include('../admin/config.php');
include('../core/class/allo.class.php');
include('../core/class/serveur.class.php');
include('../core/class/config.class.php');
include('../core/class/membre.class.php');
$infos = new Membre();
$info = $infos->recInfo($_SESSION['id']);
$pay = new Paiement();
$allo = new Allopass();
$mer = $allo->getInfoAllo();

  $RECALL = $_GET["RECALL"];
  if( trim($RECALL) == "" )
  {
    // La variable RECALL est vide, renvoi de l'internaute

    // vers une page d'erreur
    header( "Location:type_pay/erreur.php" );
    exit(1);
  }
  // $RECALL contient le code d'accès
  $RECALL = urlencode( $RECALL );

  // $AUTH doit contenir l'identifiant de VOTRE document

  $AUTH = urlencode( $mer['auth'] );


  $r = @file( "http://payment.allopass.com/api/checkcode.apu?code=$RECALL&auth=$AUTH" );

  // on teste la réponse du serveur

  if( substr( $r[0],0,2 ) != "OK" ) 
  {
    // Le serveur a répondu ERR ou NOK : l'accès est donc refusé

    header( "Location: type_pay/erreur.php" );
    exit(1);
  }
 
  setCookie( "CODE_OK", "1", 0, "/", ".".$url, false );
  	$token = ++$info['token'];
	$pay->crediteToken($token, $info['pseudo']);
	header('Location:'.$url.'membre.php');

?>