<?php

namespace App\Listeners;

use App\Models\User;
use App\Events\ActivateUser;

class AccountActivateListener
{
    public function handle(ActivateUser $event)
    {
        $this->deletePasswordToken($event->user);
    }

    public function deletePasswordToken(User $user)
    {
        $user->forceFill([
            'remember_token' => null
        ])->save();
    }
}
