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
	<title><?php echo $siteadi?> Admin Panel</title>

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
					<h3 class="panel-title">Sayfa Sıralamaları</h3>
					</div>
					
					<div class="panel-body">

						<ul id="test-list">

							<?php

							$ana_kat = mysql_query("SELECT * FROM sayfa WHERE katid=0 order by ordernum asc");

							while($ana_kat_yaz = mysql_fetch_array($ana_kat)){

								echo "<li id=listItem_'".$ana_kat_yaz["id"]."'><img src='images/arrow.png' alt='move' width='12' height='12' class='handle' /><b>".$ana_kat_yaz["baslik"]."</b>"; 
								altkat($ana_kat_yaz["id"]);
								echo "</li>";

							}

							function altkat($gelen){

								$alt_kat = mysql_query("SELECT * FROM sayfa WHERE katid='$gelen' order by ordernum asc");

								while($alt_kat_yaz = mysql_fetch_array($alt_kat)){

									//echo "<ul id='test-list'>";
									echo "<li id=listItem_'".$alt_kat_yaz["id"]."' style='padding-left:15px;'><img src='images/arrow.png' alt='move' width='12' height='12' class='handle' /><b>".$alt_kat_yaz["baslik"]."</b>"; 
									altkat($alt_kat_yaz["id"]);
									echo "</li>";
									//echo "</ul>";

								}

							}

							?>

						</ul>

					<div style="clear:both;"></div>
					
				</div></div>

			</div>
		</div>

	</div>

	<?php include "include/footer.php"; ?>

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
		      $.post("sayfasiralaislem.php",posted,function(e){
			   
				})
		    }
		  })
		});
		</script>

</body>
</html>