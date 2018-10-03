#!/usr/bin/php
<?php
    function ft_is_sort($ar)
    {
        $new = array();
        $new = $ar;
        sort($new);
        if ($new == $ar)
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
?>