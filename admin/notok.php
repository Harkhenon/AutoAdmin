<?php
include('../core/templates/header_admin.php');
			$templates = new Templates();
			$templates->headerAffiche();
?>
<p class="warning">Une erreur est survenue:</p>
<?php
if($_GET['erreur'] == "vide")
	{
		echo '<p>Un ou des champs n\'ont pas été remplis</p>';
	}
	
if($_GET['erreur'] == "noconc")
	{
		echo "<p>Les mots de passes ne concordent pas</p>";
	}
	
if($_GET['erreur'] == "nolong")
	{
		echo 'Le ou les mots de passes doivent comporter 8 caractères minimum.<br />Si votre mot de passe est trop court, changez le depuis l\'interface de votre hébergeur<br />Puis enregistrez-le ici ensuite.';
	}
?>
<br /><br />
<a href="admin_choose.php">Retour</a>
<?php
$templates->footerAffiche();
?>