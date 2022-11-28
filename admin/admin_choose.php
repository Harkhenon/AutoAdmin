<?php
include('../core/templates/header_admin.php');
	$templates = new Templates();
	$templates->headerAffiche();
?>
<form action="admin_view.php" method="POST" class="center">
<select name="type">
<option value="membre">Gestion des membres</option>
<option value="serveur">Gestion des serveurs</option>
<option value="flag">Gestion des flags des plugins</option>
<option value="demande">Gestion des demandes</option>
<option value="token">Gestion des tokens</option>
<option value="news">Gestion des news</option>
</select>
<input type="submit" name="ok" value="Envoyer"/>
</form>
<?php
$templates->footerAffiche();
?>