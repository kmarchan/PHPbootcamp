<?php
class Tyrion {
   public function sleepWith($name)
   {
        if ($name instanceof Jaime || $name instanceof Cersei)
            print ("Not even if I'm am drunk !" . PHP_EOL);
        else if ($name instanceof Sansa)
            print ("Let's to this." . PHP_EOL);
   } 
}
?>