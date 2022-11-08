<?php

namespace App\Services;

class CommissionService
{
    private $percentage = 8.5;

    public function calculate($value)
    {
        if (!$this->isValidValue($value)) {
            return false;
        }

        $result = ($this->percentage/100) * $value;

        return $result;
    }

    private function isValidValue($value)
    {
        if (!is_numeric($value)) {
            return false;
        }

        if ($value < 0) {
            return false;
        }

        return true;
    }
}
