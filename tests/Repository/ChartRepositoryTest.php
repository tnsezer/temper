<?php

namespace Test\Repository;

use App\Model\Csv;
use App\Repository\ChartRepository;
use App\Util\Percentage;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ChartRepositoryTest extends TestCase
{
    /** @var ChartRepository $chartRepository */
    private $chartRepository;

    /** @var MockObject\MockObject|Csv $dataModel */
    private $dataModel;

    /** @var MockObject|Percentage $percentage */
    private $percentage;

    public function setUp()
    {
        $this->dataModel = $this->createMock(Csv::class);
        $this->percentage = $this->createMock(Percentage::class);
        $this->chartRepository = new ChartRepository($this->dataModel, $this->percentage);
    }

    public function testGetGroupedData()
    {
        $data = [
            ['user_id' => '3121', 'created_at' => '2016-07-19', 'onboarding_perentage' => '40'],
            ['user_id' => '3122', 'created_at' => '2016-07-26', 'onboarding_perentage' => '30']
        ];
        $this->dataModel->expects($this->once())
            ->method('getContextData')
            ->willReturn($data);

        $this->percentage->expects($this->exactly(2))
            ->method('findStepInFlow')
            ->withConsecutive([40], [30])
            ->willReturnOnConsecutiveCalls(2, 1);

        $result = $this->chartRepository->getGroupedData();

        $expectResult = [
            29 => [0 => 1, 1 => 1, 2 => 1, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0],
            30 => [0 => 1, 1 => 1, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0]
        ];
        $this->assertEquals($expectResult, $result);
    }
}