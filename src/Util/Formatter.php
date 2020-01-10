<?php

namespace App\Util;

interface Formatter
{
    public static function format(array $data): string;
}