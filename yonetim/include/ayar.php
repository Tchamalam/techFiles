<?php
ob_start();
session_start();
$dbhost  = "localhost";   
$dbkullanici = "technrol_sql";
$dbsifre  = "MASuexMiPkzT";
$dbadi = "technrol_sql"; 
$baglan = mysql_connect($dbhost,$dbkullanici,$dbsifre);
mysql_query("SET NAMES 'utf8'");
if(!$baglan)
   { ('MYSQL Baglanamiyor..!!');}  
else
   { ('MYSQL baglantisi kuruldu...'); }
mysql_select_db($dbadi,$baglan) or die ("Veri Tabanina Baglanamiyor");
$ip=$_SERVER['REMOTE_ADDR'];
$ayar = mysql_fetch_assoc(mysql_query("SELECT * FROM ayarlar WHERE id=1"));
$siteadi = $ayar["siteadi"];
$web = $ayar["web"];

$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>