<?php
require_once '../bootstrap.php';

use App\Controller\ApiController;
use App\Model\Csv;
use App\Repository\ChartRepository;
use App\Service\ChartService;
use App\Util\Percentage;

$csvModel = new Csv();
$percentage = new Percentage();
$chartRepository = new ChartRepository($csvModel, $percentage);
$chartService = new ChartService($chartRepository, $percentage);
$controller = new ApiController();

$controller->getChartData($chartService);