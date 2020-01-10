<?php

namespace Test\Service;

use App\Repository\ChartRepository;
use App\Service\ChartService;
use App\Util\Percentage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChartServiceTest extends TestCase
{
    /** @var ChartService $chartService */
    private $chartService;

    /** @var MockObject|ChartRepository $chartRepository */
    private $chartRepository;

    /** @var MockObject|Percentage $percentage */
    private $percentage;

    public function setUp()
    {
        $this->chartRepository = $this->createMock(ChartRepository::class);
        $this->percentage = $this->createMock(Percentage::class);
        $this->chartService = new ChartService($this->chartRepository, $this->percentage);
    }

    public function testGetChartData()
    {
        $groupedData = [
            29 => ['count' => 1, '40' => 1],
            30 => ['count' => 3, '20' => 1, '40' => 2]
        ];
        $this->chartRepository->expects($this->once())
            ->method('getGroupedData')
            ->willReturn($groupedData);
        $this->percentage->expects($this->exactly(3))
            ->method('calculatePercentageAverage')
            ->withConsecutive([1,1], [1,3], [2,3])
            ->willReturnOnConsecutiveCalls(100, 33, 67);

        $result = $this->chartService->getChartData();

        $expectResult = [
            'steps' => array_values(Percentage::STEPS),
            'series' => [
                0 => ['name' => '29. week', 'data' => [0,0,100,0,0,0,0,0]],
                1 => ['name' => '30. week', 'data' => [0,33,67,0,0,0,0,0]],
            ]
        ];
        $this->assertEquals($expectResult, $result);
    }
}