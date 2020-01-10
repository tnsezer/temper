<?php

namespace App\Util;

class JSONOutput implements Output
{
    /**
     * @param string $data
     */
    public static function output(string $data): void
    {
        header('Content-type: application/json');
        echo $data;
    }
}