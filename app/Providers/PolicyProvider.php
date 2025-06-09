<?php

namespace App\Providers;

use App\Models\Panel\ArticleMedia;
use App\Policies\ArticleMediaPolicy;

use App\Models\Page\Contact;
use App\Policies\ContactPolicy;

use App\Models\Panel\Subscriber;
use App\Policies\SubscriberPolicy;

use App\Models\User;
use App\Policies\UserPolicy;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PolicyProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		Gate::policy(User::class, UserPolicy::class);
		Gate::policy(Contact::class, ContactPolicy::class);
		Gate::policy(Subscriber::class, SubscriberPolicy::class);
		Gate::policy(ArticleMedia::class, ArticleMediaPolicy::class);

		// Register Policy custom model locations
		// Gate::policy(Subscriber::class, SubscriberPolicy::class);
	}
}
