<?php

namespace App\Enums\Spatie\Permissions\Model;

enum ArticleEnum: string
{
	case ARTICLE_VIEW = 'article_view';
	case ARTICLE_CREATE = 'article_create';
	case ARTICLE_UPDATE = 'article_update';
	case ARTICLE_DELETE = 'article_delete';
}
