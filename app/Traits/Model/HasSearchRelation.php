<?php

namespace App\Traits\Model;

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

	public function scopeSearchAddress($query, $str)
	{
		$query->whereHas('address', function ($q) use ($str) {
			$q->where('city', 'LIKE', "%{$str}%");
		});
	}
}
