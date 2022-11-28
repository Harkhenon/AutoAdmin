<?php
include('../core/templates/header_admin.php');
?>

<?php
if($_GET['page'] == "gocron")
{
$urlcron		= $url.$_POST['url'];
$minute		= $_POST['minute'];
$heure		= $_POST['heure'];
$dayweek	= $_POST['dayweek'];
$day		= $_POST['day'];
$month		= $_POST['month'];

//       The time and date fields are:
//
//              field          allowed values
//              -----          --------------
//              minute         0-59
//              hour           0-23
//              day of month   1-31
//              month          0-12 (or names, see below)
//              day of week    0-7 (0 or 7 is Sun, or use names)
//
//       A field may be an asterisk (*), which always stands for ``first-last''.

$texte  = $minute." ".$heure." ".$day." ".$month." ".$dayweek." ";

// pour exécuter un script php en ligne de commande: php -f
$texte .= "php -f ".$urlcron;

// Ecriture de la requête dans un fichier (penser aux droits)

$fichier = "cront.cron";
$fil = fopen($fichier,'a');
if(fputs($fil,$texte."\n"))
	echo "La requete ".$texte." a ete enregistree<BR>";
else 	{
	echo "Erreur! La requete ".$texte." n'a pas ete enregistree!";
	exit();
	}

// Exécution de cron avec votre username à la place de YOURUSERNAME

if(passthru('crontab bistofly cront.cron'))
	echo "La requete ".$texte." a ete ajoutee a la liste des taches";
else 	echo "Erreur! La requete ".$texte." n'a pas ete ajoutee a la liste des taches!";
}
else
{
echo '<form action="admin_cron.php?page=gocron" method="post">
<table border=0 cellpadding="0" cellspacing="0" align="center" height="194">
<tr>
<td height="25">
<font size="2" face="Arial">
<b>
Url</b></font>
</td>
<td height="25">
<input type="text" name="url" value="">
</td>
</tr>
<tr>
<td height="25">
<font size="2" face="Arial"><b>Minute</b></font>
</td>
<td height="25">
<select  NAME="minute" size="1">
<OPTION VALUE="*">Toutes les minutes</option>

<OPTION VALUE="0">0</option>
<OPTION VALUE="1">1</option>
<OPTION VALUE="2">2</option>
<OPTION VALUE="3">3</option>
<OPTION VALUE="4">4</option>
<OPTION VALUE="5">5</option>
<OPTION VALUE="6">6</option>
<OPTION VALUE="7">7</option>
<OPTION VALUE="8">8</option>
<OPTION VALUE="9">9</option>
<OPTION VALUE="10">10</option>
<OPTION VALUE="11">11</option>
<OPTION VALUE="12">12</option>
<OPTION VALUE="13">13</option>
<OPTION VALUE="14">14</option>
<OPTION VALUE="15">15</option>
<OPTION VALUE="16">16</option>
<OPTION VALUE="17">17</option>
<OPTION VALUE="18">18</option>
<OPTION VALUE="19">19</option>
<OPTION VALUE="20">20</option>
<OPTION VALUE="21">21</option>
<OPTION VALUE="22">22</option>
<OPTION VALUE="23">23</option>
<OPTION VALUE="24">24</option>
<OPTION VALUE="25">25</option>
<OPTION VALUE="26">26</option>
<OPTION VALUE="27">27</option>
<OPTION VALUE="28">28</option>
<OPTION VALUE="29">29</option>
<OPTION VALUE="30">30</option>
<OPTION VALUE="31">31</option>
<OPTION VALUE="32">32</option>
<OPTION VALUE="33">33</option>
<OPTION VALUE="34">34</option>
<OPTION VALUE="35">35</option>
<OPTION VALUE="36">36</option>
<OPTION VALUE="37">37</option>
<OPTION VALUE="38">38</option>
<OPTION VALUE="39">39</option>
<OPTION VALUE="40">40</option>
<OPTION VALUE="41">41</option>
<OPTION VALUE="42">42</option>
<OPTION VALUE="43">43</option>
<OPTION VALUE="44">44</option>
<OPTION VALUE="45">45</option>
<OPTION VALUE="46">46</option>
<OPTION VALUE="47">47</option>
<OPTION VALUE="48">48</option>
<OPTION VALUE="49">49</option>
<OPTION VALUE="50">50</option>
<OPTION VALUE="51">51</option>
<OPTION VALUE="52">52</option>
<OPTION VALUE="53">53</option>
<OPTION VALUE="54">54</option>
<OPTION VALUE="55">55</option>
<OPTION VALUE="56">56</option>
<OPTION VALUE="57">57</option>
<OPTION VALUE="58">58</option>
<OPTION VALUE="59">59</option>

</select>
</td>
</tr>
<tr>
<td height="25">
<font size="2" face="Arial">
<b>
Heure</b>
</td>
<td height="25">
<select  NAME="heure">
<OPTION VALUE="*">Toutes les heures</option>

<OPTION VALUE="0">0</option>
<OPTION VALUE="1">1</option>
<OPTION VALUE="2">2</option>
<OPTION VALUE="3">3</option>
<OPTION VALUE="4">4</option>
<OPTION VALUE="5">5</option>
<OPTION VALUE="6">6</option>
<OPTION VALUE="7">7</option>
<OPTION VALUE="8">8</option>
<OPTION VALUE="9">9</option>
<OPTION VALUE="10">10</option>
<OPTION VALUE="11">11</option>
<OPTION VALUE="12">12</option>
<OPTION VALUE="13">13</option>
<OPTION VALUE="14">14</option>
<OPTION VALUE="15">15</option>
<OPTION VALUE="16">16</option>
<OPTION VALUE="17">17</option>
<OPTION VALUE="18">18</option>
<OPTION VALUE="19">19</option>
<OPTION VALUE="20">20</option>
<OPTION VALUE="21">21</option>
<OPTION VALUE="22">22</option>
<OPTION VALUE="23">23</option>
</select>
</td>
</tr>
<tr>
<td height="25">

<font size="2" face="Arial">
<b>
Jour de la semaine</b>
</td>
<td height="25">
<select NAME="dayweek">
<OPTION VALUE="*">Tous les jours de la semaine</option>
<OPTION VALUE="0">Dimanche</option>
<OPTION VALUE="1">Lundi</option>
<OPTION VALUE="2">Mardi</option>
<OPTION VALUE="3">Mercredi</option>
<OPTION VALUE="4">Jeudi</option>
<OPTION VALUE="5">Vendredi</option>
<OPTION VALUE="6">Samedi</option>
</select>
</td>
</tr>
<tr>
<td height="25">
<font size="2" face="Arial">
<b>
Jour du mois</b>
</td>
<td height="25">

<select NAME="day">
<OPTION VALUE="*">Tous les jours du mois</option>
<OPTION VALUE="0">0</option>
<OPTION VALUE="1">1</option>
<OPTION VALUE="2">2</option>
<OPTION VALUE="3">3</option>
<OPTION VALUE="4">4</option>
<OPTION VALUE="5">5</option>
<OPTION VALUE="6">6</option>
<OPTION VALUE="7">7</option>
<OPTION VALUE="8">8</option>
<OPTION VALUE="9">9</option>
<OPTION VALUE="10">10</option>
<OPTION VALUE="11">11</option>
<OPTION VALUE="12">12</option>
<OPTION VALUE="13">13</option>
<OPTION VALUE="14">14</option>
<OPTION VALUE="15">15</option>
<OPTION VALUE="16">16</option>
<OPTION VALUE="17">17</option>
<OPTION VALUE="18">18</option>
<OPTION VALUE="19">19</option>
<OPTION VALUE="20">20</option>
<OPTION VALUE="21">21</option>
<OPTION VALUE="22">22</option>
<OPTION VALUE="23">23</option>
<OPTION VALUE="24">24</option>
<OPTION VALUE="25">25</option>
<OPTION VALUE="26">26</option>
<OPTION VALUE="27">27</option>
<OPTION VALUE="28">28</option>
<OPTION VALUE="29">29</option>
<OPTION VALUE="30">30</option>
<OPTION VALUE="31">31</option>
</select>
</td>
</tr>

<tr>
<td height="25">
<font size="2" face="Arial">
<b>
Mois</b>
</td>
<td height="25">
<select NAME="month">
<OPTION VALUE="*">Tous les mois</option>
<OPTION VALUE="1">Janvier</option>
<OPTION VALUE="2">Février</option>
<OPTION VALUE="3">Mars</option>
<OPTION VALUE="4">Avril</option>
<OPTION VALUE="5">Mai</option>
<OPTION VALUE="6">Juin</option>
<OPTION VALUE="7">Juillet</option>
<OPTION VALUE="8">Août</option>
<OPTION VALUE="9">Septembre</option>
<OPTION VALUE="10">Octobre</option>
<OPTION VALUE="11">Novembre</option>
<OPTION VALUE="12">Décembre</option>

</select>
</td>
</tr>
<tr>
<td colspan="2" align="center" valign="center" height="27">
<input type="submit" name="valider" value="Valider">
<input type="Reset" value="Effacer">
</tr>
</table>
</form>';
}
$templates->footerAffiche();
?>