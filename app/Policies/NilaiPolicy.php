<?php

namespace App\Policies;

use App\Models\nilai_pkl;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NilaiPolicy
{
    use HandlesAuthorization;

    public function update(User $user, nilai_pkl $nilai_pkl)
    {
        return $user->id === $nilai_pkl->user_id || $user->role === 'admin';
    }
}
