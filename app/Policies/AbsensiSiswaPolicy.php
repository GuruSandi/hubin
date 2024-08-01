<?php

namespace App\Policies;

use App\Models\absensisiswa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AbsensiSiswaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        // Semua guru dan admin dapat melihat semua absensi
        return $user->role === 'admin' || $user->role === 'guru';
    }

    /**
     * Determine whether the user can view the absensi siswa.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsensiSiswa  $absensisiswa
     * @return mixed
     */
    public function view(User $user, AbsensiSiswa $absensisiswa)
    {
        // Siswa dapat melihat absensi mereka sendiri, atau jika pengguna adalah guru atau admin
        return $user->id === $absensisiswa->siswa_id || $user->role === 'guru' || $user->role === 'admin';
    }

    /**
     * Determine whether the user can create absensi siswa.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user, absensisiswa $absensisiswa)
    {
        // Hanya admin atau guru yang bisa membuat absensi
        return $user->id === $absensisiswa->user_id || $user->role === 'admin';

    }

    /**
     * Determine whether the user can update the absensi siswa.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsensiSiswa  $absensisiswa
     * @return mixed
     */
    public function update(User $user, absensisiswa $absensisiswa)
    {
        // Siswa dapat mengupdate absensi mereka sendiri atau admin
        return $user->id === $absensisiswa->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the absensi siswa.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AbsensiSiswa  $absensisiswa
     * @return mixed
     */
    public function delete(User $user, AbsensiSiswa $absensisiswa)
    {
        // Hanya admin yang bisa menghapus absensi
        return $user->role === 'admin';
    }
}
