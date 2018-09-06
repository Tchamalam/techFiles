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

	<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />

</head>

<body>

	<div class="container">

		<?php include "include/header.php"; ?>

		<div class="row">
			<?php include "include/solmenu.php"; ?>

			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title">Sitede Bulunan Ürünler</h3>
					</div>
					<div class="panel-body">

					<?php
					if($id > 0){
							
						$dyr = mysql_fetch_assoc(mysql_query("SELECT * FROM urunler WHERE id='$id'"));
						$dyr_adi = $dyr["resim"];
						if(file_exists("../$dyr_adi")){
							@unlink("../$dyr_adi");
						}

						$sil = mysql_query("DELETE FROM urunler WHERE id='$id'");
						
						if($sil){

							$resimc = mysql_query("SELECT * FROM urunresimler WHERE resid='$id'");
							while ($resim_res = mysql_fetch_array($resimc)) {
								$resim = $resim_res["resim"];
								unlink("../$resim");
							}

							$sil = mysql_query("DELETE FROM urunresimler WHERE resid='$id'");

							echo '<div class="alert alert-success">Seçilen Yazı Başarıyla Silindi</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}
					}
					?>

						<ul id="test-list">

						<li>
						<div class="col-md-3"><b><u>Ürün Kategori</u></b></div>
						<div class="col-md-1"><b><u>ID</u></b></div>
						<div class="col-md-4"><b><u>Ürün Başlığı</u></b></div>
						<div class="col-md-4"><b><u>İşlemler</u></b></div>
						</li>

						  <?php

						  $sayfa = @intval($_GET['s']);
		                  if(!$sayfa) $sayfa = 1;
		                  $toplam = mysql_num_rows(mysql_query("SELECT * FROM urunler where dil='1'"));
		                  $limit = 800;
		                  $sayfa_sayisi = ceil($toplam/$limit);
		                  if($sayfa > $sayfa_sayisi) $sayfa = 1;
		                  $goster = $sayfa * $limit - $limit;
						  $pr = mysql_query("SELECT * FROM urunler where dil='1' and katid='0' ORDER BY ordernum ASC");
						  while($pr_getir = mysql_fetch_array($pr)){
							  $katcek=mysql_fetch_object(mysql_query("select baslik from urunler where id='".$pr_getir2["katid"]."'"));
						  ?>

						  <li id="listItem_<?php echo $pr_getir['id']; ?>">
						  <div class="col-md-3"><?php echo $katcek->baslik?></div>
						  <div class="col-md-1"> </div>
						  <div class="col-md-4">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir['baslik']?>
						  </div>
						  <div class="col-md-4"><a href="urunresimekle.php?id=<?php echo $pr_getir['id']?>">Resim Ekle</a> - <a href="urunduzenle.php?id=<?php echo $pr_getir['id']?>">Düzenle</a> - <a href="urunler.php?id=<?php echo $pr_getir['id']?>" onClick="return confirm('Bu Ürünü Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  <? 
						  $pr2 = mysql_query("SELECT * FROM urunler where dil='1' and katid='".$pr_getir["id"]."' ORDER BY ordernum ASC");
						  while($pr_getir2 = mysql_fetch_array($pr2)){
							  $katcek2=mysql_fetch_object(mysql_query("select baslik from urunler where id='".$pr_getir2["katid"]."'"));
						  ?>
						  
						  <li id="listItem_<?php echo $pr_getir2['id']; ?>">
						  <div class="col-md-3"><?php echo $katcek2->baslik?></div>
						  <div class="col-md-1"> </div>
						  <div class="col-md-4">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir2['baslik']?>
						  </div>
						  <div class="col-md-4"><a href="urunresimekle.php?id=<?php echo $pr_getir2['id']?>">Resim Ekle</a> - <a href="urunduzenle.php?id=<?php echo $pr_getir2['id']?>">Düzenle</a> - <a href="urunler.php?id=<?php echo $pr_getir2['id']?>" onClick="return confirm('Bu Ürünü Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>
						  <? 
						  $pr3 = mysql_query("SELECT * FROM urunler where dil='1' and katid='".$pr_getir2["id"]."' ORDER BY ordernum DESC");
						  while($pr_getir3 = mysql_fetch_array($pr3)){
							  $katcek3=mysql_fetch_object(mysql_query("select baslik from urunler where id='".$pr_getir3["katid"]."'"));
						  ?>
						  
						  <li id="listItem_<?php echo $pr_getir3['id']; ?>">
						  <div class="col-md-3"><?php echo $katcek3->baslik?></div>
						  <div class="col-md-1"><?php echo $pr_getir3['yazi2']?></div>
						  <div class="col-md-4">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir3['baslik']?>
						  </div>
						  <div class="col-md-4"><a href="urunresimekle.php?id=<?php echo $pr_getir3['id']?>">Resim Ekle</a> - <a href="urunduzenle.php?id=<?php echo $pr_getir3['id']?>">Düzenle</a> - <a href="urunler.php?id=<?php echo $pr_getir3['id']?>" onClick="return confirm('Bu Ürünü Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  <?php 
						  $pr4 = mysql_query("SELECT * FROM urunler where dil='1' and katid='".$pr_getir3["id"]."' ORDER BY ordernum DESC");
						  while($pr_getir4 = mysql_fetch_array($pr4)){
							  $katcek4=mysql_fetch_object(mysql_query("select baslik from urunler where id='".$pr_getir4["katid"]."'"));
						  ?>
						  
						  <li id="listItem_<?php echo $pr_getir4['id']; ?>">
						  <div class="col-md-3"><?php echo $katcek4->baslik?></div>
						  <div class="col-md-1"><?php echo $pr_getir4['yazi2']?></div>
						  <div class="col-md-4">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir4['baslik']?>
						  </div>
						  <div class="col-md-4"><a href="urunresimekle.php?id=<?php echo $pr_getir4['id']?>">Resim Ekle</a> - <a href="urunduzenle.php?id=<?php echo $pr_getir4['id']?>">Düzenle</a> - <a href="urunler.php?id=<?php echo $pr_getir4['id']?>" onClick="return confirm('Bu Ürünü Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  <?php } }}} ?>
						  </ul>

						  <ul class="pagination">
            
		                    <?php
		                    
		                    $gorunen = 10;
		         
		                    if($sayfa > 1){
		                        $onceki = $sayfa - 1;
		                        echo "<li><a href='urunler.php?s=$onceki' class'prev'><i class='fa fa-chevron-left'></i></a></li>";
		                    }else{
		                        echo "<li><a class'prev'><i class='fa fa-chevron-left'></i></a></li>";
		                    }
		                 
		                    for($i= $sayfa - $gorunen; $i < $sayfa + $gorunen + 1; $i++){
		                 
		                        if($i > 0 and $i <= $sayfa_sayisi){
		                                if($i == $sayfa){
		                                    echo "<li class='active'><a>$i</a></li>";
		                            } else {
		                                echo "<li><a href='urunler.php?s=$i'>$i</a></li>";
		                            }
		                        }
		                    }
		                 
		                    if($sayfa != $sayfa_sayisi){
		                        $sonraki = $sayfa +1;
		                        echo "<li><a href='urunler.php?s=$sonraki' class='next'><i class='fa fa-chevron-right'></i></a></li>";
		                    }else{
		                        echo "<li><a class='next'><i class='fa fa-chevron-right'></i></a></li>";
		                    }       
		                    
		                    ?>
		                    
		                    </ul>
						<div style="clear:both;"></div>

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
		      $.post("urunsiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>

</body>
</html>