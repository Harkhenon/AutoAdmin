<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
       <meta http-equiv="Content-Type" content="text/html; charset=iso-8851-2" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="[url_temp]style.css" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="[url_temp]bbcode.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script src="core/js/jsconf.js"></script>
	<title>[title]</title>
   </head>
<body>
<div id="header">
<div id="login">
[form_login]
</div>
  <h1 class="team">[team]</h1>
  <img src="templates/default/images/header.png"/>
 </div>
 <div id="corps">
<div id="menu_liens">
 <table class="center">
<tr>
<td><a href="index.php">Accueil</a></td>
<td>&nbsp;|&nbsp;<a href="news.php">Actualités</a></td>
<?php
if(isset($_SESSION['level']) && $_SESSION['level'] >= "7")
{
echo '<td>&nbsp;|&nbsp;<a href="'.$conf['url'].'admin/">Administration</a></td>';
}
?>
</tr>
</table>

</div>

<div id="conteneur">
<div id="contenu">
