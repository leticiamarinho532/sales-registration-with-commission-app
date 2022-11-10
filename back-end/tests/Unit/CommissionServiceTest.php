<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;
use App\Services\CommissionService;

class CommissionServiceTest extends TestCase
{
    public function testShouldCalculateThePercentageOf8Dot5PercentInAValue()
    {
        $simulateCommisionCalc = new CommissionService();
        $input = 200;

        $output = $simulateCommisionCalc->calculate($input);

        $this->assertEquals(
            $output,
            17
        );
    }
}
