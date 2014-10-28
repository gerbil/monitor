<?php

$url = "http://op5.corp.tele2.com/monitor/index.php/default/show_login";
$user_cookie = "/var/www/html/monitor/wp-content/themes/monitor/db/cookie.txt";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'username=guest&password=guest&csrf_token=8rF2yE2h8H2eUt3fNlZj2nnp0o9jXzliM5vgBLixV');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_COOKIEJAR, $user_cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $user_cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $user_cookie);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
   
$result = curl_exec($ch);

$fp = fopen('/var/www/html/monitor/wp-content/themes/monitor/db/data.txt', 'w');
fwrite($fp, $result);
fclose($fp);

curl_close($ch);