<?php

namespace App\Traits;

trait InteractsWithEnumOptions
{
    /**
     * Generate an array of options with value, label, and description for select inputs.
     *
     * @return array
     */
    public static function options(): array
    {
        return array_map(fn($case) => [
            'value' => $case->value,
            'label' => $case->label(),
            'description' => $case->description(),
        ], self::cases());
    }
}
