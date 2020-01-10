<?php

namespace Test\Util;

use App\Util\JSONFormatter;
use PHPUnit\Framework\TestCase;

class JSONFormatterTest extends TestCase
{
    public function testFormat()
    {
        $this->assertEquals('{"test":true}', JSONFormatter::format(['test' => true]));
    }
}