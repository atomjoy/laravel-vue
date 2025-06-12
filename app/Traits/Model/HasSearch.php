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
		$query->orWhere('name', 'LIKE', "%{$name}%"); // case insensitive
	}

	public function scopeSearchEmail($query, $email)
	{
		$query->orWhere('email', 'LIKE', "%{$email}%");
	}

	public function scopeSearchMobile($query, $mobile)
	{
		$query->orWhere('mobile', 'LIKE', "%{$mobile}%");
	}

	public function scopeSearchTitle($query, $str)
	{
		$query->orWhere('title', 'LIKE', "%{$str}%");
	}

	public function scopeSearchSubject($query, $str)
	{
		$query->orWhere('subject', 'LIKE', "%{$str}%");
	}

	public function scopeSearchLastname($query, $str)
	{
		$query->orWhere('lastname', 'LIKE', "%{$str}%");
	}
}


// Model::whereRaw("UPPER('{$column}') LIKE '%'". strtoupper($value)."'%'");
