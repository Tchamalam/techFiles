<?php

ob_start();
include "include/ayar.php";
include "include/tirnak.php";

$id = mysql_real_escape_string($_GET["id"]);
$resim = mysql_fetch_assoc(mysql_query("SELECT * FROM blogresimler WHERE id='$id'"));
$res_ad = "../".$resim['resim'];

if(file_exists($res_ad)){
    unlink("$res_ad");
    mysql_query("DELETE FROM blogresimler WHERE id='$id'");
    header("Location: ".$_SERVER['HTTP_REFERER']);
}

?> 