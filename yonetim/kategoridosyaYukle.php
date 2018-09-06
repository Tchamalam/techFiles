<?php

$toplam = count($_FILES["files"]["name"]);
$formatlar = array("image/png","image/jpeg","image/gif");

for ($i = 0; $i < $toplam; $i++){

$fileName = strtolower($_FILES['files']['name'][$i]);
$whitelist = array('jpg', 'png', 'gif', 'jpeg', 'JPG', 'PNG', 'JPEG'); #whitelist örneği
$backlist = array('php', 'php3', 'php4', 'phtml','exe','txt'); #kara liste örneği

if(!in_array(end(explode('.', $fileName)), $whitelist)) {
    echo 'Dosya türü desteklenmiyor';
    exit(0);
}

if(in_array(end(explode('.', $fileName)), $backlist)) {
    echo 'Dosya türü desteklenmiyor';
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

$kaynak = $_FILES["files"]["tmp_name"][$i];
$dosyaadi = $_FILES["files"]["name"][$i];
$dosyatipi = $_FILES["files"]["type"][$i];
$dboyut	= $_FILES["files"]["size"][$i];
$hedef = "dosya/";
$uzanti	= substr($dosyaadi, -4);
$yeniad = substr(md5(uniqid(rand())), 0,10);
$yeniresimadi = $hedef.$yeniad.".".$uzanti;
$a = "../".$hedef.$yeniad.".".$uzanti;
$yukle = move_uploaded_file($kaynak,$a);

    if ($yukle){
    	include "include/ayar.php";
    	$id = mysql_real_escape_string($_GET['id']);
    	$ekle =  @mysql_query("INSERT INTO kategoriresimler(resim, resid ) VALUES ('$yeniresimadi', '$id')");

    }

}
?>