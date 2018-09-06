<?php
	include "yonetim/include/ayar.php";
	include "function.php";

	$menu = array(
		'anasayfa' 		=> "PAGE D'ACCUEIL",
		'kurumsal'	 	=> 'COMPAGNIE',
		'urunler'		=> 'PRODUITS',
        'uretim'		=> 'PRODUCTION',
		'blog'			=> 'BLOG',
		'iletisim' 		=> 'CONTACT'
	);
	$menualt = array(
		'menu' 		=> 'MENÜ',
		'anasayfa' 		=> 'Anasayfa',
		'hakkimizda' 	=> 'Kurumsal',
		'urunler'		=> 'Ürünlerimiz',
        'franchising'	=> 'Franchising',
		'blog'			=> 'Blog',
		'haberler' 		=> 'Haberler',
		'iletisim' 		=> 'İletisim',
		'sosyalmedya' 	=> 'SOSYAL MEDYA',
		'takip' 		=> 'Bizi Sosyal Medyadan Takip Edebilirsiniz...',
		'takipci' 		=> 'Takipçi',
		'begeni' 		=> 'Beğeni',
		'ebultenyazi'	=> 'E-Bültene Kaydolarak Bizi Daha Yakından Takip Edebilirsiniz !',
		'ebultenkaydol'	=> 'Kaydol',
		'adres'			=> 'Adres',
		'telefon'		=> 'Tel',
		'email'			=> 'E-posta',
		'ebultenemailyaz'	=> 'E-Posta Adresiniz...'
	);


	
	$genel = array(
		'tumurunler' 	=> 'TOUTES LES CATÉGORIES DE PRODUITS',
		'urunkod'		=> 'Code Produit : ', 
		'rafblog' 		=> 'RAFF TEKSTILE BLOG',
		'rafvideo' 		=> 'RAFF TEKSTILE VIDÉO',
		'ebulten' 		=> 'E-BULLETIN INSCRIPTION',
		'ebultenyazi'	=> 'Inscrivez-vous à notre newsletter électronique pour être informé',
		'takip'			=> 'Suivez-nous!',
		'sosyalmedya'	=> 'Suivez-nous les comptes sociaux.',
		'kayitol'		=> 'Registre',
		'emailyaz' 		=> "Tapez votre adresse email",
		'ad' 			=> "Prénom",
		'soyad' 		=> "Nom de famille",
		'telefon' 		=> "Téléphone",
		'email' 		=> "E-Mail",
		'mesaj' 		=> "Message",
		'gonder' 		=> "ENVOYER",
	);

	$ayar = mysql_fetch_assoc(mysql_query("SELECT * FROM ayarlar WHERE id='1'"));
		$ayarlar = array(
			'siteadi' 				=> $ayar['siteadi'],
			'aciklama' 				=> $ayar['aciklama'],
			'anahtarkelimeler' 		=> $ayar['anahtarkelime'],
			'anasayfahakkimizda' 	=> $ayar['anhak'],
			'projeyazisi' 			=> $ayar['proje'],
			'facebook' 				=> $ayar['facebook'],
			'twitter' 				=> $ayar['twitter'],
			'skype' 				=> $ayar['skype'],
			'youtube' 				=> $ayar['youtube'],
			'web' 					=> $ayar['web'],
            'harita' 				=> $ayar['harita'],
            'anhak' 				=> $ayar['anhak'],
            'site_mail_adres'       => $ayar['site_mail_adres'],
            'iletisim_bilgi'		=> $ayar['iletisim_bilgi'],
            'telefon'				=> $ayar['telefon'],
            'iletisim_bilgi2'		=> $ayar['iletisim_bilgi2'],
            'telefon2'				=> $ayar['telefon2']
		);

	
	$sayfalar = array(
		'baslik' => 'baslik',
        'kisa_yazi' => 'kisa_yazi',
		'yazi' => 'yazi',
		'altslogan' => 'bslogan1'
	);
	$anasayfayaz = array(
		'slogan1' => 'slogan1',
		'slogan2' => 'slogan2',
        'blog1baslik' => 'blog1baslik',
        'blog1yazi' => 'blog1yazi',
        'blog2baslik' => 'blog2baslik',
        'blog2yazi' => 'blog2yazi',
        'blog3baslik' => 'blog3baslik',
        'blog3yazi' => 'blog3yazi',
        'blog4baslik' => 'blog4baslik',
        'blog4yazi' => 'blog4yazi',
	);

    $banner = array(
        'slogan'  => 'slogan',
        'slogan1' => 'slogan1',
		'slogan2' => 'slogan2'
	);

	$iletisim = array(
		'adsoyad' 			=> 'Ad Soyad',
		'email' 			=> 'E-Mail Adresiniz',
		'telefon' 			=> 'Telefon Numaranız',
		'mesaj' 			=> 'Mesajınız',
		'gonder' 			=> 'Gönder',
		'vazgec' 			=> 'Vazgeç',
        'adres1'            => 'Adres',
        'telefon1'          => 'Telefon',
        'eposta1'           => 'E-Posta',
		'iletisimbilgileri' => 'İletişim Bilgilerimiz',
		'uyariadsoyad' => 'Lütfen Adınızı ve Soyadınızı Belirtiniz',
		'uyariemail' => 'Lütfen E-Mail Adresinizi Belirtiniz',
		'uyaritelefon' => 'Lütfen Telefon Numaranızı Belirtiniz',
		'uyarimesaj' => 'Lütfen Mesajınızı Yazınız',
        'contact_alert' => 'Mesajınız başarıyla gönderilmiştir.'
	);

	$error = array(
		'ileteror1' => 'Lütfen Ad Soyad Alanını Boş Bırakmayınız.',
		'ileteror2' => 'Lütfen E-Mail Adresi Alanını Boş Bırakmayınız.',
		'ileteror3' => 'Lütfen Geçerli Bir E-Mail Adresi Giriniz.',
		'ileteror4' => 'Lütfen Mesaj Alanını Boş Bırakmayınız.'
	);

	$error2 = array(
		'ileteror1' => 'Lütfen Ad Soyad Alanını Boş Bırakmayınız.',
		'ileteror2' => 'Lütfen E-Mail Adresi Alanını Boş Bırakmayınız.',
		'ileteror3' => 'Lütfen Geçerli Bir E-Mail Adresi Giriniz.',
		'ileteror4' => 'Lütfen Mesaj Alanını Boş Bırakmayınız.',
		'ileteror5' => 'Lütfen E-Mail Adresi Alanını Boş Bırakmayınız.',
		'ileteror6' => 'Lütfen Geçerli Bir E-Mail Adresi Giriniz.',
		'ileteror7' => 'Lütfen Mesaj Alanını Boş Bırakmayınız.'
	);

?>