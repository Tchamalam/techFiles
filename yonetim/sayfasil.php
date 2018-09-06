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
					<h3 class="panel-title">Anasayfa / Site Ayarları</h3>
					</div>
					<div class="panel-body">

						<?php
						$id = mysql_real_escape_string($_GET['id']);
						$sil = mysql_query("DELETE FROM sayfa WHERE id='$id'");
						if($sil){
							echo '<div class="alert alert-success">Seçilen Sayfa Başarıyla Silindi.Lütfen Bekleyiniz..</div>';
							header("refresh:2; url=anasayfa.php");
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
							header("refresh:2; url=anasayfa.php");
						}
						?>						

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

</body>
</html>