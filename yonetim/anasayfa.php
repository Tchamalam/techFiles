<?

	ob_start();

	error_reporting(0);

	session_start();

	include "include/ayar.php";

	if (!$_SESSION['oturum']) { header("location:index.php"); }

	$id = mysql_real_escape_string($_GET["id"]);

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

					<h3 class="panel-title">Anasayfa Bannerlar</h3>

					</div>

					<div class="panel-body">

						<?

							if(isset($_POST['banner_gonder'])){
								$son_id=mysql_fetch_object(mysql_query("select * from banner order by ids desc"));
								$idal=$son_id->id;
								$idal=$idal+1;
								if($_POST['csrf_token_name'] == sha1(md5(md5("incefikirler.com@vizyonhafifbeton*1592014+1404")))){
								
									// Dosya Upload Başlangıç

									$toplam = count($_FILES["dosya"]["name"]);
									$formatlar = array("image/png","image/jpeg","image/gif");

									$fileName = strtolower($_FILES['dosya']['name']);

									$whitelist = array('jpg', 'png', 'gif', 'jpeg'); #whitelist örneği
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
										$slogan  = $_POST['slogan'.$diller->links];
										$slogan=str_replace("'", "`", $slogan);
										$slogan1 = $_POST['slogan1'.$diller->links];
										$slogan1=str_replace("'", "`", $slogan1);
										$slogan2 = $_POST['slogan2'.$diller->links];
										$slogan2=str_replace("'", "`", $slogan2);
										$lnk = $_POST['lnk'.$diller->links];
										$lnk2 = $_POST['lnk2'.$diller->links];
										$ekle =  mysql_query("INSERT INTO banner (id, baslik, slogan, slogan1, slogan2, lnk, lnk2, dil) VALUES ('$idal','$yeniresimadi', '$slogan', '$slogan1', '$slogan2', '$lnk', '$lnk2', '$diller->id')");
										 }
										echo '<div class="alert alert-success">Yeni Banner Başarıyla Eklendi.</div>';

									} else {
										
										echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

									}
									
									// Dosya Upload Bitiş

								}else{

									return false;
									exit();

								}

							}

							if($id > 0){
									
								$resim = mysql_fetch_assoc(mysql_query("SELECT * FROM banner WHERE id='$id'"));
								$resim_adi  = $resim['baslik'];

								$silinecek_resim  = "../".$resim_adi;
								unlink($silinecek_resim);
								
								$sil = mysql_query("DELETE FROM banner WHERE id='$id'");

								if($sil){

									echo '<div class="alert alert-success">Banner Resmi Başarıyla Silindi.</div>';

								}else{

									echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';

								}

							}
						?>

						<form class="form-horizontal" method="POST" action="<?$PHP_SELF?>" enctype="multipart/form-data">
							
							<div id="myTabContent" class="tab-content">

								<ul class="nav nav-tabs" style="margin-bottom: 15px;">
                                  <? $sql_dil=mysql_query("select * from diller");
								  while($diller=mysql_fetch_object($sql_dil)){?>
								  <li><a href="#slogan<?=$diller->links?>" data-toggle="tab"><?=$diller->baslik?></a></li>
                                  <? } ?>
								</ul>

                                <div class="form-group">
                                    <label for="inputEmail" class="col-lg-2 control-label">Banner</label>
                                    <div class="col-lg-10">
                                    <input type="file" class="form-control" id="dosya" name="dosya">
                                    </div>
                                </div>
								<? 
								$j=0;
								$sql_dil2=mysql_query("select * from diller");
								while($diller2=mysql_fetch_object($sql_dil2)){
								$j++;
								?>
								<div class="tab-pane fade <? if($j==1){ echo "active"; } ?> in" id="slogan<?=$diller2->links?>">

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan<?=$diller2->links?>" name="slogan<?=$diller2->links?>" placeholder="Slogan">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan 1</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan1<?=$diller2->links?>" name="slogan1<?=$diller2->links?>" placeholder="Slogan 1">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Slogan 2</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="slogan2<?=$diller2->links?>" name="slogan2<?=$diller2->links?>" placeholder="Slogan 2">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Katalog</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="lnk<?=$diller2->links?>" name="slogan2<?=$diller2->links?>" placeholder="Katalog">
										</div>
									</div>

									<div class="form-group">
										<label for="inputEmail" class="col-lg-2 control-label">Kullanım Kılavuzu</label>
										<div class="col-lg-10">
										<input type="text" class="form-control" id="lnk2<?=$diller2->links?>" name="slogan2<?=$diller2->links?>" placeholder="Kullanım Kılavuzu">
										</div>
									</div>						
								
								<div class="form-group">
									<label class="col-lg-2"></label>
									<div class="col-lg-10">
										<button name="banner_gonder" type="submit" class="btn btn-default">Banner Ekle</button>
									</div>
								</div>
								</div>
								<? } ?>
								


							</div>

							<input type="hidden" name="csrf_token_name" value="<?=sha1(md5(md5("incefikirler.com@vizyonhafifbeton*1592014+1404")));?>" />

						</form>

						<ul id="test-list">

						<li>
						<div class="col-md-6"><b><u>Banner</u></b></div>
						<div class="col-md-3"><b><u>Banner Slogan</u></b></div>
						<div class="col-md-3"><b><u>İşlemler</u></b></div>
						</li>

						  <?
						  $pr = mysql_query("SELECT * FROM banner where dil='1' group by id ORDER BY ordernum ASC");
						  while($pr_getir = mysql_fetch_array($pr)){
						  ?>
						  
						  <li id="listItem_<? echo $pr_getir['id']; ?>">
						  <div class="col-md-6">
						      <div style="float:left;">
						      	<img src="images/arrow.png" alt="move" width="12" height="12" class="handle" />
						      </div>
						      <div class="thumbnail" style="float:left;width:150px;margin-left:15px;">
						      	<img src="../<?=$pr_getir['baslik']?>" width="200" />
						      </div>
						  </div>
						  <div class="col-md-3">
						      <?=$pr_getir['slogan'];?>
						  </div>
						  <div class="col-md-3"><a href="bannerduzenle.php?id=<?=$pr_getir['id']?>">Düzenle</a> - <a href="anasayfa.php?id=<?=$pr_getir['id']?>" onClick="return confirm('Bu Bannerı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
						  </li>

						  <? } ?>
						  </ul>
						<div style="clear:both;"></div>

					</div>

				</div>



			</div>

		</div>



	</div>



	<? include "include/footer.php"; ?>



	<script src="js/jquery.js"></script>

	<script src="js/bootstrap.min.js"></script>


	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
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



</body>

</html>