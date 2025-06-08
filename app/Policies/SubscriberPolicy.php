<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Panel\Subscriber;
use Illuminate\Auth\Access\Response;

class SubscriberPolicy
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
	public function view(Admin $admin, Subscriber $subscriber): bool
	{
		return true;
	}

	/**
	 * Determine whether the admin can create models.
	 */
	public function create(Admin $admin): bool
	{
		if ($admin->hasRole(['admin', 'super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can update the model.
	 */
	public function update(Admin $admin, Subscriber $subscriber): bool
	{
		if ($admin->hasRole(['admin', 'super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can delete the model.
	 */
	public function delete(Admin $admin, Subscriber $subscriber): bool
	{
		if ($admin->hasRole(['admin', 'super_admin'])) {
			return true;
		}

		return false;
	}

	/**
	 * Determine whether the admin can restore the model.
	 */
	public function restore(Admin $admin, Subscriber $subscriber): bool
	{
		return $this->delete($admin, $subscriber);
	}

	/**
	 * Determine whether the admin can permanently delete the model.
	 */
	public function forceDelete(Admin $admin, Subscriber $subscriber): bool
	{
		return $this->delete($admin, $subscriber);
	}
}
