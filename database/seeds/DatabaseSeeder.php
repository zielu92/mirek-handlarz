<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $pathCars = 'database/dbfiles/cars.sql';
        $pathOptions = 'database/dbfiles/options.sql';
        DB::unprepared(file_get_contents($pathCars));
        DB::unprepared(file_get_contents($pathOptions));
        $this->command->info('Brands and models and options table seeded!');
    }


}
