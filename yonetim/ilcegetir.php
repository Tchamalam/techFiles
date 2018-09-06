<?
	include "include/ayar.php";
	
	$secim = mysql_real_escape_string($_POST['secim']);
	
?>

<select name="ilce" id="ilcesecimi" class="form-control" required>
	<?
	$ilceler = mysql_query("SELECT * FROM ilce WHERE IlId='".$secim."' ORDER BY IlceAdi ASC");
	while($ilcegetir = mysql_fetch_array($ilceler)){
	?>
		<option value="<?=$ilcegetir['Id']?>"><?=$ilcegetir['IlceAdi']?></option>
	<? } ?>
</select>