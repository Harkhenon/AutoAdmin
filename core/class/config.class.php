<?php
class Paiement
	{
	public function recTemps()
		{
		global $bdd, $prefix;
				$requete = $bdd->query("SELECT temps FROM ".$prefix."type_pay");
				$temps = $requete->fetchAll();
				
				return $temps;
				$requete->closeCursor();
		}
	public function recPeriode()
		{
		global $bdd, $prefix;
				$requete = $bdd->query("SELECT type_tps FROM ".$prefix."modul_pay");
				$periode = $requete->fetchAll();
				
				return $periode;
				$requete->closeCursor();
		}
	public function recNb($type_per)
		{
		global $bdd, $prefix;
				$requete = $bdd->query("SELECT * FROM ".$prefix."modul_pay WHERE type_tps='".$type_per."'");
				$nb = $requete->fetch();
				
				return $nb;
				$requete->closeCursor();
		}
		public function calculPrix($temps, $periode)
			{
				global $bdd, $prefix;
					
									$requete = $bdd->query("SELECT nb FROM ".$prefix."modul_pay WHERE type_tps='".$periode."'");
				$nb = $requete->fetch();
					
					$total = $nb['nb'] * $temps;
					
					return $total;
				$requete->closeCursor();
			}
		public function timestamp($periode)
			{
				if($periode == "mois")
						{
							$timestamp = time() + 31 * 24 * 3600;
						}
					elseif($periode == "annee")
						{
							$timestamp = time() + 365 * 24 * 3600;
						}
						
						return $timestamp;
				
			}
		public function validPay($pseudo, $email, $steamid, $serveur, $pay, $valid, $timestamp)
			{
				global $bdd, $prefix;
				$new_droit = $bdd->prepare("INSERT INTO ".$prefix."demande VALUES ('', :pseudo, :email, :steamid, :serveur, :pay, :valid, :timestamp)");
				$new_droit->execute(array("pseudo" => $pseudo,
										  "email" => $email,
										  "steamid" => $steamid,
										  "serveur" => $serveur,
										  "pay" => $pay,
										  "valid" => $valid,
										  "timestamp" => $timestamp));
				$new_droit->closeCursor();
			}
		public function piqueToken($nb, $pseudo)
			{
				global $bdd, $prefix;
				$jetelespiquemuhahaha = $bdd->prepare("UPDATE ".$prefix."membre SET token= :token WHERE pseudo= :pseudo");
				$jetelespiquemuhahaha->execute(array("token" => $nb, "pseudo" => $pseudo));
				$jetelespiquemuhahaha->closeCursor();
			}
		public function crediteToken($nb, $pseudo)
			{
				global $bdd, $prefix;
				$jetelesdonnebouhouhou = $bdd->prepare("UPDATE ".$prefix."membre SET token= :token WHERE pseudo= :pseudo");
				$jetelesdonnebouhouhou->execute(array("token" => $nb, "pseudo" => $pseudo));
				$jetelesdonnebouhouhou->closeCursor();
			}
	}