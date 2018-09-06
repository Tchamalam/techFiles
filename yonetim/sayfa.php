
<?php

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }



	$id = mysql_real_escape_string($_GET['id']);

	function katListeleSelect($katid, $onek = 1)
{
	$asd = mysql_fetch_assoc(mysql_query("SELECT * FROM sayfa WHERE id='".mysql_real_escape_string($_GET["id"])."'"));
	$sql = mysql_query("SELECT * FROM sayfa WHERE katid='$katid'");
 
	while($sonuc = mysql_fetch_array($sql))
	{
		if(!empty($sonuc))
		{

			if($asd["katid"] == $sonuc["id"]){ $selected = "selected"; }else{ $selected = ""; }

			echo "<option value='".$sonuc["id"]."'".$selected.">";
			echo str_repeat('- ', $onek);
			echo ''.$sonuc['baslik'];
			echo '</option>';
			katListeleSelect($sonuc['id'], ($onek+1));
		}
	}
}

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

	<link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.css" />

	<!-- Fck Başlangıç -->

	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

	<!-- Fck Bitiş -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<!--=== FANCYBOX ===-->
	<link rel="stylesheet" type="text/css" href="../fancy/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<link rel="stylesheet" type="text/css" href="../fancy/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<link rel="stylesheet" type="text/css" href="../fancy/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="../fancy/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script type="text/javascript" src="../fancy/source/jquery.fancybox.js?v=2.1.5"></script>
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
	<script type="text/javascript" src="../fancy/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
	    $(document).ready(function() {
	        
	        $('.fancybox').fancybox();

	    });
	</script>
	<!--=== FANCYBOX ===-->

</head>



<body>



	<div class="container">



		<?php include "include/header.php"; ?>



		<div class="row">

			<?php include "include/solmenu.php"; ?>



			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading">

					<h3 class="panel-title"><b><?php echo $syf['baslik']?></b> Sayfasını Düzenle</h3>

					</div>

					<div class="panel-body">



					<div class="navbar navbar-default">

						<ul class="nav navbar-nav navbar-right">

							<li><a href="yenialtsayfa.php?id=<?php echo $id?>"><span class="glyphicon glyphicon-hand-right"></span>&nbsp;Yeni Alt Sayfa Ekle</a></li>
							<?php if($syf['katid'] != 0){ ?><li><a href="sayfasil.php?id=<?php echo $id?>" onClick="return confirm('Bu Sayfayı Silmek İstediğinizden Emin misiniz?')"><span class="glyphicon glyphicon-remove"></span>&nbsp;Bu Sayfayı Sil</a></li><?php } ?>
							<li><a href="resimekle.php?id=<?php echo $id?>"><span class="glyphicon glyphicon-hand-right"></span>&nbsp;Yeni Resim Ekle&nbsp;</a></li>
							<li><a href="bannerekle.php?id=<?php echo $id?>"><span class="glyphicon glyphicon-hand-right"></span>&nbsp;Yeni Banner Ekle&nbsp;</a></li>

						</ul>

					</div>



					<?php

					$id = mysql_real_escape_string($_GET['id']);



					if(isset($_POST['gonder'])){

						$ordernum = $_POST['ordernum'];
						$_POST = array_map("tirnak_replace", $_POST);

						$baslik = $_POST['baslik'];
						$yazi = $_POST['yazi'];
						$katid = $_POST['katid'];						

						$guncelle = mysql_query("UPDATE sayfa SET 

							baslik='$baslik', 
							yazi='$yazi', 
							katid='$katid',
							ordernum='$ordernum'

							WHERE id='$id'

						");

						if($guncelle){

							echo '<div class="alert alert-success">Sayfa İçeriği Başarıyla Düzenlendi.Düzenleme Bazı Alanlarda Sayfayı Yeniledikten Sonra Görülebilir.</div>';

						} else {

							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

						}

					}

					?>



					<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>">
						<fieldset>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Sayfa Başlığı</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="baslik" placeholder="Sayfa Başlığı" value="<?php echo $syf['baslik']?>">
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Sayfa Sırası</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="ordernum" placeholder="Sayfa Sırası" value="<?php echo $syf['ordernum']?>">
								</div>
							</div>

							<div class="form-group">
								<label for="select" class="col-lg-2 control-label">Üst Sayfa</label>
								<div class="col-lg-10">
									<select class="form-control" name="katid" id="select">
									<option value="0">Anasayfa</option>
									<?php echo katListeleSelect(0);?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-12">
								<textarea name="yazi" id="editor1"><?php echo $syf['yazi']?></textarea>
								</div>
							</div>


							<div class="form-group">
								<div class="col-lg-12">
									<button name="gonder" type="submit" class="btn btn-default">Sayfa Bilgilerini Güncelle</button>
								</div>
							</div>
						</fieldset>
					</form>

						<?php
						$resimid = mysql_real_escape_string($_GET['resimid']);
						if($resimid > 0){
							$resim = mysql_query("SELECT * FROM resimler WHERE id='$resimid'");
							while ($resim_res = mysql_fetch_array($resim)) {
								$resim = $resim_res["resim"];
								unlink("../$resim");	
							}	
							$sil = mysql_query("DELETE FROM resimler WHERE id='$resimid'");
							if($sil){
								echo '<div class="alert alert-success">Seçilen Resim Başarıyla Silindi.</div>';
							} else {
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
							}
						}
						?>

				    	<!---->
				    	<div class="row" id="listeleme_1">
		                  <div class="col-md-12">
		                      <section class="panel tasks-widget">
		                          <header class="panel-heading">
		                              
		                              Sayfa Resimler

		                              <div style="float:right;"> 
		                                
		                                <a href="javascript:void(0);" id="list_click"><i class="fa fa-th-list fa-2x"></i></a>

		                              </div>                              
		                                                            
		                          </header>
		                          <div class="panel-body">
		                              <div class="task-content" id="yenile resimler1">
	                                  	<?php
								    	$rs = mysql_query("SELECT * FROM resimler WHERE resid='$id' ORDER BY ordernum ASC");
								    	while($rs_getir = mysql_fetch_array($rs)){
								    	?>
								        <div class="col-xs-3" id="listItem_<?php echo $rs_getir['id']; ?>">
								            <a href="<?php echo "../".$rs_getir['resim']?>" class="fancybox" data-fancybox-group="gallery" class="thumbnail">
								                <img data-rich-file-id="65" src="../<?php echo $rs_getir['resim']?>" alt="resim" class="thumbnail" style="width:151px;height:104px;">
								            </a>
								            <center><a href="sayfa.php?id=<?php echo $id?>&resimid=<?php echo $rs_getir['id']?>"><span class="glyphicon glyphicon-remove"></span></a></center>
								        </div>
								        <?php } ?>
		                              </div>
		                          </div>
		                      </section>
		                  </div>
		              </div>

		              <div class="row" id="listeleme_2">
		                  <div class="col-md-12">
		                      <section class="panel tasks-widget">
		                          <header class="panel-heading">
		                              
		                              Sayfa Resimler

		                              <div style="float:right;">

		                                <a href="javascript:void(0);" id="list_click2"><i class="fa fa-th fa-2x"></i></a>

		                              </div>                              
		                                                            
		                          </header>
		                          <div class="panel-body">
		                              <div class="task-content" id="yenile resimler1">
		                                  <!---->
		                                  <ul id="test-list" style="padding:0;margin:0;">
									    	<?php
									    	$rs = mysql_query("SELECT * FROM resimler WHERE resid='$id' ORDER BY ordernum ASC");
									    	while($rs_getir = mysql_fetch_array($rs)){
									    	?>
									        <div class="row" id="listItem_<?php echo $rs_getir['id']; ?>">
									        	<div class="col-xs-12">

										        	<div class="col-md-3 col-sm-3 col-xs-3">

										        		<img class="thumbnail" width="120" height="90" src="../<?php echo $rs_getir["resim"];?>" />

										        	</div>

										        	<div class="col-md-9 col-sm-9 col-xs-9"><b>Resim Adı : </b><?php echo $rs_getir["resim"];?></div>

										        </div>
									        </div>
									        <?php } ?>
									       </ul>
		                                  <!---->
		                              </div>
		                          </div>
		                      </section>
		                  </div>
		              </div>
				    	<!---->

					</div>

				</div>

			</div>

		</div>

	</div>

	<?php include "include/footer.php"; ?>

	

	<script src="js/bootstrap.min.js"></script>

	<script type="text/javascript">

		$(function() {

          $("#list_click").click(function(){

              document.getElementById("listeleme_1").style.display = "none";
              document.getElementById("listeleme_2").style.display = "block";

          }); 

          $("#list_click2").click(function(){

              document.getElementById("listeleme_1").style.display = "block";
              document.getElementById("listeleme_2").style.display = "none";

          });    

          $(window).load(function(){

              document.getElementById("listeleme_2").style.display = "none";

          });

        });  

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

	<script src="js/sortable.js"></script>

        <script type="text/javascript">

		$(function() {

		  $("#test-list").sortable({

		    update:function(){

		      var posted = $(this).sortable("serialize");

		      $.post("resimsiralaislem.php",posted,function(e){

				})

		    }

		  })

		});

		</script>



</body>

</html>