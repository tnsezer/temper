<?php

namespace App\Util;

interface FormatterInterface
{
    public static function format(array $data): string;
}