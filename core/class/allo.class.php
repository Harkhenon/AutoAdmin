<?php

class Allopass
	{
		public function getInfoAllo()
			{
				global $bdd, $prefix;
				$recmer = $bdd->query("SELECT * FROM ".$prefix."allopass");
				$mer = $recmer->fetch();
				
				return $mer;
			}
	}
