<?php
$result = $bdd->query("SELECT * FROM ".$prefix."config");
while($value = $result->fetch())
	{
		$conf[$value['type']] = $value['valeur'];
	}
?>