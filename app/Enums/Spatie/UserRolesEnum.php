<?php

namespace App\Enums\Spatie;

enum UserRolesEnum: string
{
	case EDITOR = 'editor';
	case MANAGER = 'manager';

	public function label(): string
	{
		return match ($this) {
			static::EDITOR => 'Editors',
			static::MANAGER => 'Managers',
			default => throw new \Exception('Unknown enum value requested for the label.'),
		};
	}
}
