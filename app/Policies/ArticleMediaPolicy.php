<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Panel\ArticleMedia;
use Illuminate\Auth\Access\Response;

class ArticleMediaPolicy
{
	/**
	 * Determine whether the admin can view any models.
	 */
	public function viewAny(Admin $admin): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can view the model.
	 */
	public function view(Admin $admin, ArticleMedia $articleMedia): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can create models.
	 */
	public function create(Admin $admin): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can update the model.
	 */
	public function update(Admin $admin, ArticleMedia $articleMedia): bool
	{
		// Admins
		if ($admin->hasRole(['admin', 'super_admin'])) {
			return true;
		}

		// Owner
		if ($admin->id == $articleMedia->admin_id) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, ArticleMedia $articleMedia): bool
	{
		// Admins
		if ($admin->hasRole(['admin', 'super_admin'])) {
			return true;
		}

		// Owner
		if ($admin->id == $articleMedia->admin_id) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, ArticleMedia $articleMedia): bool
	{
		return $this->delete($admin, $articleMedia);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, ArticleMedia $articleMedia): bool
	{
		return $this->delete($admin, $articleMedia);
	}
}
