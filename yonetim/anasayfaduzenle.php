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

					<h3 class="panel-title">Kayıt Düzenle</h3>

					</div>

					<div class="panel-body">

					<?php
					if(isset($_POST['gonder'])){
						$_POST = array_map("tirnak_replace", $_POST);
						$id = mysql_real_escape_string($_GET['id']);
						

						if($_FILES["dosya"]["size"] > 0){

							$durak = mysql_fetch_assoc(mysql_query("SELECT * FROM anasayfa WHERE id='$id'"));
							$durak_adi = $durak["resim"];

							if(file_exists("../$durak_adi")){
								@unlink("../$durak_adi");
							}

							// Dosya Upload Başlangıç

							$toplam = count($_FILES["dosya"]["name"]);
							$formatlar = array("image/png","image/jpeg","image/gif");

							$fileName = strtolower($_FILES['dosya']['name']);

							$whitelist = array('pdf', 'doc', 'docx', 'xls', 'xlsx'); #whitelist örneği
							$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

							if(!in_array(end(explode('.', $fileName)), $whitelist)) {
							    

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

								$resim = mysql_query("SELECT * FROM anasayfa WHERE id='$id'");

								$gelen_resim = $resim['resim'];

								if(file_exists("../$gelen_resim")){

									unlink("../$gelen_resim");

								}
								
								$sql_dil=mysql_query("select * from diller");
								while($diller=mysql_fetch_object($sql_dil)){
								$baslik = $_POST["baslik".$diller->links];
								$baslik=str_replace("'", "`", $baslik);
								$yazi = $_POST["yazi".$diller->links];
								$yazi=str_replace("'", "`", $yazi);
								$kisa_yazi = $_POST["kisa_yazi".$diller->links];
								$kisa_yazi=str_replace("'", "`", $kisa_yazi);
								$guncelle = mysql_query("UPDATE anasayfa SET baslik='$baslik', resim='$yeniresimadi', kisa_yazi='$kisa_yazi', yazi='$yazi' WHERE id='$id' and dil='".$diller->id."'");
								}
								echo '<div class="alert alert-success">Seçilen Kayıt Başarıyla Düzenlendi..</div>';

							} else {
								
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}
							
							// Dosya Upload Bitiş

						}else{
							$sql_dil=mysql_query("select * from diller");
							while($diller=mysql_fetch_object($sql_dil)){
							$baslik = $_POST["baslik".$diller->links];
							$baslik=str_replace("'", "`", $baslik);
							$yazi = $_POST["yazi".$diller->links];
							$yazi=str_replace("'", "`", $yazi);
							$kisa_yazi = $_POST["kisa_yazi".$diller->links];
							$kisa_yazi=str_replace("'", "`", $kisa_yazi);
							$guncelle = mysql_query("UPDATE anasayfa SET baslik='$baslik', yazi='$yazi', kisa_yazi='$kisa_yazi' WHERE id='$id' and dil='".$diller->id."'");
							}
							if($guncelle){

								echo '<div class="alert alert-success">Seçilen Kayıt Başarıyla Düzenlendi..</div>';

							} else {

								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!h</div>';

							}

						}

					}



					$gelen = mysql_fetch_assoc(mysql_query("SELECT * FROM anasayfa WHERE id='$id'"));

					?>

					<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">

						<div id="myTabContent" class="tab-content">

							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                  <?php $sql_dil=mysql_query("select * from diller");
								  while($diller=mysql_fetch_object($sql_dil)){?>
								  <li><a href="#<?php echo $diller->links?>" data-toggle="tab"><?php echo $diller->baslik?></a></li>
                                  <?php } ?>
							</ul>
							<?php if($gelen['resim'] != ""){ ?>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Dosya</label>
                                <div class="col-lg-10">
                                <img src="../<?php echo $gelen['resim'];?>" class="thumbnail" width="200" />
                                </div>
                            </div>
                            <?php } ?>

                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Dosya</label>
                                <div class="col-lg-10">
                                <input type="file" class="form-control" id="inputEmail" name="dosya">
                                </div>
                            </div>
							<?php
							$j=0;
							$sql_dil2=mysql_query("select * from diller");
							  while($diller2=mysql_fetch_object($sql_dil2)){
							$j++;
							  $dyr_kyt=mysql_fetch_object(mysql_query("select * from anasayfa where id='$id' and dil='".$diller2->id."'"));?>
							<div class="tab-pane fade <?php if($j==1){ echo "active"; } ?> in" id="<?php echo $diller2->links?>">
								
								<fieldset>
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="baslik<?php echo $diller2->links?>" placeholder="Kayıt Başlığı" value="<?php echo $dyr_kyt->baslik?>">
										</div>
									</div>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Kısa Açıklama</label>
                                    <div class="col-lg-10">
                                    <textarea class="form-control" name="kisa_yazi<?php echo $diller2->links?>"><?php echo $dyr_kyt->kisa_yazi;?></textarea>
                                    </div>
                                </div>

									<div class="form-group">
										<div class="col-lg-12">
										<textarea name="yazi<?php echo $diller2->links?>" id="editor<?php echo $diller2->id?>"><?php echo $dyr_kyt->yazi?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
											<button name="gonder" type="submit" class="btn btn-default">Kayıt Düzenle</button>
										</div>
									</div>

								</fieldset>

							</div>
							<?php } ?>
						</div>					

					</form>



					<?php

					$resimid = mysql_real_escape_string($_GET['resimid']);


					?>
				</div>

				</div>



			</div>

		</div>



	</div>



	<?php include "include/footer.php"; ?>





	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

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

		CKEDITOR.replace( 'editor4',
			{
			filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php',
			filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Flash',
			filebrowserUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Flash'
			}
		);
		CKEDITOR.replace( 'editor5',
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



	<script src="js/sortable.js"></script>


</body>

</html>