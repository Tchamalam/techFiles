<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";
	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }

?>

<!DOCTYPE html>

<html class="no-js">

<head>



	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">

	<title><?php echo $siteadi?> Yönetim Paneli</title>



	<link rel="stylesheet" href="css/style.css">

	<link rel="stylesheet" href="css/bootstrap.min.css">



	<!-- Fck Başlangıç -->

	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

	<!-- Fck Bitiş -->



</head>



<body>



	<div class="container">



		<?php include "include/header.php"; ?>



		<div class="row">

			<?php include "include/solmenu.php"; ?>



			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading">

					<h3 class="panel-title">Site Ayarları</h3>

					</div>

					<div class="panel-body">

						<?php

						if(isset($_POST['gonder'])){

							//Seo Meta
							$siteadi 		 	 = tirnak_replace($_POST['siteadi']);
							$yetkili 			 = tirnak_replace($_POST['yetkili']);
							$aciklama 			 = tirnak_replace($_POST['aciklama']);
							$anahtarkelime 		 = tirnak_replace($_POST['anahtarkelime']);

							$siteadien 		 	 = $_POST['siteadien'];
							$yetkilien 			 = $_POST['yetkilien'];
							$aciklamaen 		 = $_POST['aciklamaen'];
							$anahtarkelimeen 	 = $_POST['anahtarkelimeen'];
							
							$siteadiru 		 	 = $_POST['siteadiru'];
							$aciklamaru 		 = $_POST['aciklamaru'];
							$anahtarkelimeru 	 = $_POST['anahtarkelimeru'];
							
							$siteadiar 		 	 = $_POST['siteadiar'];
							$aciklamaar 		 = $_POST['aciklamaar'];
							$anahtarkelimear 	 = $_POST['anahtarkelimear'];
							
							$siteadifr 		 	 = $_POST['siteadifr'];
							$aciklamafr 		 = $_POST['aciklamafr'];
							$anahtarkelimefr 	 = $_POST['anahtarkelimefr'];
							
							//Harita
							$harita 		 	= $_POST['harita'];

							//Sosyal Medya
							$facebook 		 	= $_POST['facebook'];
							$twitter 		 	= $_POST['twitter'];
							$instagram 		 	= $_POST['instagram'];
							$youtube 		 	= $_POST['youtube'];
							$linkedin 		 	= $_POST['linkedin'];
							$google 		 	= $_POST['google'];
							$pinterest			= $_POST['pinterest'];

							//Mail Ayaları
							$mail_server	 	= $_POST['mail_server'];
							$mail_kulad			= $_POST['mail_kulad'];
							$mail_sifresi		= $_POST['mail_sifresi'];
							$mail_port			= $_POST['mail_port'];
							$mail_gidecek 		= $_POST['mail_gidecek'];
							$mail_isim_gidecek	= $_POST['mail_isim_gidecek'];
							$site_mail_adres	= $_POST['site_mail_adres'];

							//Diğer
							$web 			 	= $_POST['web'];
							$iletisim_bilgi 	= $_POST['iletisim_bilgi'];
							$telefon 			= $_POST['telefon'];
							$telefon2 			= $_POST['telefon2'];
							$metrica 		 	= $_POST['metrica'];
							$analytics 		 	= $_POST['analytics'];
														
							
							$guncelle = mysql_query("UPDATE `ayarlar` SET `siteadi`='$siteadi',`yetkili`='$yetkili',`aciklama`='$aciklama',`anahtarkelime`='$anahtarkelime',`email`='$site_mail_adres',`web`='$web',`harita`='$harita',`facebook`='$facebook',`twitter`='$twitter',`instagram`='$instagram',`metrica`='$metrica',`analytics`='$analytics',`siteadien`='$siteadien',`aciklamaen`='$aciklamaen',`anahtarkelimeen`='$anahtarkelimeen',`siteadiru`='$siteadiru',`aciklamaru`='$aciklamaru',`anahtarkelimeru`='$anahtarkelimeru',`siteadiar`='$siteadiar',`aciklamaar`='$aciklamaar',`anahtarkelimear`='$anahtarkelimear',`siteadifr`='$siteadifr',`aciklamafr`='$aciklamafr',`anahtarkelimefr`='$anahtarkelimefr',`google`='$google',`iletisim_bilgi`='$iletisim_bilgi',`telefon`='$telefon',`linkedin`='$linkedin',`pinterest`='$pinterest',`mail_server`='$mail_server',`mail_kulad`='$mail_kulad',`mail_sifresi`='$mail_sifresi',`mail_port`='$mail_port',`mail_gidecek`='$mail_gidecek',`mail_isim_gidecek`='$mail_isim_gidecek',`site_mail_adres`='$site_mail_adres' WHERE id='1'");

							if($guncelle){

								echo '<div class="alert alert-success">Site Ayarları Başarıyla Düzenlendi.</div>';

							} else {

								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}

						}



						$ayar = mysql_fetch_assoc(mysql_query("SELECT * FROM ayarlar WHERE id='1'"));

						?>

						<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>">

							<fieldset>

							<div id="myTabContent" class="tab-content">

								<ul class="nav nav-tabs" style="margin-bottom: 15px;">
								  <li class=""><a href="#seometa" data-toggle="tab">Seo / Meta Verileri</a></li>								  
								  <li class=""><a href="#harita" data-toggle="tab">Harita Bilgileri</a></li>
								  <li class=""><a href="#sosyal" data-toggle="tab">Sosyal Medya</a></li>	
								  <li class=""><a href="#mail" data-toggle="tab">Mail Ayarları</a></li>						  
								  <li class=""><a href="#diger" data-toggle="tab">Diğer</a></li>
								</ul>

								<div class="tab-pane fade active in" id="seometa">

									<div class="form-group">

										<label for="inputEmail" class="col-lg-2 control-label">Site Başlığı</label>

										<div class="col-lg-10">

										<input type="text" class="form-control" id="inputEmail" name="siteadi" value="<?php echo $ayar['siteadi']?>" placeholder="Site Başlığı">

										</div>

									</div>


									<div class="form-group">

										<label for="inputEmail" class="col-lg-2 control-label">Yetkili</label>

										<div class="col-lg-10">

										<input type="text" class="form-control" id="inputEmail" name="yetkili" value="<?php echo $ayar['yetkili']?>" placeholder="Yetkili">

										</div>

									</div>

									<div class="form-group">

										<label for="textArea" class="col-lg-2 control-label">Açıklama</label>

										<div class="col-lg-10">

										<textarea class="form-control" rows="3" id="textArea" name="aciklama" placeHolder="Yaptığınız işi tanımlayan kısa bir açıklama yazısı yazınız"><?php echo $ayar['aciklama']?></textarea>

										</div>

									</div>

									<div class="form-group">

										<label for="textArea" class="col-lg-2 control-label">Anahtar Kelimeler</label>

										<div class="col-lg-10">

										<textarea class="form-control" rows="3" id="textArea" name="anahtarkelime" placeHolder="Aralarına virgül koyarak anahtar kelimelerinizi belirtiniz"><?php echo $ayar['anahtarkelime']?></textarea>

										</div>

									</div>


								</div>

								<div class="tab-pane fade" id="harita">

									<div class="form-group">

										<label for="textArea" class="col-lg-2 control-label">Google Maps</label>

										<div class="col-lg-10">

										<textarea class="form-control" rows="6" id="textArea" name="harita" placeHolder="Google Maps Haritanızı Buraya Yerleştiriniz"><?php echo $ayar['harita']?></textarea>

										</div>

									</div>

								</div>

								<div class="tab-pane fade" id="sosyal">

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Facebook Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="facebook" value="<?php echo $ayar['facebook']?>" placeholder="Facebook Adresiniz">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Twitter Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="twitter" value="<?php echo $ayar['twitter']?>" placeholder="Twitter Adresiniz">
										</div>
									</div>
                                    
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Instagram Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="instagram" value="<?php echo $ayar['instagram']?>" placeholder="Instagram Adresiniz">
										</div>
									</div>
                                    
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Google Plus Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="google" value="<?php echo $ayar['google']?>" placeholder="Google Plus Adresiniz">
										</div>
									</div>
                                    
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Linkedin Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="linkedin" value="<?php echo $ayar['linkedin']?>" placeholder="Linkedin Adresiniz">
										</div>
									</div>
                                    
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Pinterest Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="pinterest" value="<?php echo $ayar['pinterest']?>" placeholder="Pinterest Adresiniz">
										</div>
									</div>

								</div>

								<div class="tab-pane fade" id="mail">

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">SMTP Mail Server</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_server" value="<?php echo $ayar['mail_server']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">SMTP Mail Kullanıcı Adı</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_kulad" value="<?php echo $ayar['mail_kulad']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">SMTP Mail Şifresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_sifresi" value="<?php echo $ayar['mail_sifresi']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">SMTP Giden Port</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_port" value="<?php echo $ayar['mail_port']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Hangi Mailden Gidecek</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_gidecek" value="<?php echo $ayar['mail_gidecek']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Hangi İsimden Gidecek</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="mail_isim_gidecek" value="<?php echo $ayar['mail_isim_gidecek']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Site Mail Adresi (İletişim İçin)</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="site_mail_adres" value="<?php echo $ayar['site_mail_adres']?>">
										</div>
									</div>

								</div>

								<div class="tab-pane fade" id="diger">

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Web Adresi</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="web" value="<?php echo $ayar['web']?>" placeholder="http://www.siteadi.com/ şeklinde yazınız">
										</div>
									</div>

									<div class="form-group">
										<label for="textArea" class="col-lg-2 control-label">Adres Bilgileri</label>
										<div class="col-lg-10">
										<textarea class="form-control" rows="3" id="textArea" name="iletisim_bilgi"><?php echo $ayar['iletisim_bilgi']?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Telefon</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="telefon" value="<?php echo $ayar['telefon']?>">
										</div>
									</div>

									<div class="form-group">
										<label for="textArea" class="col-lg-2 control-label">Metrica</label>
										<div class="col-lg-10">
										<textarea class="form-control" rows="3" id="textArea" name="metrica" placeHolder="Yandex Metrica Kodunuzu Yazınız"><?php echo $ayar['metrica']?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="textArea" class="col-lg-2 control-label">Analytics</label>
										<div class="col-lg-10">
										<textarea class="form-control" rows="3" id="textArea" name="analytics" placeHolder="Google Analytics Kodunuzu Yazınız"><?php echo $ayar['analytics']?></textarea>
										</div>
									</div>

								</div>

							</div>	

							<div class="form-group">

								<div class="col-lg-10 col-lg-offset-2">

									<button name="gonder" type="submit" class="btn btn-default">Site Ayarlarını Düzenle</button>

								</div>

							</div>

						</fieldset>

					</form>

					</div>

				</div>



			</div>

		</div>



	</div>



	<?php include "include/footer.php"; ?>



	<script src="js/jquery.js"></script>

	<script src="js/bootstrap.min.js"></script>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	    <script src="js/sortable.js"></script>
        <script type="text/javascript">

		$(function() {
		  $("#test-list").sortable({
		    update:function(){
		      var posted = $(this).sortable("serialize");
		      $.post("anasiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>

	<script type="text/javascript">

	    CKEDITOR.replace( 'editor1',
			{
			filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php',
			filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Flash',
			filebrowserUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Flash'
			}
		);

		CKEDITOR.replace( 'editor2',
			{
			filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php',
			filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Flash',
			filebrowserUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Flash'
			}
		);

		CKEDITOR.replace( 'editor3',
			{
			filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php',
			filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Flash',
			filebrowserUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Flash'
			}
		);

	</script>



</body>

</html>