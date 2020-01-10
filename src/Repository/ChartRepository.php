<?php

namespace App\Repository;

use App\Model\DataInterface;
use App\Util\Percentage;

class ChartRepository implements ChartRepositoryInterface
{
    /** @var DataInterface $connection */
    private $connection;

    /** @var Percentage $percentage */
    private $percentage;

    /**
     * ChartRepository constructor.
     * @param DataInterface $connection
     * @param Percentage $percentage
     */
    public function __construct(DataInterface $connection, Percentage $percentage) {
        $this->connection = $connection;
        $this->percentage = $percentage;
    }

    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getGroupedData(): array
    {
        $records = $this->connection->getContextData();

        $groupedData = [];
        foreach ($records as $record) {
            try {
                $date = new \DateTime($record['created_at']);
            } catch (\Exception $e) {
                throw new \InvalidArgumentException();
            }

            $percentage = $this->percentage->findPercentageInSteps((int) $record['onboarding_perentage']);
            $week = $date->format("W");

            if (!array_key_exists($week, $groupedData)) {
                $groupedData[$week]['count'] = 0;
            }
            if (!array_key_exists($percentage, $groupedData[$week])) {
                $groupedData[$week][$percentage] = 0;
            }

            $groupedData[$week][$percentage]++;
            $groupedData[$week]['count']++;
        }

        return $groupedData;
    }
}