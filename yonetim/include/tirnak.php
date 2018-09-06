<?php
function tirnak_replace ($par)
{
	return str_replace(
		array(
			"'"
			),
		array(
			"`"
		),
		$par
	);
}
?>