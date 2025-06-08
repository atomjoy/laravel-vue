<?php

namespace App\Enums\Spatie\Permissions\Model;

enum DisableEnum: string
{
	case DISABLE_LOGIN = 'disable_login';
	case DISABLE_2FA = 'disable_2fa';
	case DISABLE_EMAIL = 'disable_email';
	case DISABLE_AVATAR = 'disable_avatar';
	case DISABLE_USERNAME = 'disable_username';
}
