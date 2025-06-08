<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
	/** @use HasFactory<\Database\Factories\Panel\ContactFactory> */
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'firstname',
		'lastname',
		'email',
		'mobile',
		'subject',
		'message',
		'file',
		'note',
		'ip',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'created_at' => 'datetime:Y-m-d H:i:s',
			'updated_at' => 'datetime:Y-m-d H:i:s',
		];
	}

	/**
	 * Get the user that owns the article.
	 */
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}
}
