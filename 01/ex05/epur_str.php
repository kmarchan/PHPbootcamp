#!/usr/bin/php
<?php
	if ($argc == 2)
	{
		$arg = $argv[1];
		$str = trim($arg);
		$str = preg_replace('/\s\s+/', ' ', $str);
		print ("$str\n");
	}
?>