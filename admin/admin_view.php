<?php
include('../core/templates/header_admin.php');
?>
<?php
switch($_POST['type'])
	{
		case "membre":
			$templates = new Templates();
	$templates->headerAffiche();
		$membre = new Membre();
					echo '<table>
			<tr id="titre_validation"><td>id</td><td>Pseudo</td><td>e-mail</td><td>steamID</td><td>level</td><td>Tokens</td><td>Nom</td><td>Prénom</td><td>Etat</td>
			</tr>';
			$info_ok = $membre->recInfo(NULL);
				foreach($info_ok as $info_all)
					{
						echo '<form action="admin_membre.php" method="post">
						<tr id="donnee_validation">
						<td><input type="hidden" value="'.$info_all['id_membre'].'" name="id"/>'.$info_all['id_membre'].'</td>
						<td>'.$info_all['pseudo'].'</td>
						<td>'.$info_all['email'].'</td>
						<td>'.$info_all['steamid'].'</td>
						<td>'.$info_all['level'].'</td>
						<td>'.$info_all['token'].'</td>
						<td>'.$info_all['nom'].'</td>
						<td>'.$info_all['prenom'].'</td>
						<td>'.$info_all['etat'].'</td>
						<td><input type="submit" name="' .$info_all['id_membre']. '" value="Selectionner"/></td>
						</tr></form>
						';
					}
			echo '</table></div></div>';
			$templates->footerAffiche();
		break;
		case "serveur":
		$templates = new Templates();
		$templates->headerAffiche();
		include('../core/class/serveur.class.php');
				$serveur = new Serveur();
					echo '<table>
			<tr id="titre_validation"><td>ID</td><td>IP</td><td>Port</td><td>Nom</td><td>Plugin</td><td>Chemin FTP</td><td>Login FTP</td></tr>';
			$info_ok = $serveur->recServAll();
				foreach($info_ok as $info_all)
					{
						echo '
												<tr id="donnee_validation">
						<form action="admin_serveur.php" method="post">
						<td><input type="hidden" value="'.$info_all['id'].'" name="id_serveur"/>'.$info_all['id'].'</td>
						<td>'.$info_all['ip_serveur'].'</td>
						<td>'.$info_all['port_serveur'].'</td>
						<td>'.$info_all['nom_serveur'].'</td>
						<td>'.$info_all['plugin_serveur'].'</td>
						<td>'.$info_all['chemin'].'</td>
						<td>'.$info_all['id_ftp'].'</td>
						<td><input type="submit" name="select" value="Selectionner"/></td>
						</tr></form>';
					}
			echo'</table><br /><hr /><br />';
						echo '<h4 class="center">Ajout d\'un serveur de jeu</h3>
						<table>
						<form action="admin_serveur.php" method="post">
						
						<tr><p>IP du serveur: <input type="text" name="ip"/></p></tr>
						<tr><p>Port du serveur: <input type="text" name="port" /></p></tr>
						<tr><p>Nom du serveur: <input type="text" name="nom" /></p></tr>
						<tr><p>Plugin du serveur: <select name="plugin">
													<option value="mani_admin_plugin">Mani Admin plugin</option>
													<option value="sourcemod">sourcemod</option>
													<option value="amxx">AmxModX</option>
													<option value="amx">Amxmod</option>
													<option value="cssmatch">CssMatch</option>
												  </select></p>
						</tr>
						<tr><p>Chemin du FTP: <input type="text" name="chemin" /></p></tr>
						<tr><p>Mot de passe Rcon: <input type="password" name="rcon" /></p></tr>
						<tr><p>Retapez le mot de passe: <input type="password" name="rcon2" /></p></tr>
						<tr><p>Login du FTP: <input type="text" name="logftp" /></p></tr>
						<tr><p>Password du FTP: <input type="password" name="passftp" /></p></tr>
						<tr><p>Retapez le password: <input type="password" name="passftp2" /></p></tr>
						<input type="hidden" name="action" value="Enregistrer" />
						<tr><input type="submit" /> | <input type="reset" /></tr>
						</form></table></div></div>';
						$templates->footerAffiche();
		break;
		
		case "token":
			header('Location: admin_token.php');
		break;
		
		case "demande":
			$templates = new Templates();
			$templates->headerAffiche();
			$verif = $bdd->query("SELECT * FROM ".$prefix."demande");
			$demande = $verif->fetchAll();
			$verif->closeCursor();
			if(empty($demande))
				{
					echo 'Aucune demande en attente';
				}
			else
				{
			echo '<table width="100%">
			<tr id="titre_validation"><td>ID</td><td>Pseudo</td><td>SteamID</td><td>Serveur</td><td>Validation</td><td>Accepter/Supprimer</td></tr>';
			foreach($demande as $res)
				{
				echo '
					<tr id="donnee_validation">
					<td>'.$res['id'].'</td>
					<td>'.$res['pseudo'].'</td>
					<td>'.$res['steamid'].'</td>
					<td>'.$res['serveur'].'</td>
					<td>'.$res['validation'].'</td>
					';
					if($res['validation'] == "oui")
						{ 
							echo'<td><a href="admin_traitement_droits.php?page=suppr&id='.$res['id'].'&pseudo='.$res['pseudo'].'">
								<img src="'.$conf['url'].'admin/img/suppr.png"/></a></td>
								</tr>';
						}
					else
						{
							echo '<td><a href="admin_traitement_droits.php?page=valider&id='.$res['id'].'"><img src="'.$conf['url'].'admin/img/ok.png"/></a></td>';
						}
					echo '</table>';
				}
				}
				$templates->footerAffiche();
		break;
		
		case "flag":
			include('../core/class/flag.class.php');
				$flag = new Flag();
			$templates = new Templates();
	$templates->headerAffiche();
			$info_ok = $flag->recFlagAll();
			echo '
			<form action="admin_flags.php" method="post">
						<p>Selectionnez le plugin</p><select name="type">';
				foreach($info_ok as $info_all)
					{
						echo '
						<option  value="'.$info_all['plugin'].'">'.$info_all['plugin'].'</option>';
					}
					echo '
					</select>
					<td><input type="submit" name="select" value="Selectionner"/></td>
						</tr></form>
						';
					
			echo'</table></div></div>';
			$templates->footerAffiche();
			break;
		case "news":

			include('../core/class/news.class.php');
			$news = new News();

			if($_GET['page'] == "ajouter")
				{
					$templates = new Templates();
					$templates->headerAffiche();
					echo '<form action="admin_view.php" method="POST">
					<label><p>Titre de la news</p>
							<input type="text" name="titre"/></label>
					<label><p>Contenu de la news (BBcode accepté)</p>
							<textarea name="contenu"></textarea></label><br />
							<input type="hidden" name="auteur" value="'.$info['pseudo'].'"/>
							<input type="hidden" name="type" value="news">
							<input type="hidden" name="action" value="ajouter"/>
							<input type="submit" name="enregistrer" value="Enregistrer"/>
							</form>';
					$templates->footerAffiche();
				}
			else
				{
					if(isset($_POST['action']))
					{
						if($_POST['action'] == "Modifier")
							{
								$contenu = htmlspecialchars($_POST['contenu']);
								$titre = htmlspecialchars($_POST['titre']);
								$id = $_POST['id'];
								$news->editNews($contenu, $titre, $id);
							}
						elseif($_POST['action'] == "Supprimer")
							{
								$news->deleteNews($_POST['id']);
							}
							elseif($_POST['action'] == "ajouter")
							{
								$news->newNews($_POST['titre'], $_POST['contenu'], $_POST['auteur']);
							}
					}
					else
							{
								$templates = new Templates();
								$templates->headerAffiche();
								
			echo '<div><form action="admin_view.php?page=ajouter" method="POST" id="fond_cool" align="center"/>
					<p>Ajouter une news</p>
					<input type="hidden" name="type" value="news">
					<input type="submit" name="ok" value="OK"/>
					</form><br />';
					echo '<div>';
								$actu = $news->recupNews(NULL);
								foreach($actu as $actus)
									{
										echo '<form action="admin_view.php" method="POST">
											  <input type="text" name="titre" value="'.$actus['titre'].'"/><br />
											  <textarea name="contenu">'.$actus['contenu'].'</textarea><br >
											  <p>Ecris par '.$actus['auteur'].'</p><br />
											  <input type="hidden" name="id" value="'.$actus['id'].'"/>
											  <input type="hidden" name="type" value="news"/>
											  <input type="submit" name="action" value="Modifier"/>
											  <input type="submit" name="action" value="Supprimer"/>
											  </form><br />';
									}
									echo '</div>';
							}
							$templates->footerAffiche();
				}
		break;
		default:
			$templates = new Templates();
	$templates->headerAffiche();
		echo '<p>Aucun module séléctionné <a href="javascript:history.back();">Retour</a></p>';
	}
	?>
