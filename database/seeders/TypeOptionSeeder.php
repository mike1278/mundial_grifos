<?php

namespace Database\Seeders;

use App\Models\TypeOption;
use Illuminate\Database\Seeder;

class TypeOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color = TypeOption::create([
            'name' => 'Colores'
        ]);
        $size = TypeOption::create([
            'name' => 'Tamaños'
        ]);
    }
}
