<?php
class News
	{
	/*Systeme de news (recupération, création, edition et suppressin) */
		public function recupNews($id)
			{
				global $bdd, $prefix;
				if(empty($id))
					{
						$request = $bdd->query("SELECT * FROM ".$prefix."news ORDER BY id DESC LIMIT 0, 5");
						$actu = $request->fetchAll();
						return $actu;
						$request->closeCursor();
					}
				else
					{
						$request = $bdd->prepare("SELECT * FROM ".$prefix."news WHERE id= :id");
						$request->execute(array("id" => $id));
						$result = $request->fetch();
						return $result;
						$request->closeCursor();
					}
			}
		public function newNews($titre, $contenu, $auteur)
			{
				global $bdd, $prefix;
				$ajouter = $bdd->prepare("INSERT INTO ".$prefix."news VALUES ('', :titre, :contenu, :auteur)");
				$ajouter->execute(array("titre" => stripslashes($titre),
										"contenu" => stripslashes($contenu),
										"auteur" => $auteur));
				$ajouter->closeCursor();
				header('location: admin_choose.php');
			}
		public function editNews($contenu, $titre, $id)
			{
				global $bdd, $prefix;
				$edit = $bdd->prepare("UPDATE ".$prefix."news SET contenu= :contenu, titre= :titre WHERE id= :id");
				$edit->execute(array("contenu" => stripslashes($contenu),
									"titre" => stripslashes($titre),
									"id" => $id));
				$edit->closeCursor();
				header('location: admin_choose.php');
			}
		public function deleteNews($id)
			{
				global $bdd, $prefix;
				$delete = $bdd->prepare("DELETE FROM ".$prefix."news WHERE id= :id");
				$delete->execute(array("id" => $id));
				$delete->closeCursor();
				header('location: admin_choose.php');
			}
	/*Opération commentaires!*/
	
		public function recupCom($id)
			{
				global $bdd, $prefix;
				$request = $bdd->prepare("SELECT id, titre, contenu, email, pseudo, id_news, DATE_FORMAT(date,'%d/%m/%Y') AS Date FROM ".$prefix."commentaire WHERE id_news= :id ORDER BY id DESC LIMIT 0,10");
				$request->execute(array("id" => $id));
				$com = $request->fetchAll();
				return $com;
				$request->closeCursor();
			}
		public function newCom($titre, $contenu, $email, $pseudo, $id_news)
			{
				global $bdd, $prefix;
				$newcom = $bdd->prepare("INSERT INTO ".$prefix."commentaire VALUES('', :titre, :contenu, :email, :pseudo, :id, NOW())");
				$newcom->execute(array("titre" => $titre,
										"contenu" => $contenu,
										"email" => $email,
										"pseudo" => $pseudo,
										"id" => $id_news));
				
				header('Location: news.php?page=commentaires&id='.$id_news.'');
				$newcom->closeCursor();
			}
		public function deleteCom($id)
			{
				global $bdd, $prefix;
				$deletecom = $bdd->prepare("DELETE FROM ".$prefix."commentaire WHERE id= :id");
				$deletecom->execute(array("id" => $id));
				$deletecom->closeCursor();
				header('location: news.php');
			}

	}