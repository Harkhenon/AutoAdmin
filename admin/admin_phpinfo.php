<?php
include('../core/templates/header_admin.php');
$templates = new Templates();
$templates->headerAffiche();
?>

<?php
ob_start();
phpinfo(INFO_GENERAL);
$phpinfo = ob_get_contents();
$phpinfo = preg_replace('`^.*<body>`is', '', $phpinfo);
$phpinfo = str_replace(array('class="e"', 'class="v"', 'class="h"', '<i>', '</i>', '<hr />', '<img border="0"', '<table border="0" cellpadding="3" width="100px" style="background: rgb(50, 50, 50);">', '</body></html>'), 
array('class="row1"', 'class="row2"', 'class="row3"', '<em class="em">', '</em>', '', '<img style="float:right;"', '<table class="module_table">', ''), $phpinfo);
echo '<style>contenu { width: 200px; }';
ob_end_clean();
echo $phpinfo;
?>
<?php $templates->footerAffiche(); ?>