<?php
include('core/templates/header.php');
include('core/class/parser.class.php');
$parse = new Parser();

if(isset($_SESSION['session']) || !empty($_SESSION['session']) || isset($info) || !empty($info))
	{
		$templates = new Templates();
	$templates->headerAffiche();
	include('core/templates/form.php');

	}

elseif(isset($_GET['page']) && $_GET['page'] == "erreurid")
	{
		$templates = new Templates();
		$templates->headerAffiche();
		echo "<div class='center'><img src='".$path_temp."images/cadenas.png' width='100px' height='100px'/><p class='center'>Mauvais pseudo ou mot de passe, Veuillez r�essayer</p>";

	}
elseif(isset($_GET['page']) && $_GET['page'] == "banzai")
	{
				$templates = new Templates();
		$templates->headerAffiche();
		echo $parse->parseText('[center]L\'administrateur a banza�� votre compte! Vous �tes [color=red]banni![/color] :hmm:[/center] ');
	}
elseif(isset($_GET['page']) && $_GET['page'] == "kesstufela")
	{
		$templates = new Templates();
		$templates->headerAffiche();
		echo '<p class="center">Vous n\'�tes pas loggu� ou tentez de rentrer dans un endroit qui n\'est pas de votre niveau!</p>';
	}
else
	{
	$templates = new Templates();
	//$templates->headerAffiche();

			echo '<hr />';
			echo var_dump($conf);
			//echo $parse->parseText($conf['mess_accueil']);
			echo '<hr />';

	}
	$templates->footerAffiche();
?>