<?php
include('core/templates/header.php');
include('core/class/news.class.php');
include('core/class/parser.class.php');
$news = new News();
$parser = new Parser();
$templates = new Templates();
?>
<?php
/* On verifie qu'on regarde pas des commentaires et on balance toutes les news */

if(isset($_GET['action']) && $_GET['action'] == "newcom" && isset($_GET['page']) && $_GET['page'] == "commentaire")
	{
		$news->newCom($_POST['titre'], $_POST['contenu'], $_POST['email'], $_POST['pseudo'], $_POST['id_news'], now());
		exit;
	}
elseif(isset($_GET['action']) && $_GET['action'] == "delete")
	{
		$news->deleteCom($_GET['id']);
		exit;
	}
if(!isset($_GET['page']))
	{
		$templates->headerAffiche();
		$templates->importDesign("news.css");
		$actu = $news->recupNews(NULL);
		foreach($actu as $actus)
			{

				echo '<div id="news">';
				echo '<div id="titre_news">';
				echo $parser->parseText($actus['titre']);
				echo '</div>';
				echo '<div id="contenu_news">';
				echo $parser->parseText($actus['contenu']);
				echo '</div>';
				echo '<div id="auteur">Ecris par: '.$actus['auteur'].' | <a href="news.php?page=commentaires&amp;id='.$actus['id'].'">Voir les commentaires</a></div>';
				echo '</div>';
				echo'<br />';
			}
	}
	/* Sinon on affiche la news avec ses commentaires */
else
	{
		$templates->headerAffiche();
		$templates->importDesign("news.css");
		$newscom = $news->recupCom($_GET['id']);
		$actu = $news->recupNews($_GET['id']);

		
		/* Affichage de la news concernée */
		
		echo '<div id="news">';
		echo '<div id="titre_news">';
		echo $parser->parseText($actu['titre']);
		echo '</div>';
		echo '<div id="contenu_news">';
		echo $parser->parseText($actu['contenu']);
		echo '</div>';
		echo '<div id="auteur">Ecris par: '.$actu['auteur'];
		echo '</div>';
		echo'<br />';
		echo '<br />';
		echo '<h3>Derniers commentaires</h3>';
		echo '<br />';
		
		/* Formulaire d'envoi d'un commentaire */
		
		echo '<form action="news.php?page=commentaire&amp;action=newcom" method="POST">
			<label><p>Titre du commentaire</P>
				<input type="text" name="titre"/></label>
			<label><p>Contenu de votre commentaire (tout contenu débile ou choquant ou qui n\'a rien a voir sera effacé)</p>
				<textarea name="contenu"></textarea></label>';
		if(!isset($info['pseudo']) || !$info['pseudo'] OR !isset($info['email']) || !$info['email'])
			{
				echo '<label><p>Votre pseudo</p>
						<input type="text" name="pseudo"/></label>
					<label><p>Votre email</p>
						<input type="text" name="email"/></label>';
			}
		else
			{
				echo '<input type="hidden" name="pseudo" value="'.$info['pseudo'].'"/>
				<input type="hidden" name="email" value="'.$info['email'].'"/>';
			}
		echo '<br /><br />';
		echo '<input type="hidden" name="id_news" value="'.$_GET['id'].'"/>';
		echo '<input type="reset" name="remise" value="Remise a zero"/>';
		echo '<input type="submit" name="envoyer" value="Envoyer"/>';
		
		echo '<hr />';
		
		/* Affichage des commentaires ou d'un message indiquant qu'il n'y en a pas */
		
		if(empty($newscom) OR !$newscom)
			{
				echo 'Aucun commentaire n\'a été fais sur cette news';
			}
			else
				{
					foreach($newscom as $coms)
						{
							echo '<div id="titre_news">';
							echo $parser->parseText(stripslashes(htmlspecialchars($coms['titre'])));
							if(isset($info['level']) && $info['level'] >= "7")
								{
									echo '&nbsp;|&nbsp;<a href="news.php?action=delete&amp;id='.$coms['id'].'"><img src="'.$path_temp.'images/suppr.png"/></a>';
								}
							echo '</div>';
							echo '<div id="contenu_news">';
							echo $parser->parseText(stripslashes(htmlspecialchars($coms['contenu'])));
							echo '</div>';
							echo '<div id="auteur">';
							echo 'Ecris par: '.$coms['pseudo'].'&nbsp;le '.$coms['Date'].'&nbsp;|&nbsp;<a href="mailto:'.$coms['email'].'">Ecrire à l\'auteur</a>';
							echo '</div><br />';
						}
				}
	}
?>
<?php
$templates->footerAffiche();
?>