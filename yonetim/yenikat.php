<?php
	ob_start();
	session_start();
	include "include/ayar.php";
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

</head>

<body>

	<div class="container">

		<?php include "include/header.php"; ?>

		<div class="row">
			<?php include "include/solmenu.php"; ?>

			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title">Yeni Renk Ekle</h3>
					</div>
					<div class="panel-body">

						<?php
						if(isset($_POST['gonder'])){
                            
						$son_id=mysql_fetch_object(mysql_query("select * from kategoriler order by ids desc"));
						$idal=$son_id->id;
						$idal=$idal+1;
						$baslik   = $_POST["basliktr"];

							if($baslik == ""){
								echo '<div class="alert alert-danger">Lütfen Tüm Alanları Doldurup Tekrar Deneyiniz!</div>';
							} else {
								if($_FILES["dosya"]["size"] > 0){

									// Dosya Upload Başlangıç

									$toplam = count($_FILES["dosya"]["name"]);
									$formatlar = array("image/png","image/jpeg","image/gif");

									$fileName = strtolower($_FILES['dosya']['name']);

									$whitelist = array('jpg', 'png', 'gif', 'jpeg'); #whitelist örneği
									$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

									if(!in_array(end(explode('.', $fileName)), $whitelist)) {
									    
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
										$baslik   = $_POST['baslik'.$diller->links];

										$baslikseo   = sef($_POST['baslik'.$diller->links]);
										$sqlsay=mysql_num_rows(mysql_query("select * from kategoriler where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
										if ($sqlsay>1)
										{
										$baslikseo = $baslikseo."-".$id;
										}
										$kat   = $_POST['kat'];
										$kisa_yazi   = $_POST['kisa_yazi'.$diller->links];
										$ekle =  mysql_query("INSERT INTO kategoriler (id, katid, baslik, baslikseo, kisa_yazi, resim, dil) VALUES ('$idal', '$kat', '$baslik', '$baslikseo', '$kisa_yazi', '$yeniresimadi','$diller->id')");
									}
										if($ekle){
											echo '<div class="alert alert-success">Yeni Renk Başarıyla Eklendi</div>';
											header("Refresh:3;url=yenikat.php");
										}else{
											echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
										}

									} else {
										
										echo '<div class="alert alert-danger">Resim Yüklenemedi!</div>';

									}
									
									// Dosya Upload Bitiş

								}else{
									$sql_dil=mysql_query("select * from diller");
									while($diller=mysql_fetch_object($sql_dil)){
										$baslik   = $_POST['baslik'.$diller->links];
										$baslikseo   = sef($_POST['baslik'.$diller->links]);
										$sqlsay=mysql_num_rows(mysql_query("select * from kategoriler where baslikseo='".$baslikseo."' and dil='".$_SESSION["dil"]."'"));
										if ($sqlsay>1)
										{
										$baslikseo = $baslikseo."-".$id;
										}
										$kat   = $_POST['kat'];
										$kisa_yazi   = $_POST['kisa_yazi'.$diller->links];
									$ekle2 = mysql_query("INSERT INTO kategoriler (id, katid, baslik, baslikseo, kisa_yazi, dil) VALUES ('$idal', '$kat','$baslik', '$baslikseo', '$kisa_yazi', '$diller->id')");
									}
									if($ekle2){

										echo '<div class="alert alert-success">Yeni Renk Başarıyla Eklendi</div>';
										header("Refresh:3;url=yenikat.php");

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
								<label for="inputEmail" class="col-lg-2 control-label">Resim</label>
								<div class="col-lg-10">
								<input type="file" class="form-control" id="inputEmail" name="dosya">
								</div>
							</div>

							<div class="form-group">
                                <label for="inputEmail" class="col-lg-2 control-label">Kategori</label>
                                <div class="col-lg-10">
                                <select name="kat" class="form-control">
                                    <option value="0">Seçiniz</option>
                                    <?php
                                        $kategori = mysql_query("select * from kategoriler where katid='0' and dil='1' order by ordernum asc");
                                        while($kyaz = mysql_fetch_array($kategori)):
                                    ?>
                                    <option value="<?php echo $kyaz['id'];?>"><?php echo $kyaz['baslik'];?></option>
                                    <?php endwhile; ?>
                                </select>
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
								<label for="inputEmail" class="col-lg-2 control-label">Renk Adı</label>
								<div class="col-lg-10">
								<input type="text" class="form-control" id="inputEmail" name="baslik<?php echo $diller2->links?>" placeholder="Renk Adı">
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-2 control-label">Renk Kısa Açıklama</label>
								<div class="col-lg-10">
								<textarea class="form-control" name="kisa_yazi<?php echo $diller2->links?>"></textarea>
								</div>
							</div>

						    </fieldset>
						    </div>
						    <?php } ?>
							<div class="form-group">
								<div class="col-lg-10 col-lg-offset-2">
									<button name="gonder" type="submit" class="btn btn-default">Renk Ekle</button>
								</div>
							</div>
                                </div>
					   </form>
                        
                       <?php
                        if($id > 0){
                            $sil = mysql_query("DELETE FROM kategoriler WHERE id='$id'");
                            if($sil){
                                echo '<div class="alert alert-success">Seçilen Takım Başarıyla Silindi</div>';
                            } else {
                                echo '<div class="alert alert-danger">Beklenmedik Bir Hata Oluştu.Lütfen Tekrar Deneyiniz!</div>';
                            }
                        }
                        ?>

                        <hr/>
                        <ul id="test-list">
                        <li>
                        <div class="col-md-8"><b><u>Takım Adı</u></b></div>
                        <div class="col-md-4"><b><u>İşlemler</u></b></div>
                        </li>

                          <?php
                          $pr = mysql_query("SELECT * FROM kategoriler where katid='0' group by id ORDER BY ordernum ASC");
                          while($pr_getir = mysql_fetch_array($pr)){
                          ?>

                          <li id="listItem_<?php echo $pr_getir['id']; ?>">
                          <div class="col-md-8">
                              <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" />&nbsp;&nbsp;<?php echo $pr_getir['baslik']?>
                          </div>
                          <div class="col-md-4"><a href="katduzenle.php?id=<?php echo $pr_getir['id']?>">Düzenle</a> - <a href="yenikat.php?id=<?php echo $pr_getir['id']?>" onClick="return confirm('Bu Kayıtı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
                          </li>
                          <?php 
						  $altkat_sql=mysql_query("SELECT * FROM kategoriler where katid='".$pr_getir["id"]."' group by id ORDER BY ordernum ASC");
						  while($altkats=mysql_fetch_object($altkat_sql)){
							
                          ?>

                          <li id="listItem_<?php echo $altkats->id; ?>" style="padding-left:25px;">
                          <div class="col-md-8">
                              <img src="images/arrow.png" alt="move" width="12" height="12" class="handle" />&nbsp;&nbsp;<?php echo $altkats->baslik?>
                          </div>
                          <div class="col-md-4"><a href="kategoriresimekle.php?id=<?php echo $altkats->id?>">Resim Ekle</a> - <a href="katduzenle.php?id=<?php echo $altkats->id?>">Düzenle</a> - <a href="yenikat.php?id=<?php echo $altkats->id?>" onClick="return confirm('Bu Kayıtı Silmek İstediğinizden Emin misiniz?')">Sil</a></div>
                          </li>
                          <?php }
							  } ?>
                          </ul>
                        <div style="clear:both;"></div>

					</div>
				</div>

			</div>
		</div>

	</div>

	<?php include "include/footer.php"; ?>

	<script src="js/jquery.js"></script>
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
		      $.post("katsiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>
	</script>
</body>
</html>