<?php

namespace App\Policies;

use App\Models\jurnal;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class JurnalPolicy
{
    use HandlesAuthorization;

    public function create(User $user, jurnal $jurnal)
    {
        return $user->id === $jurnal->user_id || $user->role === 'admin';

    }
    public function update(User $user, jurnal $jurnal)
    {
        // Siswa dapat mengupdate absensi mereka sendiri atau admin
        return $user->id === $jurnal->user_id || $user->role === 'admin';
    }
}
