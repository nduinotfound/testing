<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */

class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->word,
            'kode_barang' => strtoupper($this->faker->bothify('??###')),
            'kategori' => $this->faker->randomElement(['Elektronik', 'ATK', 'Furniture']),
            'jumlah' => $this->faker->numberBetween(1, 50),
            'kondisi' => $this->faker->randomElement(['Baik', 'Rusak', 'Butuh Perbaikan']),
            'lokasi_simpan' => $this->faker->city,
            'tanggal_masuk' => $this->faker->date(),
        ];
    }

}
