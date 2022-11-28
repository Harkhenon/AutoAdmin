<?php
if(empty($_POST['login']) || empty($_POST['pass']) || empty($_POST['nom']) || empty($_POST['prefix']) || empty($_POST['serveur']))
	{
		header('Location: ../index.php?err=1');
		exit;
	}
else
	{
		$file = fopen('../../admin/config.php', 'a+');
		fputs($file, '<?php
						$servbdd = "'. $_POST['serveur'].'";
						$namebdd = "'. $_POST['nom']. '";
						$logbdd = "' .$_POST['login']. '";
						$passbdd = "' .$_POST['pass']. '";
						$prefix  = "' .$_POST['prefix']. '";
						try
							{
								$bdd = new PDO("mysql:host=".$servbdd.";dbname=".$namebdd."", $logbdd, $passbdd);
							}
						catch (Exception $e)
							{
								die("Erreur BDD->PDO : " . $e->getMessage() . "");
							}
						?>');
		fclose($file);
		header('Location: ../index.php?step=3');
	}