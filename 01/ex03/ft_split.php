#!/usr/bin/php
<?php
	function ft_split($str)
	{
		$str = trim($str);
		$noxspace = preg_replace('/\s\s+/', ' ', $str);
		$ret = explode(' ', $noxspace);
		sort($ret);
		return ($ret);
	}
?>
