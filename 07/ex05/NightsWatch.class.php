<?php
    class NightsWatch implements IFighter {
        private $fght;
        function recruit($sold) {
            if (method_exists($sold, 'fight'))
                $fght = ("* ".$sold->fight(). PHP_EOL);
        }
        function fight() {
            print ($fght. PHP_EOL);
        }
    }
?>