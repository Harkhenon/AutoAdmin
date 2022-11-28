<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
       <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="[url_temp]base.css" />
	   <link rel="stylesheet" media="screen" type="text/css" title="Design" href="[url_temp]bbcode.css" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
	<script src="core/js/jsconf.js"></script>
	<title>[title]</title>
   </head>
   <body>

<div id="corps">
<div id="login">
[form_login]
</div>
  <div id="header"><h1 style="color: white; text-align: right; font-size: 18px;">[/team]</h1></div>
<div id="menu_liens">
  <table class="center">
<tr>
<td><a href="index.php">Accueil</a></td>
<td>&nbsp;|&nbsp;<a href="news.php">Actualités</a></td>
<?php 
if(isset($_SESSION['level']) && $_SESSION['level'] >= "7")
{
echo '<td>&nbsp;|&nbsp;<a href="[url]admin/">Administration</a></td>';
}
else{}
?>
</tr>
</table>
</div>

<div id="conteneur">
<div id="contenu">
