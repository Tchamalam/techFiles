<?php
ob_start();
session_start();
/*
define('BASEPATH', "");
require_once '../../../../application/config/config.php';


$cookie = @$_COOKIE[ $config['sess_cookie_name'] ];
if (!preg_match("#adminUsername#si", $cookie)){
die("Yetkisiz erisim!!");
exit;
}
*/
if (!$_SESSION["oturum"]){
 //echo "Yetkisi Erişim";
 exit();
}

require "core/autoload.php";
$browser = new browser();
$browser->action();

?>