<?php

namespace App\Services;

class CommissionService
{
    public function calculate($value)
    {
        if (!$this->isValidValue($value)) {
            return false;
        }

        // ...
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
