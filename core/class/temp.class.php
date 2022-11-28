<?php
// Parser & systeme de templates

//##PARSER##
Class Templates
	{

		public function headerAffiche()
			{
				global $path_temp, $conf, $templates, $info;
				
				/* On inclus le fichier de template du header
				et on commence a parser le code obtenu */
				
				ob_start();
				include($path_temp.'header.tpl');
				$templates_header = ob_get_contents();
				ob_end_clean();
				
				/* Parsons! :) */
				
				$templates_header = preg_replace("#\[title\]#isUm", $conf['titre_site'], $templates_header);
				$templates_header = preg_replace("#\[team\]#isUm", $conf['nom_team'], $templates_header);
				$templates_header = preg_replace("#\[url\]#isUm", $conf['url'], $templates_header);
				$templates_header = preg_replace("#\[url_temp\]#isUm", $path_temp, $templates_header);
				
				/* On inclus le code du formulaire de connexion
				*/
				
				ob_start(); ?>
				<?php
				if(!isset($_SESSION['session']) || !$_SESSION['session'])
				{
				echo '
				<form name="login" method="POST" action="verif.php">
				<input type="text" name="pseudo" value="Login"/>
				&nbsp;<input type="password" name="passe" value="password"/>
				&nbsp;<input type="submit" value="Envoyer"  name="envoyer" onClick="verif_form_login();"/><br />
				</form><a href="adduser.php">Pas encore inscris?</a>&nbsp;&nbsp;&nbsp;<a href="mdpo.php">Mot de passe oublié?</a>';
				}
				else
				{
				echo'<p>Bienvenue <i>'.$info['pseudo'].'</i><br /><br />Solde: <font class="warning">' .$info['token']. '</font> tokens<br /><br /><a href="'.$conf['url'].'membre.php">Mon compte</a><br /><br />';
				if(isset($_SESSION['session']))
				{
				echo '<a href="'.$conf['url'].'logout.php">Déconnexion</a></p>';
				}
				}
				?>
				<?php
				$login = ob_get_contents();
				ob_end_clean();
				
				// On remplace tout ce joli code par une balise débile qui va trainer dans notre header.tpl ;)
				
				$templates_header = preg_replace("#\[form_login\]#isUm", $login, $templates_header);
				
				// Nous sommes sur l'administration? Balançons donc le menu de liens :D
				
				ob_start();
				include($path_temp.'menu_admin.tpl');
				$menu_admin = ob_get_contents();
				ob_end_clean();
				
				$templates_header = preg_replace("#\[menu_admin\]#isUm", $menu_admin, $templates_header);

				
				// Et on lance la machine!
				
				echo $templates_header;
			}
			
			
			
			
		public function footerAffiche()
			{
				global $path_temp, $conf, $bdd, $prefix;
				$req = $bdd->query("SELECT url FROM ".$prefix."hebergeur WHERE hebergeur='".$conf['hebergeur']."'") or die(print_r($bdd->errorInfo()));
				$res = $req->fetch();
				$req->closeCursor();
				$url_heberg = $res['url'];
				$hebergeur_actuel = 'Serveurs hébergés chez: <a href="' .$url_heberg.'">' .$conf['hebergeur']. '</a>';
				ob_start();
				include($path_temp.'footer.tpl');
				$templates_footer = ob_get_contents();
				$templates_footer = preg_replace("#\[/copyright\]#isUm",'Powered by Isoka | 2010 | &copy; Auto admin 2010 V'.$conf['version'].'' , $templates_footer);
				$templates_footer = preg_replace("#\[/hebergeur\]#isUm",$hebergeur_actuel , $templates_footer);
				ob_end_clean();
				echo $templates_footer;
			}
			
			
			
			
			
			
		public function importDesign($design)
			{
				global $path_temp;
				echo '<style type="text/css">@import url('.$path_temp.$design.'); </style>';
			}
			
			
			
			
			
			
		public function chooseTemp()
			{
				global $bdd, $prefix;
				$request = $bdd->query("SELECT nom FROM ".$prefix."templates");
				$style = $request->fetchAll();
				return $style;
			}
			
			
			
			
			
			
		public function importJava($file)
			{
				ob_start();
				include('core/js/'.$file);
				$javascript = ob_get_contents();
				ob_end_clean();
				echo '<script type="text/javascript">'.$javascript.'</script>';
			}
	}
?>
