<?php
class Serveur
	{
			//Récupération des infos serveur groupées & individuelles

	public function recServAll()
	{
		global $bdd, $prefix;
		$infos = $bdd->query("SELECT * FROM ".$prefix."donnee_serveur");
		$info_ok = $infos->fetchAll();
		return $info_ok;
	}

			
		public function recServ($id)
			{
				global $bdd, $prefix;
				$query_infos = $bdd->query("SELECT * FROM ".$prefix."donnee_serveur WHERE id='".$id."'");
				$serv = $query_infos->fetch();
				return $serv;
			}
			
			//Fonction de delete d'un serveur
public function delServ($id)
	{
		global $bdd, $prefix;
		$delserv = $bdd->prepare("DELETE FROM ".$prefix."donnee_serveur WHERE id= :id ");
		$delserv->execute(array("id" => $id));
		header('Location: ok.php');
	}
			
			//Fonction d'edit d'un serveur
		public function editServ($ip, $port, $nom, $plugin, $ftp, $rcon, $login, $pass, $id)
			{
				global $bdd, $prefix;
		$edit_serveur = $bdd->prepare("UPDATE ".$prefix."donnee_serveur SET ip_serveur= :ip, port_serveur= :port, nom_serveur= :nom, plugin_serveur= :plugin, chemin= :ftp, rcon= :rcon, id_ftp= :login, mdp_ftp= :pass WHERE id= :id");
		$edit_serveur->execute(array("ip" => $ip,
										"port" => $port,
										"nom" => $nom,
										"plugin" => $plugin,
										"ftp" => $ftp,
										"rcon" => $rcon,
										"login" => $login,
										"pass" => $pass,
										"id" => $id));
		$edit_serveur->closeCursor();
		header('Location: ok.php');
			}
			
		public function choosePlug()
			{
				global $bdd, $prefix;
				$choose = $bdd->query("SELECT * FROM ".$prefix."flags");
				$choose->fetchAll();
				return $choose;
			}
		public function createServ($ip, $port, $nom, $plugin, $chemin, $passrcon, $passrcon2, $loginftp, $passftp, $passftp2)
			{
				global $bdd, $url, $prefix;
				if(empty($ip) OR empty($port) OR empty($nom) OR empty($plugin) OR empty($chemin) OR empty($passrcon) OR empty($passrcon2) OR empty($loginftp) OR empty($passftp) OR empty($passftp2))
					{
						header('location: '.$url.'admin/notok.php?erreur=vide');
					}
				elseif($passrcon != $passrcon2 OR $passftp != $passftp2)
					{
						header('Location: '.$url.'admin/notok.php?erreur=noconc');
					}
				elseif(strlen($passrcon) < 8 OR strlen($passftp) < 8)
					{
						header('Location: '.$url.'admin/notok.php?erreur=nolong');
					}
				else
					{
						$newserveur = $bdd->prepare("INSERT INTO ".$prefix."donnee_serveur VALUES('', :ip, :port, :nom, :plugin, :chemin, :passrcon, :loginftp, :passftp)");
						$newserveur->execute(array("ip" => $ip,
												   "port" => $port,
												   "nom" => $nom,
												   "plugin" => $plugin,
												   "chemin" => $chemin,
												   "passrcon" => $passrcon,
												   "loginftp" => $loginftp,
												   "passftp" => $passftp));
						header('Location: ok.php');
					}
			}
	}