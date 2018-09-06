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



	<div class="container">



		<?php include "include/header.php"; ?>



		<div class="row">

			<?php include "include/solmenu.php"; ?>



			<div class="col-md-9">

				<div class="panel panel-default">

					<div class="panel-heading">

					<h3 class="panel-title">Kategori Düzenle</h3>

					</div>

					<div class="panel-body">

						<?php

						if(isset($_POST['gonder'])){

								$baslik 			= $_POST['baslik'];

						if ($_FILES['dosya']['size']>0){ 

						$toplam = count($_FILES["dosya"]["name"]);
						$formatlar = array("image/png","image/jpeg","image/gif");

						for ($i = 0; $i < $toplam; $i++){

						$fileName = strtolower($_FILES['dosya']['name']);
						$whitelist = array('jpg', 'png', 'gif', 'jpeg'); #whitelist örneği
						$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

						if(!in_array(end(explode('.', $fileName)), $whitelist)) {
							echo '<div class="alert alert-danger">Hatalı Resim Seçimi</div>';
							exit(0);
						}

						if(in_array(end(explode('.', $fileName)), $backlist)) {
							echo '<div class="alert alert-danger">Hatalı Resim Seçimi</div>';
							exit(0);
						}

						$noktaArray = array();
						$j=0;
						while ( $j<strlen($fileName) ){
							 if($fileName[$i]=="."){
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

							$oncekiresim = mysql_fetch_assoc(mysql_query("SELECT * FROM galerikategoriler WHERE id='$id'"));
							$silinecek = $oncekiresim['resim'];
							unlink("../$silinecek");

							$guncelle = mysql_query("UPDATE galerikategoriler SET resim='$yeniresimadi', baslik='$baslik' WHERE id='$id'"); 
							if($guncelle){
							echo '<div class="alert alert-success">Kategori Bilgileri Başarıyla Düzenlendi</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}

							} 
						}
						} else {
							$guncelle2 = mysql_query("UPDATE galerikategoriler SET baslik='$baslik' WHERE id='$id'");
							if($guncelle2){
							echo '<div class="alert alert-success">Kategori Bilgileri Başarıyla Düzenlendi</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}
						}
						}

						$gelen = mysql_fetch_assoc(mysql_query("SELECT * FROM galerikategoriler WHERE id='$id'"));
						?>

						<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">

							<?php if($gelen['resim'] != ""){ ?>
								<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Önceki Resim</label>
								<div class="col-lg-10">
								<img src="../<?php echo $gelen['resim']?>" class="thumbnail" width="110">
								</div>
								</div>
							<?php } ?>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Referans Resmi</label>
								<div class="col-lg-10">
								<input type="file" name="dosya" />
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="baslik" placeholder="Referans Başlığı" value="<?php echo $gelen['baslik']?>">
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button name="gonder" type="submit" class="btn btn-default">Kategori Bilgilerini Düzenle</button>
								</div>
							</div>

					</form>

					<div class="clearfix"></div>


					</div>

				</div>



			</div>

		</div>



	</div>



	<?php include "include/footer.php"; ?>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

	<script src="js/bootstrap.min.js"></script>



	    <script src="js/sortable.js"></script>
        <script type="text/javascript">

		$(function() {
		  $("#test-list").sortable({
		    update:function(){
		      var posted = $(this).sortable("serialize");
		      $.post("referanssiralaislem.php",posted,function(e){
				})
		    }
		  })
		});
		</script>

	</script>

</body>

</html>