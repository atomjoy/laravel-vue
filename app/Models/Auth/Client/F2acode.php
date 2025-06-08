<?php

namespace App\Models\Auth\Client;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class F2acode extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'f2acodes';

	protected $fillable = [
		'user_id',
		'code',
		'hash'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}
