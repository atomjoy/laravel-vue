<?php

namespace App\Enums;

use App\Contracts\Enum as Contract;
use App\Traits\InteractsWithEnumOptions;

enum Status: string implements Contract
{
    use InteractsWithEnumOptions;

    case DRAFT = 'draft';
    case PUBLISHED = 'published';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            Status::DRAFT => 'Draft',
            Status::PUBLISHED => 'Published',
            Status::ARCHIVED => 'Archived',
            default => throw new \Exception('Unknown enum value requested for the label'),
        };
    }

    public function description(): string
    {
        return match ($this) {
            Status::DRAFT => 'Draft articles',
            Status::PUBLISHED => 'Published articles',
            Status::ARCHIVED => 'Archived articles',
            default => throw new \Exception('Unknown enum value requested for the description'),
        };
    }

    public function color(): string
    {
        return match ($this) {
            Status::DRAFT => 'grey',
            Status::PUBLISHED => 'green',
            Status::ARCHIVED => 'red',
            default => throw new \Exception('Unknown enum value requested for the color'),
        };
    }
}
