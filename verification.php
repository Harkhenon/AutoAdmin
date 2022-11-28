<?php
include('core/templates/header.php');
			$templates = new Templates();
	$templates->headerAffiche();
	$validation = $bdd->query("SELECT * FROM ".$prefix."demande ORDER BY id DESC")or die(print_r($bdd->errorInfo()));
	$valid = $validation->fetchAll();
	if(empty($valid))
		{
			echo 'Aucune demande de droit';
		}
	else
		{
			echo '
				<p class="warning">Liste des joueurs ayants donnés pour les droits serveur:</p>
				<br />
				<div id="tableau">
				<table>
				<tr id="titre_validation">
				<td>Pseudo</td>
				<td>Validation du don</td>
				<td>SteamID</td>
				<td>Serveur</td>
				<td>Validé par l\'admin</td>
				</tr>';
					foreach($valid as $droit)
						{
							echo'
							<tr id="donnee_validation">
							<td>'.$droit['pseudo'].'</td>
							<td>'.$droit['pay_valid'].'</td>
							<td>'.$droit['steamid'].'</td>
							<td>'.$droit['serveur'].'</td>
							<td>'.$droit['validation'].'</td>
							</tr>';

						}
				echo'
				</table></div>';
		}
?>
<br />
<br />
<a href="javascript: history.back();">Retour</a>
<?php
$templates->footerAffiche();
?>