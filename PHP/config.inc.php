<?php
ini_set('upload_max_filesize', 100);
ini_set('post_max_size', 100);

$db_host = 'localhost';
$db_naam = 'root';
$db_pass = '';
$db_db = '84843_beroeps';

$mysqli = mysqli_connect($db_host, $db_naam, $db_pass, $db_db);
?>
