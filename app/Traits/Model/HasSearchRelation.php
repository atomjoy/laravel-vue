<?php

namespace App\Traits\Model;

use Illuminate\Database\Eloquent\Builder;

/**
 * Model search scopes relation
 *
 * $authors = Author::with([
 * 'books' => fn($query) => $query->where('title', 'LIKE', 'PHP%')])
 * ->whereHas('books', fn($query) =>
 * 		$query->where('title', 'LIKE', 'PHP%')
 * )->get();
 */
trait HasSearchRelation
{
	/**
	 * Scope relations
	 *
	 * Author::withWhereHas('books', fn($query) =>
	 *  	$query->where('title', 'LIKE', 'PHP%')
	 * )->get();
	 */
	public function scopeWithWhereHas($query, $relation, $constraint)
	{
		return $query->whereHas($relation, $constraint)
			->with([$relation => $constraint]);
	}

	/**
	 * Search with admin relation
	 *
	 * @param Builder $query
	 * @param String $str
	 * @return void
	 */
	public function scopeSearchAdmin($query, $str)
	{
		$query->orWhereHas('admin', function ($q) use ($str) {
			$q->where('name', 'LIKE', "%{$str}%");
		});
	}
}
