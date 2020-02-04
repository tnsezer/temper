<?php

namespace Test\Repository;

use App\Model\Csv;
use App\Repository\ChartRepository;
use App\Util\CsvReader;
use PHPUnit\Framework\TestCase;

class ChartRepositoryTest extends TestCase
{
    /** @var ChartRepository $chartRepository */
    private $chartRepository;

    /** @var MockObject\MockObject|Csv $dataModel */
    private $dataModel;

    public function setUp()
    {
        $this->dataModel = $this->createMock(Csv::class);
        $this->chartRepository = new ChartRepository($this->dataModel);
    }

    public function testAll()
    {
        $csvReader = new CsvReader(DATA_DIR . 'export.csv', ';');
        $dataSource = $csvReader->read();
        $this->dataModel->expects($this->once())
            ->method('getContextData')
            ->willReturn($dataSource);
        $result = $this->chartRepository->all();

        $this->assertEquals($dataSource, $result);
    }
}