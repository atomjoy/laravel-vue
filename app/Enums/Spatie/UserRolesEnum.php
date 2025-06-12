<?php

namespace App\Enums\Spatie;

enum UserRolesEnum: string
{
	case EDITOR = 'editor';
	case MANAGER = 'manager';
	case LITE = 'lite';
	case PRO = 'pro';
	case VIP = 'vip';

	public function label(): string
	{
		return match ($this) {
			// Stuff
			static::EDITOR => 'Editors',
			static::MANAGER => 'Managers',
			static::LITE => 'Lites',
			static::PRO => 'Pros',
			static::VIP => 'Vips',
			default => throw new \Exception('Unknown enum value requested for the label.'),
		};
	}
}
