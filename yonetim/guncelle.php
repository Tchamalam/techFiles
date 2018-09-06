<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }
	function sef($string)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$string = strtolower(str_replace($find, $replace, $string));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		return $string;
	}


	$id = mysql_real_escape_string($_GET['id']);

	$sql=mysql_query("select * from urunler order by ids asc");
	while($kayit=mysql_fetch_object($sql)){
		$baslik=sef($kayit->baslik);
		$baslikseo=$baslik."-".$kayit->id;
		mysql_query("UPDATE `urunler` SET `baslikseo`='".$baslikseo."' WHERE ids='".$kayit->ids."' ");
	}
	echo "bitti";