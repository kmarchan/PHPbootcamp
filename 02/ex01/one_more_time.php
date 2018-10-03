#!/usr/bin/php
<?php
    $str = $argv[1];
    $frenchm = array(janvier, fevrier, mars, avril, mai, juin, juillet, aout, septembre, octobre, novembre, decembre);
	$str = trim($str);
	$noxspace = preg_replace('/\s\s+/', ' ', $str);
    $ret = explode(' ', $noxspace);
    $ret[2] = lcfirst("$ret[2]");
    $key = array_search($ret[2], $frenchm);
    $ret[2] = $key + 1;
    $in = time();
    $in = $ret[3]."-".$ret[2]."-".$ret[1]." ".$ret[4];
    $out = strtotime($in);
    if ($out == FALSE)
        echo "Wrong Format";
    echo $out;
?>