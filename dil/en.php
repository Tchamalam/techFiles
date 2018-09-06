<?php
	include "yonetim/include/ayar.php";
	include "function.php";

	
	$menu = array(
		'anasayfa' 		=> 'HOME',
		'kurumsal'	 	=> 'COMPANY',
		'urunler'		=> 'PRODUCTS',
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

	$ik = array(
		'1' => 'İnsan Kaynakları',
		'2' => 'Sizide aramıza bekleriz!',
		'3' => 'Kısa yazı',
		'4' => 'Başvuru Formu',
		'5' => 'Ad Soyad',
		'6' => 'Doğum Tarihiniz',
		'7' => 'Hangi Şehirde Çalışmak İstersiniz ?',
		'8' => 'Halen Çalışmakta Mısınız ?',
		'9' => 'Cevabınız Hayır İse Hangi Dalda ?',
		'10' => 'Eğitim Durumunuz',
		'11' => 'Medeni Haliniz',
		'12' => 'Eposta Adresiniz',
		'13' => 'Telefon Numaranız',
		'14' => 'Hangi Bölüm İçin Başvuruyorsunuz ?',
		'15' => 'Hangi Şube İçin Başvuruyorsunuz ?',
		'16' => 'Referanslarınız',
		'select' => 'Seçiniz',
		'okul1' => 'İlkokul',
		'okul2' => 'Ortaokul',
		'okul3' => 'Lise',
		'okul4' => 'Üniversite',
		'okul5' => 'Master',
		'medeni1' => 'Evli',
		'medeni2' => 'Bekar',
		'basvuru1' => 'Temizlik',
		'basvuru2' => 'Servis',
		'basvuru3' => 'Barista',
		'basvuru4' => 'M. Yöneticisi'
	);

	


	
	$genel = array(
		'tumurunler' 	=> 'ALL PRODUCT CATEGORY',
		'katalogyazi' 	=> 'Click to see Catalogue 2017',
		'rafblog' 		=> 'RAFF TEKSTILE BLOG',
		'rafvideo' 		=> 'RAFF TEKSTILE VIDEO',
		'ebulten' 		=> 'E-BULLETIN REGISTRATION',
		'ebultenyazi'	=> 'Register to our e-newsletter to be informed',
		'takip'			=> 'Follow us!',
		'sosyalmedya'	=> 'Follow us social media accounts.',
		'kayitol'		=> 'Register',
		'emailyaz' 		=> "Type your email address",
		'ad' 			=> "Name",
		'soyad' 		=> "Surname",
		'telefon' 		=> "Phone",
		'email' 		=> "E-Mail",
		'mesaj' 		=> "Message",
		'gonder' 		=> "SEND",
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