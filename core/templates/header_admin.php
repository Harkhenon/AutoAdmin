<?php
session_start(); // on demarre la session

	/////////////////////////////////////
	/// Admin tools V1.0 | 2010       ///
	/// By Isoka                      ///
	/// Script sous copyright         ///
	/// Interdiction de reproduction  ///
	/// Sans l'accord du proprietaire ///
	/// isoka33@gmail.com             ///
	/////////////////////////////////////
	include('config.php'); // on inclus le fichier de config
	include('../core/begin.php');
	include('../core/class/membre.class.php');
	include('fonction.php');

	
	verif_login_admin();
	
	$infos = new Membre();
	$info = $infos->recInfo($_SESSION['id']);
	
	if(empty($info['style']) || !$info['style']){$path_temp = "../templates/default/admin/";}
	else{$path_temp = '../templates/'.$info['style'].'/admin/';}
	
	include('config.php');
	include('../core/class/temp.class.php');
	?>
