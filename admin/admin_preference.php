<?php
require('../core/templates/header_admin.php');
include_once('../core/class/config.class.php');

/*section formulaires
/!\ ne pas modifier si vous ne connaissez pas le php!*/

?>
<?php
$templates = new Templates();
$templates->headerAffiche();
?>
<h3>Préférences générales</h3>
<br /> <br />
<form method="post" action="admin_preference.php?page=Modifier">
<table width="100%" style="text-align: center;">
<tr>
<td>Nom du site: </td>
</tr>
<tr>
<td><input type="text" name="nom_site" value="<?php echo $conf['titre_site'] ?>"/></td>
</tr>
<tr>
<td>Nom de la team:</td>
</tr>
<tr>
<td><input type="text" name="nom_team" value="<?php echo $conf['nom_team'] ?>"/></td>
</tr>
<tr>
<td>Hebergeur: </td>
</tr>
<tr>
<td><select name="hebergeur">
<option checked="checked" value="...">...</option>
<?php
$gsp = $bdd->query("SELECT * FROM ".$prefix."hebergeur");
$done = $gsp->fetchAll();
foreach($done as $banzai)
	{
		echo '<option value="'.$banzai['hebergeur'].'">'.$banzai['hebergeur'].'</option>';
	}
?>
</select></td>
</tr>
<tr>
<td>E-mail de l'admin: </td>
</tr>
<tr>
<td><input type="text" name="email" value="<?php echo $conf['mail_admin']; ?>"/></td>
</tr>
<tr>
<td>URL du script (Avec un "/" a la fin!!): </td>
</tr>
<tr>
<td><input type="text" name="url" value="<?php echo $conf['url']; ?>"/></td>
</tr>
<tr>
<td>Message d'acceuil du script:</td>
</tr>
<tr>
<td><textarea name="acceuil"/><?php echo $conf['mess_accueil']; ?></textarea></td>
</tr>
<tr>
<td>Message de maintenance:</td>
</tr>
<tr>
<td><textarea name="maintenance"/><?php echo nl2br($conf['mess_maint']); ?></textarea></td>
</tr>
<tr>
<td>Mode maintenance</td>
</tr>
<tr>
<td><select name="maint"><option value="1">ON</option><option <?php if($conf['maint'] == "0") {echo 'selected="selected"';} else{} ?> value="0">OFF</option></select></td>
</tr>
</table>
<input type="hidden" name="type" value="modifier"/>
<p><input type="submit" value="Envoyer" name="pref_site"/></p>
</form>





<?php
/*****************************************************************************/
/*section php et traitement des données*/
/*Preferences générales*/
if(isset($_POST['type']))
{
switch($_POST['type'])
{
case("modifier"):

if($_GET['page'] == 'Modifier')
{
if(isset($_POST['pref_site']) && $_POST['pref_site'] == 'Envoyer')
{
		if(empty($_POST['nom_site']) OR empty($_POST['nom_team']) OR empty($_POST['email']) OR empty($_POST['maintenance']) OR empty($_POST['url']))
			{
						echo '
						<script language="javascript" type="text/javascript">
						<!--
						window.location.replace("notok.php");
						-->
						</script>';
			}
		else
		{
			$nom_site = htmlspecialchars($_POST['nom_site']);
			$nom_team = htmlspecialchars($_POST['nom_team']);
			$email = htmlspecialchars($_POST['email']);
			$mess_maint = stripslashes($_POST['maintenance']);
			$hebergeur = htmlspecialchars($_POST['hebergeur']);
			$url_load = htmlspecialchars($_POST['url']);
			$texte = stripslashes($_POST['acceuil']);
			$maint = $_POST['maint'];
			
			if($hebergeur == "...")
			{
					$pref = $bdd->prepare("UPDATE ".$prefix."config SET mail_admin= :mail, titre_site= :titre, mess_maintenance= :MM, mess_acceuil= :MA, url_site= :url, nom_team= :nom, maint= :maint") or die(print_r($bdd->errorInfo()));
					$pref->execute(array(
									'url' => $url_load,
									'mail' => $email,
									'titre' => $nom_site,
									'MM' => $mess_maint,
									'MA' => $texte,
									'nom' => $nom_team,
									'maint' => $maint)) or die(print_r($pref->errorInfo()));

					echo '
					<script language="javascript" type="text/javascript">
					<!--
					window.location.replace("ok.php");
					-->
					</script>';
			}
			else
			{
					$pref = $bdd->prepare("UPDATE ".$prefix."config SET hebergeur= :gsp, mail_admin= :mail, titre_site= :titre, mess_maintenance= :MM, mess_acceuil= :MA, url_site= :url, nom_team= :nom, maint= :maint");
						$pref->execute(array(
									'url' => $url_load,
									'gsp' => $hebergeur,
									'mail' => $email,
									'titre' => $nom_site,
									'MM' => $mess_maint,
									'MA' => $mess_acceuil,
									'nom' => $nom_team,
									'maint' => $maint)) or die(print_r($bdd->errorInfo()));

					echo '
					<script language="javascript" type="text/javascript">
					<!--
					window.location.replace("ok.php");
					-->
					</script>';
				
			}
}
}
}
break;
}
}
?>
<?php
/**********************************************************************/
$templates->footerAffiche();
?>