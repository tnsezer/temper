<?php

namespace App\Controller;

use App\Service\ChartService;
use App\Util\JSONFormatter;
use App\Util\JSONOutput;

class ApiController
{
    public function getWeeklyChartDataAsJson(ChartService $chartService): void
    {
        $steps = $chartService->getSteps();
        $data = $chartService->getWeeklyChartData();

        JSONOutput::output(
            JSONFormatter::format(['steps' => $steps, 'series' =>  $data])
        );
    }
}