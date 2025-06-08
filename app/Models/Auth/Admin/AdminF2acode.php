<?php

namespace App\Models\Auth\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminF2acode extends Model
{
	use HasFactory, SoftDeletes;

	protected $table = 'adminf2acodes';

	protected $fillable = [
		'user_id',
		'code',
		'hash'
	];

	public function user(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}
}
