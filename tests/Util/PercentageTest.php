<?php

namespace Test\Util;

use App\Util\Percentage;
use PHPUnit\Framework\TestCase;

class PercentageTest extends TestCase
{
    public function testFindStepInFlow(): void
    {
        $this->assertEquals(1, Percentage::findStepInFlow(39));
        $this->assertEquals(2, Percentage::findStepInFlow(40));
    }

    public function testCalculatePercentageAverage(): void
    {
        $this->assertEquals(75, Percentage::calculatePercentageAverage(3, 4));
        $this->assertEquals(25, Percentage::calculatePercentageAverage(1, 4));
    }

    public function testCalculatePercentageAverageException(): void
    {
        $this->expectException(\BadFunctionCallException::class);
        Percentage::calculatePercentageAverage(3, 0);
    }
}