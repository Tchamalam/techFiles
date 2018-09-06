<?php
	ob_start();
	error_reporting(0);
	session_start();
	include "include/ayar.php";
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

	<div class="container">

		<?php include "include/header.php"; ?>

		<div class="row">
			<?php include "include/solmenu.php"; ?>

			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title">Sitede Bulunan Sayfalar</h3>
					</div>
					<div class="panel-body">

					<?php
					if($id > 0){
							
						$sil = mysql_query("DELETE FROM sayfa WHERE id='$id'");
						
						if($sil){

							$resimc = mysql_query("SELECT * FROM sayfaresimler WHERE id='$id'");
							while ($resim_res = mysql_fetch_array($resimc)) {
								$resim = $resim_res["resim"];
								unlink("../$resim");
							}

							$sil = mysql_query("DELETE FROM resimler WHERE resid='$id'");

							echo '<div class="alert alert-success">Seçilen Galeri Başarıyla Silindi</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}
					}
					?>

						<ul id="test-list">

						<li>
						<div class="col-md-8"><b><u>Sayfa Başlığı</u></b></div>
						<div class="col-md-4"><b><u>İşlemler</u></b></div>
						</li>

						  <?php
						  $pr = mysql_query("SELECT * FROM sayfa WHERE katid='0' group by id ORDER BY ordernum ASC");
						  while($pr_getir = mysql_fetch_array($pr)){
						  ?>
						  
						  <li id="listItem_<?php echo $pr_getir['id']; ?>">
						  <div class="col-md-6">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir['baslik']?>
						  </div>
						  <div class="col-md-6 text-right"><a href="bannerekle.php?id=<?php echo $pr_getir['id']?>">Banner Ekle</a> - <a <?php if($pr_getir['id'] != 9){ ?>href="resimekle.php?id=<?php echo $pr_getir['id']?>"<?php } ?> <?php if($pr_getir['id'] == 9){ ?> data-toggle="modal" data-target="#myModal"<?php } ?> style="cursor:pointer;">Resim Ekle</a> - <a href="sayfa_duzenle.php?id=<?php echo $pr_getir['id']?>">Düzenle</a> - <a href="sayfalar.php?id=<?php echo $pr_getir['id']?>" onClick="return confirm('Bu Sayfayı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  	  <?php
							  $pr2 = mysql_query("SELECT * FROM sayfa WHERE katid='".$pr_getir['id']."' group by id ORDER BY ordernum ASC");
							  while($pr_getir2 = mysql_fetch_array($pr2)){
							  ?>
							  
							  <li id="listItem_<?php echo $pr_getir2['id']; ?>" style="padding-left:20px;">
							  <div class="col-md-6">
							      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir2['baslik']?>
							  </div>
							  <div class="col-md-6 text-right"><a href="bannerekle.php?id=<?php echo $pr_getir2['id']?>">Banner Ekle</a> - <a href="resimekle.php?id=<?php echo $pr_getir2['id']?>">Resim Ekle</a> - <a href="sayfa_duzenle.php?id=<?php echo $pr_getir2['id']?>">Düzenle</a> - <a href="sayfalar.php?id=<?php echo $pr_getir2['id']?>" onClick="return confirm('Bu Sayfayı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
							  </li>

							  <?php 
							  $pr3 = mysql_query("SELECT * FROM sayfa WHERE katid='".$pr_getir2['id']."' group by id ORDER BY ordernum ASC");
							  while($pr_getir3 = mysql_fetch_array($pr3)){
							  ?>
							  
							  <li id="listItem_<?php echo $pr_getir3['id']; ?>" style="padding-left:30px;">
							  <div class="col-md-6">
							      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir3['baslik']?>
							  </div>
							  <div class="col-md-6 text-right"><a href="bannerekle.php?id=<?php echo $pr_getir3['id']?>">Banner Ekle</a> - <a href="resimekle.php?id=<?php echo $pr_getir3['id']?>">Resim Ekle</a> - <a href="sayfa_duzenle.php?id=<?php echo $pr_getir3['id']?>">Düzenle</a> - <a href="sayfalar.php?id=<?php echo $pr_getir3['id']?>" onClick="return confirm('Bu Sayfayı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
							  </li>

							  <?php
							  $pr4 = mysql_query("SELECT * FROM sayfa WHERE katid='".$pr_getir3['id']."' group by id ORDER BY ordernum ASC");
							  while($pr_getir4 = mysql_fetch_array($pr4)){
							  ?>
							  
							  <li id="listItem_<?php echo $pr_getir4['id']; ?>" style="padding-left:45px;">
							  <div class="col-md-6">
							      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir4['baslik']?>
							  </div>
							  <div class="col-md-6 text-right"><a href="bannerekle.php?id=<?php echo $pr_getir4['id']?>">Banner Ekle</a> - <a href="resimekle.php?id=<?php echo $pr_getir4['id']?>">Resim Ekle</a> - <a href="sayfa_duzenle.php?id=<?php echo $pr_getir4['id']?>">Düzenle</a> - <a href="sayfalar.php?id=<?php echo $pr_getir4['id']?>" onClick="return confirm('Bu Sayfayı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
							  </li>

							  <?php }
							   }

							} ?>

						  <?php } ?>
						  </ul>
						<div style="clear:both;"></div>
						<!-- Modal -->
						<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" id="myModalLabel">Galeri Kategorisi</h4>
						      </div>
						      <div class="modal-body">
						        
						      		<?php
						      		$kt = mysql_query("SELECT * FROM galerikategoriler ORDER BY ordernum ASC");
						      		while($ktgetir = mysql_fetch_array($kt)){
						      		?>
						      			<a href="resimekle.php?id=9&katid=<?php echo $ktgetir['id']?>"><?php echo $ktgetir['baslik']?><br>
						      		<?php } ?>

						      </div>

						    </div>
						  </div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<!--<div class="panel panel-default">
			<div class="panel-heading">
			<h3 class="panel-title">Site İstatistikleri</h3>
			</div>
			<div class="panel-body">
			Site Bilgileri
			</div>
		</div>-->

	</div>

	<?php include "include/footer.php"; ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	    <script src="js/sortable.js"></script>
        <script type="text/javascript">
		  // When the document is ready set up our sortable with it's inherant function(s)
		  
		  /*
		  $(document).ready(function() {
		    $("#test-list").sortable({
		      handle : '.handle',
		      update : function () {
				  var order = $('#test-list').sortable('serialize');
		  		$(".infom").load("islem.php?"+order);
		      }
		    });
		});*/

		$(function() {
		  $("#test-list").sortable({
		    update:function(){
		      var posted = $(this).sortable("serialize");
		      $.post("sayfasiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>

</body>
</html>