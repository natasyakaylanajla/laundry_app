<?php

namespace Database\Factories;

use App\Models\TransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TransactionDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_transaksi' => $this->faker->numberBetween(1, 20),
            'id_paket' => $this->faker->numberBetween(1, 5),
            'qty' => $this->faker->numberBetween(1, 3),
            'keterangan' => $this->faker->sentence(6),
        ];
    }
}
