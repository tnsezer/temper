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

    public function testFindPercentageInSteps(): void
    {
        $this->assertEquals(20, $this->percentage->findPercentageInSteps(39));
        $this->assertEquals(40, $this->percentage->findPercentageInSteps(40));
    }

    public function testCalculatePercentageAverage(): void
    {
        $this->assertEquals(75, $this->percentage->calculatePercentageAverage(3, 4));
        $this->assertEquals(25, $this->percentage->calculatePercentageAverage(1, 4));
    }
}