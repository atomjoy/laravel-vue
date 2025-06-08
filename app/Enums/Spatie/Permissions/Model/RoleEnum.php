<?php

namespace App\Enums\Spatie\Permissions\Model;

enum RoleEnum: string
{
	case ROLE_VIEW = 'role_view';
	case ROLE_CREATE = 'role_create';
	case ROLE_UPDATE = 'role_update';
	case ROLE_DELETE = 'role_delete';
}
