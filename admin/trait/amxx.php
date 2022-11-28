<?php

if(file_exists('file_re/users.ini'))
{
unlink('file_re/users.ini');
}

$conn_id = ftp_connect($ip_serveur, 21) or die ("Impossible de ce connecter au serveur FTP");
$login_res = ftp_login($conn_id, $id_ftp, $mdp_ftp);
ftp_pasv($conn_id, 1);

$remote_file = $url_serveur.'addons/amxmodx/configs/users.ini';

$handle = fopen('file_re/users.ini', 'a+');

ftp_fget($conn_id, $handle, $remote_file, FTP_ASCII, 0);

fclose($handle);
ftp_close($conn_id);

$file = fopen('file_re/users.ini', 'a+');

$puts_don = "\n\n; Admin par paiement -> $name \n
\"".$steamid."\" \"\" \"".$flags_admin."\" \"ce\"";

fputs($file, $puts_don);

fclose($file);

$conn_id = ftp_connect($ip_serveur, 21);
$login_res = ftp_login($conn_id, $id_ftp, $mdp_ftp);
ftp_pasv($conn_id, 1);

$file = $url_serveur.'addons/amxmodx/configs/users.ini';

$fp = fopen('file_re/users.ini', 'a+');

ftp_fput($conn_id, $file, $fp, FTP_ASCII);

ftp_close($conn_id);
fclose($fp);

unlink('file_re/users.ini');


header('Location: '.$url.'admin/ok.php');
