<?php
	ob_start();
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
					<h3 class="panel-title">Yeni Yönetici Ekle</h3>
					</div>
					<div class="panel-body">

						<?php
						if(isset($_POST['gonder'])){
							$adsoyad = $_POST['adsoyad'];
							$email = $_POST['email'];
							$kadi = $_POST['kadi'];
							$sifre = $_POST['sifre'];

							if($adsoyad == "" or $email == "" or $kadi == "" or $sifre == ""){
								echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurup Tekrar Deneyiniz!</div>';
							} else {
								$sifre = md5($_POST['sifre']);
								$ekle =  mysql_query("insert into yonetim(adsoyad, email, kadi, sifre)  values  ('$adsoyad', '$email', '$kadi', '$sifre')");

								if($ekle){
									echo '<div class="alert alert-success">Yeni Yönetici Başarıyla Eklendi.</div>';
								} else {
									echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
								}

							}
						}
						?>

						<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>">
							<fieldset>
							
							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Adı Soyadı</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="adsoyad" placeholder="Ad Soyad">
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">E-Mail</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="email" placeholder="E-Mail Adresi">
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Kullanıcı Adı</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="kadi" placeholder="Kullanıcı Adı">
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword" class="col-lg-2 control-label">Şifre</label>
								<div class="col-lg-10">
								<input type="password" class="form-control" id="inputPassword" name="sifre" placeholder="Kullanıcı Şifresi">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button name="gonder" type="submit" class="btn btn-default">Kullanıcıyı Ekle</button>
								</div>
							</div>
						</fieldset>
					</form>

					</div>
				</div>

			</div>
		</div>

	</div>

	<?php include "include/footer.php"; ?>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>