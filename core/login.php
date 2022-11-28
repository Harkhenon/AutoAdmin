<?php
	if(!$_SESSION['session'])
		{ ?>
			<form method="post" action="verif.php">
			<input type="text" name="pseudo" value="Login" onfocus="if (this.value == 'Login') {this.value = ''}"/>
			&nbsp;<input type="password" name="passe" value="password" onfocus="if (this.value == 'password') {this.value = ''}"/>
			&nbsp;<input type="submit" value="Envoyer"/><br />
			<a href="adduser.php">Pas encore inscris?</a>&nbsp;&nbsp;&nbsp;<a href="mdpo.php">Mot de passe oublié?</a>
			</form>
<?php
		}
	else
		{
			global $info, $url;
			echo'<p>Bienvenue <i>'.$info['pseudo'].'</i><br /></b><a href="'.$url.'membre.php">Mon compte</a><br />Solde: ' .$info['token']. ' tokens<br />';
			if(isset($_SESSION['session']))
{
echo '<a href="[/aa_url]logout.php">Déconnexion</a></p>';
}
		}
?>