<?php



/**************************************************************************/
function verif_login()
	{
		global $conf, $info;
		
		if($info['etat'] == 1)
			{
				session_destroy();
				session_unset();
				header('Location: index.php?page=banzai');
			}
		elseif(!$_SESSION['session'] or !$_SESSION['level'])
			{
				header('Location: '.$conf['url'].'index.php?page=kesstufela');
			}
	}
/****************************************************************************/
function verif_login_admin()
	{
		global $info;
		
		if($info['etat'] == 1)
			{
				header('Location: ../index.php?page=banzai');
			}
		if(!$_SESSION['session'] or $_SESSION['level'] <= "7" or !$_SESSION['level'])
			{
				global $conf;
				header('Location: ../index.php?page=kesstufela');
			}
	}
/****************************************************************************/
?>