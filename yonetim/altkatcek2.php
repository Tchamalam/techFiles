<?php
	include('include/ayar.php');
		
	$altkatId = mysql_real_escape_string($_POST['altkatId']);
	$seckatId = mysql_real_escape_string($_POST['seckatId']);
	$rv = '';
	if($altkatId != 0){
		$query = mysql_query('select * from ilceler where katid = "'.$altkatId.'"');
		$rv .= '<option value="0">Seçiniz</option>';
		while($urunkat = mysql_fetch_array($query)){
			if ($seckatId==$urunkat[id]){ $selecteds=' selected="selected"';}else{$selecteds="";}
			$rv .= '<option value="'. $urunkat['id'].'" '.$selecteds.'>'.$urunkat['baslik'].'</option>';	
		}
		
		echo $rv;
	}
?>