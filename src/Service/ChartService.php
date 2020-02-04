<?php

namespace App\Service;

use App\Repository\ChartRepository;
use App\Util\Percentage;

class ChartService
{

    /** @var ChartRepository $chartRepository */
    private $chartRepository;

    /**
     * ChartService constructor.
     * @param ChartRepository $chartRepository
     */
    public function __construct(ChartRepository $chartRepository)
    {
        $this->chartRepository = $chartRepository;
    }

    /**
     * @return array
     */
    public function getWeeklyChartData(): array
    {
        $chartData = $this->chartRepository->all();
        $groupedData = $this->groupedDataWeekly($chartData);
        $series = $this->calculatePercentageAverageWeekly($groupedData);

        return array_values($series);
    }

    /**
     * @return array
     */
    public function getSteps(): array
    {
        return array_values(Percentage::STEPS);
    }

    /**
     * @param string $dateTime
     * @return \DateTime
     * @throws \InvalidArgumentException
     */
    public function convert(string $dateTime): \DateTime
    {
        try {
            return $this->convertToDateTime($dateTime);
        } catch (\Exception $e) {
            throw new \InvalidArgumentException();
        }
    }

    /**
     * @param string $dateTime
     * @return \DateTime
     * @throws \Exception
     */
    private function convertToDateTime(string $dateTime): \DateTime
    {
        return new \DateTime($dateTime);
    }

    /**
     * @param array $records
     * @return array
     */
    private function groupedDataWeekly(array $records): array
    {
        $groupedData = [];
        $defaultData = array_fill(0, count(Percentage::STEPS), 0);
        foreach ($records as $record) {
            $date = $this->convert($record['created_at']);
            $step = Percentage::findStepInFlow(
                (int) $record['onboarding_percentage']
            );
            $week = $date->format("W");

            if (!array_key_exists($week, $groupedData)) {
                $groupedData[$week] = $defaultData;
            }
            for ($i=0; $i <= $step; $i++) {
                $groupedData[$week][$i]++;
            }
        }

        return $groupedData;
    }

    private function calculatePercentageAverageWeekly(array $groupedData): array
    {
        $series = [];
        foreach ($groupedData as $week => $data) {
            if (!array_key_exists($week, $series)) {
                $series[$week]['name'] = $this->makeNameOfWeek($week);
            }

            $total = current($data);
            $series[$week]['data'] = $data;
            foreach ($data as $step => $count) {
                if ($count > 0) {
                    $series[$week]['data'][$step] = Percentage::calculatePercentageAverage($count, $total);
                }
            }
            $series[$week]['data'] = array_values($series[$week]['data']);
        }
        ksort($series);

        return $series;
    }

    /**
     * @param string $week
     * @return string
     */
    private function makeNameOfWeek(string $week): string
    {
        return $week . " week";
    }
}