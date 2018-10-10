<?php
    class NightsWatch implements IFighter {
        private $fght;
        function recruit($sold) {
            if (method_exists($sold, 'fight'))
                $fght = ($sold->fight());
        }
        function fight() {
            print ($fght);
        }
    }
?>