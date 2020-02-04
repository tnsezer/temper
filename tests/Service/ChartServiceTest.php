<?php

namespace Test\Service;

use App\Repository\ChartRepository;
use App\Service\ChartService;
use App\Util\CsvReader;
use App\Util\Percentage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChartServiceTest extends TestCase
{
    /** @var ChartService $chartService */
    private $chartService;

    /** @var MockObject|ChartRepository $chartRepository */
    private $chartRepository;

    public function setUp(): void
    {
        $this->chartRepository = $this->createMock(ChartRepository::class);
        $this->chartService = new ChartService($this->chartRepository);
    }

    public function testConvert()
    {
        $this->assertInstanceOf(\DateTime::class, $this->chartService->convert('now'));
    }

    public function testConvertInvalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->chartService->convert('TEST');
    }

    public function testGetSteps()
    {
        $this->assertSame(array_values(Percentage::STEPS),  $this->chartService->getSteps());
    }

    public function testGetWeeklyChartData()
    {
        $csvReader = new CsvReader(DATA_DIR . 'export.csv', ';');
        $this->chartRepository->expects($this->once())
            ->method('all')
            ->willReturn($csvReader->read());

        $result = $this->chartService->getWeeklyChartData();

        $this->assertArrayHasKey('name', current($result));
        $this->assertArrayHasKey('data', current($result));
    }
}