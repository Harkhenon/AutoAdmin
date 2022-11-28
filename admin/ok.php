<?php
include('../core/templates/header_admin.php');
			$templates = new Templates();
			$templates->headerAffiche();
?>
<p>Manipulation effectuée</p><br /><br />
<a href="admin_choose.php">Retour</a>
<?php
$templates->footerAffiche();
?>