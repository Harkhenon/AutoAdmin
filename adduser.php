<?php
include('core/templates/header.php');

?>
<?php


switch($_POST['action']) {
/*-----------------------------------------------------------------*/
/*	AJOUT DANS MySQL			*/
/*-----------------------------------------------------------------*/

case "add";


// TEST SUR LES VALEURS SAISIES
		$templates = new Templates();
	$templates->headerAffiche();
if(empty($_POST['pseudo'])){echo "Vous devez choisir un pseudo<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if(empty($_POST['passe'])){echo "Vous devez choisir un mot de passe<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if(empty($_POST['email'])){echo "Vous n'avez pas saisi votre email<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if(empty($_POST['steamid'])){echo "Vous n'avez pas saisi le steamID<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if(empty($_POST['nom'])){echo "Vous n'avez pas saisi votre nom<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if(empty($_POST['prenom'])){echo "Vous n'avez pas saisi votre prénom<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
if($_POST['passe'] != $_POST['passe2']) {echo "Les mots de passes ne correspondent pas<br><br><a href=\"javascript:window.history.back()\">Retour</a>";exit;}
$pseudo_membre = htmlspecialchars($_POST['pseudo']);
$passe_membre = htmlspecialchars(sha1($_POST['passe']));
$steam_membre = htmlspecialchars($_POST['steamid']);
$email_membre = htmlspecialchars($_POST['email']);
$nom_membre = htmlspecialchars($_POST['nom']);
$prenom_membre = htmlspecialchars($_POST['prenom']);
$level = $_POST['level'];

// ON VERIFIE SI CE PSEUDO EXISTE DEJA
$requete = $bdd->query("SELECT * FROM ".$prefix."membre WHERE pseudo='".$pseudo_membre."' OR email='".$email_membre."'");
$num = $requete->fetchColumn();
$verif = $requete->fetch();
$requete->closeCursor();
if($num != 0)
	{
	echo 'Ce pseudo/email existe déjà, veuillez en choisir un autre<br><br><a href="javascript:window.history.back()">Retour</a>';
	}

else
	{
	// CREATION D'UN IDENTIFIANT ALEATOIRE
	$taille = 20;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$id.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		

$membre = new Membre();
$membre->newMembre($pseudo_membre, $passe_membre, $id, $email_membre, $steam_membre, $nom_membre, $prenom_membre);
	// REDIRECTION VERS LA PAGE D'ENTREE DE L'ESPACE MEMBRE
	echo 'Merci, vous êtes bien enregistré. Cliquez <a href="membre.php">ici</a> pour entrer dans votre espace privé.';
	}

break;


/*-----------------------------------------------------------------*/
/*	AFFICHAGE DU FORMULAIRE			*/
/*-----------------------------------------------------------------*/

default;
	$templates = new Templates();
	$templates->headerAffiche();
echo '	<h2>Inscription</h2>
<form action="adduser.php" method="post">
<table width="100%">
	
	
	<input type="hidden" name="action" value="add">
	<tr><td>Choisissez un pseudo* :	</td><td><input type="text" name="pseudo"/></td></tr>
	<tr><td>Choisissez un mot de passe* :	</td><td><input type="password" name="passe"/></td></tr>
	<tr><td>Retapez le mot de passe* :	</td><td><input type="password" name="passe2"/></td></tr>
	<tr><td>Votre email* :	</td><td><input type="text" name="email"/></td></tr>
	<tr><td>SteamID* :	</td><td><input type="text" name="steamid"/></td></tr>
	<tr><td>Nom* :	</td><td><input type="text" name="nom"/></td></tr>
	<tr><td>Prénom* :	</td><td><input type="text" name="prenom"/></td></tr>
	</table>
	<br />
	<input type="submit" value="S\'inscrire"/>
	</form>';
break;
}
?>
<?php
$templates->footerAffiche();
?>