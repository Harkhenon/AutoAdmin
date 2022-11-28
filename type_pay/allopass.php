<?php
include('core/class/allo.class.php');
$allo = new Allopass();
$mer = $allo->getInfoAllo();
echo '
<p class="center"><img src="'.$path_temp.'images/05.jpg"/></p><br />
<p>Merci de bien vouloir rentrer le nombre de codes demandé.<br />
Veuillez entrer les codes correctement et sans fautes ou touche maj enfoncée.</p><br />
				
<form action ="http://payment.allopass.com/acte/access.apu" method="post">
    <input type="hidden" name="SITE_ID" value="' .$mer['id'].'" />
    <input type="hidden" name="DOC_ID" value="' .$mer['idd']. '" />
    <input type="hidden" name="recall" value="1" />
    <input type="text" name="code[]" size="8" />
    <input type="submit" value=" Entrer " />

  </form>
';
?>