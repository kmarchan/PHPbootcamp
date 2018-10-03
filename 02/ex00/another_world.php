#!/usr/bin/php
<?php
    if ($argc > 1)
    {
        $str = trim($argv[1]);
        $noxspace = preg_replace('/\s\s+/', ' ', $str);
        print ("$noxspace\n");
    }
?>