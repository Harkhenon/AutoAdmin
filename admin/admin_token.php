<?php
include('../core/templates/header_admin.php');
?>
<?php
			if(isset($_GET['action']) && $_GET['action'] == "supprimmer")
				{
							$prepare_del = $bdd->prepare("DELETE FROM ".$prefix."modul_pay WHERE id= :id");
							$delete = $prepare_del->execute(array("id" => $_GET['id']));
							$prepare_del->closeCursor();
							header('Location: ok.php');
							$templates->footerAffiche();
						}
						
switch(isset($_POST['type']))
	{
		case "token_per":

			if($_GET['action'] == "modifier")
				{

					if($_GET['action'] == "modifier" && isset($_GET['envoi']) && $_GET['envoi'] == "banzai")
						{
							$prepare_up = $bdd->query("UPDATE ".$prefix."modul_pay SET nb= :nb, type_tps= :type_tps WHERE id= :id");
							$prepare_up->execute(array(
												"nb" => $_POST['nb_token'],
												"type_tps" => $_POST['periode'],
												"id" => $_POST['id']));
							$prepare_up->closeCursor();
							header('Location: '.$conf['url'].'admin/admin_token.php');
						}
					

					else
						{
							$templates = new Templates();
							$templates->headerAffiche();
							$dem = $bdd->query("SELECT * FROM ".$prefix."modul_pay WHERE id='".$_GET['id']."'");
							$env = $dem->fetch();
							$dem->closeCursor();
							echo '<form action="?action=modifier&amp;envoi=banzai" method="POST">
							<input type="hidden" name="type" value="token_per"/>
							<input type="text" name="nb_token" value="'.$env['nb'].'"/>  tokens par:
							<select name="periode">
							<option value="mois">Mois</option>
							<option value="annee">Année</option>
							</select>
							<input type="hidden" name="id" value="'.$_GET['id'].'"/>
							<input type="submit" value="Enregistrer"/>
							</form>';
						}
				}
				else
					{
						$nombre_de_tokens = $_POST['nb_token'];
						$periode_de_paiement = $_POST['periode'];
							if(is_nan($nombre_de_tokens))
								{
									echo '<p>Le nombre de tokens doit être numérique!</p>';
									echo '<a href="javascript: history.back();">Retour</a>';
								}
							else
								{
									$tok_per = $bdd->prepare("INSERT INTO ".$prefix."modul_pay (id, nb, type_tps) VALUES ('', :nb_tok, :per_tok)");
									$tok_per->execute(array(
													'nb_tok' => $nombre_de_tokens,
													'per_tok' => $periode_de_paiement));
									$tok_per->closeCursor();
									echo '<meta http-equiv="refresh" content="0;url='.$conf['url'].'admin/admin_token.php"/>';
								}
					}
					$templates->footerAffiche();
		break;

		default:
			$templates = new Templates();
	$templates->headerAffiche();
		
			echo '<p>Entrez ici le nombre de tokens par periode que vous souhaitez faire payer</p>';
			echo '<br />';
			$type = $bdd->query("SELECT * FROM ".$prefix."modul_pay");
			echo '<table>
			<tr id="titre_validation">
			<td>Tokens</td>
			<td>Par</td>
			<td>Modifier</td>
			</tr>';

				while($pay = $type->fetch())
					{
						echo '<form action="?action=modifier&amp;id='.$pay['id'].'" method="post">
						<tr id="donnee_validation">
						<td>'.$pay['nb'].'</td>
						<td>'.$pay['type_tps'].'</td>
						<input type="hidden" name="type" value="token_per"/>
						<td><input type="submit" src="img/move.png" name="submit" value="Modifier"/></form></td>
						</tr>
						';
					}
			echo'</table><br /><br />';
			
			$templates->footerAffiche();
	}

?>