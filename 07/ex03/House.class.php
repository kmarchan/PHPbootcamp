<?php 
class House {
    public function introduce() {
        $ret = "House ".$this->getHouseName() . " of ". $this->getHouseSeat(). " : " . "\"". $this->getHouseMotto()."\"";
        print ($ret. PHP_EOL);
    }
}
?>