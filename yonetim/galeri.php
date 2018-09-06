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
					<h3 class="panel-title">Sitede Bulunan Resimler</h3>
					</div>
					<div class="panel-body">

					<?php
					if($id > 0){
							
						$dyr = mysql_fetch_assoc(mysql_query("SELECT * FROM galeri WHERE id='$id'"));
						$dyr_adi = $dyr["resim"];
						if(file_exists("../$dyr_adi")){
							@unlink("../$dyr_adi");
						}

						$sil = mysql_query("DELETE FROM galeri WHERE id='$id'");
						
						if($sil){

							$resimc = mysql_query("SELECT * FROM galeriresimler WHERE resid='$id'");
							while ($resim_res = mysql_fetch_array($resimc)) {
								$resim = $resim_res["resim"];
								unlink("../$resim");
							}

							$sil = mysql_query("DELETE FROM galeriresimler WHERE resid='$id'");

							echo '<div class="alert alert-success">Seçilen Yazı Başarıyla Silindi</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}
					}
					?>

						<ul id="test-list">

						<li>
						<div class="col-md-8"><b><u>Başlık</u></b></div>
						<div class="col-md-4"><b><u>İşlemler</u></b></div>
						</li>

						  <?php

						  $sayfa = @intval($_GET['s']);
		                  if(!$sayfa) $sayfa = 1;
		                  $toplam = mysql_num_rows(mysql_query("SELECT * FROM galeri group by id"));
		                  $limit = 10;
		                  $sayfa_sayisi = ceil($toplam/$limit);
		                  if($sayfa > $sayfa_sayisi) $sayfa = 1;
		                  $goster = $sayfa * $limit - $limit;

						  $pr = mysql_query("SELECT * FROM galeri group by id ORDER BY ordernum ASC LIMIT $goster,$limit");
						  while($pr_getir = mysql_fetch_array($pr)){
						  ?>
						  
						  <li id="listItem_<?php echo $pr_getir['id']; ?>">
						  <div class="col-md-8">
						      <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" /><?php echo $pr_getir['baslik']?>
						  </div>
						  <div class="col-md-4"><a href="galeriresimekle.php?id=<?php echo $pr_getir['id']?>">Resim Ekle</a> - <a href="galeriduzenle.php?id=<?php echo $pr_getir['id']?>">Düzenle</a> - <a href="galeri.php?id=<?php echo $pr_getir['id']?>" onClick="return confirm('Bu Kayıtı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  <?php } ?>
						  </ul>

						  <ul class="pagination">
            
		                    <?php
		                    
		                    $gorunen = 3;
		         
		                    if($sayfa > 1){
		                        $onceki = $sayfa - 1;
		                        echo "<li><a href='galeri.php?s=$onceki' class'prev'><i class='fa fa-chevron-left'></i></a></li>";
		                    }else{
		                        echo "<li><a class'prev'><i class='fa fa-chevron-left'></i></a></li>";
		                    }
		                 
		                    for($i= $sayfa - $gorunen; $i < $sayfa + $gorunen + 1; $i++){
		                 
		                        if($i > 0 and $i <= $sayfa_sayisi){
		                                if($i == $sayfa){
		                                    echo "<li class='active'><a>$i</a></li>";
		                            } else {
		                                echo "<li><a href='galeri.php?s=$i'>$i</a></li>";
		                            }
		                        }
		                    }
		                 
		                    if($sayfa != $sayfa_sayisi){
		                        $sonraki = $sayfa +1;
		                        echo "<li><a href='galeri.php?s=$sonraki' class='next'><i class='fa fa-chevron-right'></i></a></li>";
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
		      $.post("galerisiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>

</body>
</html>