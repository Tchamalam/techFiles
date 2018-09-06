<?
	ob_start();
	error_reporting(0);
	session_start();
	include "include/ayar.php";
	include "include/tirnak.php";
	if (!$_SESSION['oturum']) { header("location:index.php"); exit(); }

	$id = mysql_real_escape_string($_GET['id']);
?>

<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">
	<title><?=$siteadi?> Yönetim Paneli</title>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

	<!-- Fck Başlangıç -->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<!-- Fck Bitiş -->
</head>
<body>
	<div class="container">
		<? include "include/header.php"; ?>
		<div class="row">
			<? include "include/solmenu.php"; ?>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title">Yeni Kayıt Ekle</h3>
					</div>
					<div class="panel-body">
					<?
					if(isset($_POST['gonder'])){
						
						$_POST = array_map("tirnak_replace", $_POST);
						$yetkili 	= $_POST['yetkili'];
						$adres 		= $_POST['adres'];
						$tel1 		= $_POST['tel1'];
						$tel2 		= $_POST['tel2'];
						$gsm1 		= $_POST['gsm1'];
						$gsm2 		= $_POST['gsm2'];
						$email 		= $_POST['email'];
						$il 		= $_POST['il'];
						$ilce 		= $_POST['ilce'];
						$tip 		= $_POST['tip'];

						$ekle =  mysql_query("insert into bayiler(yetkili, adres, tel1, tel2, gsm1, gsm2, email, il, ilce, tip)  values  ('$yetkili', '$adres', '$tel1', '$tel2', '$gsm1', '$gsm2', '$email', '$il', '$ilce', '$tip')");
						if($ekle){
							echo '<div class="alert alert-success">Yeni Kayıt Başarıyla Eklendi.</div>';
						} else {
							echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
						}
					}
					?>

					<form class="form-horizontal" method="POST" action="<?$PHP_SELF?>" enctype="multipart/form-data">


							<div class="form-group">
		                        <div class="col-md-6">
		                          <label>Bulunduğu İl:</label>
		                          <select name="il" class="form-control" id="ilsecimi" required>
		                            <option value="">Lütfen Seçim Yapınız</option>
		                            <?
		                            $iller = mysql_query("SELECT * FROM il WHERE UlkeId='213' ORDER BY IlAdi ASC");
		                            while($ilgetir = mysql_fetch_array($iller)){
		                            ?>
		                              <option value="<?=$ilgetir['Id']?>"><?=$ilgetir['IlAdi']?></option>
		                            <? } ?>
		                          </select>
		                        </div>

		                        <div class="col-md-6">
		                          <label>Bulunduğu İlçe:</label>
		                          <div id="ilceler">
		                            <select name="ilce" class="form-control" required>
		                              <option value="">Lütfen Seçim Yapınız</option>
		                            </select>
		                          </div>
		                        </div>
		                      </div>

		                    <div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Tip : </label>
									<select name="tip" class="form-control">
										<option value="">Lütfen Tip Seçiniz</option>
										<option value="1">Bayi</option>
										<option value="2">Teknik Servis</option>
									</select>
								</div>
							</div>


							<div class="col-md-6" style="width: 49%;">
								<div class="form-group">
									<label for="inputEmail">Yetkili : </label>
									<input type="text" class="form-control" id="inputEmail" name="yetkili" style="margin-left: 8px;" required>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="inputEmail">Adres : </label>
									<textarea name="adres" class="form-control" rows="3"></textarea>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">Tel 1 : </label>
									<input type="text" class="form-control" id="inputEmail" name="tel1">
								</div>
							</div>

							<div class="col-md-6" style="width: 49%;">
								<div class="form-group">
									<label for="inputEmail">Tel 2 : </label>
									<input type="text" class="form-control" id="inputEmail" name="tel2" style="margin-left: 8px;">
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail">GSM 1 : </label>
									<input type="text" class="form-control" id="inputEmail" name="gsm1">
								</div>
							</div>

							<div class="col-md-6" style="width: 49%;">
								<div class="form-group">
									<label for="inputEmail">GSM 2 : </label>
									<input type="text" class="form-control" id="inputEmail" name="gsm2" style="margin-left: 8px;">
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<label for="inputEmail">E-Posta : </label>
									<input type="text" class="form-control" id="inputEmail" name="email">
								</div>
							</div>



							<div class="form-group" style="padding-right:20px;">
								<div class="col-lg-4">
									<button name="gonder" type="submit" class="btn btn-default">Kayıt Ekle</button>
								</div>
							</div>

					</form>


					</div>
				</div>
			</div>
		</div>
	</div>

	<? include "include/footer.php"; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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

	<script type="text/javascript">
	  $('#ilsecimi').on('change', function() {
	      var secim = $(this).find(":selected").val();

	      $.ajax
	      ({ 
	          url: 'ilcegetir.php',
	          data: {"secim": secim},
	          type: 'post',
	          success: function(result)
	          {
	              $("#ilceler").html(result);
	          }
	      });

	  });
	</script>

</body>

</html>