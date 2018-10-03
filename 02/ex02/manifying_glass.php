#!/usr/bin/php
	<!-- // $file = fopen($argv[1], "r") or die("unable to open file!");
	// $i = str_find($file, "<a");
	// $e = str_find($file, "/a>");
	// while ($i < $e)
	// {
	// 	strchr();
	// } -->

<?php
   function lookforstr($data)
   {
       $i = -1;
       while (++$i < strlen($data))
       {
           if($i = strpos($data, "<a", $i))
           {
               while ($data[$i] !== ">")
                   $i++;
               while ($data[++$i] !== "<")
                   $data[$i] = strtoupper($data[$i]);
           }
           else
               break ;
       }
       return ($data);
   }
   function lookfortitle($data)
   {
       $i = -1;
       while (++$i < strlen($data))
       {
           if ($i = strpos($data, "title=", $i))
           {
               while ($data[$i] !== "\"")
                   $i++;
               while ($data[++$i] !== "\"")
                   $data[$i] = strtoupper($data[$i]);
           }
           else
               break ;
       }
       return ($data);
   }
    if ($argv[1])
    {
        $data = file_get_contents($argv[1]);
        $data = lookfortitle($data);
        $data = lookforstr($data);
        echo $data;
    }
?>