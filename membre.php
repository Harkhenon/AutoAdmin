<?php
include('core/templates/header.php');
include('core/class/parser.class.php');
$parser = new Parser();
$templates = new Templates();
verif_login();
?>
<?php
if(isset($_GET['page']))
	{
		if($_GET['page'] == "modif")
			{
				if(isset($_POST['modifier']))
					{
							$membre = new Membre();
							$membre->editInfoMembre($_POST['type'], $_POST['id'], $_POST[$_POST['type']]);
					}

				$templates->headerAffiche();
				$type = htmlspecialchars(trim($_GET['type']));
				echo '<form action="" method="POST">
				<p>Votre nouveau ' .$type. '</p>
				<br />
				<input type="text" value="'.$info[$type].'" name="' .$type. '"/>
				<input type="hidden" name="type" value="' .$type. '"/>
				<input type="hidden" name="id" value="'.$info['id'].'"/>
				<br />
				<input type="submit" name="modifier" value="Modifier"/>
				<br /><br />
				<a href="membre.php">Retour</a>';
			}
		elseif($_GET['page'] == "changestyle")
			{
				$membre = new Membre();
				$membre->changeStyle($_POST['style'], $_POST['id']);
			}
	}
elseif(isset($_GET['erreur']))
	{
		if($_GET['erreur'] == "edition")
			{
				$templates->headerAffiche();
				echo $parser->parseText('Petit filou va! [b][u]Impossible[/b][/u] de modifier son email, pseudo ou nombre de [color=red]tokens[/color] :p');
			}
	}
else
	{
		$templates->headerAffiche();
		$style = $templates->chooseTemp();
		echo '<h3 class="center">Configuration du compte</h3><br /><br />';
		echo 'Bienvenue ' .$info['pseudo']. '!
		<br /><br />
		<p><u>Vos informations:</u></p>
		<br /><br />
		<div id="donnee_validation">
		<table id="tab_mem">
		<tr>
		<td><p><b>Pseudo:</b></p></td>	<td><p>' .$info['pseudo']. '</p></td>
		</tr><tr>
		<td><p><b>E-mail:</b></p></td>	<td><p>' .$info['email']. '</p></td>
		</tr>
		<tr>
		<td><p><b>Steam ID:</b></p></td>		<td><p>' .$info['steamid']. '</p></td><td><a href="membre.php?page=modif&type=steamid">Modifier</a></td>
		</tr>
		<tr>
		<td><p><b>Nom:</b></p></td>		<td><p>' .$info['nom']. '</p></td><td><a href="membre.php?page=modif&type=nom">Modifier</a></td>
		</tr>
		<tr>
		<td><p><b>Prénom:</b></p></td>		<td><p>' .$info['prenom']. '</p></td><td><a href="membre.php?page=modif&type=prenom">Modifier</a></td>
		</tr>
		<tr>
		<td><p><b>Solde de tokens:</b></p></td>		<td><p>' .$info['token']. '</p></td>
		</tr>
		</table></div>
		<br />
		<hr width="100%" />
		<br />';	
		echo '<h3 class="center">Changer de style</h3>';
		echo '<p>Style actuel:&nbsp;'.$info['style'];
		echo '<form action="?page=changestyle" method="POST">
		<select name="style">';
			foreach($style as $temp)
				{
					echo '<option value="'.$temp['nom'].'">'.$temp['nom'].'</option>';
				}
		echo '</select>';
		echo '<input type="hidden" name="id" value="'.$info['id'].'"/>';
		echo '<input type="submit" name="Envoyer" value="Changer de style"/>';
		echo '</form></p><br />';
		echo '<h3 class="center">Acheter des tokens</h3>
		<p>Acheter des tokens par:
		<form method="post" action="paiement.php?paiement=achat-token">
		<select name="type">
		<option value="paypal">Paypal</option>
		<option value="allopass">Allopass</option>
		<option value="starpass">Starpass</option>
		</select>
		<input type="submit" name="Acheter" value="Acheter"/>
		</form></p>';
	}
?>
<?php
$templates->footerAffiche();
?>