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
        $path = 'database/dbfiles/cars.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Brands and models table seeded!');
    }


}
