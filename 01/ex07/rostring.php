#!/usr/bin/php
<?php
	$end = array();
	$str = trim($argv[1]);
	$str = preg_replace('/\s\s+/', ' ', $str);
	$new = explode(' ', $str);
	for ($j = 0; $j < count($new); $j++)
	{
		array_push($end, $new[$j]);
	}
	$l = count($end);
	for ($j = 1; $j < $l; $j++)
	{
		print("$end[$j] ");
	}
	print ("$end[0]");
?>