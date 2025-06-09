<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\Response;

class AdminPolicy
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
	public function view(Admin $admin, Admin $user): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can create models.
	 */
	public function create(Admin $admin): bool
	{
		// Admins
		if ($admin->hasRole(['super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can update the model.
	 */
	public function update(Admin $admin, Admin $user): bool
	{
		// Admins
		if ($admin->hasRole(['super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Admin $user): bool
	{
		// Admins
		if ($admin->hasRole(['super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Admin $user): bool
	{
		return $this->delete($admin, $user);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Admin $user): bool
	{
		return $this->delete($admin, $user);
	}
}
