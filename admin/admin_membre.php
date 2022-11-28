<?php
include('../core/templates/header_admin.php');
			$templates = new Templates();
			$templates->headerAffiche();
?>
<?php
			if(isset($_POST['action']) && $_POST['action'] == "password")
				{
					$membre = new Membre();
					$membre->editPassword(sha1($_POST['passe']), sha1($_POST['passe2']), $_POST['id']);
				}
			elseif(isset($_POST['action']) && $_POST['action'] == "informations")
				{
					if($_POST['type'] == "Modifier")
						{
						$membre = new Membre();
						$membre->editMembre($_POST['pseudo'], $_POST['level'], $_POST['email'], $_POST['steam'], $_POST['nom'], $_POST['prenom'], $_POST['etat'], $_POST['token'], $_POST['id']);
						}
					elseif($_POST['type'] == "Supprimer")
						{
							$membre = new Membre();
							$membre->delMembre($_POST['id']);
						}
				}
			else
				{

					echo '<p>Espace d\'administration des membres.<br /><br />
					Vous pouvez modifier leurs données ou supprimer un membre simplement
					en appuyant sur "modif" en ayant rempli les champs au préalable
					ou sur "suppr" pour supprimer le membre</p><br ><br />';
					$membre = new Membre();
					if(!isset($_POST['id']))
						{
							echo '<p>Aucun membre selectionné <a href="javascript:history.back();">Retour</a></p>';
						}
					else
						{
							$info = $membre->recInfo($_POST['id']);
							echo '<form method="POST" action="" name="informations">
							<div id="donnee_validation">
							<table id="tab_mem">
							<tr>
							<td>ID</td><td><input type="hidden" value="'.$info['id_membre'].'" name="id"/>'.$info['id_membre'].'</td>
							</tr>
							<tr>
							<td>Pseudo</td><td><input type="text" value="'.$info['pseudo'].'" name="pseudo" /></td>
							</tr>
							<tr>
							<td>E-Mail</td><td><input type="text" value="'.$info['email'].'" name="email" /></td>
							</tr>
							<tr>
							<td>SteamID</td><td><input type="text" value="'.$info['steamid'].'" name="steam" /></td>
							</tr>
							<tr>
							<td>Level</td><td><input type="text" value="'.$info['level'].'" name="level" /></td>
							</tr>
							<tr>
							<td>Tokens</td><td><input type="text" value="'.$info['token'].'" name="token" /></td>
							</tr>
							<tr>
							<td>Nom</td><td><input type="text" value="'.$info['nom'].'" name="nom" /></td>
							</tr>
							<tr>
							<td>Prénom</td><td><input type="text" value="'.$info['prenom'].'" name="prenom" /></td>
							</tr>
							<tr>
							<td>Etat</td><td><input type="text" value="'.$info['etat'].'" name="etat" /></td>
							</tr>
							</table>
							<br />
							<input type="hidden" name="action" value="informations"/>
							<input type="submit" name="type" value="Modifier" />|<input type="submit" name="type" value="Supprimer" />
							</form>';
							
							echo '<form action="" method="POST" name="password">
							<table id="tab_mem">
							<tr>
							<td>Changer le mot de passe</td><td><input type="password" name="passe"/></td>
							</tr>
							<tr>
							<td>Confirmer le mot de passe</td><td><input type="password" name="passe2"/></td>
							</tr>
							</table>
							<input type="hidden" value="'.$info['id_membre'].'" name="id"/>
							<input type="hidden" name="action" value="password"/>
							<br />
							<input type="submit" name="type" value="Modifier le password" />
							</form></div>';
						}
				}
?>
<?php
$templates->footerAffiche();
?>