<?php
	include('include/ayar.php');
		
	$KatId = mysql_real_escape_string($_POST['katid']);
	$seckatId = mysql_real_escape_string($_POST['seckatid']);
	$rv = '';
	echo "select * from kategoriler where katid='".$KatId."' and dil='".$_SESSION["dil"]."' order by ordernum asc";
	if($KatId != 0){
		$query = mysql_query("select * from kategoriler where katid='".$KatId."' and dil='".$_SESSION["dil"]."' order by ordernum asc");
			$rv .= '<option value="0">Seçiniz</option>';
		while($urunkat = mysql_fetch_array($query)){
			if ($seckatId==$urunkat[id]){ $selecteds=' selected="selected"';}else{ $selecteds="";}
			$rv .= '<option value="'. $urunkat['id'].'" '.$selecteds.'>'.$urunkat['baslik'].'</option>';	
		}
		
		echo $rv;
	}
?>