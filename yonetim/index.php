<?php
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html class="no-js">
<head>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1,requiresActiveX=true">
	<title>Giriş Yap</title>

	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">

    <script type="text/javascript">
        function giris(){
        if($("#kadi").val() == ''){
          $("#kadi").attr("placeholder","Lütfen Kullanıcı Adınızı Belirtiniz...");
          return false;
        }
        if($("#sifre").val() == ''){
          $("#sifre").attr("placeholder","Lütfen Şifrenizi Belirtiniz...");
          return false;
        }
        $.ajax({
          type:'POST',
          url:'include/girisislem.php',
          data:$('#giris-form').serialize(),
          success:function(cevap){
            $("#sonuc").html(cevap);
          }
        });
        $("#kadi").val("");
        $("#sifre").val("");
        }
    </script>

</head>

<body>

	<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Lütfen Giriş Yapınız</h1>
            <div id="sonuc"></div>
            <div class="account-wall">
                <img class="profile-img" src="images/avatar.png"alt="">
                <form class="form-signin" id="giris-form">
                <input type="text" class="form-control" placeholder="Kullanıcı Adınız" name="kadi" id="kadi">
                <input type="password" class="form-control" placeholder="Şifreniz" name="sifre" id="sifre">
                <button class="btn btn-lg btn-primary btn-block" type="button" onclick="giris();">Giriş Yap</button>
                <p style="margin-top:8px;text-align:center;">Şifrenizi unuttuysanız lütfen sistem yöneticisi ile irtibata geçiniz..</p>
                </form>
            </div>
        </div>
    </div>
</div>

	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
  
  <script>
  $('input').keyup(function(e){
      if(e.keyCode == 13)
      {
          giris();
      }
    });
  </script>
</body>
</html>