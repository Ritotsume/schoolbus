<?php

ob_start();

ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Content-Type: text/html;charset=utf-8');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
header('X-Frame-Options: sameorigin');
header('Pragma: no-cache');
header('Expires: -1');
header('X-Permitted-Cross-Domain-Policies: master-only');

session_cache_expire(30);
session_start();

include_once './app/Config.inc.php';
$login = $_SESSION;
$url_home = HOME;
if(isset($login['schoolbus_login']) && !empty($login['schoolbus_login']))
{
  include_once './header.php';
  include_once './sidebar.php';
  include_once './content.php';
  include_once './footer.php';
}else{
  header("Location: {$url_home}login.php");
}
ob_flush();
