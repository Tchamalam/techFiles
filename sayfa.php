<? $pagenumber = 2;
  ob_start();
  session_start();
  include "yonetim/include/ayar.php";
  include "function.php";
  $ayar = mysql_fetch_assoc(mysql_query("SELECT * FROM ayarlar WHERE id='1'"));

    $_SESSION['dil'] = 1;
  if($_SESSION['dil'] == ""){
    $_SESSION['dil'] = 1;
  }
  if($_SESSION['dil'] == 1){ include "dil/tr.php"; } elseif($_SESSION['dil'] == 2){ include "dil/en.php"; }  elseif($_SESSION['dil'] == 3){ include "dil/fr.php"; } else{ include "dil/tr.php"; }
  function tirnak_replaces ($par)
  {
  return str_replace(
    array("&quot;"), array('"'),  $par);
  }
$menudeger=1;

function veriTemizle($mVar){
    if(is_array($mVar)){
        foreach($mVar as $gVal => $gVar){
            if(!is_array($gVar)){
                    $mVar[$gVal] = htmlspecialchars(strip_tags(urldecode(mysql_escape_string(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($gVar)))))))));  // -> Dizi olmadığını fark edip temizledik.
            }else{
                    $mVar[$gVal] = clearMethod($gVar);
            }
        }
    }else{
        $mVar = htmlspecialchars(strip_tags(urldecode(mysql_escape_string(addslashes(stripslashes(stripslashes(trim(htmlspecialchars_decode($mVar))))))))); // -> Dizi olmadığını fark edip temizledik.
    }
    return $mVar;
}
$id = veriTemizle($_GET['id']);

$page=mysql_fetch_object(mysql_query("select * from sayfa where baslikseo='$id' and dil='".$_SESSION["dil"]."' order by ordernum asc"));
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<base href="<?=$ayar['web']?>">
	<title><?=$ayar['siteadi']?></title>
	<link rel="icon" type="image/x-icon" href="favicon.png" />
	<meta name="description" content="<?=$ayar['aciklama']?>">
	<meta name="keywords" content="<?=$ayar['anahtarkelime']?>">
	<meta name="author" content="<?=$ayar['yetkili']?>">
	<meta name="google-site-verification" content="zdR_mFt3_JqbqyjH1sV0-mV9xaDb9G6LzR3ZKmbWbLg" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
	<meta property="og:image" content="http://technroll.com.tr/images/social_technroll.jpg" />
	
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/customScrollbar.css">
	<link rel="stylesheet" href="css/photoswipe.css">
	<link rel="stylesheet" href="css/default-skin.css">
	<link rel="stylesheet" href="css/prettyPhoto.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window,document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	 fbq('init', '459046017881139'); 
	fbq('track', 'PageView');
	</script>
	<noscript>
	 <img height="1" width="1" 
	src="https://www.facebook.com/tr?id=459046017881139&ev=PageView
	&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
</head>
<body>

	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">

		<? include "header.php"; ?>
		<div class="tg-haslayout tg-parallaxinnerbanner" data-z-index="2" data-appear-top-offset="600" data-parallax="scroll" data-image-src="<?=$page->banner?>">
			<div class="tg-pageinnerbanner tg-parallaximg tg-innerbannerimg">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<div class="tg-pageheadcontent">
								<div class="tg-pagetitle">
									<h1><?=$page->baslik?></h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<main id="tg-main" class="tg-main tg-haslayout">
			<div class="container">
				<div class="row">
					<div id="tg-twocolumns" class="tg-twocolumns tg-sectionspace">

						<? if($page->id == 133){ ?>
							<?
							$r = 1;
							$alt = mysql_query("SELECT * FROM sayfa WHERE katid='133' AND dil='1' ORDER BY ordernum ASC");
							while($altgetir = mysql_fetch_array($alt)){
							?>
								<!--<? if($r == 1){ ?><div class="col-md-12"><h3>Konuşmacı<hr></h3></div><? } ?>
								<? if($r == 4){ ?><div class="col-md-12"><h3>Panelist<hr></h3></div><? } ?>
								<? if($r == 8){ ?><div class="col-md-12"><h3>Konuşmacı<hr></h3></div><? } ?>
								<? if($r == 16){ ?><div class="col-md-12"><h3>Jüri Üyesi<hr></h3></div><? } ?>-->

								<? if($r == 1 OR $r == 4 OR $r == 8 OR $r == 25){ ?><div class="row" style="margin-bottom: 60px;"><? } ?>
									<? if($r < 4){ ?>
										<div class="col-md-3 col-xs-6 techlist" style="margin-bottom: 20px;">
											<img src="<?=$altgetir['resim']?>">
										</div>
									<? } elseif($r < 8){ ?>
										<div class="col-md-3 col-xs-6 techlist" style="margin-bottom: 20px;">
											<img src="<?=$altgetir['resim']?>">
										</div>
									<? } elseif($r < 18){ ?>
										<div class="col-md-3 col-xs-6 techlist" style="margin-bottom: 20px;">
											<img src="<?=$altgetir['resim']?>">
										</div>
									<? } elseif($r < 35){ ?>
										<div class="col-md-3 col-xs-6 techlist" style="margin-bottom: 20px;">
											<img src="<?=$altgetir['resim']?>">
										</div>
									<? } ?>
								<? if($r == 3 OR $r == 7 OR $r == 24 OR $r == 43){ ?></div><? } ?>

							<? $r++; ?>
							<? } ?>
						<? } ?>

						<div class="col-sm-12 col-xs-12 pull-right">
							<div id="tg-content" class="tg-content">
								<article class="tg-post tg-postdetail">
								<?=$page->yazi?>
								</article>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</main>

		<footer id="tg-footer" class="tg-footer tg-haslayout">
			<div class="tg-footerbar">
				<a id="tg-btnscrolltop" class="tg-btnscrolltop" href="javascript:void(0);"><i class="icon-chevron-up"></i></a>
				<div class="container">
					<div class="row">
						<ul class="tg-socialicons pull-right">
							<li class="tg-facebook"><a href="<?=$ayar["facebook"]?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
							<li class="tg-twitter"><a href="<?=$ayar["twitter"]?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
							<li class="tg-instagram"><a href="<?=$ayar["instagram"]?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
						</ul>
						<p class="tg-copyrights pull-left">2018 All Rights Reserved © Tech'n Roll | Konsept <a href="https://www.incefikirler.com" target="_blank">İnce Fikirler</a></p>
					</div>
				</div>
			</div>
		</footer>
	</div>
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
	<script src="js/jquery.singlePageNav.min.js"></script>
	<script src="js/photoswipe-ui-default.js"></script>
	<script src="js/customScrollbar.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/photoswipe.min.js"></script>
	<script src="js/prettyPhoto.js"></script>
	<script src="js/tilt.jquery.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/parallax.js"></script>
	<script src="js/gmap3.js"></script>
	<script src="js/main.js"></script>
</body>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119519345-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-119519345-1');
	</script>

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
	    (function (d, w, c) {
	        (w[c] = w[c] || []).push(function() {
	            try {
	                w.yaCounter48924029 = new Ya.Metrika({
	                    id:48924029,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true,
	                    webvisor:true
	                });
	            } catch(e) { }
	        });

	        var n = d.getElementsByTagName("script")[0],
	            s = d.createElement("script"),
	            f = function () { n.parentNode.insertBefore(s, n); };
	        s.type = "text/javascript";
	        s.async = true;
	        s.src = "https://mc.yandex.ru/metrika/watch.js";

	        if (w.opera == "[object Opera]") {
	            d.addEventListener("DOMContentLoaded", f, false);
	        } else { f(); }
	    })(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/48924029" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->
</html>