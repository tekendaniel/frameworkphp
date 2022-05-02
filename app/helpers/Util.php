<?php

class Util{


    static public function InitialsName(String $tex1, string $tex2)
    {

        return strtoupper(substr($tex1, 0, 1) . substr($tex2, 0, 1));
    }
}

