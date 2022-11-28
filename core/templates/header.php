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
	if(file_exists("install/index.php"))
		{
			header('location: ./install/');
			exit;
		}

	include('admin/config.php'); // on inclus le fichier de config
	include('core/begin.php');
	include('admin/fonction.php');
	include('core/class/membre.class.php');
	include('core/class/temp.class.php');
	
	$infos = new Membre();
	
	if(isset($_SESSION['id'])){ $info = $infos->recInfo($_SESSION['id']); }
	if(empty($info['style']) || !$info['style']){$path_temp = "templates/default/";}
	else{$path_temp = 'templates/'.$info['style'].'/';}


?>