#!/usr/bin/php
<?php
   function str($file)
   {
       $i = -1;
       while (++$i < strlen($file))
       {
           if($i = strpos($file, "<a", $i))
           {
               while ($file[$i] !== ">")
               {
                   $i++;
               }
               while ($file[++$i] !== "<")
               {
                   $file[$i] = strtoupper($file[$i]);
               }
           }
           else
           {
               break ;
           }
       }
       return ($file);
   }
   function title($file)
   {
       $i = -1;
       while (++$i < strlen($file))
       {
           if ($i = strpos($file, "title=", $i))
           {
               while ($file[$i] !== "\"")
               {
                   $i++;
               }
               while ($file[++$i] !== "\"")
               {
                   $file[$i] = strtoupper($file[$i]);
               }
           }
           else
           {
               break ;
           }
       }
       return ($file);
   }
    if ($argv[1])
    {
        $file = file_get_contents($argv[1]);
        $file = title($file);
        $file = str($file);
        echo $file;
    }
?>