<?php
require_once '../bootstrap.php';

use App\Controller\ApiController;
use App\Model\Csv;
use App\Repository\ChartRepository;
use App\Service\ChartService;
use App\Util\Percentage;

$csvModel = new Csv();
$chartRepository = new ChartRepository($csvModel);
$percentage = new Percentage();
$chartService = new ChartService($chartRepository, $percentage);
$controller = new ApiController();

$controller->getWeeklyChartDataAsJson($chartService);