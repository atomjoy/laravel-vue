<?php

namespace App\Traits\Model;

/**
 * Admin model search scopes
 *
 * $q = Model::query();
 * if ($request->filled('search')) { // Not empty
 * 	$q->searchName($request->input('name'));
 * }
 * if ($request->filled('search')) { // Not empty
 * 	$q->searchEmail($request->input('email'));
 * }
 * return $q->latest('id')->paginate(5);
 * return $q->orderBy('id')->paginate(5);
 */
trait HasSearch
{
	public function scopeSearchName($query, $name)
	{
		$query->orWhere('name', 'like', "%{$name}%");
	}

	public function scopeSearchEmail($query, $email)
	{
		$query->orWhere('email', 'like', "%{$email}%");
	}

	public function scopeSearchMobile($query, $mobile)
	{
		$query->orWhere('mobile', 'like', "%{$mobile}%");
	}
}
