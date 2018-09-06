<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }



	$id = mysql_real_escape_string($_GET['id']);

	$syf = mysql_fetch_assoc(mysql_query("SELECT * FROM sayfa WHERE id='$id'"));

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

					<h3 class="panel-title"><b><?php echo $syf['baslik']?></b> Sayfasına Banner Ekle</h3>

					</div>

					<div class="panel-body">



						<?php

							$resid = mysql_real_escape_string($_GET["resid"]);
							if($resid > 0){

								$sayfa = mysql_fetch_assoc("SELECT * FROM sayfa WHERE id='$id'");

								$resim = $sayfa["banner"];

								@unlink("../$resim");

								$guncelle_asd = mysql_query("UPDATE sayfa SET banner='' WHERE id='$id'");

								if($guncelle_asd){

									echo '<div class="alert alert-success">Banner Başarıyla Silindi.</div>';

								}else{

									echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';	

								}

							}



							if(isset($_POST["pdfyukel"])){



								if($_POST["csrf_token_name"] == md5(sha1(md5("incefikirler_unluteknik*13579+2015/29092014")))){



									/////

									$slogan = $_POST["slogan"];



									if($_FILES["dosya"]["size"] > 0){



										// Dosya Upload Başlangıç



										$rasd = mysql_fetch_assoc(mysql_query("SELECT * FROM sayfa WHERE id='$id'"));

										$rasd_ic = $rasd["banner"];

										@unlink("../$rasd_ic");



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

											$sql_dil=mysql_query("select * from diller");
											while($diller=mysql_fetch_object($sql_dil)){
											$slogan = $_POST["slogan".$diller->links];
											$ekle =  mysql_query("UPDATE sayfa SET banner='$yeniresimadi', slogan='$slogan' WHERE id='$id' and dil='".$diller->id."'");
											}
											

											if($ekle){
												echo '<div class="alert alert-success">Banner Bilgileri Başarıyla Güncellendi.</div>';

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
										$slogan = $_POST["slogan".$diller->links];
										$ekle2 =  mysql_query("UPDATE sayfa SET slogan='$slogan' WHERE id='$id' and dil='".$diller->id."'");
										}
										if($ekle2){

											echo '<div class="alert alert-success">Banner Bilgileri Başarıyla Güncellendi.</div>';

										}else{

											echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

										}

									}



									/////



								}



							}



						$banner = mysql_fetch_assoc(mysql_query("SELECT * FROM sayfa WHERE id='$id' and dil='1'"));	



						?>



					    <div id="genel">

						<div id="yuklemeFormu">

						<form action="<?php $PHP_SELF; ?>" method="post" class="form-horizontal" enctype="multipart/form-data" id="form">
						
						<div id="myTabContent" class="tab-content">

							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							  <?php $sql_dil=mysql_query("select * from diller");
                              while($diller=mysql_fetch_object($sql_dil)){?>
                              <li><a href="#<?php echo $diller->links?>" data-toggle="tab"><?php echo $diller->baslik?></a></li>
                              <?php } ?>
							</ul>
                       <?php if($banner["banner"] != ""){ ?>
						<div class="form-group">
							<div class="col-lg-12">
							<img src="../<?php echo $banner["banner"];?>" class="thumbnail" style="width:100%;height:auto;" />
							<a href="bannerekle.php?id=<?php echo $id;?>&resid=<?php echo $id;?>" style="padding-top:-10px;" Onclick="return confirm('Bu Bannerı Silmek İstediğinizden Emin misiniz ?');">Resmi Sil</a>
							</div>
						</div>						

						<?php } ?>

						<div class="form-group">
							<label for="inputEmail" class="col-lg-2 control-label">Banner</label>
							<div class="col-lg-10">
							<input type="file" class="form-control" name="dosya">
							</div>
						</div>
							<?php 
							$j=0;
							$sql_dil2=mysql_query("select * from diller");
							while($diller2=mysql_fetch_object($sql_dil2)){
							  $syf_kyt=mysql_fetch_object(mysql_query("select * from sayfa where id='$id' and dil='".$diller2->id."'"));
							$j++;
							?>
							<div class="tab-pane <?php if($j==1){ echo "active"; } ?> fade in" id="<?php echo $diller2->links?>">

						<fieldset>

						<div class="form-group">

							<label for="inputEmail" class="col-lg-2 control-label">Slogan</label>

							<div class="col-lg-10">

							<input type="text" class="form-control" name="slogan<?php echo $diller2->links?>" value="<?php echo $syf_kyt->slogan;?>" />

							</div>

						</div>

						<div class="form-group">
							<label for="inputEmail" class="col-lg-2 control-label"></label>
							<div class="col-lg-10">
								<button type="submit" name="pdfyukel" class="btn btn-default">Banner Ekle</button>
							</div>
						</div>
					</fieldset>
					</div>
                    <?php } ?>
						<input type="hidden" name="csrf_token_name" value="<?php echo md5(sha1(md5("incefikirler_unluteknik*13579+2015/29092014")));?>" />

						</form>

						</div>



						<iframe id="gelenBilgi" name="gelenBilgi" src="" style="display: none"></iframe>



						</div>



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

	</script>



	<script type="text/javascript">

	$(document).ready(function(){

		

		

		/*

		$("#form").bind("submit", function(){

			

			$("#sonuclar").empty();

			$(this).attr("target","gelenBilgi");

			$("<img />").attr("src","images/yukleniyor.gif").appendTo($("#sonuclar"));

			

			$("#gelenBilgi").bind("load", function(){

				

				var deger = $("#gelenBilgi").contents().find("body").html();

				$("img").remove();

				$("#sonuclar").html(deger);

				

			});

			

		});*/

		

	});

	</script>



</body>

</html>