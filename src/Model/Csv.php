<?php

namespace App\Model;

use App\Util\CsvReader;

class Csv implements DataInterface
{

    /** @var AbstractCsv $context */
    private $context;

    /**
     * Csv constructor.
     */
    public function __construct()
    {
        $this->context = new CsvReader(DATA_DIR . 'export.csv', ';');
    }

    /**
     * @return array
     */
    public function getContextData(): array
    {
        return $this->context->read();
    }
}