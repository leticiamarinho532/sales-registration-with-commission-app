<?php

namespace App\Services;

class CommissionService
{
    private $percentage = 8.5;

    public function calculate($value)
    {
        $comission = ($this->percentage/100) * $value;

        $formattedComission = number_format($comission, 2);

        return $formattedComission;
    }
}
