<?php
class Membre 
	{
		//Récupération des infos des membres
		public function recInfo($id)
			{
				global $bdd, $prefix;
				if(!empty($id))
					{
						$query_infos = $bdd->query("SELECT * FROM ".$prefix."membre WHERE id_membre='".$id."'");
						$info = $query_infos->fetch();
						$query_infos->closeCursor();
						return $info;
					}
				else
					{
						$query_infos = $bdd->query("SELECT * FROM ".$prefix."membre");
						$info = $query_infos->fetchAll();
						$query_infos->closeCursor();
						return $info;
					}
			}
		//Delete de membre
		public function delMembre($id)
			{
				global $bdd, $prefix, $conf;
				$del = $bdd->prepare("DELETE FROM ".$prefix."membre WHERE id_membre= :id")or die($bdd->errorinfo());
				$del->execute(array("id" => $id));
				$del->closeCursor();
				header('Location:' .$conf['url']. 'admin/ok.php');
			}

		//Création d'un nouveau membre
		public function newMembre($pseudo, $passe, $id, $mail, $steam, $nom, $prenom)
			{

				global $bdd, $prefix;
				$create_membre = $bdd->prepare("INSERT INTO ".$prefix."membre VALUES('', :pseudo, :passe, :id, '1', :mail, :steam, :nom, :prenom, '0', '0')");
				$create_membre->execute(array("pseudo" => $pseudo,
										"passe" => $passe,
										"id" => $id,
										"mail" => $mail,
										"steam" => $steam,
										"nom" => $nom,
										"prenom" => $prenom));
			}
		public function editMembre($pseudo, $level, $mail, $steam, $nom, $prenom, $etat, $token, $id)
			{
				global $bdd, $prefix, $conf;
						$edit_membre = $bdd->prepare("UPDATE ".$prefix."membre SET pseudo= :pseudo, level= :level, email= :mail, steamid= :steam, nom= :nom, prenom= :prenom, etat= :etat, token= :token WHERE id_membre= :id");
						$edit_membre->execute(array("pseudo" => $pseudo,
														"level" => $level,
														"mail" => $mail,
														"steam" => $steam,
														"nom" => $nom,
														"prenom" => $prenom,
														"etat" => $etat,
														"token" => $token,
														"id" => $id));
						header('Location: ' .$conf['url']. 'admin/ok.php');
			}
		public function editPassword($passe, $passe2, $id)
			{
				global $bdd, $prefix;
				if($passe == $passe2 || empty($passe) || empty($passe2))
					{
						$edit_password = $bdd->prepare("UPDATE ".$prefix."membre SET passe= :passe WHERE id_membre= :id");
						$edit_password->execute(array("passe" => $passe, "id" => $id));
						header('Location: ok.php');
					}
				else
					{
						header('Location: notok.php?erreur=noconc');
					}
			}
		public function editInfoMembre($type, $id, $donnee)
			{
				global $bdd, $prefix;
				if($type == "token" OR $type == "pseudo" OR $type == "email")
					{
						header('Location: membre.php?erreur=edition');
						exit;								
					}
				$up_info = $bdd->prepare("UPDATE " .$prefix. "membre SET ".$type."= :donnee WHERE id= :id");
				$up_info->execute(array("donnee" => $donnee,
										"id" => $id));
				$up_info->closeCursor();
				header('Location: membre.php');
			}
		public function verif_identifiants($pseudo, $passe)
			{
				global $bdd, $prefix;
				$requete = $bdd->prepare("SELECT * FROM ".$prefix."membre WHERE pseudo= :pseudo AND passe= :passe") or die ($bdd->errorinfo());
				$requete->execute(array("pseudo" => $pseudo, "passe" => $passe));
				$nb_ligne = $requete->fetchColumn();
				$requete->closeCursor();
				return $nb_ligne;
			}
		public function verif_ban($pseudo, $passe)
			{
				global $bdd, $prefix;
				$requete = $bdd->prepare("SELECT * FROM ".$prefix."membre WHERE pseudo= :pseudo AND passe= :passe") or die ($bdd->errorinfo());
				$requete->execute(array("pseudo" => $pseudo_membre, "passe" => $passe_membre));
				$verif = $requete->fetch();
				$requete->closeCursor();
				return $verif;
			}
		public function changeStyle($style, $id)
			{
				global $bdd, $prefix;
				$change = $bdd->prepare("UPDATE ".$prefix."membre SET style= :style WHERE id= :id");
				$change->execute(array("style" => $style,
										"id" => $id));
				$change->closeCursor();
				header('Location: membre.php');
			}
	}