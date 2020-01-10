<?php

namespace App\Controller;

use App\Service\ChartService;
use App\Util\JSONFormatter;
use App\Util\JSONOutput;

class ApiController
{
    public function getChartData(ChartService $chartService): void
    {
        $data = $chartService->getChartData();
        JSONOutput::output(
            JSONFormatter::format($data)
        );
    }
}