<?php

namespace Database\Factories;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'id_outlet' => 1,
            'kode_invoice' => $this->faker->uuid(),
            'id_member' => $this->faker->numberBetween(1, 10),
            'batas_waktu' => $this->faker->dateTimeBetween(Carbon::now()->addDays(3), Carbon::now()->addDays(7)),
            'biaya_tambahan' => $this->faker->randomElement([500, 1000, 2000, 3000]),
            'diskon' => $this->faker->randomElement([500, 1000, 2000]),
            'pajak' => $this->faker->randomElement([500, 1000, 2000]),
            'status' => $this->faker->randomElement(['baru', 'proses', 'selesai', 'diambil']),
            'dibayar' => $this->faker->randomElement(['dibayar', 'belum_dibayar']),
            'id_user' => 1,
        ];

        if ($data['dibayar'] == 'dibayar') {
            $data['tgl_bayar'] = $this->faker->dateTimeBetween(Carbon::now()->addDays(3), Carbon::now()->addDays(5));
        } else {
            $data['tgl_bayar'] = null;
        }

        return $data;
    }
}
