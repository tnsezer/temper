<?php

namespace App\Util;

class JSONFormatter implements Formatter {

    /**
     * @param array $data
     * @return string
     */
    public static function format(array $data): string
    {
        return json_encode($data);
    }
}