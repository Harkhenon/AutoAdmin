<?php
if(!empty($_POST['creer']) && $_POST['creer'] == "Creer")
	{
		include('../../admin/config.php');
		$sql = "CREATE TABLE IF NOT EXISTS `aa_allopass` (
  `id` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `auth` text NOT NULL
)
";
		$bdd->query($sql);
		header('Location: ../index.php?step=4');
	}
else
	{
		header('Location: ../index.php?err=4');
	}