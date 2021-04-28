<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usd = Currency::create([
            'name' => 'Dólares',
            'symbol' => 'USD',
        ])->id;
        $bs = Currency::create([
            'name' => 'Bolivares',
            'symbol' => 'BS',
        ])->id;
        Rate::create([
            'rate' => 1/2500000,
            'currency_id' => $usd,
            'to_currency_id' => $bs,
        ]);
        Rate::create([
            'rate' => 2500000,
            'currency_id' => $bs,
            'to_currency_id' => $usd,
        ]);
    }
}
