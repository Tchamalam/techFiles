<?
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
?>
<!doctype html>
<html class="no-js" lang="tr">
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

	<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
	<meta property="og:image" content="http://technroll.com.tr/images/social_technroll.jpg" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	<link rel="stylesheet" href="toastr/toastr.min.css">
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
<body id="body" class="tg-home tg-homeone">
	<div id="status">
		<!--<div id="preloader" class="preloader">
			<img src="images/Loader.gif" alt="Preloader" />
		</div>-->
	</div>
	<div id="tg-wrapper" class="tg-wrapper tg-haslayout">
		<? include "header.php"; ?>

		<div id="tg-homebanner" class="tg-homebanner tg-haslayout">
        <? $sql_banner=mysql_query("select * from banner where dil='".$_SESSION["dil"]."' order by ordernum asc");
            while($banners=mysql_fetch_object($sql_banner)){
        ?>
			<figure class="tg-themepostimg">
				<img src="<?=$banners->baslik?>" alt="Tech'n Roll">
				<figcaption>
					<div class="tg-bannercontent" data-tilt>
						<span class="tg-datetime"><?=$banners->slogan?></span>
						<h1><span><?=$banners->slogan1?></span></h1>
						<div class="tg-speakerinfo">
							<div class="tg-authorholder">
								<div class="tg-authorcontent">
									<div class="tg-speakername">
										<span class="tg-eventcatagory"><?=$banners->slogan2?></span>
										<h2></h2>
										<a class="tg-btnviewall" href="#"></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</figcaption>
			</figure>
		<? } ?>
		</div>

		<main id="tg-main" class="tg-main tg-haslayout">

		<? $anasayfa=mysql_fetch_object(mysql_query("select * from anasayfa where id='1' and dil='".$_SESSION["dil"]."'")); ?>
			<section class="tg-sectionspace tg-haslayout" id="whattechnroll">
				<div class="container">
					<div class="row">
						<div class="tg-aboutus">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="tg-textshortcode">
									<div class="tg-sectionhead tg-textalignleft">
										<div class="tg-sectionheading">
											<span><?=$anasayfa->baslik?></span>
											<h2><?=$anasayfa->kisa_yazi?></h2>
										</div>
										<div class="tg-description">
											<?=$anasayfa->yazi?>
										</div>
										<div class="tg-btnarea">
											<a class="tg-btn" href="techn-roll-nedir">Detay</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="tg-videoarea">
									<figure>
										<img src="<?=$anasayfa->resim?>" alt="image description">
									</figure>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

		<? $anasayfa2=mysql_fetch_object(mysql_query("select * from anasayfa where id='2' and dil='".$_SESSION["dil"]."'")); ?>
			<section class="tg-haslayout">
				<div class="container-fluid">
					<div class="row">
						<div class="tg-counterarea">
							<div class="tg-eventinfo">
								<figure class="tg-themepostimg">
									<img src="<?=$anasayfa2->resim?>" alt="image description">
									<figcaption>
										<time class="tg-timedate" datetime="2018-12-12"><?=$anasayfa2->baslik?></time>
										<h2><?=$anasayfa2->kisa_yazi?> <span><?=$anasayfa2->yazi?></span></h2>
									</figcaption>
								</figure>
							</div>
							<div id="tg-upcomingeventcounter" class="tg-upcomingeventcounter"></div>
						</div>
					</div>
				</div>
			</section>

		<? $anasayfa3=mysql_fetch_object(mysql_query("select * from sayfa where id='2' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-schedule" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-eventconfrences">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-headholder">
									<div class="tg-sectionhead tg-textalignleft">
										<div class="tg-sectionheading">
											<span><?=$anasayfa3->kisa_yazi?></span>
											<h2><?=$anasayfa3->baslik?></h2>
										</div>
										<div class="tg-description">
											<?=$anasayfa3->yazi?>
										</div>
									</div>
								</div>
								<di2v class="tg-eventscheduletabs">
									<ul class="tg-eventschedulenav" role="tablist">
										<? $j=0;
										   $sql_program=mysql_query("select * from sayfa where katid='2' and dil='".$_SESSION["dil"]."' order by ordernum asc");
								           while($programs=mysql_fetch_object($sql_program)){
								           $j++;
								        ?>
										<li role="presentation" <? if($j=="1"){ ?> class="active" <? } ?>><a href="#kat<?=$programs->id?>" aria-controls="kat<?=$programs->id?>" role="tab" data-toggle="tab"><?=$programs->baslik?><span><?=$programs->kisa_yazi?></span></a></li>
										<? } ?>
									</ul>
									<div class="tg-eventschedulecontent tab-content">
									<? $k=0;
									   $sql_program2=mysql_query("select * from sayfa where katid='2' and dil='".$_SESSION["dil"]."' order by ordernum asc");
							           while($programs2=mysql_fetch_object($sql_program2)){
							           $k++;
							        ?>
										<div role="tabpanel" class="tab-pane <? if($k=="1"){ ?> active <? } ?>" id="kat<?=$programs2->id?>">
											<div class="tg-eventschaduletime">
												<h2><?=$programs2->baslik?></h2>
												<h3><?=$programs2->kisa_yazi?></h3>
											</div>
											<div class="tg-eventvenuetabs">
												<ul class="tg-eventvenuenav" role="tablist">
													<? $s=0;
													   $sql_program3=mysql_query("select * from sayfa where katid='".$programs2->id."' and dil='".$_SESSION["dil"]."' order by ordernum asc");
											           while($programs3=mysql_fetch_object($sql_program3)){
											           $s++;
											        ?>
													<li role="presentation" class="<? if($s=="1"){ ?>active <? } ?>bolum<?=$s?>"><a href="#kat<?=$programs3->id?>" aria-controls="kat<?=$programs3->id?>" role="tab" data-toggle="tab"><?=$programs3->baslik?></a></li>
													<? } ?>
												</ul>
												<div class="tab-content">
													<? $t=0;
													   $sql_program4=mysql_query("select * from sayfa where katid='".$programs2->id."' and dil='".$_SESSION["dil"]."' order by ordernum asc");
											           while($programs4=mysql_fetch_object($sql_program4)){
											           $t++;
											        ?>
													<div role="tabpanel" class="tab-pane <? if($t=="1"){ ?> active <? } ?>" id="kat<?=$programs4->id?>">
													<? 
													   $sql_program5=mysql_query("select * from sayfa where katid='".$programs4->id."' and dil='".$_SESSION["dil"]."' order by ordernum asc");
											           while($programs5=mysql_fetch_object($sql_program5)){
											        ?>
											        <div class="tg-event">
											           <div class="row">
											        	<div class="col-md-2">
											        		<figure>
																<img src="<?=$programs5->resim?>" alt="image description">
															</figure>
											        	</div>
														<div class="col-md-10">
																<div class="tg-eventhead">
																	<div class="tg-leftarea">
																		<time datetime="2017-12-12"><?=$programs5->kisa_yazi?></time>
																		<div class="tg-title">
																			<h2><?=$programs5->baslik?></h2>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<? } ?>
													</div>
													<? } ?>													
												</div>
											</div>
										</div>
										<? } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<section class="tg-askquestions tg-haslayout tg-sectionspace tg-bglight" id="sss">
				<div class="container">
					<div class="row">

						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="tg-sectionhead tg-textalignleft">
								<div class="tg-sectionheading">
									<span>Merak Edilenler</span>
									<h2>Sıkça Sorulan Sorular</h2>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="tg-faqs">
								<div id="tg-accordion" class="tg-accordion" role="tablist" aria-multiselectable="true">
						        <?  $i=0;
						        	$sql_sss=mysql_query("select * from sayfa where katid='3' and dil='".$_SESSION["dil"]."' order by ordernum asc");
						            while($ssss=mysql_fetch_object($sql_sss)){
						            $i++;
						        ?>
									<div class="tg-panel">
										<h4><span><?=$i?>.</span><?=$ssss->baslik?></h4>
										<div class="tg-panelcontent">
											<div class="tg-description">
												<? if ($ssss->id=="11"){ echo $ssss->yazi; }else{ echo $ssss->kisa_yazi; } ?>
											</div>
										</div>
									</div>
								<? if (($i % 4) == 0){ ?>
								</div>
							</div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<div class="tg-faqs">
								<div id="tg-accordion" class="tg-accordion" role="tablist" aria-multiselectable="true">
						<? } } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>

			<? $sponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='52' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponserss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$sponsorlar->kisa_yazi?></span>
									<h2><?=$sponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$sponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<li class="tg-brand" style="border-color: #fff;"><figure><a href="javascript:void(0);" class="sponsorlar"></a></figure></li>
								<? $s=0; $sql_sponsor=mysql_query("select * from resimler where resid='52' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $s++; ?>
								<li class="tg-brand" <? if($s==1){ ?> style="border-left: 0px;" <? } ?>><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="<?=$sponsors->resim?>" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $anasponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='123' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponsers" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$anasponsorlar->kisa_yazi?></span>
									<h2><?=$anasponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$anasponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<li class="tg-brand" style="border-color: #fff;"><figure><a href="javascript:void(0);" class="sponsorlar"></a></figure></li>
								<? $s=0; $sql_sponsor=mysql_query("select * from resimler where resid='123' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $s++; ?>
								<li class="tg-brand" <? if($s==1){ ?> style="border-left: 0px;" <? } ?>><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="thumb.php?src=<?=$sponsors->resim?>&size=260x180" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $anasponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='124' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponserss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$anasponsorlar->kisa_yazi?></span>
									<h2><?=$anasponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$anasponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<?  $j=0; $sql_sponsor=mysql_query("select * from resimler where resid='124' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $j++; ?>
								<li class="tg-brand"><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="thumb.php?src=<?=$sponsors->resim?>&size=260x180" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $anasponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='221' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponserss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$anasponsorlar->kisa_yazi?></span>
									<h2><?=$anasponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$anasponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<?  $j=0; $sql_sponsor=mysql_query("select * from resimler where resid='221' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $j++; ?>
								<li class="tg-brand"><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="thumb.php?src=<?=$sponsors->resim?>&size=260x180" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $anasponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='126' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponserss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$anasponsorlar->kisa_yazi?></span>
									<h2><?=$anasponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$anasponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<?  $j=0; $sql_sponsor=mysql_query("select * from resimler where resid='126' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $j++; ?>
								<li class="tg-brand"><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="thumb.php?src=<?=$sponsors->resim?>&size=260x180" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $sponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='4' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponsersss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$sponsorlar->kisa_yazi?></span>
									<h2><?=$sponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$sponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<?  $j=0; $sql_sponsor=mysql_query("select * from resimler where resid='4' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ $j++; ?>
								<li class="tg-brand"><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="thumb.php?src=<?=$sponsors->resim?>&size=260x180" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<? $sponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='51' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponserss" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$sponsorlar->kisa_yazi?></span>
									<h2><?=$sponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$sponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<? $sql_sponsor=mysql_query("select * from resimler where resid='51' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ ?>
								<li class="tg-brand"><figure><a href="<? if($sponsors->link != ""){ ?><?=$sponsors->link?><? } else { ?>javascript:void(0);<? } ?>" <? if($sponsors->link != ""){ ?>target="_blank"<? } ?> class="sponsorlar"><img src="<?=$sponsors->resim?>" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<!--<? $sponsorlar=mysql_fetch_object(mysql_query("select * from sayfa where id='34' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-sponsers" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-xs-offset-0 col-xs-12 col-sm-offset-0 col-sm-12 col-md-offset-2 col-md-8 col-lg-offset-2 col-lg-8">
							<div class="tg-sectionhead">
								<div class="tg-sectionheading">
									<span><?=$sponsorlar->kisa_yazi?></span>
									<h2><?=$sponsorlar->baslik?></h2>
								</div>
								<div class="tg-description">
									<?=$sponsorlar->yazi?>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="tg-brands">
								<? $sql_sponsor=mysql_query("select * from resimler where resid='34' order by ordernum asc");
								while($sponsors=mysql_fetch_object($sql_sponsor)){ ?>
								<li class="tg-brand"><figure><a href="javascript:void(0);" class="sponsorlar"><img src="<?=$sponsors->resim?>" alt=""></a></figure></li>
								<? } ?>
							</ul>
						</div>
					</div>
				</div>
			</section>-->

			<? $iletisim=mysql_fetch_object(mysql_query("select * from sayfa where id='5' and dil='".$_SESSION["dil"]."'")); ?>
			<section id="tg-venue" class="tg-sectionspace tg-haslayout">
				<div class="container">
					<div class="row">
						<div class="tg-eventvenueregistration">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="tg-headholder">
									<div class="tg-sectionhead tg-textalignleft">
										<div class="tg-sectionheading">
											<span><?=$iletisim->kisa_yazi?></span>
											<h2><?=$iletisim->baslik?></h2>
										</div>

									</div>
								</div>
								<div class="tg-locationregister no-gutters">
									<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
										<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3130.4826485849526!2d26.631903515592235!3d38.314652688686415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14bb905dcd88e679%3A0x325bc54080b37c33!2zVEVLTk9QQVJLIMSwWk3EsFI!5e0!3m2!1str!2str!4v1526559463203" width="100%" height="626" frameborder="0" style="border:0" allowfullscreen></iframe>
										<!--<div id="tg-locationmap" class="tg-locationmap tg-map"></div>-->
									</div>
									<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
										<div class="tg-register">
											<div class="tg-registerholder">
												<div class="tg-registercontent">
													<div class="tg-heading">
														<h2>İletişim Formu</h2>
													</div>
													<form class="tg-formtheme tg-formregister" action="" method="POST">
														<fieldset>
															<div class="form-group">
																<input type="text" name="name" class="form-control" placeholder="Adınız Soyadınız" required>
															</div>
															<div class="form-group">
																<input type="email" name="email" class="form-control" placeholder="E-Posta Adresiniz" required>
															</div>
															<div class="form-group">
																<input type="text" name="phone" class="form-control" placeholder="Telefon Numaranız">
															</div>
															<div class="form-group">
																<textarea name="message" class="form-control" placeholder="Mesajınız" rows="3" required></textarea>
															</div>
															<input type="submit" name="gonder" class="tg-btn" value="Gönder">
														</fieldset>
													</form>
													<div class="tg-sendquery">
														<h2><?=$ayar["iletisim_bilgi"]?></h2>
														<h2 class="contactlink"><a href="tel:<?=$ayar["telefon"]?>"><?=$ayar["telefon"]?></a></h2>
														<h2 class="contactlink"><a href="mailto:<?=$ayar["email"]?>"><?=$ayar["email"]?></a></h2>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>


		</main>

		<footer id="tg-footer" class="tg-footer tg-haslayout">

			<div class="tg-footerbar">
				<a id="tg-btnscrolltop" class="tg-btnscrolltop" href="javascript:void(0);"><i class="icon-chevron-up"></i></a>
				<div class="container">
					<div class="row">
						<!--<p class="tg-copyrights pull-right"><a href="https://www.incefikirler.com" target="_blank" title="Reklam Ajansı İzmir"><img src="images/incefikirler.jpeg" style="width: 100px;margin-left: 20px;"></a></p>-->
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

	<!--div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p><a href="https://docs.google.com/forms/d/e/1FAIpQLSeIgEYTrDJkXNqaFBYCC8Z3YpXQs_8E9oZi8OCyG10_NuXdRA/viewform" target="_blank"><img src="images/tarih uzatıldı-05.png" class="img-responsive"></a></p>
            </div>
          </div>
          
        </div>
    </div-->

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
	<script src="toastr/toastr.min.js"></script>

	<script type="text/javascript">

		<?
          	if(isset($_POST['gonder'])){

              $name      		= $_POST['name'];
              $email          	= $_POST['email'];
              $phone        	= $_POST['phone'];
              $message        	= $_POST['message'];
              
              require_once("class.phpmailer.php");

              $mail = new PHPMailer();
              $mail->IsSMTP();
              $mail->Host = "mail.technroll.com.tr";
              $mail->SMTPAuth = true;
              $mail->Username = "noreply@technroll.com.tr";
              $mail->Password = "0171293";
              $mail->From = "noreply@technroll.com.tr";
              $mail->FromName = "Tech'n Roll İletişim Formu";
              $mail->CharSet = 'UTF-8';
              $mail->AddAddress("engin@incefikirler.com","Tech'n Roll İletişim Formu");
              $mail->AddAddress("erdem@incefikirler.com","Tech'n Roll İletişim Formu");
              $mail->AddAddress("akin@incefikirler.com","Tech'n Roll İletişim Formu");
              $mail->AddAddress("iytetechnroll@gmail.com","Tech'n Roll İletişim Formu");
              $mail->Subject = "Tech'n Roll İletişim Formu";
              $mail->ContentType = 'text/html';
              $mail->Body = "
                  <b>Ad Soyad :</b> ".$name." <br>
                  <b>E-Posta :</b> ".$email." <br>
                  <b>Telefon :</b> ".$phone." <br>
                  <b>Mesaj :</b> ".$message." <br>
              ";

              if($mail->Send()) { ?>
                Command: toastr["success"]("BAŞARILI<br>Mesajınız başarıyla bize ulaştı.");
 				fbq('track', 'CompleteRegistration');
              <? } else { ?>
                Command: toastr["success"]("HATA<br>Beklenmedik bir hata oluştu.Lütfen tekrar deneyiniz!")
              <? }

          }
        ?>
	        toastr.options = {
	          "closeButton": false,
	          "debug": false,
	          "newestOnTop": false,
	          "progressBar": false,
	          "positionClass": "toast-top-right",
	          "preventDuplicates": false,
	          "onclick": null,
	          "showDuration": "300",
	          "hideDuration": "1000",
	          "timeOut": "5000",
	          "extendedTimeOut": "1000",
	          "showEasing": "swing",
	          "hideEasing": "linear",
	          "showMethod": "fadeIn",
	          "hideMethod": "fadeOut"
	        }
	</script>

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

	<script type="text/javascript">
	    $(document).ready(function(){
	        $("#myModal").modal('show');
	    });
	</script>

	<script type="text/javascript">
		/*$(document).ready(function(){
        	$('.bolum1').click(function(){
            	$('.bolum1').addClass("active");
            	$('.bolum2').removeClass("active");
            	$('.bolum3').removeClass("active");
        	});

        	$('.bolum2').click(function(){
            	$('.bolum2').addClass("active");
            	$('.bolum1').removeClass("active");
            	$('.bolum3').removeClass("active");
        	});

        	$('.bolum3').click(function(){
            	$('.bolum3').addClass("active");
            	$('.bolum1').removeClass("active");
            	$('.bolum2').removeClass("active");
        	});
		});*/
	</script>

</body>

</html>