<?php

namespace App\Service;

use App\Repository\ChartRepository;
use App\Util\Percentage;

class ChartService
{

    /** @var ChartRepository $chartRepository */
    private $chartRepository;

    /** @var Percentage $percentage */
    private $percentage;

    /**
     * ChartService constructor.
     * @param ChartRepository $chartRepository
     * @param Percentage $percentage
     */
    public function __construct(ChartRepository $chartRepository, Percentage $percentage)
    {
        $this->chartRepository = $chartRepository;
        $this->percentage = $percentage;
    }

    /**
     * @return array
     */
    public function getChartData(): array
    {
        $groupedData = $this->chartRepository->getGroupedData();

        $defaultData = array_fill_keys( array_keys(Percentage::STEPS), 0);
        $series = [];
        foreach ($groupedData as $week => $data) {
            if (!array_key_exists($week, $series)) {
                $series[$week]['name'] = "$week. week";
                $series[$week]['data'] = $defaultData;
            }
            $total = $data['count'];
            unset($data['count']);
            foreach ($data as $percentage => $count) {
                $series[$week]['data'][$percentage] = $this->percentage->calculatePercentageAverage($count, $total);
            }
            $series[$week]['data'] = array_values($series[$week]['data']);
        }
        ksort($series);

        return ['steps' => array_values(Percentage::STEPS), 'series' => array_values($series)];
    }
}