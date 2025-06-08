<?php

namespace App\Traits;

/**
 * Enum trait
 *
 * $names = AllowedFileType::names(); // Returns an array of file type names.
 * $values = AllowedFileType::values(); // Returns an array of file type values.
 * $enumArray = AllowedFileType::array(); // Returns an associative array of values to names.
 */
trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }
}
