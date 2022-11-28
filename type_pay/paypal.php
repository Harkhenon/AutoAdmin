<?php
		$request = $bdd->query("SELECT * FROM ".$prefix."paypal");
		$paypal = $request->fetch();
		$request->closeCursor();
		echo $parse->parseText("[center]En cliquant sur ce bouton, vous créditerez votre compte tokens de [color=red]5[/color] Tokens[/center]");
		echo '<form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="POST">
<input type="hidden" name="cmd" value="' .$paypal['cmd']. '">
<input type="hidden" name="business" value="' .$paypal['business']. '">
<input type="hidden" name="currency_code" value="' .$paypal['currency_code']. '">
<input type="hidden" name="item_name" value="' .$paypal['item_name']. '">
<input type="hidden" name="notify_url" value="' .$paypal['notify_url'].'">
<input type="hidden" name="return" value="' .$paypal['return']. '">
<input type="hidden" name="cancel_return" value="' .$paypal['cancel_return']. '">
<input type="hidden" name="rm" value="' .$paypal['rm']. '">
<input type="hidden" name="amount" value="' .$paypal['amount']. '">
<table>
<tr>
    <td><input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" border="0" name="submit"></td>
  </tr>
</table>
</form>
';

?>