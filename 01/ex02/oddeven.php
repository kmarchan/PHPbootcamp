#!/usr/bin/php
<?php

echo "Enter a number: ";
$in = trim(fgets(STDIN));
while ($in = trim(fgets(STDIN))); 
{
    if (is_numeric($in))
    {
        if ($in % 2 == 0)
            print "The number $in is even";
        else if ($in %2 != 0)
            print ("The number $in is odd");
    }
    else 
        print ("'$in' is not a number");
}
?>
