<?php
include('../core/templates/header_admin.php');
?>
<?php
					$templates = new Templates();
			$templates->headerAffiche();
echo 'Bienvenue ' .$info['pseudo']. '!<br /><br />';

echo 'Etat de vos serveurs:<br /><br />';
$monitor= $bdd->query("SELECT * FROM ".$prefix."donnee_serveur");
while($monitor_go = $monitor->fetch())
{
echo '<iframe src="http://cache.www.gametracker.com/components/html0/?host='.$monitor_go['ip_serveur'].':'.$monitor_go['port_serveur'].'&bgColor=FFFFFF&fontColor=333333&titleBgColor=FFFFFF&titleColor=000000&borderColor=BBBBBB&linkColor=091858&borderLinkColor=5C5C5C&showMap=1&showCurrPlayers=0&topPlayersHeight=100&showTopPlayers=1&showBlogs=0&width=240" frameborder="0" scrolling="no" width="240" height="500"></iframe>';
}
echo '<br />';

?>

<?php
$templates->footerAffiche();
?>