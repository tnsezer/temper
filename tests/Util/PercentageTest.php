<?php

namespace Test\Util;

use App\Util\Percentage;
use PHPUnit\Framework\TestCase;

class PercentageTest extends TestCase
{
    /** @var Percentage $percentage */
    private $percentage;

    public function setUp()
    {
        $this->percentage = new Percentage();
    }

    public function testFindStepInFlow(): void
    {
        $this->assertEquals(1, $this->percentage->findStepInFlow(39));
        $this->assertEquals(2, $this->percentage->findStepInFlow(40));
    }

    public function testCalculatePercentageAverage(): void
    {
        $this->assertEquals(75, $this->percentage->calculatePercentageAverage(3, 4));
        $this->assertEquals(25, $this->percentage->calculatePercentageAverage(1, 4));
    }

    public function testCalculatePercentageAverageException(): void
    {
        $this->expectException(\BadFunctionCallException::class);
        $this->percentage->calculatePercentageAverage(3, 0);
    }
}