<?php

ob_start();
include "include/ayar.php";
include "include/tirnak.php";

foreach ($_POST['listItem'] as $position => $item) :
	mysql_query("UPDATE `ozellikler` SET `ordernum` = $position WHERE `id` = '$item'");
	endforeach;
?> 