<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }



	$id = mysql_real_escape_string($_GET['id']);

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

	<?php

	$buay  = date("n");

	$buyil = date("Y");

	$buguny= date("w");

	$bugun = date("j");

	$gun_yazi[0]="Pazar";

	$gun_yazi[1]="Pazartesi";

	$gun_yazi[2]="Salı";

	$gun_yazi[3]="Çarşamba";

	$gun_yazi[4]="Perşembe";

	$gun_yazi[5]="Cuma";

	$gun_yazi[6]="Cumartesi";

	$ay_yazi[1]="Ocak";

	$ay_yazi[2]="Şubat";

	$ay_yazi[3]="Mart";

	$ay_yazi[4]="Nisan";

	$ay_yazi[5]="Mayıs";

	$ay_yazi[6]="Haziran";

	$ay_yazi[7]="Temmuz";

	$ay_yazi[8]="Ağustos";

	$ay_yazi[9]="Eylül";

	$ay_yazi[10]="Ekim";

	$ay_yazi[11]="Kasım";

	$ay_yazi[12]="Aralık";

	$buaytxt  = $ay_yazi[$buay];

	$buguntxt = $gun_yazi[$buguny];

	$tarih    = "$bugun $buaytxt $buyil";

	//echo $tarih;

	?>

	<div class="container">



		<?php include "include/header.php"; ?>



		<div class="row">

			<?php include "include/solmenu.php"; ?>



			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading">

					<h3 class="panel-title">Menü Düzenle</h3>

					</div>

					<div class="panel-body">



					<?php

					if(isset($_POST['gonder'])){
						
						$_POST = array_map("tirnak_replace", $_POST);
						$baslik   = $_POST["baslik"];
						$basliken = $_POST["basliken"];
						$kisa_yazi = $_POST["kisa_yazi"];						
						$kisa_yazien = $_POST["kisa_yazien"];
						$yazi = $_POST["yazi"];						
						$yazien = $_POST["yazien"];
						$kat = $_POST["kat"];
						$public = $_POST["public"];

						if($_FILES["dosya"]["size"] > 0){

							// Dosya Upload Başlangıç

							$toplam = count($_FILES["dosya"]["name"]);
							$formatlar = array("image/png","image/jpeg","image/gif");

							$fileName = strtolower($_FILES['dosya']['name']);

							$whitelist = array('jpg', 'png', 'gif', 'jpeg'); #whitelist örneği
							$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

							if(!in_array(end(explode('.', $fileName)), $whitelist)) {
							    
							    echo '<div class="alert alert-danger">Dosya türü desteklenmiyor</div>';

							    //exit(0);
							}

							if(in_array(end(explode('.', $fileName)), $backlist)) {
							    
							    echo '<div class="alert alert-danger">Dosya türü desteklenmiyor</div>';
								//exit(0);

							}

							$noktaArray = array();
							$j=0;
							while ( $j<strlen($fileName) ){
							     if($fileName=="."){
							        array_push($karakter,$noktaArray);
							    }  ++$j; 
							}
							if (count($noktaArray)>1) exit(0);

							$kaynak = $_FILES["dosya"]["tmp_name"];
							$dosyaadi = $_FILES["dosya"]["name"];
							$dosyatipi = $_FILES["dosya"]["type"];
							$dboyut	= $_FILES["dosya"]["size"];
							$hedef = "dosya/";
							$uzanti	= substr($dosyaadi, -4);
							$yeniad = substr(md5(uniqid(rand())), 0,10);
							$yeniresimadi = $hedef.$yeniad.".".$uzanti;
							$a = "../".$hedef.$yeniad.".".$uzanti;
							$yukle = move_uploaded_file($kaynak,$a);

							if ($yukle){
								
								$ekle =  mysql_query("UPDATE menuler SET katid='$kat', public='$public', baslik='$baslik', basliken='$basliken', resim='$yeniresimadi', kisa_yazi='$kisa_yazi', kisa_yazien='$kisa_yazien', yazi='$yazi', yazien='$yazien' WHERE id='$id'");
								
								if($ekle){
									echo '<div class="alert alert-success">Menü Başarıyla Düzenlendi</div>';
									header("Refresh:3;url=menuler.php");
								}else{
									echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
								}

							} else {
								
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}
							
							// Dosya Upload Bitiş

						}else{

							$ekle2 = mysql_query("UPDATE menuler SET katid='$kat', public='$public', baslik='$baslik', basliken='$basliken', kisa_yazi='$kisa_yazi', kisa_yazien='$kisa_yazien', yazi='$yazi', yazien='$yazien' WHERE id='$id'");
								
							if($ekle2){

								echo '<div class="alert alert-success">Menü Başarıyla Düzenlendi</div>';
								header("Refresh:3;url=menuler.php");

							}else{

								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}

						}
					
					}

					$gelen = mysql_fetch_assoc(mysql_query("SELECT * FROM menuler WHERE id='$id'"));

					$resid = mysql_real_escape_string($_GET['resid']);

					if($resid > 0):

						$resim = mysql_fetch_assoc(mysql_query("SELECT * FROM menuler WHERE id='$resid'"));
						$delimg = $resim['resim'];
						if(file_exists("../$delimg")){
							unlink("../$delimg");
							mysql_query("UPDATE menuler SET resim='' WHERE id='$resid'");
							header("Location:menuduzenle.php?id=".$resid);
						}

					endif;

					?>

					<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">

						<div id="myTabContent" class="tab-content">

							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							  <li class="active"><a href="#tr" data-toggle="tab">Türkçe</a></li>
							  <li class=""><a href="#en" data-toggle="tab">İngilizce</a></li>
							</ul>

							<div class="tab-pane fade active in" id="tr">

								<fieldset>
									<?php if($gelen['resim'] != ''): ?>
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Resim</label>
										<div class="col-lg-8">
										<img src="../<?php echo $gelen['resim'];?>" class="img-responsive thumbnail" width="200" />
										<a href="menuduzenle.php?resid=<?php echo $id;?>" class="col-lg-3">Resmi Sil</a>
										</div>
									</div>									
									<?php endif; ?>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Resim</label>
										<div class="col-lg-10">
										<input type="file" class="form-control" id="inputEmail" name="dosya">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kategori</label>
										<div class="col-lg-10">
										<select name="kat" class="form-control">
											<option value="0">Seçiniz</option>
											<?php
												$kategori = mysql_query("select * from kategoriler order by ordernum asc");
												while($kyaz = mysql_fetch_array($kategori)):
											?>
											<option value="<?php echo $kyaz['id'];?>" <?php if($gelen['katid'] == $kyaz['id']): echo "selected"; endif; ?>><?php echo $kyaz['baslik'];?></option>
											<?php endwhile; ?>
										</select>
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Anasayfada Göster</label>
										<div class="col-lg-10">
										Göster <input type="radio" name="public" value="1" <?php if($gelen['public'] == 1): echo "checked"; endif; ?> />
										Gösterme <input type="radio" name="public" value="0" <?php if($gelen['public'] == 0): echo "checked"; endif; ?> />
										</div>
									</div>
									
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="baslik" value="<?php echo $gelen['baslik'];?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kısa Yazı</label>
										<div class="col-lg-10">
										<textarea name="kisa_yazi" class="form-control" placeholder="Kısa Yazı"><?php echo $gelen['kisa_yazi'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
										<textarea name="yazi" id="editor1" placeholder="Açıklama"><?php echo $gelen['yazi'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
											<button name="gonder" type="submit" class="btn btn-default">Menü Düzenle</button>
										</div>
									</div>

								</fieldset>

							</div>

							<div class="tab-pane fade in" id="en">

								<fieldset>
																
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="basliken" value="<?php echo $gelen['basliken'];?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kısa Yazı</label>
										<div class="col-lg-10">
										<textarea name="kisa_yazien" class="form-control" placeholder="Kısa Yazı"><?php echo $gelen['kisa_yazien'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
										<textarea name="yazien" id="editor2" placeholder="Açıklama"><?php echo $gelen['yazien'];?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
											<button name="gonder" type="submit" class="btn btn-default">Menü Düzenle</button>
										</div>
									</div>
									
								</fieldset>

							</div>

						</div>	

					</form>

					</div>

				</div>



			</div>

		</div>



	</div>



	<?php include "include/footer.php"; ?>



	<script src="js/jquery.js"></script>

	<script src="js/bootstrap.min.js"></script>



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