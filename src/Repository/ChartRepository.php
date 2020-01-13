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

            $percentage = (int)$record['onboarding_perentage'];
            $step = $this->percentage->findStepInFlow($percentage);
            $week = $date->format("W");

            if (!array_key_exists($week, $groupedData)) {
                $groupedData[$week] = array_fill(0, count(Percentage::STEPS), 0);
            }
            for ($i=0; $i <= $step; $i++) {
                $groupedData[$week][$i]++;
            }
        }

        return $groupedData;
    }
}