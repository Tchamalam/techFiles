<? 
	ob_start();
	error_reporting(0);
	session_start();
if (strpos($_SERVER['REQUEST_URI'],"yonetim")){
	if(!array_key_exists('oturum', $_SESSION)){ header("location:index.php"); exit();} 
}
?>

<?php $dillink = "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'].""; ?>
<div class="nav nav-default">
	<div class="navbar navbar-default">
		<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="anasayfa.php"><?php echo $siteadi?> Admin Paneli</a>
		</div>
		
		<div class="navbar-collapse collapse navbar-responsive-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="dildegistir.php?dil=1&link=<?php echo $dillink?>"><span <?php if($_SESSION['dil'] == 1){ ?>class="dilstyle"<?php } ?>>TR</span></a></li>
				<li><a href="anasayfa.php"><span class="glyphicon glyphicon-home form-control-feedback"></span>&nbsp;Anasayfa</a></li>
				<li><a href="<?php echo $ayar['web']?>" target="_blank"><span class="glyphicon glyphicon-refresh form-control-feedback"></span>&nbsp;Siteye Git</a></li>
				<li><a href="ayarlar.php"><span class="glyphicon glyphicon-wrench form-control-feedback"></span>&nbsp;Site Ayarları</a></li>
				<li><a href="sayfasirala.php"><span class="glyphicon glyphicon-list form-control-feedback"></span>&nbsp;Sayfa Sıralamaları</a></li>
				<li class="dropdown">
				    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Merhaba Yönetici <b class="caret"></b></a>
				    <ul class="dropdown-menu">
				      <li><a href="yeniyonetici.php">Yeni Yönetici</a></li>
				      <li><a href="yoneticiler.php">Eklenen Yöneticiler</a></li>
				      <li class="divider"></li>
				      <li><a href="include/cikis.php">Çıkış Yap</a></li>
				    </ul>
			  </li>
			</ul>
		</div>

	</div>
</div>