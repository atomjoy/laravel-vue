<?php

namespace App\Enums\Spatie\Permissions;

use App\Enums\Spatie\Permissions\Model\UserEnum;
use App\Enums\Spatie\Permissions\Model\ArticleEnum;

enum AdminPermissionsEnum: string
{
	case USER_VIEW = UserEnum::USER_VIEW->value;
	case USER_CREATE = UserEnum::USER_CREATE->value;
	case USER_UPDATE = UserEnum::USER_UPDATE->value;
	case USER_DELETE = UserEnum::USER_DELETE->value;

	case ARTICLE_VIEW = ArticleEnum::ARTICLE_VIEW->value;
	case ARTICLE_CREATE = ArticleEnum::ARTICLE_CREATE->value;
	case ARTICLE_UPDATE = ArticleEnum::ARTICLE_UPDATE->value;
	case ARTICLE_DELETE = ArticleEnum::ARTICLE_DELETE->value;
}
