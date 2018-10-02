#!/usr/bin/php
<?php
echo "Enter a number: ";
while ($in = fgets(STDIN)) 
{
    $in = trim($in);
    if (is_numeric($in))
    {
        if ($in % 2 == 0)
        {
            echo "The number $in is even\n";
        }
        else
        {
           echo "The number $in is odd\n";
        }
    }
    else
    {
        echo "'$in' is not a number\n";
    }
    echo "Enter a number: ";
}
echo "\n";
?>
