<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
	/** @use HasFactory<\Database\Factories\AdminFactory> */
	use HasFactory, Notifiable;
	use HasRoles;

	/**
	 * Default table name
	 *
	 * @var string
	 */
	protected $table = 'admins';

	/**
	 * Default guard name
	 *
	 * @var string
	 */
	protected $guard = 'admin';

	/**
	 * Display relations with model
	 *
	 * @var array
	 */
	// protected $with = ['roles', 'permissions'];

	/**
	 * Append user all permissions
	 *
	 * @var array
	 */
	protected $appends = ['permission'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'f2a',
		'mobile_prefix',
		'mobile',
		'location',
		'avatar',
		'bio',
		'allow_email',
		'allow_sms',
		'address_line1',
		'address_line2',
		'address_city',
		'address_country',
		'address_state',
		'address_postal',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var list<string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'email_verified_at' => 'datetime',
			'password' => 'hashed',
		];
	}

	/**
	 * Default guard name permissions
	 *
	 * @var string
	 */
	protected function getDefaultGuardName()
	{
		return 'admin';
	}

	/**
	 * Spatie get all user permissions (direct + roles)
	 */
	public function getPermissionAttribute()
	{
		return $this->getAllPermissions();
	}

	// /**
	//  * Get the articles for the blog post.
	//  */
	// public function articles(): HasMany
	// {
	// 	return $this->hasMany(Article::class);
	// }

	// /**
	//  * Get the admin comments.
	//  */
	// public function comments(): MorphMany
	// {
	// 	return $this->morphMany(Comment::class, 'commentable');
	// }

	// /**
	//  * Get the users profile.
	//  */
	// public function profile(): MorphOne
	// {
	// 	return $this->morphOne(Profile::class, 'profileable');
	// }
}
