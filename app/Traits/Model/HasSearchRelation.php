<?php

namespace App\Traits\Model;

/**
 * Model search scopes relation
 *
 * $authors = Author::with([
 * 'books' => fn($query) => $query->where('title', 'like', 'PHP%')])
 * ->whereHas('books', fn($query) =>
 * 		$query->where('title', 'like', 'PHP%')
 * )->get();
 */
trait HasSearchRelation
{
	/**
	 * Scope relations
	 *
	 * Author::withWhereHas('books', fn($query) =>
	 *  	$query->where('title', 'like', 'PHP%')
	 * )->get();
	 */
	public function scopeWithWhereHas($query, $relation, $constraint)
	{
		return $query->whereHas($relation, $constraint)
			->with([$relation => $constraint]);
	}

	public function scopeSearchName($query, $name)
	{
		$query->whereHas('name', function ($q) use ($name) {
			$q->where('name', 'like', "%{$name}%");
		});
	}

	public function scopeSearchEmail($query, $email)
	{
		$query->whereHas('email', function ($q) use ($email) {
			$q->where('email', 'like', "%{$email}%");
		});
	}

	public function scopeSearchMobile($query, $mobile)
	{
		$query->whereHas('mobile', function ($q) use ($mobile) {
			$q->where('mobile', 'like', "%{$mobile}%");
		});
	}
}
