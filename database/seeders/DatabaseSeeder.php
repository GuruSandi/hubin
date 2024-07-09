<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'username'=>'admin',
            'password'=>bcrypt('123'),
            'encrypted_password'=>'123',
            'role'=>'admin',
        ]);
        User::create([
            'username'=>'guru',
            'password'=>bcrypt('123'),
            'encrypted_password'=>'123',
            'role'=>'guru',
        ]);
        User::create([
            'username'=>'siswa',
            'password'=>bcrypt('123'),
            'encrypted_password'=>'123',
            'role'=>'siswa',
        ]);
    }
}
