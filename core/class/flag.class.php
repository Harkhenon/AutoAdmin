<?php
class Flag
	{
		public function recFlagAll()
			{
				global $bdd, $prefix;
				$recflags = $bdd->query("SELECT * FROM " .$prefix. "flags");
				$flagAll = $recflags->fetchAll();
				
				return $flagAll;
			}
		public function recFlag($plugin)
			{
				global $bdd, $prefix;
				$recflags = $bdd->query("SELECT * FROM " .$prefix. "flags WHERE plugin='" .$plugin. "'");
				$flags = $recflags->fetch();
				
				return $flags;
			}
		public function editFlag($plugin, $immunity, $admin)
			{
				global $bdd, $prefix;
				$editflag = $bdd->prepare("UPDATE " .$prefix. "flags SET immunity= :immunity, admin= :admin WHERE plugin= :plugin");
				$editflag->execute(array(
										"plugin" => $plugin,
										"immunity" => $immunity,
										"admin" => $admin));
			}
	}