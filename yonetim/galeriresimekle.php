<?php
	ob_start();
	error_reporting(0);
	session_start();
	include "include/ayar.php";
	include "include/tirnak.php";
	if (!$_SESSION['oturum']) { header("location:index.php"); }

	$id = mysql_real_escape_string($_GET['id']);
	$syf = mysql_fetch_assoc(mysql_query("SELECT * FROM galeri WHERE id='$id'"));
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

	<link rel="stylesheet" href="css/jquery.fileupload.css">
    
    <script language="JavaScript">

    function toggle(source) {

      checkboxes = document.getElementsByName('resim_sil[]');

      for(var i=0, n=checkboxes.length;i<n;i++) {

        checkboxes[i].checked = source.checked;

      }

    }
        
    function sor(id){

        var soru = confirm('Seçilen Resmi Silmek İstediğinizden Emin misiniz?');
        if(soru == true){
            window.location.href='galeriresimsil.php?id='+id;
        }else{
            return false;        
        }
    
    }    

    </script>

</head>

<body>

	<div class="container">

		<?php include "include/header.php"; ?>

		<div class="row">
			<?php include "include/solmenu.php"; ?>

			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
					<h3 class="panel-title"><b><?php echo $syf['baslik']?></b> Galeri Resim(ler) Ekle</h3>
					</div>
					<div class="panel-body">

					    <blockquote>
					        <strong>Sınırsız Resim Yüklemesi Yapabilirsiniz. Ortalama resim boyutları 800px * 600px</strong>
					    </blockquote>
					    
					    <span class="btn btn-info btn-sm fileinput-button">
					        <i class="glyphicon glyphicon-cloud-upload"></i>
					        <span>Dosya Yüklemek İçin Tıklayınız</span>
					        <input id="fileupload" type="file" name="files[]" multiple>
					    </span>
					    <br>
					    <br>
					    <div id="progress" class="progress">
					        <div class="progress-bar progress-bar-success"></div>
					    </div>
					    
					    <div id="files" class="files">
                            <?php
                                if(isset($_POST['tumunu_sil'])){
                                    $resim_sil = $_POST['resim_sil'];
                                    foreach($resim_sil as $deger){
                                        $resim_name = mysql_fetch_assoc(mysql_query("SELECT * FROM galeriresimler WHERE id='$deger'"));
                                        $resim_name2 = "../".$resim_name['resim'];
                                        if(file_exists($resim_name2)){
                                            unlink("$resim_name2");
                                            mysql_query("DELETE FROM galeriresimler WHERE id='$deger'");
                                        }
                                    }
                                }                            
                            ?>
                            <form action="<?php echo $PHP_SELF;?>" method="post">
                                
                                <button type="submit" class="btn btn-danger btn-sm delete pull-right" name="tumunu_sil" onClick="return confirm('Seçilen Resimleri Silmek İstediğinizden Emin misiniz?');">
				                    <i class="glyphicon glyphicon-trash"></i>
				                    <span>Seçilenleri Sil</span>
				                </button>
                                
					    	<ul id="test-list">

							<li>
                            <div class="col-md-4">
                                <input type="checkbox" name="tumunu" id="tumunu" onClick="toggle(this)" style="margin-right:8px;" />
                                <b><u>Resim</u></b>
                            </div>
							<div class="col-md-4"><b><u>Resim Adı</u></b></div>
							<div class="col-md-4"><b><u>İşlemler</u></b></div>
							</li>
					    	
					    	<?php
					    		$resim = mysql_query("SELECT * FROM galeriresimler WHERE resid='$id' ORDER BY ordernum ASC");
					    		while($resimler = mysql_fetch_array($resim)){
					    	?>

					    	<li id="listItem_<?php echo $resimler['id']; ?>">
							  
							  <div class="col-md-4">
                                  <input type="checkbox" name="resim_sil[]" id="resim_sil" style="float:left;margin-right:10px;margin-top:25px;" value="<?php echo $resimler['id'];?>">
                                  <img src="../<?php echo $resimler['resim'];?>" class="thumbnail" width="100" style="float:left;" />
							  </div>
                                
                              <div class="col-md-4">
							     <?php echo $resimler['resim']?>
							  </div>
                                
							  <div class="col-md-4">

							  	<button type="button" class="btn btn-danger btn-sm delete" onClick="return sor('<?php echo $resimler["id"];?>');">
				                    <i class="glyphicon glyphicon-trash"></i>
				                    <span>Resim Sil</span>
				                </button>	

							  </div>
							
							</li>

					    	<?php } ?>

					    	</ul>
                            </form>

					    </div>

					</div>
				</div>

			</div>
		</div>

	</div>

	<?php include "include/footer.php"; ?>

	<script src="js/jquery-2.1.1.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!--# Resim Ekleme #-->
	<script src="js/vendor/jquery.ui.widget.js"></script>
	<script src="js/jquery.iframe-transport.js"></script>
	<script src="js/jquery.fileupload.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script>
	
	$(function () {
	    'use strict';
	    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : 'galeridosyaYukle.php?id=<?php echo $id;?>';
	    $('#fileupload').fileupload({
	        url: url,
	        dataType: 'json',
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
	                if(file.error==''){
	                	$('<p/>').text('Başarılı!!! Resim Yüklendi. '+file.name).appendTo('#files');
	                }else{
	                	$('<p/>').text('Hata!!! Resim Yüklenemedi. '+file.name).appendTo('#files');
	                }
	            });
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );

	            if(progress==100){
	            	setTimeout(function(){
	            		document.location.reload(true);
	            	},2000);
	            }

	        }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>
	<!--# Resim Ekleme #-->
    
</body>
</html>