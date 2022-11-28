<?php
include('../core/templates/header_admin.php');
include('../core/class/flag.class.php');
$flag = new Flag();
$templates = new Templates();
	$templates->headerAffiche();
?>
<!-- Formulaires et tout le tralala.. -->
<?php
echo '<h4>Gestion des flags pour les plugins</h4>';
echo '<br /><br />';
switch($_POST['type'])
	{
	case "Modifier":
		if(isset($_POST['type']) AND isset($_POST['plugin']))
	{
		if(!isset($_POST['admin']) OR !isset($_POST['immunity']))
			{
				echo 'Aucune valeur entrée, recommencez. <a href="admin_choose.php">Retour</a>';
			}
		else
			{
				$flag->editFlag($_POST['plugin'], $_POST['immunity'], $_POST['admin']);
				echo 'Valeur modifiée, <a href="index.php">Retour</a>';
			}
	}
	else
	{
		echo 'Probleme!!';
		include('includes/footer_admin.php');
		exit;
	}
	break;
	
	case "mani_admin_plugin":
		echo '<div align="right"><img src="' .$conf['url']. '/admin/img/plugins/' .$_POST['type']. '.png"/><br /><font id="fond_cool"><a target="_blank" href="http://www.nitroserv.fr/forum/viewtopic.php?id=28486">Plus d\'informations sur les flags</a></font></div>';
		$result = $flag->recFlag($_POST['type']);
		echo '<form method="POST" action="">
		<h3>Flags admin</h3><br />
		<textarea name="admin">' .$result['admin']. '</textarea><br />
		<h3>Flags d\'immunité</h3><br />
		<textarea name="immunity">' .$result['immunity']. '</textarea><br />
		<input type="hidden" name="plugin" value="' .$_POST['type']. '" />
		<input type="submit" name="type" value="Modifier"/>
		</form>';
	break;
	case "sourcemod":
		echo '<div align="right"><img src="' .$conf['url']. '/admin/img/plugins/' .$_POST['type']. '.png"/><br /><font id="fond_cool"><a target="_blank" href="http://www.nitroserv.fr/forum/viewtopic.php?id=28486">Plus d\'informations sur les flags</a></font></div>';
		$result = $flag->recFlag($_POST['type']);
		echo '<form method="POST" action="">
		<h3>Flags admin</h3><br />
		<textarea name="admin">' .$result['admin']. '</textarea><br />
		<h3>Pourcentage d\'immunité</h3><br />
		<textarea name="immunity">' .$result['immunity']. '</textarea><br />
		<input type="hidden" name="plugin" value="' .$_POST['type']. '" />
		<input type="submit" name="type" value="Modifier"/>
		</form>';
	break;
	
	case "amxx":
		echo '<div align="right"><img src="' .$conf['url']. '/admin/img/plugins/' .$_POST['type']. '.png"/><br /><font id="fond_cool"><a target="_blank" href="http://www.nitroserv.fr/forum/viewtopic.php?id=28486">Plus d\'informations sur les flags</a></font></div>';
		$result = $flag->recFlag($_POST['type']);
		echo '<form method="POST" action="">
		<h3>Flags admin</h3><br />
		<textarea name="admin">' .$result['admin']. '</textarea><br />
		<input type="hidden" name="immunity" value="NULL" />
		<input type="hidden" name="plugin" value="' .$_POST['type']. '" />
		<input type="submit" name="type" value="Modifier"/>
		</form>';
	break;
	case "amx":
		echo '<div align="right"><img src="' .$conf['url']. '/admin/img/plugins/' .$_POST['type']. '.png"/><br /><font id="fond_cool"><a target="_blank" href="http://www.nitroserv.fr/forum/viewtopic.php?id=28486">Plus d\'informations sur les flags</a></font></div>';
		$result = $flag->recFlag($_POST['type']);
		echo '<form method="POST" action="">
		<h3>Flags admin</h3><br />
		<textarea name="admin">' .$result['admin']. '</textarea><br />
		<input type="hidden" name="immunity" value="NULL" />
		<input type="hidden" name="plugin" value="' .$_POST['type']. '" />
		<input type="submit" name="type" value="Modifier"/>
		</form>';
	break;
	
	case "cssmatch":
	echo '<div align="right"><img src="' .$conf['url']. '/admin/img/plugins/' .$_POST['type']. '.png"/></div><br />';
		echo 'Aucun systeme de flags n\'existe pour cssmatch <a href="admin_choose.php">Retour</a>';
	break;
		default:
		
		echo 'Aucun plugin spécifié';
	}
?>
<?php
$templates->footerAffiche();
?>