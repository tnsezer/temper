<?php

namespace Test\Util;

use App\Util\CsvReader;
use PHPUnit\Framework\TestCase;

class CsvReaderTest extends TestCase
{
    /** @var CsvReader $csvReader */
    private $csvReader;

    public function setUp()
    {
        $this->csvReader = new CsvReader('tests/data/export.csv');
    }

    public function testRead(): void
    {
        $array = [
            ['user_id' => '3121', 'created_at' => '2016-07-19', 'onboarding_perentage' => '40'],
            ['user_id' => '3122', 'created_at' => '2016-07-26', 'onboarding_perentage' => '30']
        ];

        $this->assertEquals($array, $this->csvReader->read());
    }
}