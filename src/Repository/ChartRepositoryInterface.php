<?php

namespace App\Repository;

interface ChartRepositoryInterface
{
    public function getGroupedData(): array;
}