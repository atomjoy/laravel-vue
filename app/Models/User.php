<?php

namespace App\Models;

use App\Traits\Model\HasSearch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
// use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
	/** @use HasFactory<\Database\Factories\UserFactory> */
	use HasFactory, Notifiable;
	use HasRoles;
	use HasSearch;

	/**
	 * Default table name
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * Default guard name
	 *
	 * @var string
	 */
	protected $guard = 'web';

	/**
	 * Display relations with model
	 *
	 * @var array
	 */
	// protected $with = ['roles', 'permissions'];

	/**
	 * Append all user permissions
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
			'email_verified_at' => 'datetime:Y-m-d H:i:s',
			'password' => 'hashed',
		];
	}

	/**
	 * Spatie get all user permissions (direct + roles)
	 */
	public function getPermissionAttribute()
	{
		return $this->getAllPermissions();
	}

	/**
	 * Default guard name permissions
	 *
	 * @var string
	 */
	protected function getDefaultGuardName()
	{
		return 'web';
	}

	// /**
	//  * Get the user comments.
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
