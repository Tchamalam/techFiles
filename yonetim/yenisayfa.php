<?php
	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	include "include/tirnak.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }



	$id = mysql_real_escape_string($_GET['id']);
	function sef($string)
	{
		$find = array('Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ö', 'ı', '+', '#');
		$replace = array('c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'o', 'i', 'plus', 'sharp');
		$string = strtolower(str_replace($find, $replace, $string));
		$string = preg_replace("@[^A-Za-z0-9\-_\.\+]@i", ' ', $string);
		$string = trim(preg_replace('/\s+/', ' ', $string));
		$string = str_replace(' ', '-', $string);
		return $string;
	}
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

					<h3 class="panel-title">Yeni Altsayfa</h3>

					</div>

					<div class="panel-body">

					<?php

					$id = mysql_real_escape_string($_GET['id']);

					if(isset($_POST['gonder'])){
						
						$_POST = array_map("tirnak_replace", $_POST);

						$son_id=mysql_fetch_object(mysql_query("select * from sayfa order by ids desc"));
						$idal=$son_id->id;
						$idal=$idal+1;
						
						$katid = $_POST['katid'];
						
						$baslik   = $_POST["basliktr"];
						$public   = $_POST["public"];
						$sor = mysql_query("SELECT * FROM sayfa WHERE baslik='$baslik'");
						

							if($baslik == ""){

								echo '<div class="alert alert-danger">Başlık Alanını Boş Bırakmayınız.</div>';

							}else{
								if($_FILES["dosya"]["size"] > 0){

									// Dosya Upload Başlangıç

									$toplam = count($_FILES["dosya"]["name"]);
									$formatlar = array("image/png","image/jpeg","image/gif");

									$fileName = strtolower($_FILES['dosya']['name']);

									$whitelist = array('jpg', 'png', 'gif', 'jpeg', 'pdf'); #whitelist örneği
									$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

									if(!in_array(end(explode('.', $fileName)), $whitelist)) {
									    
									    echo '<div class="alert alert-danger">Dosya türü desteklenmiyor</div>';

									    //exit(0);
									}

									if(in_array(end(explode('.', $fileName)), $backlist)) {
									    
									    echo '<div class="alert alert-danger">Dosya türü desteklenmiyor</div>';
										//exit(0);

									}

									$noktaArray = array();
									$j=0;
									while ( $j<strlen($fileName) ){
									     if($fileName=="."){
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
									
									$sql_dil=mysql_query("select * from diller");
									while($diller=mysql_fetch_object($sql_dil)){
									$baslik   = $_POST["baslik".$diller->links];
									$baslik	  = str_replace("'", "`", $baslik);
									$baslikseo = sef($_POST['baslik'.$diller->links]);
									$sqlsay=mysql_num_rows(mysql_query("select * from sayfa where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
									if ($sqlsay>1)
									{
										$baslikseo = $baslikseo."-".$idal;
									}
									$kisa_yazi 	  = $_POST["kisa_yazi".$diller->links];
									$kisa_yazi=str_replace("'", "`", $kisa_yazi);
									$yazi 	  = $_POST["yazi".$diller->links];
									$yazi=str_replace("'", "`", $yazi);
									$ekle =  mysql_query("INSERT INTO sayfa (id, baslik, baslikseo, katid, resim, kisa_yazi, yazi, dil) VALUES ('$idal', '$baslik', '$baslikseo', '$katid', '$yeniresimadi', '$kisa_yazi', '$yazi', '$diller->id')");
									}
										echo '<div class="alert alert-success">Yeni Sayfa Başarıyla Eklendi</div>';

									} else {
										
										echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

									}
									
									// Dosya Upload Bitiş

								}else{
									$sql_dil=mysql_query("select * from diller");
									while($diller=mysql_fetch_object($sql_dil)){
									$baslik   = $_POST["baslik".$diller->links];
									$baslik=str_replace("'", "`", $baslik);
									$baslikseo = sef($_POST['baslik'.$diller->links]);
									$sqlsay=mysql_num_rows(mysql_query("select * from sayfa where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
									if ($sqlsay>1)
									{
										$baslikseo = $baslikseo."-".$idal;
									}
									$kisa_yazi 	  = $_POST["kisa_yazi".$diller->links];
									$kisa_yazi	  = str_replace("'", "`", $kisa_yazi);
									$yazi 	  	  = $_POST["yazi".$diller->links];
									$yaz	  	  = str_replace("'", "`", $yazi);
									$ekle2 = mysql_query("INSERT INTO sayfa (id, baslik, baslikseo, kisa_yazi, katid, yazi, dil) VALUES ('$idal', '$baslik', '$baslikseo', '$kisa_yazi', '$katid', '$yazi', '$diller->id')");
									}
										
									if($ekle2){

										echo '<div class="alert alert-success">Yeni Sayfa Başarıyla Eklendi</div>';

									}else{

										echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

									}
								}
							}
					}

					?>

					<form class="form-horizontal" method="POST" action="<?php $PHP_SELF?>" enctype="multipart/form-data">

						<div id="myTabContent" class="tab-content">

							<ul class="nav nav-tabs" style="margin-bottom: 15px;">
							  <?php $sql_dil=mysql_query("select * from diller");
                              while($diller=mysql_fetch_object($sql_dil)){?>
                              <li><a href="#<?php echo $diller->links?>" data-toggle="tab"><?php echo $diller->baslik?></a></li>
                              <?php } ?>
							</ul>

							<div class="form-group">
								<label for="select" class="col-lg-2 control-label">Üst Sayfa</label>
								<div class="col-lg-10">
									<select class="form-control" name="katid" id="select">
									<option value="0">Seçiniz</option>
									<?php
									$ust = mysql_query("SELECT * FROM sayfa WHERE katid='0' and dil='1' ORDER BY ordernum ASC");
									while($ust_getir = mysql_fetch_array($ust)){
									?>
										<option value="<?php echo $ust_getir['id']?>" <?php if($id == $ust_getir['id']){ echo "selected"; } ?>><?php echo $ust_getir['baslik']?></option>
									<?php $ust2 = mysql_query("SELECT * FROM sayfa WHERE katid='".$ust_getir["id"]."' and dil='1' ORDER BY ordernum ASC");
									while($ust_getir2 = mysql_fetch_array($ust2)){
									?>
										<option value="<?php echo $ust_getir2['id']?>" <?php if($id == $ust_getir2['id']){ echo "selected"; } ?>>&nbsp;&nbsp;&nbsp;<?php echo $ust_getir2['baslik']?></option>
									<?php $ust3 = mysql_query("SELECT * FROM sayfa WHERE katid='".$ust_getir2["id"]."' and dil='1' ORDER BY ordernum ASC");
									while($ust_getir3 = mysql_fetch_array($ust3)){
									?>
										<option value="<?php echo $ust_getir3['id']?>" <?php if($id == $ust_getir3['id']){ echo "selected"; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ust_getir3['baslik']?></option>
									<?php $ust4 = mysql_query("SELECT * FROM sayfa WHERE katid='".$ust_getir3["id"]."' and dil='1' ORDER BY ordernum ASC");
									while($ust_getir4 = mysql_fetch_array($ust4)){
									?>
										<option value="<?php echo $ust_getir4['id']?>" <?php if($id == $ust_getir4['id']){ echo "selected"; } ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ust_getir4['baslik']?></option>
									<?php }}}} ?>
									</select>
								</div>
							</div>
							

                            <div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Resim</label>
                                <div class="col-lg-10">
                                <input type="file" class="form-control" id="inputEmail" name="dosya">
                                </div>
                            </div>
                            
							<?php 
							$j=0;
							$sql_dil2=mysql_query("select * from diller");
							while($diller2=mysql_fetch_object($sql_dil2)){
							$j++;
							?>
							<div class="tab-pane <?php if($j==1){ echo "active"; } ?> fade in" id="<?php echo $diller2->links?>">
								
								<fieldset>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Sayfa Başlığı</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="inputEmail" name="baslik<?php echo $diller2->links?>" placeholder="Sayfa Başlığı" value="<?php echo $syf['baslik']?>">
										</div>
									</div>
									
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-lg-2 control-label">Kısa Açıklama</label>
                                        <div class="col-lg-10">
                                        <textarea class="form-control" name="kisa_yazi<?php echo $diller2->links?>"></textarea>
                                        </div>
                                    </div>
                                    
									<div class="form-group">
										<div class="col-lg-12">
										<textarea name="yazi<?php echo $diller2->links?>" id="editor<?php echo $diller2->id?>"><?php echo $syf['yazi']?></textarea>
										</div>
									</div>

									<div class="form-group">
										<div class="col-lg-12">
											<input name="gonder" type="submit" class="btn btn-default" value="Yeni Altsayfa Ekle">
										</div>
									</div>

								</fieldset>

							</div>
							<?php } ?>

						</div>						

					</form>

					</div>

				</div>

			</div>

		</div>



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
		CKEDITOR.replace( 'editor4',
			{
			filebrowserBrowseUrl : 'ckeditor/kcfinder/browse.php',
			filebrowserImageBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Images',
			filebrowserFlashBrowseUrl : 'ckeditor/kcfinder/browse.php?type=Flash',
			filebrowserUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Files',
			filebrowserImageUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Images',
			filebrowserFlashUploadUrl : 'ckeditor/kcfinder/upload.php?command=QuickUpload&type=Flash'
			}
		);
		CKEDITOR.replace( 'editor5',
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