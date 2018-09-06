<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }

	$id = mysql_real_escape_string($_GET["id"]);

	$ban = mysql_fetch_assoc(mysql_query("SELECT * FROM banner WHERE id='$id'"));
	$banner = $ban["baslik"];
	$k_banner = $ban["baslik2"];

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

					<h3 class="panel-title">Banner Düzenle</h3>

					</div>

					<div class="panel-body">

						<?php

							if(isset($_POST['banner_gonder'])){

								if($_POST['csrf_token_name'] == sha1(md5(md5("incefikirler.com@yildizsogutma*1592014+1404")))){


									if($_FILES["dosya"]["size"] > 0){

										if(file_exists("../$banner")){
											unlink("../$banner");
										}

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
										    $sql_dil=mysql_query("select * from diller");
											while($diller=mysql_fetch_object($sql_dil)){
											$slogan  = $_POST['slogan'.$diller->links];
											$slogan1 = $_POST['slogan1'.$diller->links];
											$slogan2 = $_POST['slogan2'.$diller->links];
											$lnk 	 = $_POST['lnk'.$diller->links];
											$lnk2 	 = $_POST['lnk2'.$diller->links];
											
											$guncelle =  mysql_query("UPDATE banner SET 

												baslik='$yeniresimadi',
												slogan='$slogan',
												slogan1='$slogan1',
												slogan2='$slogan2',
												lnk='$lnk',
												lnk2='$lnk2'
												WHERE id='$id' and dil='".$diller->id."'");
											}
											echo '<div class="alert alert-success">Banner Resmi Başarıyla Güncellendi.</div>';

										} else {
											
											echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

										}
										
										// Dosya Upload Bitiş

									}else{
											$sql_dil=mysql_query("select * from diller");
											while($diller=mysql_fetch_object($sql_dil)){
											$slogan  = $_POST['slogan'.$diller->links];
											$slogan1 = $_POST['slogan1'.$diller->links];
											$slogan2 = $_POST['slogan2'.$diller->links];
											$lnk 	 = $_POST['lnk'.$diller->links];
											$lnk2  	 = $_POST['lnk2'.$diller->links];
											
											$guncelle =  mysql_query("UPDATE banner SET 
												slogan='$slogan',
												slogan1='$slogan1',
												slogan2='$slogan2',
												lnk='$lnk',
												lnk2='$lnk2'
												WHERE id='$id' and dil='".$diller->id."'");
											}
										if($guncelle){
											
											echo '<div class="alert alert-success">Banner Başarıyla Güncellendi.</div>';

										}else{
											
											echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

										}

									}

								}else{

									return false;
									exit();

								}

							}

						$banner = mysql_fetch_array(mysql_query("SELECT * FROM banner WHERE id='$id'"));
							
						?>

						<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">
							
							<div id="myTabContent" class="tab-content">

								<ul class="nav nav-tabs" style="margin-bottom: 15px;">
								  <li class="active"><a href="#resim" data-toggle="tab">Resim</a></li>
                                  <?php $sql_dil=mysql_query("select * from diller");
								  while($diller=mysql_fetch_object($sql_dil)){?>
								  <li><a href="#slogan<?php echo $diller->links?>" data-toggle="tab"><?php echo $diller->baslik?></a></li>
                                  <?php } ?>
								</ul>

								<div class="tab-pane fade active in" id="resim">

									<?php if($banner['baslik'] != ""){ ?>
									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Banner</label>
										<div class="col-lg-10">
										<img src="../<?php echo $banner['baslik'];?>" class="thumbnail" width="100%" />
										</div>
									</div>
									<?php } ?>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Banner</label>
										<div class="col-lg-10">
										<input type="file" class="form-control" id="dosya" name="dosya">
										</div>
									</div>

								</div>
								<?php $sql_dil2=mysql_query("select * from diller");
								  while($diller2=mysql_fetch_object($sql_dil2)){
								  $banner_kyt=mysql_fetch_object(mysql_query("select * from banner where id='$id' and dil='".$diller2->id."'"));?>
								<div class="tab-pane fade in" id="slogan<?php echo $diller2->links?>">

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan<?php echo $diller2->links?>" name="slogan<?php echo $diller2->links?>" value="<?php echo $banner_kyt->slogan?>" placeholder="Slogan">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan 1</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan1<?php echo $diller2->links?>" name="slogan1<?php echo $diller2->links?>" value="<?php echo $banner_kyt->slogan1?>" placeholder="Slogan 1">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan 2</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan2<?php echo $diller2->links?>" name="slogan2<?php echo $diller2->links?>" value="<?php echo $banner_kyt->slogan2?>" placeholder="Slogan 2">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Katalog</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="lnk<?php echo $diller2->links?>" name="lnk<?php echo $diller2->links?>" value="<?php echo $banner_kyt->lnk?>" placeholder="Katalog">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kullanım Kılavuzu</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="lnk2<?php echo $diller2->links?>" name="lnk2<?php echo $diller2->links?>" value="<?php echo $banner_kyt->lnk2?>" placeholder="Kullanım Kılavuzu">
										</div>
									</div>
								
								</div>
								<?php } ?>
								

								<div class="form-group">
									<label class="col-lg-2"></label>
									<div class="col-lg-10">
										<button name="banner_gonder" type="submit" class="btn btn-default">Banner Düzenle</button>
									</div>
								</div>

							</div>

							<input type="hidden" name="csrf_token_name" value="<?php echo sha1(md5(md5("incefikirler.com@yildizsogutma*1592014+1404")));?>" />

						</form>

						<div style="clear:both;"></div>

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
		      $.post("bannersiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>



</body>

</html>