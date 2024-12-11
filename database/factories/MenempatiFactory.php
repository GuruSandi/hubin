<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenempatiFactory extends Factory
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
            'instansi_id' => $this->faker->randomElement([1, 2, 3]), 
            // Mengambil ID siswa secara acak
            'siswa_id' => $this->faker->randomElement([1, 2, 3]), 
           
        ];
    }
}
