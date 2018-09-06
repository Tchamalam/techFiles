<?
  ob_start();
  session_start();
  include "yonetim/include/ayar.php";
  include "function.php";
  $ayar = mysql_fetch_assoc(mysql_query("SELECT * FROM ayarlar WHERE id='1'"));
  if($_SESSION['dil'] == ""){
    $_SESSION['dil'] = 1;
  }
  if($_SESSION['dil'] == 1){ include "dil/tr.php"; } elseif($_SESSION['dil'] == 2){ include "dil/en.php"; }else { include "dil/tr.php"; }
function tirnak_replaces ($par)
{
	return str_replace(
		array("&quot;"), array('"'),	$par);
}
$menudeger=1;
$page=mysql_fetch_object(mysql_query("select * from sayfa where id='1' and dil='".$_SESSION['dil']."'"));
?>
<!DOCTYPE html>
<html lang="tr">
<!--*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*
İnce Fikirler | Avcı Kimya (c) 2015
Proje Başlangıç Tarihi : 11/11/2015
Fihrist:
1. Metatagler ve cssler, bootstrap
2. Site Genel Yapıları
	2.1. Header
		2.1.1. Navigasyon
		2.1.2. Sosyal İkonlar
	2.2. Content
        2.2.2 Menülerimiz
        2.2.3 Avcı Kimya
	2.3. Footer
	2.4. Scriptler
*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<base href="<?=$ayar['web']?>">  
<title><?=$ayar['siteadi']?></title>
<meta name="description" content="<?=$ayar['aciklama']?>">
<meta name="keywords" content="<?=$ayar['anahtarkelime']?>">
<meta name="author" content="<?=$ayar['yetkili']?>">
<link href="css/bootstrap.min.css" type="text/css" rel="stylesheet">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link href="css/if-slider.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/modernizr.custom.28468.js"></script>
<script src="js/if-slider.js" type="text/javascript" charset="utf-8"></script>
<link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="page-index main-container">
  <? include("header.php"); ?>
  <a name="ifslider"></a>
  <section class="ifslider-container">
      <div class="ifslider-control left inactive"></div>
      <div class="ifslider-control right"></div>
    <div class="ifslider">
    <? $s=0;
	   $sql_banner=mysql_query("select * from banner where dil='".$_SESSION['dil']."' order by ordernum asc");
	   while($banners=mysql_fetch_object($sql_banner)){   
		  $slideleft=$j."00";
		  $bgleft=$slideleft/2;
	?>
      <div class="ifslide ifslide-<?=$s?> <? if($s==0){ ?> active <? } ?>" style="left:<?=$j?>00%;">
        <div class="ifslide-bg" style="background:url(<?=$banners->baslik?>);background-position:top center; left:-<?=$bgleft?>%;" ></div>
        <div class="ifslide-content">
          <div class="container">
            <div class="ifslide-text">
              <h2 class="ifslide-text-heading"><?=$banners->slogan?></h2>
              <p class="ifslide-text-desc"><?=$banners->slogan1?></p>
              <p class="ifslide-text-desc2"><?=$banners->slogan2?></p>
              <a class="ifslide-text-link"><span>Hakkımızda</span></a> </div>
          </div>
        </div>
      </div>
      <? $s++; $j++;} ?>
    </div>
    <div class="banner-overlay"></div>
  </section>
  <section id="main">
  	<div class="container">
    	<div class="col-md-6 col-sm-6 col-xs-12">
        	<div class="urunozellikler">
        		<h1>ÜRÜNLER</h1>
        		<h3>Teknik Özellikleri</h3>
                <div class="lines"></div>
	                <div class="block">
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft"><img src="images/icon1.png" width="36" height="34"><h5>|</h5><h4>HUNTPOL</h4></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft">Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin</div>
                 	</div>
	                <div class="block">
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft"><img src="images/icon2.png" width="36" height="35"><h5>|</h5><h4>HUNTPOL</h4></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft">Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin</div>
                 	</div>
	                <div class="block">
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft"><img src="images/icon3.png" width="34" height="26"><h5>|</h5><h4>HUNTPOL</h4></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 noleft">Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin</div>
                 	</div>
            </div>
        </div>
   	  <div class="col-md-6 col-sm-6 col-xs-12"><img src="images/yuvarlak.png" class="img-responsive daire"></div>
        <div class="col-md-12 col-sm-12 col-xs-12 center"><img src="images/slide.png"  class="img-responsive" style="margin:auto;text-align:center;"></div>
    </div>
  </section>
</div>
<? include("footer.php"); ?>
</body>
</html>
