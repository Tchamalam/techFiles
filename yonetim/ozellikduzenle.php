<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }



	$id = mysql_real_escape_string($_GET['id']);
	function sef($string)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$string = strtolower(str_replace($find, $replace, $string));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		return $string;
	}

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

					<h3 class="panel-title">Özellik Düzenle</h3>

					</div>

					<div class="panel-body">



					<?php

					if(isset($_POST['gonder'])){
						
						$_POST = array_map("tirnak_replace", $_POST);
						$pdfeski = $_POST["pdfeski"];
						$kat = $_POST["kat"];
						$renk = $_POST["renk"];
						$public = $_POST["public"];

						$kaynak2 = $_FILES["pdf"]["tmp_name"];
						$dosyaadi2 = $_FILES["pdf"]["name"];
						$dosyatipi2 = $_FILES["pdf"]["type"];
						$dboyu2t	= $_FILES["pdf"]["size"];
						$hedef2 = "pdf/";
						$uzanti2	= substr($dosyaadi2, -4);
						$yeniad2 = substr(md5(uniqid(rand())), 0,10);
						$yeniresimadi2 = $hedef2.$yeniad2.".".$uzanti2;
						$a2 = "../".$hedef2.$yeniad2.".".$uzanti2;
						$yukle2 = move_uploaded_file($kaynak2,$a2);

						if($yeniresimadi2==""){
							$yeniresimadi2=$pdfeski;
						}

						if($_FILES["dosya"]["size"] > 0){

							// Dosya Upload Başlangıç

							$toplam = count($_FILES["dosya"]["name"]);
							$formatlar = array("image/png","image/jpeg","image/gif");

							$fileName = strtolower($_FILES['dosya']['name']);

							$whitelist = array('jpg', 'png', 'gif', 'jpeg', 'pdf'); #whitelist örneği
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
								$sql_dil=mysql_query("select * from diller");
								while($diller=mysql_fetch_object($sql_dil)){
									$baslik   = $_POST["baslik".$diller->links];
									$baslikseo   = sef($_POST['baslik'.$diller->links]);
									$sqlsay=mysql_num_rows(mysql_query("select * from ozellikler where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
									if ($sqlsay>1)
									{
									$baslikseo = $baslikseo."-".$id;
									}
									$kisa_yazi = $_POST["kisa_yazi".$diller->links];
									$yazi = $_POST["yazi".$diller->links];
									$yazi2 = $_POST["yazi2".$diller->links];
									$title   = $_POST["title".$diller->links];
									$description   = $_POST["description".$diller->links];
									$keywords   = $_POST["keywords".$diller->links];
								$ekle =  mysql_query("UPDATE ozellikler SET resim='$yeniresimadi', katid='$kat', baslik='$baslik', baslikseo='$baslikseo', kisa_yazi='$kisa_yazi', yazi='$yazi' WHERE id='$id' and dil='".$diller->id."'");
								}
								if($ekle){
									echo '<div class="alert alert-success">Özellik Başarıyla Düzenlendi</div>';
									header("Refresh:3;url=ozellikler.php");
								}else{
									echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
								}

							} else {
								
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}
							
							// Dosya Upload Bitiş

						}else{
							$sql_dil=mysql_query("select * from diller");
							while($diller=mysql_fetch_object($sql_dil)){
								$baslik   = $_POST["baslik".$diller->links];
								$baslikseo   = sef($_POST['baslik'.$diller->links]);
								$sqlsay=mysql_num_rows(mysql_query("select * from ozellikler where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
								if ($sqlsay>1)
								{
								$baslikseo = $baslikseo."-".$id;
								}
								$kisa_yazi = $_POST["kisa_yazi".$diller->links];
								$yazi = $_POST["yazi".$diller->links];
								$yazi2 = $_POST["yazi2".$diller->links];
								$title   = $_POST["title".$diller->links];
								$description   = $_POST["description".$diller->links];
								$keywords   = $_POST["keywords".$diller->links];
								
							$ekle2 = mysql_query("UPDATE ozellikler SET katid='$kat', baslik='$baslik', baslikseo='$baslikseo', kisa_yazi='$kisa_yazi', yazi='$yazi' WHERE id='$id' and dil='".$diller->id."'");
								}
								
							if($ekle2){

								echo '<div class="alert alert-success">Özellik Başarıyla Düzenlendi</div>';
								header("Refresh:3;url=ozellikler.php");

							}else{

								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

							}

						}
					
					}

					$gelen = mysql_fetch_assoc(mysql_query("SELECT * FROM ozellikler WHERE id='$id'"));

					$resid = mysql_real_escape_string($_GET['resid']);

					if($resid > 0):

						$resim = mysql_fetch_assoc(mysql_query("SELECT * FROM ozellikler WHERE id='$resid'"));
						$delimg = $resim['resim'];
						if(file_exists("../$delimg")){
							unlink("../$delimg");
							mysql_query("UPDATE ozellikler SET resim='' WHERE id='$resid'");
							header("Location:ozellikduzenle.php?id=".$resid);
						}

					endif;
					if($pdfid > 0):

						$pdfs = mysql_fetch_assoc(mysql_query("SELECT * FROM ozellikler WHERE id='$pdfid'"));
						$delpdf = $pdfs['pdf'];
						if(file_exists("../$delpdf")){
							unlink("../$delpdf");
							mysql_query("UPDATE ozellikler SET pdf='' WHERE id='$pdfid'");
							header("Location:ozellikduzenle.php?id=".$pdfid);
						}

					endif;

					?>

					<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">

						<div id="myTabContent" class="tab-content">

							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							<?php $sql_dil=mysql_query("select * from diller");
                              while($diller=mysql_fetch_object($sql_dil)){?>
                              <li><a href="#<?php echo $diller->links?>" data-toggle="tab"><?php echo $diller->baslik?></a></li>
                              <?php } ?>
							</ul>
							<?php if($gelen["resim"] != ''): ?>
                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Resim</label>
                                <div class="col-lg-8">
                                <img src="../<?php echo $gelen["resim"];?>" class="img-responsive thumbnail" width="200" />
                                <a href="ozellikduzenle.php?resid=<?php echo $id;?>" class="col-lg-3">Resmi Sil</a>
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
                                        $kategori = mysql_query("select * from urunler where katid='0' and dil='1' order by ordernum asc");
                                        while($kyaz = mysql_fetch_array($kategori)):
                                    ?>
                                    <option value="<?php echo $kyaz['id'];?>" <?php if($gelen["katid"] == $kyaz['id']): echo "selected"; endif; ?>><?php echo $kyaz['baslik'];?></option>
									<? endwhile; ?>
                                </select>
                                </div>
                            </div>

							<?php 
							$j=0;
							$sql_dil2=mysql_query("select * from diller");
							while($diller2=mysql_fetch_object($sql_dil2)){
							  $syf_kyt=mysql_fetch_object(mysql_query("select * from ozellikler where id='$id' and dil='".$diller2->id."'"));
							$j++;
							?>
							<div class="tab-pane <?php if($j==1){ echo "active"; } ?> fade in" id="<?php echo $diller2->links?>">

								<fieldset>
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="baslik<?php echo $diller2->links?>" value="<?php echo $syf_kyt->baslik;?>">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kısa Yazı</label>
										<div class="col-lg-10">
										<textarea name="kisa_yazi<?php echo $diller2->links?>" class="form-control" placeholder="Kısa Yazı"><?php echo $syf_kyt->kisa_yazi;?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
										<textarea name="yazi<?php echo $diller2->links?>" id="editor<?php echo $diller2->id?>" placeholder="Açıklama"><?php echo $syf_kyt->yazi;?></textarea>
										</div>
									</div>

                                    
									<div class="form-group">
										<div class="col-lg-12">
											<button name="gonder" type="submit" class="btn btn-default">Özellik Düzenle</button>
										</div>
									</div>

								</fieldset>

							</div>
							<?php } ?>
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