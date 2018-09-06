<?php
	error_reporting(0);
	ob_start();
	session_start();
	include "ayar.php";

	$kadi = htmlspecialchars($_POST["kadi"]);
	$sifre = md5($_POST["sifre"]);

	$kadi = mysql_real_escape_string($kadi);
	$sifre = mysql_real_escape_string($sifre);

	$sorgu=mysql_query("SELECT kadi FROM yonetim WHERE kadi='$kadi' and sifre='$sifre'");
	if(mysql_num_rows($sorgu)>0){

	$kullanici = mysql_fetch_array($sorgu);
	$_SESSION['oturum'] = true;
	$_SESSION['oturum_id'] = $kullanici['id'];
	$_SESSION['dil'] = 1;

	echo '<script language="Javascript">window.location.href="anasayfa.php"</script>';
	
	} else {
		echo '<div class="alert alert-danger">Hatalı Giriş Bilgisi!</div>';
	}

?>