<?php
// On detruit la session
session_destroy();
session_unset();
//et on renvoie sur la page d'accueil
header('Location: index.php');
?>