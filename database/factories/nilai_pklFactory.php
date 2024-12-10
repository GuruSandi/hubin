<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class nilai_pklFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // Mengambil ID user secara acak
            'user_id' => $this->faker->randomElement([1, 2, 3]), 
            // Mengambil ID guru_mapel_pkl secara acak
            'guru_mapel_pkl_id' => $this->faker->randomElement([1, 2, 3]), 
            // Mengambil ID siswa secara acak
            'siswa_id' => $this->faker->randomElement([1, 2, 3]), 
            // Menghasilkan nilai acak antara 0 dan 100
            'nilai1' => $this->faker->numberBetween(0, 100),
            'nilai2' => $this->faker->numberBetween(0, 100),
            'nilai3' => $this->faker->numberBetween(0, 100),
            'nilai4' => $this->faker->numberBetween(0, 100),
        ];
    }
}
