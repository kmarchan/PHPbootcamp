#!/usr/bin/php
<?php
$end = array();
$i = 1;
	while ($i < $argc)
	{
		$str = trim($argv[$i]);
		$str = preg_replace('/\s\s+/', ' ', $str);
		$new = explode(' ', $str);
		for ($j = 0; $j < count($new); $j++)
		{
			array_push($end, $new[$j]);
		}
		$i++;
	}
	sort($end);
	for ($j = 0; $j < count($end); $j++)
	{
		print("$end[$j]\n");
	}
?>