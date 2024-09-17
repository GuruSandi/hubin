<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JurnalFactory extends Factory
{
    protected $model = \App\Models\Jurnal::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3]),
            'guru_mapel_pkl_id' => $this->faker->randomElement([1, 2, 3]),
            'siswa_id' => $this->faker->randomElement([1, 2, 3]),
            'tanggal' => $this->faker->date(),
            'deskripsi_jurnal' => $this->faker->paragraph(),
            'validasi' => $this->faker->randomElement(['tervalidasi', 'belum_tervalidasi', 'ditolak']),
        ];
    }
}
