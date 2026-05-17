<?php

namespace App\Enums;

trait EnumMethods
{

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function names(): array
    {
        return array_column(self::cases(), 'name');
    }

}