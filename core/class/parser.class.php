<?php
class Parser
	{
		public function parseText($texte)
			{
				global $bdd, $prefix, $path_temp;
				 $texte = preg_replace("#\[b\](.+)\[/b\]#isU", '<span class="gras">$1</span>', $texte);
				 $texte = preg_replace("#\[ligne=(.+)\]#isU", '<hr width="$1%">', $texte);
				$texte = preg_replace("#\[i\](.+)\[/i\]#isU", '<span class="italique">$1</span>', $texte);
				$texte = preg_replace("#\[u\](.+)\[/u\]#isU", '<span class="souligne">$1</span>', $texte);
				$texte = preg_replace("#\[img\](.+)\[/img\]#i", '<img src="$1"/>', $texte);
				$texte = preg_replace("#\[url=?(.+)?\](.+)\[/url\]#isU", '<a href="$1">$2</a>', $texte);
				$texte = preg_replace("#\[color=(red|blue|green|orange|yellow)\](.+)\[/color\]#isU", '<span class="$1">$2</span>', $texte);
				$texte = preg_replace("#\[center\](.+)\[/center\]#isU", '<div style="text-align: center;" align="center"">$1</div>', $texte);
				$texte = preg_replace("#\[quote\](.+)\[/quote\]#isU", "<blockquote>$1</blockquote>", $texte);
				$requete = $bdd->query('SELECT * FROM '.$prefix.'smileys') or die ($bdd->errorinfo());
				$smileys = $requete->fetchAll();
				foreach($smileys as $go)
					{
						$texte = str_replace("".$go['code']."", '<img src="'.$path_temp.$go['url'].'"/>', $texte);
					}
				$requete->closeCursor(); 
				echo nl2br($texte);
			}
	}
	?>