<?php

namespace App\Util;

class JSONFormatter implements FormatterInterface {

    /**
     * @param array $data
     * @return string
     */
    public static function format(array $data): string
    {
        return json_encode($data);
    }
}