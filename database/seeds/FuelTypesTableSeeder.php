<?php

use Illuminate\Database\Seeder;

class FuelTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fuelTypes = [
            ['name' => 'Etanol'],
            ['name' => 'Gasolina'],
            ['name' => 'Diesel'],
            ['name' => 'Gás natural'],
            ['name' => 'Biodiesel'],
        ];

        foreach ($fuelTypes as $key => $fuelType) {
            $exists = DB::table('fuel_types')
                ->where($fuelType)
                ->first();

            if (empty($exists)) {
                continue;
            }

            $fuelTypes[$key] = null;
        }

        $fuelTypes = array_filter($fuelTypes);

        if (empty($fuelTypes)) {
            return false;
        }

        DB::table('fuel_types')->insert($fuelTypes);
    }
}
