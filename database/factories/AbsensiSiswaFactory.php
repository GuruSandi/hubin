<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AbsensiSiswaFactory extends Factory
{
    protected $model = \App\Models\AbsensiSiswa::class;

    public function definition()
    {
        return [
            'user_id' =>  $this->faker->randomElement([1, 2, 3]), // Assuming you have a User model
            'siswa_id' =>  $this->faker->randomElement([1, 2, 463]), // Assuming you have a Siswa model
            'tanggal' => $this->faker->date(),
            'latitude' => $this->faker->latitude( -90, 90 ),
            'longitude' => $this->faker->longitude( -180, 180 ),
            'jarak' => $this->faker->numberBetween(0, 1000),
            'jam_masuk' => $this->faker->time(),
            'jam_pulang' => $this->faker->time(),
            'keterangan' => $this->faker->randomElement(['hadir', 'libur', 'absen', 'tidak_hadir_pkl']),
        ];
    }
}
