<?php

namespace App\Util;

class JSONOutput implements OutputInterface
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