<?php
include('../core/templates/header_admin.php');
include('../core/class/serveur.class.php');

?>
<?php
switch(isset($_POST['action']))
	{
		case "Enregistrer":
				$serveur = new Serveur();
				$serveur->createServ($_POST['ip'], $_POST['port'], $_POST['nom'], $_POST['plugin'], $_POST['chemin'], $_POST['rcon'], $_POST['rcon2'], $_POST['logftp'], $_POST['passftp'], $_POST['passftp2']);
		break;
		case "Modifier":
				$serveur = new Serveur();
				$serveur->editServ($_POST['ip'], $_POST['port'], $_POST['nom'], $_POST['plugin'], $_POST['ftp'], $_POST['rcon'], $_POST['login'], $_POST['pass'], $_POST['id']);
		break;
		case "Supprimer":
			$serveur = new Serveur();
			$serveur->delServ($_POST['id']);
		break;
		default:
		
			$templates = new Templates();
			$templates->headerAffiche();
			
			echo '<p>Espace d\'administration des serveurs.<br /><br />
			Vous pouvez modifier leurs données ou supprimer un serveur simplement
			en appuyant sur "modif" en ayant rempli les champs au préalable
			ou sur "suppr" pour supprimer le serveur</p><br ><br />';
			$serveur = new Serveur();
			if(!isset($_POST['id_serveur']))
				{
					echo '<p>Aucun serveur selectionné <a href="javascript:history.back();">Retour</a></p>';
				}
			else
				{
				$info = $serveur->recServ($_POST['id_serveur']);
	  echo '<form method="POST" action="">
			<div id="donnee_validation">
			<table id="tab_mem">
			<tr>
			<td>ID</td><td><input type="hidden" value="'.$info['id'].'" name="id"/>'.$info['id'].'</td>
			</tr>
			<tr>
			<td>IP</td><td><input type="text" value="'.$info['ip_serveur'].'" name="ip" /></td>
			</tr>
			<tr>
			<td>Port</td><td><input type="text" value="'.$info['port_serveur'].'" name="port" /></td>
			</tr>
			<tr>
			<td>Nom</td><td><input type="text" value="'.$info['nom_serveur'].'" name="nom" /></td>
			</tr>
			<tr>
			<td>Plugin</td><td>						<select name="plugin">
						<option value="mani_admin_plugin">Mani Admin plugin</option>
						<option value="sourcemod">sourcemod</option>
						<option value="amxx">AmxModX</option>
						<option value="amx">Amxmod</option>
						<option value="cssmatch">CssMatch</option>
						</select></td>
			</tr>
			<tr>
			<td>Chemin FTP</td><td><input type="text" size="50" value="'.$info['chemin'].'" name="ftp" /></td>
			</tr>
			<tr>
			<td>Rcon</td><td><input type="password" value="'.$info['rcon'].'" name="rcon" /></td>
			</tr>
			<tr>
			<td>Login FTP</td><td><input type="text" value="'.$info['id_ftp'].'" name="login" /></td>
			</tr>
			<tr>
			<td>Pass FTP</td><td><input type="password" value="'.$info['mdp_ftp'].'" name="pass" /></td>
			</tr>
			</table>
			<div class="center"><input type="submit" name="action" value="Modifier" />|<input type="submit" name="action" value="Supprimer" /></div>
			</form></div>';
			}
			
	}
	?>
<?php
$templates->footerAffiche();
?>