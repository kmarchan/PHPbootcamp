<?php
class Jaime {
   public function sleepWith($name)
   {
        if ($name instanceof Tyrion)
            print ("Not even if I'm am drunk !" . PHP_EOL);
        else if ($name instanceof Sansa)
            print ("Let's to this." . PHP_EOL);
        else if ($name instanceof Cersei)
            print ("With pleasure, bit only in a tower in Winterfell, then." . PHP_EOL);
   } 
}
?>