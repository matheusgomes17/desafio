<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * @param \App\Models\User $user
     * @return void
     */
    public function deleting(User $user)
    {
        $user->cars()->sync([]);
    }
}
