<?php
session_start();
include('admin/config.php');
?>
<?php
$pseudo_membre = htmlspecialchars($_POST['pseudo']);
$passe_membre = sha1($_POST['passe']);
$requete = $bdd->prepare("SELECT * FROM ".$prefix."membre WHERE pseudo= :pseudo AND passe= :passe") or die ($bdd->errorinfo());
$requete->execute(array("pseudo" => $pseudo_membre, "passe" => $passe_membre));
$nb_ligne = $requete->fetchColumn();
$requete->closeCursor();

if($nb_ligne == 0)
	{
	header('Location: '.$conf['url'].'index.php?page=erreurid');
exit;
	}
// SI LE LOGIN ET MOT DE PASSE SONT EXACTES	
else
	{
	// CREATION D'UN IDENTIFIANT ALEATOIRE
	$taille = 20;
	$lettres = "abcdefghijklmnopqrstuvwxyz0123456789";
	srand(time());
	for ($i=0;$i<$taille;$i++)
		{
		$id.=substr($lettres,(rand()%(strlen($lettres))),1);
		}
		
	// MISE A JOUR DE L'IDENTIFIANT DANS LA TABLE 
	$requete = $bdd->prepare("UPDATE ".$prefix."membre SET id='".$id."' WHERE pseudo='".$pseudo_membre."' AND passe='".$passe_membre."'") or die ($bdd->errorinfo());
	$requete->execute();
	$requete->closeCursor();
	
		$recup_info_mem = $bdd->query("SELECT * FROM ".$prefix."membre WHERE pseudo='".$pseudo_membre."' AND passe='".$passe_membre."'") or die ($bdd->errorinfo());
		$recup = $recup_info_mem->fetch();
		$_SESSION['id'] = $recup['id_membre'];
	$_SESSION['session'] = $id;
	$_SESSION['level'] = $recup['level'];
	$recup_info_mem->closeCursor();
	
	// REDIRECTION VERS UNE PAGE PROTEGEE AVEC L'IDENTIFIANT SERVANT DE CLE
	if($_SESSION['level'] >= "7")
	{
	 header('Location: '.$conf['url'].'admin/');
	 }
	 else
	 {
	 header('Location: '.$conf['url'].'membre.php');
	 }
	}
?>