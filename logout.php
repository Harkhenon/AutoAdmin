<?php
session_start();
include('admin/config.php');
include('admin/fonction.php');
include('core/begin.php');
verif_login();
?>
<?php

session_unset();
session_destroy();
unset($_COOKIE['pseudo_membre']);
unset($_COOKIE['passe_membre']);
header('Location: '.$conf['url'].'');
?>