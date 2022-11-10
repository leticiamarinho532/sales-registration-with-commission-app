<?php

namespace App\Services;

class CommissionService
{
    private $percentage = 8.5;

    public function calculate($value)
    {
        $result = ($this->percentage/100) * $value;

        return $result;
    }
}
