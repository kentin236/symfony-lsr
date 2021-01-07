<?php

namespace App\Util;

class Calculator
{
    public function add(int $a, int $b): float
    {
        return ($a + $b);
    }

    public function min(int $a, int $b): float
    {
        return ($a - $b);
    }
}
