<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Str;
use App\Services\CommissionService;

class CommissionServiceTest extends TestCase
{
    public function testShouldReturnFalseIfValueGivenIsNotANumber()
    {
        $simulateCommisionCalc = new CommissionService();
        $input = Str::random(5);

        $output = $simulateCommisionCalc->calculate($input);

        $this->assertFalse($output);
    }

    public function testShouldReturnFalseIfNumberGivenIsNegative()
    {
        $simulateCommisionCalc = new CommissionService();
        $input = rand(-10, -1);

        $output = $simulateCommisionCalc->calculate($input);

        $this->assertFalse($output);
    }

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
