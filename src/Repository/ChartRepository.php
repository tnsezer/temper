<?php

namespace App\Repository;

use App\Model\DataInterface;
use App\Util\Percentage;

class ChartRepository implements ChartRepositoryInterface
{
    /** @var DataInterface $connection */
    private $connection;

    /**
     * ChartRepository constructor.
     * @param DataInterface $connection
     */
    public function __construct(DataInterface $connection) {
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws \InvalidArgumentException
     */
    public function all(): array
    {
        return $this->connection->getContextData();
    }
}