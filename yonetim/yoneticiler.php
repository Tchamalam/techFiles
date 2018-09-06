<?php
	ob_start();
	error_reporting(0);
	session_start();
	include "include/ayar.php";
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

</head>

<body>

	<div class="container">

		<?php include "include/header.php"; ?>

		<div class="row">
			<?php include "include/solmenu.php"; ?>

			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title">Sitede Bulunan Yöneticiler</h3>
					</div>
					<div class="panel-body">

						<?php
						$id = mysql_real_escape_string($_GET['id']);
						if($id > 0){
							$sil = mysql_query("DELETE FROM yonetim WHERE id='$id'");
							if($sil){
								echo '<div class="alert alert-success">Seçilen Yönetici Başarıyla Silindi.</div>';
							} else {
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
							}
						}
						?>

						<table class="table table-striped table-hover ">
						  <thead>
						    <tr>
						      <th>Adı Soyadı</th>
						      <th>Kullanıcı Adı</th>
						      <th>İşlemler</th>
						    </tr>
						  </thead>
						  <tbody>
						  <?php
						  $yonetici = mysql_query("SELECT * FROM yonetim WHERE durum='0' ORDER BY id DESC");
						  while($yonetici_getir = mysql_fetch_array($yonetici)){
						  ?>
						    <tr>
						      <td><?php echo $yonetici_getir["adsoyad"]?></td>
						      <td><?php echo $yonetici_getir["kadi"]?></td>
						      <td><a href="yoneticiduzenle.php?id=<?php echo $yonetici_getir['id']?>" title="Düzenle" rel='tooltip'><span class="glyphicon glyphicon-edit"></span></a>&nbsp;<a href="yoneticiler.php?id=<?php echo $yonetici_getir['id']?>" title="Sil" rel='tooltip' onClick="return confirm('Bu Yöneticiyi Silmek İstediğinizden Emin misiniz?')"><span class="glyphicon glyphicon-remove"></span></a></td>
						    </tr>
						  <?php } ?>
						  </tbody>
						</table> 

					</div>
				</div>

			</div>
		</div>

	</div>

	<?php include "include/footer.php"; ?>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script language="javascript">
   $(document).ready(function(){
	$("[rel='tooltip']").tooltip();
    })
</script>

</body>
</html>