<?php

if(file_exists('file_re/adminlist.txt'))
{
unlink('file_re/adminlist.txt');
}

$conn_id = ftp_connect($ip_serveur, 21) or die ("Impossible de ce connecter au serveur FTP");
$login_res = ftp_login($conn_id, $id_ftp, $mdp_ftp);
ftp_pasv($conn_id, 1);

$remote_file = $url_serveur.'cfg/cssmatch/adminlist.txt';

$handle = fopen('file_re/adminlist.txt', 'a+');

ftp_fget($conn_id, $handle, $remote_file, FTP_ASCII, 0);

fclose($handle);
ftp_close($conn_id);

$file = fopen('file_re/adminlist.txt', 'a+');

$puts_don = "\n\n//Admin par paiement -> $name \n
$steamid";

fputs($file, $puts_don);

fclose($file);

$conn_id = ftp_connect($ip_serveur, 21);
$login_res = ftp_login($conn_id, $id_ftp, $mdp_ftp);
ftp_pasv($conn_id, 1);

$file = $url_serveur.'cfg/cssmatch/adminlist.txt';

$fp = fopen('file_re/adminlist.txt', 'a+');

ftp_fput($conn_id, $file, $fp, FTP_ASCII);

ftp_close($conn_id);
fclose($fp);

unlink('file_re/adminlist.txt');


header('Location: '.$url.'admin/ok.php');