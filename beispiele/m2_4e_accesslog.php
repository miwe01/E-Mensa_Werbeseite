<?php
/**
 * Praktikum DBWT. Autoren:
 * Mika, Weber, 3252173
 * Ben, Loos, 3207009
 */
$accesslog = fopen('accesslog.txt', 'a');
date_default_timezone_set("Europe/Berlin");
$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$browser = $_SERVER['HTTP_USER_AGENT'];


fwrite($accesslog, $date . " " . $ip . " " . $browser ."\n");
fclose($accesslog);

?>