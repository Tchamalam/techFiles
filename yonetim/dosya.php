<?
	ob_start();
	error_reporting(0);
	session_start();
	include "include/ayar.php";
	include "include/tirnak.php";
	if (!$_SESSION['oturum']) { header("location:index.php"); }

	$id = mysql_real_escape_string($_GET['id']);
	$syf = mysql_fetch_assoc(mysql_query("SELECT * FROM sayfa WHERE id='$id'"));
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
					<h3 class="panel-title"><b>Dosya Yükle</h3>
					</div>
					<div class="panel-body">

						<?

						if(isset($_POST['gonder'])){

							$toplam = count($_FILES["dosya"]["name"]);
							$formatlar = array("image/png","image/jpeg","image/gif");

							for ($i = 0; $i < $toplam; $i++){
							$fileName = strtolower($_FILES['dosya']['name'][$i]);
							$whitelist = array('jpg', 'png', 'gif', 'jpeg', 'pdf', 'doc', 'docx', 'bmp'); #whitelist örneği
							$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

							if(!in_array(end(explode('.', $fileName)), $whitelist)) {
								echo '<div class="alert alert-danger">Resim Seçmediniz veya Seçtiğiniz Resim Türü Desteklenmiyor!</div>';
								exit(0);
							}

							if(in_array(end(explode('.', $fileName)), $backlist)) {
								echo '<div class="alert alert-danger">Resim Seçmediniz veya Seçtiğiniz Resim Türü Desteklenmiyor!</div>';
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
							$kaynak = $_FILES["dosya"]["tmp_name"][$i];
							$dosyaadi = $_FILES["dosya"]["name"][$i];
							$dosyatipi = $_FILES["dosya"]["type"][$i];
							$dboyut	= $_FILES["dosya"]["size"][$i];
							$hedef = "dosya/";
							$uzanti	= substr($dosyaadi, -4);
							$yeniad = substr(md5(uniqid(rand())), 0,10);
							$yeniresimadi = $hedef.$yeniad.".".$uzanti;
							$a = "../".$hedef.$yeniad.".".$uzanti;
							$yukle = move_uploaded_file($kaynak,$a);

							if ($yukle){
								include "include/ayar.php";
								
								//$_POST = array_map("tirnak_replace", $_POST);
								$baslik = $_POST['baslik'];

								$ekle =  mysql_query("insert into dosya(dosya, baslik)  values  ('$yeniresimadi', '$baslik')");
								echo '<div class="alert alert-success">Yeni Dosya Başarıyla Eklendi.</div>';
								} else {
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Dosya Seçtiğinizden Emin Olarak Tekrar Deneyiniz!</div>';
							}
							}
						}
						?>

					    <form class="form-horizontal" method="POST" action="<?$PHP_SELF?>" enctype="multipart/form-data">
						
							<fieldset>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Dosya</label>
								<div class="col-lg-10">
								<input type="file" name="dosya[]" class="form-control" />
								</div>
							</div>

							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Başlık</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="baslik" placeholder="Dosya Başlığı">
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button name="gonder" type="submit" class="btn btn-default">Dosya Yükle</button>
								</div>
							</div>

							</fieldset>
						</form>


						<?
						if($id > 0){
							$ds = mysql_fetch_assoc(mysql_query("SELECT * FROM dosya WHERE id='$id'"));
							$silinecek = $ds['dosya'];
							unlink("../$silinecek");
							$sil = mysql_query("DELETE FROM dosya WHERE id='$id'");
							if($sil){
								echo '<div class="alert alert-success">Seçilen Dosya Başarıyla Silindi</div>';
							} else {
								echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
							}
						}
						?>
						<hr/>
						<? $dosyasay = mysql_num_rows(mysql_query("SELECT * FROM dosya")); ?>
						<? if($dosyasay > 0){ ?>
							<ul id="test-list">
							<li>
							<div class="col-md-4"><b><u>Dosya Başlığı</u></b></div>
							<div class="col-md-7"><b><u>Link</u></b></div>
							<div class="col-md-1"><b><u>İşlemler</u></b></div>
							</li>

							  <?
							  $pr = mysql_query("SELECT * FROM dosya ORDER BY id desc");
							  while($pr_getir = mysql_fetch_array($pr)){
							  ?>

							  <li id="listItem_<? echo $pr_getir['id']; ?>">
							  <div class="col-md-4">
							      -&nbsp;&nbsp;<?=$pr_getir['baslik']?>
							  </div>
							  <div class="col-md-7">
							      <a href="../<?=$pr_getir['dosya']?>" target="_blank"><?=$web?><?=$pr_getir['dosya']?></a>
							  </div>
							  <div class="col-md-1"><a href="dosya.php?id=<?=$pr_getir['id']?>" onClick="return confirm('Bu Dosyayı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
							  </li>
							  <? } ?>
							  </ul>
							<div style="clear:both;"></div>
						<? } else { ?>
							<div class="alert alert-info">
									<strong>BİLGİ!</strong><br>Henüz Dosya Eklenmedi.
							</div>
						<? } ?>

					</div>
				</div>

			</div>
		</div>

	</div>

	<? include "include/footer.php"; ?>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>

</body>
</html>